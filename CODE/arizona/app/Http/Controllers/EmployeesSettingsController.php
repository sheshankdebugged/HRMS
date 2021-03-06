<?php

namespace App\Http\Controllers;

use App\Models\EmployeesSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeesSettingsController extends Controller
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
        $list = EmployeesSettings::where($where)->paginate(10);

        // $list = employeessettings::where(['status' => 1])->paginate(10);
        return view('hrmodule.employeessettings.list')->with([
            'listData' => $list,
            'pageTitle' => "Employees Settings",
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
        return view('hrmodule.employeessettings.add')->with([
            'action' => $action,
            'pageTitle' => "Employees Settings",
            'Addform' => "Add New Contract",
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
                'employee' => 'required',
                'contract_title' => 'required'
            ]);
            if ($validator->fails()) {
                $action = 'addemployeessettings';
                return redirect('/employeessettings/add')
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
                $file->move('./img/uploads/employeessettings/', $input['icon_img']);
            }
            echo "<pre>";

       
            // $input['contract_start_date'] = ($input['contract_start_date'] !="")?date('Y-m-d',strtotime($input['contract_start_date'])):$input['contract_start_date'];
            // $input['contract_end_date']   = ($input['contract_end_date'] !="")?date('Y-m-d',strtotime($input['contract_end_date'])):$input['contract_end_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Settings Updated Successfully.');
                EmployeesSettings::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Settings Added Successfully.');
                EmployeesSettings::insertGetId($input);
            }
            return redirect('/employeessettings');
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
        $result = EmployeesSettings::find($id);
        $action = 'add';
        $editname = "Edit " . $result->employee;
        return view('hrmodule.employeessettings.add')->with([
            'action' => $action,
            'pageTitle' => "Employees Settings",
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
        $employeessettings = employeesSSettings::find($id);
        $employeessettings->status = 0;
        $employeessettings->save();
        Session::flash('message', 'Employees Settings delete successfully');
        return redirect("/employeessettings");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeessettings'), function () {
            Route::get('/', array('as' => 'employeessettings.index', 'uses' => 'EmployeesSettingsController@index'));
            Route::get('/add', array('as' => 'employeessettings.create', 'uses' => 'EmployeesSettingsController@create'));
            Route::post('/save', array('as' => 'employeessettings.save', 'uses' => 'EmployeesSettingsController@store'));
            Route::get('/edit/{id}', array('as' => 'employeessettings.edit', 'uses' => 'EmployeesSettingsController@edit'));
            Route::post('/update/{id}', array('as' => 'employeessettings.update', 'uses' => 'EmployeesSettingsController@update'));
            Route::get('/delete/{id}', array('as' => 'employeessettings.destroy', 'uses' => 'EmployeesSettingsController@destroy'));
        });
    }
}
