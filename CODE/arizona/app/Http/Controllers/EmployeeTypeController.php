<?php

namespace App\Http\Controllers;

use App\Models\EmployeeType;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;


class EmployeeTypeController extends Controller
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
        $list = EmployeeType::where($where)->paginate(10);

          return view('hrmodule.employeetype.list')->with([
            'listData' => $list,
            'pageTitle' => "Employee Type",
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
        return view('hrmodule.employeetype.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Type",
            'Addform' => "Add New Employee Type",
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
                $action = 'employeetype';
                return redirect('/employeetype/add')
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
                $file->move('./img/uploads/employeetype/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Type Updated Successfully.');
                EmployeeType::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Type  Added Successfully.');
                EmployeeType::insertGetId($input);
            }
            return redirect('/employeetype');
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
        $result =  EmployeeType::find($id);
        $action = 'add';
        $editname = "Edit " . $result->name;
        return view('hrmodule.employeetype.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Type",
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
        $employeetype = EmployeeType::find($id);
        $employeetype->status = 0;
        $employeetype->save();
        Session::flash('message', 'Employee Type delete successfully');
        return redirect("/employeetype");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeetype'), function () {
            Route::get('/', array('as' => 'employeetype.index', 'uses' => 'EmployeeTypeController@index'));
            Route::get('/add', array('as' => 'employeetype.create', 'uses' => 'EmployeeTypeController@create'));
            Route::post('/save', array('as' => 'employeetype.save', 'uses' => 'EmployeeTypeController@store'));
            Route::get('/edit/{id}', array('as' => 'employeetype.edit', 'uses' => 'EmployeeTypeController@edit'));
            Route::post('/update/{id}', array('as' => 'employeetype.update', 'uses' => 'EmployeeTypeController@update'));
            Route::get('/delete/{id}', array('as' => 'employeetype.destroy', 'uses' => 'EmployeeTypeController@destroy'));
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

