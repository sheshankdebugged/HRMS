<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $list = Projects::where(['status' => 1])->paginate(10);

        // echo "<pre>";
        //print_r($list);

        // die;
        return view('hrmodule.projects.list')->with([
            'listData' => $list,
            'pageTitle' => "Projects",
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
        return view('hrmodule.projects.add')->with([
            'action' => $action,
            'pageTitle' => "Projects",
            'Addform' => "Add New Projects",
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
                'project_title' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addprojects';
                return redirect('/addprojects')
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
                $file->move('./img/uploads/Companies/', $input['icon_img']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Projects  Updated Successfully.');
                Projects::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Projects  Added Successfully.');
                Projects::insertGetId($input);
            }
            return redirect('/projects');
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
        $result = Projects::find($id);
        $action = 'add';
        $editname = "Edit " . $result->project_title;
        return view('hrmodule.projects.add')->with([
            'action' => $action,
            'pageTitle' => "Project",
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

        $Companies = Projects::find($id);
        $Companies->status = 0;
        $Companies->save();
        Session::flash('message', 'Project delete successfully');
        return redirect("/projects");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'projects'), function () {
            Route::get('/', array('as' => 'projects.index', 'uses' => 'ProjectsController@index'));
            Route::get('/add', array('as' => 'projects.create', 'uses' => 'ProjectsController@create'));
            Route::post('/save', array('as' => 'projects.save', 'uses' => 'ProjectsController@store'));
            Route::get('/edit/{id}', array('as' => 'projects.edit', 'uses' => 'ProjectsController@edit'));
            Route::post('/update/{id}', array('as' => 'projects.update', 'uses' => 'ProjectsController@update'));
            Route::get('/delete/{id}', array('as' => 'projects.destroy', 'uses' => 'ProjectsController@destroy'));
        });

    }
}
