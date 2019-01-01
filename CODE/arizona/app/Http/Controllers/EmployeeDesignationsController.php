<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDesignations;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;
class EmployeeDesignationsController extends Controller
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
                ['employeedesignations_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =  EmployeeDesignations::where($where)->paginate(10);

          return view('hrmodule.employeedesignations.list')->with([
            'listData' => $list,
            'pageTitle' => "Employee Designations",
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
        return view('hrmodule.employeedesignations.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Designations",
            'Addform' => "Add New Employee Designations",
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
                // ' employeedesignations_title' => 'required',
                // ' employeedesignations_date' => 'required',
                // 'monthly_repayment_amount' => 'required',
                // 'repayment_start_date' => 'required'                    
            ]);
            if ($validator->fails()) {
                $action = 'addemployeedesignations';
                return redirect('/employeedesignations/add')
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
                $file->move('./img/uploads/employeedesignations/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            // $input['employeedesignations_date'] = ($input['employeedesignations_date'] !="")?date('Y-m-d',strtotime($input[' employeedesignations_date'])):$input[' employeedesignations_date'];
            // $input['repayment_start_date'] = ($input['repayment_start_date'] !="")?date('Y-m-d',strtotime($input['repayment_start_date'])):$input['repayment_start_date'];

            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Designations Updated Successfully.');
                EmployeeDesignations::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Designations  Added Successfully.');
                EmployeeDesignations::insertGetId($input);
            }
            return redirect('/employeedesignations');
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
        $result =  EmployeeDesignations::find($id);
        $action = 'add';
        $editname = "Edit Boan " . $result->employee;
        return view('hrmodule.employeedesignations.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Designations",
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
        $employeedesignations = EmployeeDesignations::find($id);
        $employeedesignations->status = 0;
        $employeedesignations->save();
        Session::flash('message', ' Employee Designations delete successfully');
        return redirect("/employeedesignations");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeedesignations'), function () {
            Route::get('/', array('as' => 'employeedesignations.index', 'uses' => 'EmployeeDesignationsController@index'));
            Route::get('/add', array('as' => 'employeedesignations.create', 'uses' => 'EmployeeDesignationsController@create'));
            Route::post('/save', array('as' => 'employeedesignations.save', 'uses' => 'EmployeeDesignationsController@store'));
            Route::get('/edit/{id}', array('as' => 'employeedesignations.edit', 'uses' => 'EmployeeDesignationsController@edit'));
            Route::post('/update/{id}', array('as' => 'employeedesignations.update', 'uses' => 'EmployeeDesignationsController@update'));
            Route::get('/delete/{id}', array('as' => 'employeedesignations.destroy', 'uses' => 'EmployeeDesignationsController@destroy'));
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

