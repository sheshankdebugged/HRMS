<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
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

class AttendanceController extends Controller
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
                ['employee_name', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =Attendance::where($where)->paginate(10);

        // $list = complaints::where(['status' => 1])->paginate(10);
        return view('hrmodule.attendance.list')->with([
            'listData' => $list,
            'pageTitle' => "Attendance",
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
        return view('hrmodule.attendance.add')->with([
            'action' => $action,
            'pageTitle' => "Attendance",
            'Addform' => "Add New Attendance",
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
        $master = $this->getmasterfields();
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                  'employee_name' => 'required',
                  'employee_name' => 'required',
                  'attendance_date' => 'required'
            ]);
            if ($validator->fails()) {
                $action = 'addAttendance';
                return redirect('/attendance/add')
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
                $file->move('./img/uploads/attendance/', $input['icon_img']);
            }

            echo "<pre>";

       
             $input['attendance_date'] = ($input['attendance_date'] !="")?date('Y-m-d',strtotime($input['attendance_date'])):$input['attendance_date'];
            // $input['poll_end_date']   = ($input['poll_end_date'] !="")?date('Y-m-d',strtotime($input['poll_end_date'])):$input['poll_end_date'];
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Attendance Updated Successfully.');
                Attendance::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Attendance  Added Successfully.');
                Attendance::insertGetId($input);
            }
            return redirect('/attendance');
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
        $result = Attendance::find($id);
        $action = 'add';
        $editname = "Edit Attendance " . $result->employee;
        return view('hrmodule.attendance.add')->with([
            'action' => $action,
            'pageTitle' => "Attendance",
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
        $attendance = Attendance::find($id);
        $attendance->status = 0;
        $attendance->save();
        Session::flash('message', ' Attendance delete successfully');
        return redirect("/attendance");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'attendance'), function () {
            Route::get('/', array('as' => 'attendance.index', 'uses' => 'AttendanceController@index'));
            Route::get('/add', array('as' => 'attendance.create', 'uses' => 'AttendanceController@create'));
            Route::post('/save', array('as' => 'attendance.save', 'uses' => 'AttendanceController@store'));
            Route::get('/edit/{id}', array('as' => 'attendance.edit', 'uses' => 'AttendanceController@edit'));
            Route::post('/update/{id}', array('as' => 'attendance.update', 'uses' => 'AttendanceController@update'));
            Route::get('/delete/{id}', array('as' => 'attendance.destroy', 'uses' => 'AttendanceController@destroy'));
        });
    }

    public function getmasterfields()
    {
        $master = array();
        $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
        $master['Stations']                = Stations::where(['status'=>1])->get()->toArray();
        $master['Projects']               = Projects::where(['status' => 1])->get()->toArray();               
        return $master;
    }
}
