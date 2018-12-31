<?php

namespace App\Http\Controllers;

use App\Models\JobTests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use App\Models\JobPosts;
use Session;
use Validator;

class JobTestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $searchQuery  = isset($_GET['search'])?trim($_GET['search']):"";
        $where   = ['status'=>1,'user_id'=>$user_id];
        
        if(!empty($searchQuery)){
            $where = [
                ['test_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $user_id = Auth::id();
        $list = JobTests::where($where)->paginate(10);
        return view('hrmodule.jobtest.list')->with([
            'listData' => $list,
            'pageTitle' => "Job Tests",
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
        $master = $this->getmasterfields();
        return view('hrmodule.jobtest.add')->with([
            'action' => $action,
            'pageTitle' => "Job Tests",
            'Addform' => "Add New Job Test",
            'master' => $master,
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
                'test_title' => 'required',

            ]);

            if ($validator->fails()) {
                $action = 'addjobtests';
                return redirect('/jobtests/add')
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
                $file->move('./img/uploads/jobtets/', $input['icon_img']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'JobTests  Updated Successfully.');
                JobTests::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Job Test  Added Successfully.');
                JobTests::insertGetId($input);
            }
            return redirect('/jobtests');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobTests  $jobTests
     * @return \Illuminate\Http\Response
     */
    public function show(JobTests $jobTests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobTests  $jobTests
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'edit';
        $result = JobTests::find($id);
        $action = 'add';
        $editname = "Edit " . $result->test_title;
        $master = $this->getmasterfields();
        return view('hrmodule.jobtest.add')->with([
            'action' => $action,
            'pageTitle' => "Job Tests",
            'Addform' => $editname,
            'result' => $result,
            'master' => $master,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobTests  $jobTests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobTests $jobTests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobTests  $jobTests
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobtest = JobTests::find($id);
        $jobtest->status = 0;
        $jobtest->save();
        Session::flash('message', 'Job Test delete successfully');
        return redirect("/jobtests");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'jobtests'), function () {
            Route::get('/', array('as' => 'jobtests.index', 'uses' => 'JobTestsController@index'));
            Route::get('/add', array('as' => 'jobtests.create', 'uses' => 'JobTestsController@create'));
            Route::post('/save', array('as' => 'jobtests.save', 'uses' => 'JobTestsController@store'));
            Route::get('/edit/{id}', array('as' => 'jobtests.edit', 'uses' => 'JobTestsController@edit'));
            Route::post('/update/{id}', array('as' => 'jobtests.update', 'uses' => 'JobTestsController@update'));
            Route::get('/delete/{id}', array('as' => 'jobtests.destroy', 'uses' => 'JobTestsController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
        $master['JobPosts']  = JobPosts::where(['status'=>1])->get()->toArray();
        return $master;
    }
}
