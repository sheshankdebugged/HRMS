<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\Employees;
use App\Models\Projects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class AssignmentsController extends Controller
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
                ['assignment_name', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =Assignments::where($where)->paginate(10);

        // $list = Assignments::where(['status'=>1])->paginate(10);
        return view('hrmodule.assignments.list')->with([
            'listData' => $list,
            'pageTitle'=>"Assignments"
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
        return view('hrmodule.assignments.add')->with([
            'action' => $action,
            'pageTitle'=>"Assignments",
            'Addform'  =>"Add New Assignment",
            'master' => $master
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 	bs@hopmanhome.com, triproserv@gmail.com adam.mckinnon75@outlook.com
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if($request->all()){

            $validator = Validator::make($request->all(), [
                'employee_id' => 'required',
                'assignment_name' => 'required',


            ]);
           if ($validator->fails()) {
                $action = 'addassignments';
                return redirect('assignments/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                         'action' => $action
                    ]);
            }

            $input = $request->all();
            echo "<pre>";

       
            $input['start_date'] = ($input['start_date'] !="")?date('Y-m-d',strtotime($input['start_date'])):$input['start_date'];
            $input['due_date']   = ($input['due_date'] !="")?date('Y-m-d',strtotime($input['due_date'])):$input['due_date'];
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Assignment Updated Successfully.');
                assignments::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Assignment  Added Successfully.');
                assignments::insertGetId($input);
            }
            return redirect('/assignments');
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
        $master = $this->getmasterfields();
        $result = Assignments::find($id);
        $action = 'add';
        $editname = "Edit ".$result->assignment_name;
        return view('hrmodule.assignments.add')->with([
            'action' => $action,
            'pageTitle'=>"Assignments",
            'Addform'  =>$editname,
            'result'  =>$result,
            'master' => $master
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
        $assignments = Assignments::find($id);
        $assignments->status = 0;
        $assignments->save();
        Session::flash('message', 'Assignment delete successfully');
        return redirect("/assignments");
    }


    /**
     * For Setting Job Posts Routes
     */
    static function routes() {
          Route::group(array('prefix' => 'assignments'), function() {
            Route::get('/', array('as' => 'assignments.index', 'uses' => 'AssignmentsController@index'));
            Route::get('/add', array('as' => 'assignments.create', 'uses' => 'AssignmentsController@create'));
            Route::post('/save', array('as' => 'assignments.save', 'uses' => 'AssignmentsController@store'));
            Route::get('/edit/{id}', array('as' => 'assignments.edit', 'uses' => 'AssignmentsController@edit'));
            Route::post('/update/{id}', array('as' => 'assignments.create', 'uses' => 'AssignmentsController@create'));
            Route::get('/delete/{id}', array('as' => 'assignments.destroy', 'uses' => 'AssignmentsController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();
           $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
           $master['Projects']            = Projects::where(['status' => 1])->get()->toArray();
        //    $master['EmployeeDesignation']     = EmployeeDesignation::where(['status' => 1])->get()->toArray();
        //    $master['EmployeeCategory']        = EmployeeCategory::where(['status' => 1])->get()->toArray();
        //    $master['Grade']                   = Grade::where(['status' => 1])->get()->toArray();
        //    $master['Departments']             = Departments::where(['status' => 1])->get()->toArray();
        //    $master['Stations']             = Stations::where(['status' => 1])->get()->toArray();
        return $master;
    }
}
