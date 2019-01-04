<?php

namespace App\Http\Controllers;

use App\Models\EmployeesDirectorySettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeesDirectorySettingsController extends Controller
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
        $list = EmployeesDirectorySettings::where($where)->paginate(10);

          return view('hrmodule.employeesdirectorysettings.list')->with([
            'listData' => $list,
            'pageTitle' => "Employees Directory Settings",
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
       
        return view('hrmodule.employeesdirectorysettings.add')->with([
            'action' => $action,
            'pageTitle' => "Employees Directory Settings",
            'Addform' => "Add New Employees Directory Settings",
            
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
                // 'training_title' => 'required', 
                // 'training_start_date' => 'required', 
                // 'training_end_date' => 'required'                              
            ]);
            if ($validator->fails()) {
                $action = 'addemployeegroups';
                return redirect('/employeesdirectorysettings/add')
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
                $file->move('./img/uploads/employeesdirectorysettings/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Directory Settings Updated Successfully.');
                EmployeesDirectorySettings::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Directory Settings Added Successfully.');
                EmployeesDirectorySettings::insertGetId($input);
            }
            return redirect('/employeesdirectorysettings');
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
     
        $result =  EmployeesDirectorySettings::find($id);
        $action = 'add';
        $editname = "Edit Employees Directory Settings";
        return view('hrmodule.employeesdirectorysettings.add')->with([
            'action' => $action,
            'pageTitle' => "Employees Directory Settings Setting",
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
        $employeesdirectorysettings = EmployeesDirectorySettings::find($id);
        $employeesdirectorysettings->status = 0;
        $employeesdirectorysettings->save();
        Session::flash('message', 'Employees Directory Settings delete successfully');
        return redirect("/employeesdirectorysettings");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeesdirectorysettings'), function () {
            Route::get('/', array('as' => 'employeesdirectorysettings.index', 'uses' => 'EmployeesDirectorySettingsController@index'));
            Route::get('/add', array('as' => 'employeesdirectorysettings.create', 'uses' => 'EmployeesDirectorySettingsController@create'));
            Route::post('/save', array('as' => 'employeesdirectorysettings.save', 'uses' => 'EmployeesDirectorySettingsController@store'));
            Route::get('/edit/{id}', array('as' => 'employeesdirectorysettings.edit', 'uses' => 'EmployeesDirectorySettingsController@edit'));
            Route::post('/update/{id}', array('as' => 'employeesdirectorysettings.update', 'uses' => 'EmployeesDirectorySettingsController@update'));
            Route::get('/delete/{id}', array('as' => 'employeesdirectorysettings.destroy', 'uses' => 'EmployeesDirectorySettingsController@destroy'));
        });
    }
    
}

