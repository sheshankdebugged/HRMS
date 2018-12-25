<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Companies;
use App\Models\Stations;
use App\Models\Departments;
use App\Models\EmployeeType;
use App\Models\EmployeeCategory;
use App\Models\EmployeeDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        
        $user_id = 1;
        $list = Employee::where(['status'=>1,'user_id'=>$user_id])->paginate(10);
        return view('hrmodule.employees.list')->with([
            'listData' => $list,
            'pageTitle' => "Employees",
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
        return view('hrmodule.employees.add')->with([
            'action' => $action,
            'pageTitle' => "Employees",
            'Addform' => "Add New Employee",
            'master' => $master,
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
        $master = $this->getmasterfields();
        if ($request->all()) {

          /*  $validator = Validator::make($request->all(), [
                'employee_name' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addemployees';
                return redirect('/employees/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            } */

            $input = $request->all();
            if (request()->hasFile('profile_pic')) {
                $file = request()->file('profile_pic');
                $input['employee_profile'] = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./img/uploads/employees/', $input['employee_profile']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Updated Successfully.');
                Employee::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employee  Added Successfully.');
                Employee::insertGetId($input);
            }
            return redirect('/employees');
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
        $result = Employee::find($id);
        $action = 'add';
        $editname = "Edit " . $result->employee_name;
        return view('hrmodule.employees.add')->with([
            'action' => $action,
            'pageTitle' => "employees",
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
        $employees = Employee::find($id);
        $employees->status = 0;
        $employees->save();
        Session::flash('message', 'Employee delete successfully');
        return redirect("/employees");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employees'), function () {
            Route::get('/', array('as' => 'employees.index', 'uses' => 'EmployeeController@index'));
            Route::get('/add', array('as' => 'employees.create', 'uses' => 'EmployeeController@create'));
            Route::post('/save', array('as' => 'employees.save', 'uses' => 'EmployeeController@store'));
            Route::get('/edit/{id}', array('as' => 'employees.edit', 'uses' => 'EmployeeController@edit'));
            Route::post('/update/{id}', array('as' => 'employees.update', 'uses' => 'EmployeeController@update'));
            Route::get('/delete/{id}', array('as' => 'employees.destroy', 'uses' => 'EmployeeController@destroy'));
        });
    }

     /*
     *
     */

    public function getmasterfields()
    {
        $master = array();
        $master['Companies']               = Companies::where(['status' => 1])->get()->toArray();
        $master['Stations']                = Stations::where(['status'=>1])->get()->toArray();
        $master['Departments']             = Departments::where(['status'=>1])->get()->toArray();
        $master['EmployeeType']            = EmployeeType::where(['status'=>1])->get()->toArray();
        $master['EmployeeCategory']        = EmployeeCategory::where(['status'=>1])->get()->toArray();
        $master['EmployeeDesignation']     = EmployeeDesignation::where(['status'=>1])->get()->toArray();
        return $master;
    }
}
