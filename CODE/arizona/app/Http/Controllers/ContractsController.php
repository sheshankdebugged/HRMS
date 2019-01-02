<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use App\Models\ContractType;
use App\Models\EmployeeCategory;
use App\Models\Grade;
use App\Models\Stations;
use App\Models\Departments;
use App\Models\EmployeeDesignation;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class ContractsController extends Controller
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
                ['contract_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =Contracts::where($where)->paginate(10);

        // $list = contracts::where(['status' => 1])->paginate(10);
        return view('hrmodule.contracts.list')->with([
            'listData' => $list,
            'pageTitle' => "Contracts",
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
        return view('hrmodule.contracts.add')->with([
            'action' => $action,
            'pageTitle' => "Contracts",
            'Addform' => "Add New Contract",
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
                'contract_title' => 'required'
            ]);
            if ($validator->fails()) {
                $action = 'addcontracts';
                return redirect('/contracts/add')
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
                $file->move('./img/uploads/contracts/', $input['icon_img']);
            }
            echo "<pre>";

       
            $input['contract_start_date'] = ($input['contract_start_date'] !="")?date('Y-m-d',strtotime($input['contract_start_date'])):$input['contract_start_date'];
            $input['contract_end_date']   = ($input['contract_end_date'] !="")?date('Y-m-d',strtotime($input['contract_end_date'])):$input['contract_end_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Contracts Updated Successfully.');
                Contracts::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Contracts Added Successfully.');
                Contracts::insertGetId($input);
            }
            return redirect('/contracts');
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
        $result = Contracts::find($id);
        $action = 'add';
        $editname = "Edit " . $result->employee;
        return view('hrmodule.contracts.add')->with([
            'action' => $action,
            'pageTitle' => "Contracts",
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
        $contracts = Contracts::find($id);
        $contracts->status = 0;
        $contracts->save();
        Session::flash('message', 'Contracts delete successfully');
        return redirect("/contracts");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'contracts'), function () {
            Route::get('/', array('as' => 'contracts.index', 'uses' => 'ContractsController@index'));
            Route::get('/add', array('as' => 'contracts.create', 'uses' => 'ContractsController@create'));
            Route::post('/save', array('as' => 'contracts.save', 'uses' => 'ContractsController@store'));
            Route::get('/edit/{id}', array('as' => 'contracts.edit', 'uses' => 'ContractsController@edit'));
            Route::post('/update/{id}', array('as' => 'contracts.update', 'uses' => 'ContractsController@update'));
            Route::get('/delete/{id}', array('as' => 'contracts.destroy', 'uses' => 'ContractsController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
           $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
           $master['ContractType']            = ContractType::where(['status' => 1])->get()->toArray();
           $master['EmployeeDesignation']     = EmployeeDesignation::where(['status' => 1])->get()->toArray();
           $master['EmployeeCategory']        = EmployeeCategory::where(['status' => 1])->get()->toArray();
           $master['Grade']                   = Grade::where(['status' => 1])->get()->toArray();
           $master['Departments']             = Departments::where(['status' => 1])->get()->toArray();
           $master['Stations']             = Stations::where(['status' => 1])->get()->toArray();
        return $master;
    }
}
