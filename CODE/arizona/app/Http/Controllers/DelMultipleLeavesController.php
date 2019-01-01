<?php

namespace App\Http\Controllers;

use App\Models\DelMultipleLeaves;
use Illuminate\Http\Request;
use App\Models\Leaves;
use App\Models\Employees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Session;
use Validator;

class DelMultipleLeavesController extends Controller
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
    $list =DelMultipleLeaves::where($where)->paginate(10);

    // $list = complaints::where(['status' => 1])->paginate(10);
    return view('hrmodule.delmultipleleaves.list')->with([
        'listData' => $list,
        'pageTitle' => "Delete Multiple Leaves",
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
    return view('hrmodule.delmultipleleaves.add')->with([
        'action' => $action,
        'pageTitle' => "Leaves",
        'Addform' => "Add New Leaves",
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
            //   'regular_hours' => 'required',
              
        ]);
        if ($validator->fails()) {
            $action = 'addRegularhours';
            return redirect('/delmultipleleaves/add')
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
        return redirect('/delmultipleleaves');
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
    $editname = "Edit Leaves  " . $result->employee;
    return view('hrmodule.delmultipleleaves.add')->with([
        'action' => $action,
        'pageTitle' => "Employee Leaves",
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
    $DelMultipleLeaves = DelMultipleLeaves::find($id);
    $DelMultipleLeaves->status = 0;
    $DelMultipleLeaves->save();
    Session::flash('message', ' Employee Leaves delete successfully');
    return redirect("/delmultipleleaves");
}
public static function routes()
{
        Route::group(array('prefix' => 'delmultipleleaves'), function () {
        Route::get('/', array('as' => 'delmultipleleaves.index', 'uses' => 'DelMultipleLeavesController@index'));
        Route::get('/add', array('as' => 'delmultipleleaves.create', 'uses' => 'DelMultipleLeavesController@create'));
        Route::post('/save', array('as' => 'delmultipleleaves.save', 'uses' => 'DelMultipleLeavesController@store'));
        Route::get('/edit/{id}', array('as' => 'delmultipleleaves.edit', 'uses' => 'DelMultipleLeavesController@edit'));
        Route::post('/update/{id}', array('as' => 'delmultipleleaves.update', 'uses' => 'DelMultipleLeavesController@update'));
        Route::get('/delete/{id}', array('as' => 'delmultipleleaves.destroy', 'uses' => 'DelMultipleLeavesController@destroy'));
    });
}
}
