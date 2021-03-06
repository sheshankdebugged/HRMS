<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmployeesExit;
use App\Models\Employees;
use App\Models\EmployeeExitType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeesExitController extends Controller
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
                ['employee', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = EmployeesExit::where($where)->paginate(10);


        // $list = employeesexit::where(['status' => 1])->paginate(10);
        return view('hrmodule.employeesexit.list')->with([
            'listData' => $list,
            'pageTitle' => "Employees Exit",
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
        return view('hrmodule.employeesexit.add')->with([
            'action' => $action,
            'pageTitle' => "Employees Exit",
            'Addform' => "Add New Employees Exit",
            'master' => $master
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
                'employee_id' => 'required',
                'exit_date' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addemployeesexit';
                return redirect('employeesexit/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();
            echo "<pre>";
            // die($input['exit_date']);
            $input['exit_date'] = ($input['exit_date'] != "") ? date('Y-m-d', strtotime($input['exit_date'])) : $input['exit_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Exit Updated Successfully.');
                EmployeesExit::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Exit  Added Successfully.');
                EmployeesExit::insertGetId($input);
            }
            return redirect('/employeesexit');
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
        $result = EmployeesExit::find($id);
        $action = 'add';
        $editname = "Edit " . $result->employees_exit;
        return view('hrmodule.employeesexit.add')->with([
            'action' => $action,
            'pageTitle' => "Employees Exit",
            'Addform' => $editname,
            'result' => $result,
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
        $employeesexit = EmployeesExit::find($id);
        $employeesexit->status = 0;
        $employeesexit->save();
        Session::flash('message', 'Employees Exit delete successfully');
        return redirect("/employeesexit");
    }

    /**
     * For Setting Job Posts Routes
     */
    public static function routes()
    {
        Route::group(array('prefix' => 'employeesexit'), function () {
            Route::get('/', array('as' => 'employeesexit.index', 'uses' => 'EmployeesExitController@index'));
            Route::get('/add', array('as' => 'employeesexit.create', 'uses' => 'EmployeesExitController@create'));
            Route::post('/save', array('as' => 'employeesexit.save', 'uses' => 'EmployeesExitController@store'));
            Route::get('/edit/{id}', array('as' => 'employeesexit.edit', 'uses' => 'EmployeesExitController@edit'));
            Route::post('/update/{id}', array('as' => 'employeesexit.update', 'uses' => 'EmployeesExitController@create'));
            Route::get('/delete/{id}', array('as' => 'employeesexit.destroy', 'uses' => 'EmployeesExitController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();
           $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
           $master['EmployeeExitType']       = EmployeeExitType::where(['status' => 1])->get()->toArray();
        //    $master['Stations']                = Stations::where(['status' => 1])->get()->toArray();
        //    $master['Departments']             = Departments::where(['status' => 1])->get()->toArray();
        return $master;
    }

}
