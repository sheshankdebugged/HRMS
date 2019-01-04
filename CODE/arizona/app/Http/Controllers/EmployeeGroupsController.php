<?php

namespace App\Http\Controllers;

use App\Models\EmployeeGroups;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;
class EmployeeGroupsController extends Controller
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
        
        // if(!empty($searchQuery)){
        //     $where = [
        //         ['employeedesignations_title', 'LIKE', "%$searchQuery%"],
        //         ['status', '=', 1],
        //         ['user_id', '=', $user_id],
        //     ];   
        // }
        $list = EmployeeGroups::where($where)->paginate(10);

          return view('hrmodule.employeegroups.list')->with([
            'listData' => $list,
            'pageTitle' => "Employee Groups",
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
        return view('hrmodule.employeegroups.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Groups",
            'Addform' => "Add New Employee Groups",
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
                
                              
            ]);
            if ($validator->fails()) {
                $action = 'addemployeegroups';
                return redirect('/employeegroups/add')
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
                $file->move('./img/uploads/employeegroups/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Groups Updated Successfully.');
                EmployeeGroups::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Groups  Added Successfully.');
                EmployeeGroups::insertGetId($input);
            }
            return redirect('/employeegroups');
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
        $result =  EmployeeGroups::find($id);
        $action = 'add';
        $editname = "Edit " . $result->title;
        return view('hrmodule.employeegroups.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Groups",
            'Addform' => $editname,
            'result' => $result,
            'master'  =>  $master
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
        $employeegroups = EmployeeGroups::find($id);
        $employeegroups->status = 0;
        $employeegroups->save();
        Session::flash('message', 'Employee Groups delete successfully');
        return redirect("/employeegroups");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeegroups'), function () {
            Route::get('/', array('as' => 'employeegroups.index', 'uses' => 'EmployeeGroupsController@index'));
            Route::get('/add', array('as' => 'employeegroups.create', 'uses' => 'EmployeeGroupsController@create'));
            Route::post('/save', array('as' => 'employeegroups.save', 'uses' => 'EmployeeGroupsController@store'));
            Route::get('/edit/{id}', array('as' => 'employeegroups.edit', 'uses' => 'EmployeeGroupsController@edit'));
            Route::post('/update/{id}', array('as' => 'employeegroups.update', 'uses' => 'EmployeeGroupsController@update'));
            Route::get('/delete/{id}', array('as' => 'employeegroups.destroy', 'uses' => 'EmployeeGroupsController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
        $master['Employees'] = Employees::where(['status' => 1])->get()->toArray();
        // $master['Repayment_Type'] = Loans::where(['status' => 1])->get()->toArray();

       
        return $master;
    }
}

