<?php

namespace App\Http\Controllers;

use App\Models\Advancesalary;
use App\Models\Employees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class AdvancesalaryController extends Controller
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
                ['advancesalary_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = advancesalary::where($where)->paginate(10);

        // $list = advancesalary::where(['status' => 1])->paginate(10);
        return view('hrmodule.advancesalary.list')->with([
            'listData' => $list,
            'pageTitle' => "Advance Salary",
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
        return view('hrmodule.advancesalary.add')->with([
            'action' => $action,
            'pageTitle' => "Advance Salary",
            'Addform' => "Add New Advance Salary",
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
                'employee_id' => 'required',
                'advancesalary_title' => 'required',
                'advancesalary_amount' => 'required',
                'advancesalary_date' => 'required'
            ]);
            if ($validator->fails()) {
                $action = 'addadvancesalary';
                return redirect('/advancesalary/add')
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
                $file->move('./img/uploads/advancesalary/', $input['icon_img']);
            }

            echo "<pre>";

       
        
             $input['advancesalary_date'] = ($input['advancesalary_date'] !="")?date('Y-m-d',strtotime($input['advancesalary_date'])):$input['advancesalary_date'];
            
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Advance Salary Updated Successfully.');
                advancesalary::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Advance Salary  Added Successfully.');
                advancesalary::insertGetId($input);
            }
            return redirect('/advancesalary');
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
        $result = advancesalary::find($id);
        $action = 'add';
        $editname = "Edit advancesalary " . $result->employee;
        return view('hrmodule.advancesalary.add')->with([
            'action' => $action,
            'pageTitle' => "Advance Salary",
            'Addform' => $editname,
            'result' => $result,
            'master' =>  $master
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
        $advancesalary = advancesalary::find($id);
        $advancesalary->status = 0;
        $advancesalary->save();
        Session::flash('message', ' Advance Salary delete successfully');
        return redirect("/advancesalary");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'advancesalary'), function () {
            Route::get('/', array('as' => 'advancesalary.index', 'uses' => 'AdvancesalaryController@index'));
            Route::get('/add', array('as' => 'advancesalary.create', 'uses' => 'AdvancesalaryController@create'));
            Route::post('/save', array('as' => 'advancesalary.save', 'uses' => 'AdvancesalaryController@store'));
            Route::get('/edit/{id}', array('as' => 'advancesalary.edit', 'uses' => 'AdvancesalaryController@edit'));
            Route::post('/update/{id}', array('as' => 'advancesalary.update', 'uses' => 'AdvancesalaryController@update'));
            Route::get('/delete/{id}', array('as' => 'advancesalary.destroy', 'uses' => 'AdvancesalaryController@destroy'));
        });
    }

    public function getmasterfields()
    {
        $master = array();
        $master['Employees'] = Employees::where(['status' => 1])->get()->toArray();
        $master['Payslip'] = Advancesalary::where(['status' => 1])->get()->toArray();

       
        return $master;
    }
}

