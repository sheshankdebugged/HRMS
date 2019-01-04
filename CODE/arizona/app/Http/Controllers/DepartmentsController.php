<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Employees;
use App\Models\Stations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class DepartmentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : "";
        $where = ['status' => 1, 'user_id' => $user_id];

        if (!empty($searchQuery)) {
            $where = [
                ['department_name', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];
        }

        $list = Departments::where($where)->paginate(10);
        return view('hrmodule.departments.list')->with([
            'listData' => $list,
            'pageTitle' => "Departments",
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
        return view('hrmodule.departments.add')->with([
            'action' => $action,
            'pageTitle' => "Departments",
            'Addform' => "Add New Departments",
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

        $user_id = Auth::user()->id;
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'department_name' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'departments/add';
                return redirect('departments/add')
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
                $file->move('./img/uploads/Departments/', $input['icon_img']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Department Updated Successfully.');
                Departments::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Department Added Successfully.');
                Departments::insertGetId($input);
            }
            return redirect('/departments');
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
        $result = Departments::find($id);
        $action = 'add';
        $master = $this->getmasterfields();
        $editname = "Edit " . $result->department_name;
        return view('hrmodule.departments.add')->with([
            'action' => $action,
            'pageTitle' => "Departments",
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
        $Departments = Departments::find($id);
        $Departments->status = 0;
        $Departments->save();
        Session::flash('message', 'Department deleted Successfully');
        return redirect("/departments");
    }

    /*
     *
     */

    public function getmasterfields()
    {
        $master = array();
        // $master['CompanyType']             = CompanyType::where(['status' => 1])->get()->toArray();
        // $master['Countries']               = Countries::where(['status' => 1])->get()->toArray();
        $master['Stations'] = Stations::where(['status' => 1])->get()->toArray();
        $master['Employees'] = Employees::where(['status' => 1])->get()->toArray();
        $master['Departments'] = Departments::where(['status' => 1])->get()->toArray();
        // $master['EmployeeType']            = EmployeeType::where(['status'=>1])->get()->toArray();
        // $master['EmployeeCategory']        = [];//EmployeeCategory::where(['status'=>1])->get()->toArray();
        // $master['EmployeeDesignation']     = [];//EmployeeDesignation::where(['status'=>1])->get()->toArray();
        return $master;
    }

    public static function routes()
    {
        Route::group(array('prefix' => 'departments'), function () {
            Route::get('/', array('as' => 'departments.index', 'uses' => 'DepartmentsController@index'));
            Route::get('/add', array('as' => 'departments.create', 'uses' => 'DepartmentsController@create'));
            Route::post('/save', array('as' => 'departments.save', 'uses' => 'DepartmentsController@store'));
            Route::get('/edit/{id}', array('as' => 'departments.edit', 'uses' => 'DepartmentsController@edit'));
            Route::post('/update/{id}', array('as' => 'departments.update', 'uses' => 'DepartmentsController@update'));
            Route::get('/delete/{id}', array('as' => 'departments.destroy', 'uses' => 'DepartmentsController@destroy'));
        });
    }

}
