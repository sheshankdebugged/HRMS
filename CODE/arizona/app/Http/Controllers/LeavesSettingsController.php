<?php

namespace App\Http\Controllers;

use App\Models\LeavesSettings;
use Illuminate\Http\Request;
use App\Models\Leaves;
use App\Models\Employees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class LeavesSettingsController extends Controller
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
                ['reason', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =LeavesSettings::where($where)->paginate(10);

        // $list = complaints::where(['status' => 1])->paginate(10);
        return view('hrmodule.leavessettings.list')->with([
            'listData' => $list,
            'pageTitle' => "Leaves Settings",
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
        return view('hrmodule.leavessettings.add')->with([
            'action' => $action,
            'pageTitle' => "Leaves Settings",
            'Addform' => "Leaves Settings",
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
                //   'employee' => 'required',
                //   'regular_hours' => 'required',
                  
            ]);
            if ($validator->fails()) {
                $action = 'addRegularhours';
                return redirect('/leavessettings/add')
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
                $file->move('./img/uploads/leavessettings/', $input['icon_img']);
            }

            echo "<pre>";

       
             $input['leave_from'] = ($input['leave_from'] !="")?date('Y-m-d',strtotime($input['leave_from'])):$input['leave_from'];
            // $input['poll_end_date']   = ($input['poll_end_date'] !="")?date('Y-m-d',strtotime($input['poll_end_date'])):$input['poll_end_date'];
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Leaves Updated Successfully.');
                Leaves::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Leaves  Added Successfully.');
                Leaves::insertGetId($input);
            }
            return redirect('/leavessettings');
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
        $result = LeavesSettings::find($id);
        $action = 'add';
        $editname = "Edit Leaves  " . $result->employee;
        return view('hrmodule.leavessettings.add')->with([
            'action' => $action,
            'pageTitle' => "Leaves Settings",
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
        $LeavesSettings = LeavesSettings::find($id);
        $LeavesSettings->status = 0;
        $LeavesSettings->save();
        Session::flash('message', ' Leaves Settings delete successfully');
        return redirect("/leavessettings");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'leavessettings'), function () {
            Route::get('/', array('as' => 'leavessettings.index', 'uses' => 'LeavesSettingsController@index'));
            Route::get('/add', array('as' => 'leavessettings.create', 'uses' => 'LeavesSettingsController@create'));
            Route::post('/save', array('as' => 'leavessettings.save', 'uses' => 'LeavesSettingsController@store'));
            Route::get('/edit/{id}', array('as' => 'leavessettings.edit', 'uses' => 'LeavesSettingsController@edit'));
            Route::post('/update/{id}', array('as' => 'leavessettings.update', 'uses' => 'LeavesSettingsController@update'));
            Route::get('/delete/{id}', array('as' => 'leavessettings.destroy', 'uses' => 'LeavesSettingsController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
        $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
        // $master['Stations']                = Stations::where(['status'=>1])->get()->toArray();
        // $master['Projects']               = Projects::where(['status' => 1])->get()->toArray();               
        return $master;
    }
}
