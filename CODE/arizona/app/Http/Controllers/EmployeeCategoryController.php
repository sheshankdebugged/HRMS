<?php

namespace App\Http\Controllers;

use App\Models\EmployeeCategor;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;
class EmployeeCategoryController extends Controller
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
        $list = EmployeeCategory::where($where)->paginate(10);

          return view('hrmodule.employeecategory.list')->with([
            'listData' => $list,
            'pageTitle' => "Employee Category",
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
        return view('hrmodule.employeecategory.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Category",
            'Addform' => "Add New Employee Category",
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
                'name' => 'required',
                              
            ]);
            if ($validator->fails()) {
                $action = 'addemployeecategory';
                return redirect('/employeecategory/add')
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
                $file->move('./img/uploads/employeecategory/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Category Updated Successfully.');
                EmployeeCategory::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Category  Added Successfully.');
                EmployeeCategory::insertGetId($input);
            }
            return redirect('/employeecategory');
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
        $result =  EmployeeCategory::find($id);
        $action = 'add';
        $editname = "Edit " . $result->name;
        return view('hrmodule.employeecategory.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Category",
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
        $employeecategory = EmployeeCategory::find($id);
        $employeecategory->status = 0;
        $employeecategory->save();
        Session::flash('message', 'Employee Category delete successfully');
        return redirect("/employeecategory");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeecategory'), function () {
            Route::get('/', array('as' => 'employeecategory.index', 'uses' => 'EmployeeCategoryController@index'));
            Route::get('/add', array('as' => 'employeecategory.create', 'uses' => 'EmployeeCategoryController@create'));
            Route::post('/save', array('as' => 'employeecategory.save', 'uses' => 'EmployeeCategoryController@store'));
            Route::get('/edit/{id}', array('as' => 'employeecategory.edit', 'uses' => 'EmployeeCategoryController@edit'));
            Route::post('/update/{id}', array('as' => 'employeecategory.update', 'uses' => 'EmployeeCategoryController@update'));
            Route::get('/delete/{id}', array('as' => 'employeecategory.destroy', 'uses' => 'EmployeeCategoryController@destroy'));
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

