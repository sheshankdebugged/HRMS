<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrganizationNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class OrganizationNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = OrganizationNews::where(['status' => 1])->paginate(10);

        return view('hrmodule.organizationNews.list')->with([
            'listData' => $list,
            'pageTitle' => "Organization News",
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $action = 'add';
        return view('hrmodule.organizationNews.add')->with([
            'action' => $action,
            'pageTitle' => "Organization News",
            'Addform' => "Add News",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'news_title' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'organizationnews';
                return redirect('/organizationnews/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();
            if (request()->hasFile('news_images')) {
                $file = request()->file('news_images');
                $input['news_images'] = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./img/uploads/news/', $input['news_images']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Projects  Updated Successfully.');
                OrganizationNews::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Projects  Added Successfully.');
                OrganizationNews::insertGetId($input);
            }
            return redirect('/organizationnews');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $action = 'edit';
        $result = OrganizationNews::find($id);
        $action = 'add';
        $editname = "Edit " . $result->news_title;
        return view('hrmodule.organizationnews.add')->with([
            'action' => $action,
            'pageTitle' => "OrganizationNews",
            'Addform' => $editname,
            'result' => $result,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projects $projects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Companies = OrganizationNews::find($id);
        $Companies->status = 0;
        $Companies->save();
        Session::flash('message', 'News delete successfully');
        return redirect("/organizationnews");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'organizationnews'), function () {
            Route::get('/', array('as' => 'OrganizationNews.index', 'uses' => 'OrganizationNewsController@index'));
            Route::get('/add', array('as' => 'OrganizationNews.create', 'uses' => 'OrganizationNewsController@create'));
            Route::post('/save', array('as' => 'OrganizationNews.save', 'uses' => 'OrganizationNewsController@store'));
            Route::get('/edit/{id}', array('as' => 'OrganizationNews.edit', 'uses' => 'OrganizationNewsController@edit'));
            Route::post('/update/{id}', array('as' => 'OrganizationNews.update', 'uses' => 'OrganizationNewsController@update'));
            Route::get('/delete/{id}', array('as' => 'OrganizationNews.destroy', 'uses' => 'OrganizationNewsController@destroy'));
        });

    }
}
