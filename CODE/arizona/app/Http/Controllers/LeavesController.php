<?php

namespace App\Http\Controllers;

use App\Models\Leaves;
use App\Models\Employees;
use App\Models\Manageleavestypes;
use App\Models\LeaveDuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class LeavesController extends Controller
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
        $list =Leaves::where($where)->paginate(10);

        // $list = complaints::where(['status' => 1])->paginate(10);
        return view('hrmodule.leaves.list')->with([
            'listData' => $list,
            'pageTitle' => "Leaves",
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
        return view('hrmodule.leaves.add')->with([
            'action' => $action,
            'pageTitle' => "Leaves",
            'Addform' => "Add New Leaves",
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
                //   'regular_hours' => 'required',
                  
            ]);
            if ($validator->fails()) {
                $action = 'addRegularhours';
                return redirect('/leaves/add')
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
                $file->move('./img/uploads/leaves/', $input['icon_img']);
            }

            echo "<pre>";

       
             $input['leave_from'] = ($input['leave_from'] !="")?date('Y-m-d',strtotime($input['leave_from'])):$input['leave_from'];
             $input['leave_to'] = ($input['leave_to'] !="")?date('Y-m-d',strtotime($input['leave_to'])):$input['leave_to'];
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
                Session::flash('message', 'Employee Leave Added Successfully.');
                Leaves::insertGetId($input);
            }
            return redirect('/leaves');
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
        $result = Leaves::find($id);
        $action = 'add';
        $master = $this->getmasterfields();
        $editname = "Edit Leaves  " . $result->employee;
        return view('hrmodule.leaves.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Leaves",
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
        $Leaves = Leaves::find($id);
        $Leaves->status = 0;
        $Leaves->save();
        Session::flash('message', ' Employee Leaves delete successfully');
        return redirect("/leaves");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'leaves'), function () {
            Route::get('/', array('as' => 'leaves.index', 'uses' => 'LeavesController@index'));
            Route::get('/add', array('as' => 'leaves.create', 'uses' => 'LeavesController@create'));
            Route::post('/save', array('as' => 'leaves.save', 'uses' => 'LeavesController@store'));
            Route::get('/edit/{id}', array('as' => 'leaves.edit', 'uses' => 'LeavesController@edit'));
            Route::post('/update/{id}', array('as' => 'leaves.update', 'uses' => 'LeavesController@update'));
            Route::get('/delete/{id}', array('as' => 'leaves.destroy', 'uses' => 'LeavesController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
        $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
        $master['ManageLeavesTypes']      = Manageleavestypes::where(['status'=>1])->get()->toArray();
        $master['LeaveDurations']          = LeaveDuration::where(['status' => 1])->get()->toArray();               
        return $master;
    }
}
