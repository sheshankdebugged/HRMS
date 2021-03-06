<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;
use App\Models\Companies;
use App\Models\Countries;
use App\Models\Departments;
use App\Models\Divisions;
use App\Models\EmployeeCategory;
use App\Models\EmployeeDesignation;
use App\Models\Employees;
use App\Models\EmployeeType;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Salutation;
use App\Models\Stations;
use App\Models\WorkShifts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeesController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {

        $userParent = Auth::user();
        $user_id    = Auth::id();  // user_id
        $parent_id =0;
        if($userParent->employee_id > 0){
            $parent_id = $userParent->parent_user_id; // organisation id
        }

        // 
        
        if($parent_id){
            
        }
     
        
        //     $list = employees::where(['status'=>1,'user_id'=>$user_id])->paginate(10);
        //     return view('hrmodule.employees.list')->with([
        //         'listData' => $list,
        //         'pageTitle' => "Employees",
        //     ]);

        // $user_id = Auth::id();
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : "";
        $where = ['status' => 1, 'user_id' => $user_id];

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

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'addemployees';
                return redirect('/employees/add')
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
                $file->move('./img/uploads/employees/', $input['employee_profile']);
            }
            $input['status'] = 1;
            $input['employee_name'] = $input['first_name'] . ' ' . $input['last_name'];
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                $input['dob'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Updated Successfully.');
                Employees::where('id', $input['id'])->update($input);
                $this->createUser($employee_id, $input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                $input['dob'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Added Successfully.');
                $employee_id = Employees::insertGetId($input);
                $this->createUser($employee_id, $input);
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
        $result = Employees::find($id);
        $action = 'add';
        $editname = "Edit " . $result->employee_name;
        $master = $this->getmasterfields();
        return view('hrmodule.employees.add')->with([
            'action' => $action,
            'pageTitle' => "employees",
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
        $employees = Employees::find($id);
        $employees->status = 0;
        $employees->save();
        Session::flash('message', 'Employee delete successfully');
        return redirect("/employees");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'employees'), function () {
            Route::get('/', array('as' => 'employees.index', 'uses' => 'EmployeesController@index'));
            Route::get('/add', array('as' => 'employees.create', 'uses' => 'EmployeesController@create'));
            Route::post('/save', array('as' => 'employees.save', 'uses' => 'EmployeesController@store'));
            Route::get('/edit/{id}', array('as' => 'employees.edit', 'uses' => 'EmployeesController@edit'));
            Route::post('/update/{id}', array('as' => 'employees.update', 'uses' => 'EmployeesController@update'));
            Route::get('/delete/{id}', array('as' => 'employees.destroy', 'uses' => 'EmployeesController@destroy'));
        });
    }

    /*
     *
     */

    public function getmasterfields()
    {
        $master = array();
        $master['Companies'] = Companies::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['Countries'] = Countries::where(['status' => 1])->get()->toArray();
        $master['Divisions'] = Divisions::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['Stations'] = Stations::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['Departments'] = Departments::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['EmployeeType'] = EmployeeType::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['EmployeeCategory'] = EmployeeCategory::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['Employees'] = Employees::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['Salutations'] = Salutation::where(['status' => 1])->get()->toArray();
        $master['Genders'] = Gender::where(['status' => 1])->get()->toArray();
        $master['BloodGroups'] = BloodGroup::where(['status' => 1])->get()->toArray();
        $master['Nationalities'] = Nationality::where(['status' => 1])->get()->toArray();
        $master['Religions'] = Religion::where(['status' => 1])->get()->toArray();
        $master['MaritalStatus'] = MaritalStatus::where(['status' => 1])->get()->toArray();
        $master['EmployeeDesignation'] = EmployeeDesignation::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['Grades'] = Grade::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        $master['WorkShifts'] = WorkShifts::where(['status' => 1, 'user_id' => Auth::id()])->get()->toArray();
        return $master;
    }

    /*
     * create usere
     */

    public function createUser($employee_id, $data)
    {

        /*return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        ]); */

        $userData['employee_id'] = $employee_id;
        $userData['email'] = $data['email_address'];
        $userData['parent_user_id'] = Auth::id();
        $userData['name'] = $data['first_name'];
        $userData['created_at'] = date("Y-m-d H:i:s");
        $userData['updated_at'] = date("Y-m-d H:i:s");
        $userData['password'] = Hash::make($data['password']);
        $employee_id = User::insertGetId($userData);

    }
}
