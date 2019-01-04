<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTrainingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeeTrainingSettingController extends Controller
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
        $list = EmployeeTrainingSetting::where($where)->paginate(10);

          return view('hrmodule.employeetrainingsetting.list')->with([
            'listData' => $list,
            'pageTitle' => "Employee Training Setting",
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
       
        return view('hrmodule.employeetrainingsetting.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Training Setting",
            'Addform' => "Add New Employee Training Setting",
            
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
                return redirect('/employeetrainingsetting/add')
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
                $file->move('./img/uploads/employeetrainingsetting/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Training Setting Updated Successfully.');
                EmployeeTrainingSetting::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Training Setting  Added Successfully.');
                EmployeeTrainingSetting::insertGetId($input);
            }
            return redirect('/employeetrainingsetting/add');
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
     
        $result =  EmployeeTrainingSetting::find($id);
        $action = 'add';
        $editname = "Edit Employee Training ";
        return view('hrmodule.employeetrainingsetting.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Training Setting",
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
        $employeetrainingsetting = EmployeeTrainingSetting::find($id);
        $employeetrainingsetting->status = 0;
        $employeetrainingsetting->save();
        Session::flash('message', 'Employee Training Setting delete successfully');
        return redirect("/employeetrainingsetting/add");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeetrainingsetting'), function () {
            Route::get('/', array('as' => 'employeetrainingsetting.index', 'uses' => 'EmployeeTrainingSettingController@index'));
            Route::get('/add', array('as' => 'employeetrainingsetting.create', 'uses' => 'EmployeeTrainingSettingController@create'));
            Route::post('/save', array('as' => 'employeetrainingsetting.save', 'uses' => 'EmployeeTrainingSettingController@store'));
            Route::get('/edit/{id}', array('as' => 'employeetrainingsetting.edit', 'uses' => 'EmployeeTrainingSettingController@edit'));
            Route::post('/update/{id}', array('as' => 'employeetrainingsetting.update', 'uses' => 'EmployeeTrainingSettingController@update'));
            Route::get('/delete/{id}', array('as' => 'employeetrainingsetting.destroy', 'uses' => 'EmployeeTrainingSettingController@destroy'));
        });
    }
    
}

