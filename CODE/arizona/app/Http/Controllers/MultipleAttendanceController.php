<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\MultipleAttendance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;

class MultipleAttendanceController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {

        $userParent = Auth::user();
        $user_id = Auth::id(); // user_id
        $parent_id = 0;
        if ($userParent->employee_id > 0) {
            $parent_id = $userParent->parent_user_id; // organisation id
        }
        if ($parent_id) {

        }

        //     $list = multipleattendance::where(['status'=>1,'user_id'=>$user_id])->paginate(10);
        //     return view('hrmodule.multipleattendance.list')->with([
        //         'listData' => $list,
        //         'pageTitle' => "Employees",
        //     ]);

        // $user_id = Auth::id();
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : "";
        $where = ['status' => 1];

        if (!empty($searchQuery)) {
            $where = [
                //     ['first_name', 'LIKE', "%$searchQuery%"],
                //     ['email_address', 'LIKE', "%$searchQuery%"],
                //     ['department', 'LIKE', "%$searchQuery%"],
                //     ['status', '=', 1],
                //     ['user_id', '=', $user_id],
            ];
        }
        $list = Employees::where($where)->paginate(10);
        return view('hrmodule.multipleattendance.list')->with([
            'listData' => $list,
            'pageTitle' => "Multiple Employees Attendance",
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
        return view('hrmodule.multipleattendance.add')->with([
            'action' => $action,
            'pageTitle' => "Multiple Employyes Attendance",
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

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'addmultipleattendance';
                return redirect('/multipleattendance/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();
            if (request()->hasFile('profile_pic')) {
                $file = request()->file('profile_pic');
                $input['employee_profile'] = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./img/uploads/multipleattendance/', $input['employee_profile']);
            }
            $input['status'] = 1;
            $input['employee_name'] = $input['first_name'] . ' ' . $input['last_name'];
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                $input['dob'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Attendance Updated Successfully.');
                MultipleAttendance::where('id', $input['id'])->update($input);
                $this->createUser($employee_id, $input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                $input['dob'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Attendance Added Successfully.');
                $employee_id = MultipleAttendance::insertGetId($input);
                $this->createUser($employee_id, $input);
            }
            return redirect('/multipleattendance');
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
        $result = MultipleAttendance::find($id);
        $action = 'add';
        $editname = "Edit " . $result->employee_name;
        $master = $this->getmasterfields();
        return view('hrmodule.multipleattendance.add')->with([
            'action' => $action,
            'pageTitle' => "multipleattendance",
            'Addform' => $editname,
            'result' => $result,
            'master' => $master,
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
        $multipleattendance = MultipleAttendance::find($id);
        $multipleattendance->status = 0;
        $multipleattendance->save();
        Session::flash('message', 'Employee Attendance delete successfully');
        return redirect("/multipleattendance");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'multipleattendance'), function () {
            Route::get('/', array('as' => 'multipleattendance.index', 'uses' => 'MultipleAttendanceController@index'));
            Route::get('/add', array('as' => 'multipleattendance.create', 'uses' => 'MultipleAttendanceController@create'));
            Route::post('/save', array('as' => 'multipleattendance.save', 'uses' => 'MultipleAttendanceController@store'));
            Route::get('/edit/{id}', array('as' => 'multipleattendance.edit', 'uses' => 'MultipleAttendanceController@edit'));
            Route::post('/update/{id}', array('as' => 'multipleattendance.update', 'uses' => 'MultipleAttendanceController@update'));
            Route::get('/delete/{id}', array('as' => 'multipleattendance.destroy', 'uses' => 'MultipleAttendanceController@destroy'));
        });
    }

    /*
     *
     */

    public function getmasterfields()
    {
        $master = array();
        // $master['Companies'] = Companies::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        return $master;
    }
}
