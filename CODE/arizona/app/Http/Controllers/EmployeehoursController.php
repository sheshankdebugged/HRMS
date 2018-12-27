<?php

namespace App\Http\Controllers;

use App\Models\Employeehours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeehoursController extends Controller
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
                ['regular_hours', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =Employeehours::where($where)->paginate(10);

        // $list = complaints::where(['status' => 1])->paginate(10);
        return view('hrmodule.employeehours.list')->with([
            'listData' => $list,
            'pageTitle' => "Employee Hours",
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
        return view('hrmodule.employeehours.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Hours",
            'Addform' => "Add New Employee Hours",
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
                  'regular_hours' => 'required',
                  
            ]);
            if ($validator->fails()) {
                $action = 'addRegularhours';
                return redirect('/employeehours/add')
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
                $file->move('./img/uploads/employeehours/', $input['icon_img']);
            }

            echo "<pre>";

       
             $input['date'] = ($input['date'] !="")?date('Y-m-d',strtotime($input['date'])):$input['date'];
            // $input['poll_end_date']   = ($input['poll_end_date'] !="")?date('Y-m-d',strtotime($input['poll_end_date'])):$input['poll_end_date'];
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Hours Updated Successfully.');
                Employeehours::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Hours  Added Successfully.');
                Employeehours::insertGetId($input);
            }
            return redirect('/employeehours');
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
        $result = Employeehours::find($id);
        $action = 'add';
        $editname = "Edit Employee Hours " . $result->employee;
        return view('hrmodule.employeehours.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Hours",
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
        $attendance = Employeehours::find($id);
        $attendance->status = 0;
        $attendance->save();
        Session::flash('message', ' Employee Hours delete successfully');
        return redirect("/employeehours");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeehours'), function () {
            Route::get('/', array('as' => 'employeehours.index', 'uses' => 'EmployeehoursController@index'));
            Route::get('/add', array('as' => 'employeehours.create', 'uses' => 'EmployeehoursController@create'));
            Route::post('/save', array('as' => 'employeehours.save', 'uses' => 'EmployeehoursController@store'));
            Route::get('/edit/{id}', array('as' => 'employeehours.edit', 'uses' => 'EmployeehoursController@edit'));
            Route::post('/update/{id}', array('as' => 'employeehours.update', 'uses' => 'EmployeehoursController@update'));
            Route::get('/delete/{id}', array('as' => 'employeehours.destroy', 'uses' => 'EmployeehoursController@destroy'));
        });
    }
}
