<?php

namespace App\Http\Controllers;

use App\Models\AddMultipleEmployeeHours;
use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Companies;
use App\Models\Employees;
use App\Models\Stations;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;


class AddMultipleEmployeeHoursController extends Controller
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
                ['job_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = AddMultipleEmployeeHours::where($where)->paginate(10);
        // $list['job_post_closing_date'] = date('MM d, y', strtotime($list['job_post_closing_date']))
        return view('hrmodule.addmultipleemployeehours.list')->with([
            'listData' => $list,
            'pageTitle' => "Add Multiple Employee Hours",
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

        return view('hrmodule.addmultipleemployeehours.add')->with([
            'action' => $action,
            'pageTitle' => "Add Multiple Employee Hours",
            'Addform' => "Add Multiple Employee Hours",
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
        $master = $this->getmasterfields();
        if ($request->all()) {
            $validator = Validator::make($request->all(), [
                // 'job_title' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'addjobpost';
                return redirect('addmultipleemployeehours/add
                ')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();

            // echo "<pre>";
            // print_r($input); die;

            $input['status'] = 1;
            $input['user_id'] = Auth::id();

            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Multiple Employee Hours  Updated Successfully.');
                AddMultipleEmployeeHours::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Multiple Employee Hours Added Successfully.');
                AddMultipleEmployeeHours::insertGetId($input);
            }
            return redirect('/addmultipleemployeehours');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddMultipleEmployeeHours  $jobPosts
     * @return \Illuminate\Http\Response
     */
    public function show(AddMultipleEmployeeHours $jobPosts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddMultipleEmployeeHours  $jobPosts
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'edit';
       
        $result = AddMultipleEmployeeHours::find($id);
        $action = 'add';
        $editname = "Edit " . $result->job_title;
        $master = $this->getmasterfields();
        return view('hrmodule.addmultipleemployeehours.add')->with([
            'action' => $action,
            'pageTitle' => "Job Posts",
            'Addform' => $editname,
            'result' => $result,
            'master' => $master,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddMultipleEmployeeHours  $jobPosts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddMultipleEmployeeHours $jobPosts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Models\AddMultipleEmployeeHours  $jobPosts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = AddMultipleEmployeeHours::find($id);
        $job->is_deleted = 1;
        $job->updated_at = date('Y-m-d H:i:s');
        $job->save();
        Session::flash('message', 'Multiple Employee Hours deleted successfully');
        return redirect("/addmultipleemployeehours");
    }

    /**
     * For Setting Job Posts Routes
     */
    public static function routes()
    {
        Route::group(array('prefix' => 'addmultipleemployeehours'), function () {
            Route::get('/', array('as' => 'addmultipleemployeehours.index', 'uses' => 'AddMultipleEmployeeHoursController@index'));
            Route::get('/add', array('as' => 'addmultipleemployeehours.create', 'uses' => 'AddMultipleEmployeeHoursController@create'));
            Route::post('/save', array('as' => 'addmultipleemployeehours.save', 'uses' => 'AddMultipleEmployeeHoursController@store'));
            Route::get('/edit/{id}', array('as' => 'addmultipleemployeehours.edit', 'uses' => 'AddMultipleEmployeeHoursController@edit'));
            Route::post('/update/{id}', array('as' => 'addmultipleemployeehours.create', 'uses' => 'AddMultipleEmployeeHoursController@create'));
            Route::get('/delete/{id}', array('as' => 'addmultipleemployeehours.destroy', 'uses' => 'AddMultipleEmployeeHoursController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();
         $master['Companies']            = Companies::where(['status' => 1])->get()->toArray();
         $master['Stations'] = Stations::where(['status' => 1])->get()->toArray();
         $master['Departments'] = Departments::where(['status' => 1])->get()->toArray();
         $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
         $master['Projects']               = Projects::where(['status' => 1])->get()->toArray();
        return $master;
    }
}
