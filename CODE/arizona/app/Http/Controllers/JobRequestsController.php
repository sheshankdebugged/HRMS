<?php

namespace App\Http\Controllers;
use App\Models\JobRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class JobRequestsController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = jobRequests::where(['status' => 1])->paginate(10);
        return view('hrmodule.jobrequest.list')->with([
            'listData' => $list,
            'pageTitle' => "jobrequest",
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
        return view('hrmodule.jobrequest.add')->with([
            'action' => $action,
            'pageTitle' => "jobrequest",
            'Addform' => "Add New Company",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *     bs@hopmanhome.com, triproserv@gmail.com adam.mckinnon75@outlook.com
     */
    public function store(Request $request)
    {

        $user_id = Auth::id();
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'job_title' => 'required',

            ]);

            if ($validator->fails()) {
                $action = 'addjobrequest';
                return redirect('/jobrequest/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();
            if (request()->hasFile('icon_img')) {
                $file = request()->file('icon_img');
                $input['icon_img'] = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./img/uploads/jobrequest/', $input['icon_img']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'JobRequest  Updated Successfully.');
                jobRequests::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'JobRequest  Added Successfully.');
                jobRequests::insertGetId($input);
            }
            return redirect('/jobrequest');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'edit';  
        $result = jobRequests::find($id);
        $action = 'add';
        $editname = "Edit " . $result->job_title;
        return view('hrmodule.jobrequest.add')->with([
            'action' => $action,
            'pageTitle' => "jobrequest",
            'Addform' => $editname,
            'result' => $result,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobrequest = jobRequests::find($id);
        $jobrequest->status = 0;
        $jobrequest->save();
        Session::flash('message', 'Company delete successfully');
        return redirect("/jobrequest");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'jobrequest'), function () {
            Route::get('/', array('as' => 'jobrequest.index', 'uses' => 'JobRequestsController@index'));
            Route::get('/add', array('as' => 'jobrequest.create', 'uses' => 'JobRequestsController@create'));
            Route::post('/save', array('as' => 'jobrequest.save', 'uses' => 'JobRequestsController@store'));
            Route::get('/edit/{id}', array('as' => 'jobrequest.edit', 'uses' => 'JobRequestsController@edit'));
            Route::post('/update/{id}', array('as' => 'jobrequest.update', 'uses' => 'JobRequestsController@update'));
            Route::get('/delete/{id}', array('as' => 'jobrequest.destroy', 'uses' => 'JobRequestsController@destroy'));
        });
    }
    
}
