<?php

namespace App\Http\Controllers;

use App\Models\EmployeesDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeesDirectoryController extends Controller
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
        $list = EmployeesDirectory::where($where)->paginate(10);

          return view('hrmodule.employeesdirectory.list')->with([
            'listData' => $list,
            'pageTitle' => "Employees Directory",
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
       
        return view('hrmodule.employeesdirectory.add')->with([
            'action' => $action,
            'pageTitle' => "Employees Directory",
            'Addform' => "Add New Employees Directory",
            
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
                return redirect('/employeesdirectory/add')
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
                $file->move('./img/uploads/employeesdirectory/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Directory Updated Successfully.');
                EmployeesDirectory::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employees Directory Added Successfully.');
                EmployeesDirectory::insertGetId($input);
            }
            return redirect('/employeesdirectory');
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
     
        $result =  EmployeesDirectory::find($id);
        $action = 'add';
        $editname = "Edit Employees Directory";
        return view('hrmodule.employeesdirectory.add')->with([
            'action' => $action,
            'pageTitle' => "Employees Directory Setting",
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
        $employeesdirectory = EmployeesDirectory::find($id);
        $employeesdirectory->status = 0;
        $employeesdirectory->save();
        Session::flash('message', 'Employees Directory delete successfully');
        return redirect("/employeesdirectory");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeesdirectory'), function () {
            Route::get('/', array('as' => 'employeesdirectory.index', 'uses' => 'EmployeesDirectoryController@index'));
            Route::get('/add', array('as' => 'employeesdirectory.create', 'uses' => 'EmployeesDirectoryController@create'));
            Route::post('/save', array('as' => 'employeesdirectory.save', 'uses' => 'EmployeesDirectoryController@store'));
            Route::get('/edit/{id}', array('as' => 'employeesdirectory.edit', 'uses' => 'EmployeesDirectoryController@edit'));
            Route::post('/update/{id}', array('as' => 'employeesdirectory.update', 'uses' => 'EmployeesDirectoryController@update'));
            Route::get('/delete/{id}', array('as' => 'employeesdirectory.destroy', 'uses' => 'EmployeesDirectoryController@destroy'));
        });
    }
    
}

