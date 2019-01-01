<?php

namespace App\Http\Controllers;

use App\Models\ManageLeavesTypes;
use Illuminate\Http\Request;
use App\Models\Leaves;
use App\Models\Employees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Session;
use Validator;

class ManageLeavesTypesController extends Controller
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
        $list = ManageLeavesTypes::where($where)->paginate(10);

        // $list = complaints::where(['status' => 1])->paginate(10);
        return view('hrmodule.manageleavestypes.list')->with([
            'listData' => $list,
            'pageTitle' => "Manage Leaves Types",
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
        return view('hrmodule.manageleavestypes.add')->with([
            'action' => $action,
            'pageTitle' => "Manage Leaves Types",
            'Addform' => "Add Leaves Types",
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
                return redirect('/manageleavestypes/add')
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
                $file->move('./img/uploads/manageleavestypes/', $input['icon_img']);
            }

            echo "<pre>";

       
             $input['leave_from'] = ($input['leave_from'] !="")?date('Y-m-d',strtotime($input['leave_from'])):$input['leave_from'];
            // $input['poll_end_date']   = ($input['poll_end_date'] !="")?date('Y-m-d',strtotime($input['poll_end_date'])):$input['poll_end_date'];
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Leaves Types Updated Successfully.');
                ManageLeavesTypes::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Leaves Type  Added Successfully.');
                ManageLeavesTypes::insertGetId($input);
            }
            return redirect('/manageleavestypes');
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
        $result = ManageLeavesTypes::find($id);
        $action = 'add';
        $editname = "Edit Leaves  " . $result->employee;
        return view('hrmodule.manageleavestypes.add')->with([
            'action' => $action,
            'pageTitle' => "Manage Leaves Types",
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
        $ManageLeavesTypes = ManageLeavesTypes::find($id);
        $ManageLeavesTypes->status = 0;
        $ManageLeavesTypes->save();
        Session::flash('message', ' Leaves Type delete successfully');
        return redirect("/manageleavestypes");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'manageleavestypes'), function () {
            Route::get('/', array('as' => 'manageleavestypes.index', 'uses' => 'ManageLeavesTypesController@index'));
            Route::get('/add', array('as' => 'manageleavestypes.create', 'uses' => 'ManageLeavesTypesController@create'));
            Route::post('/save', array('as' => 'manageleavestypes.save', 'uses' => 'ManageLeavesTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'manageleavestypes.edit', 'uses' => 'ManageLeavesTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'manageleavestypes.update', 'uses' => 'ManageLeavesTypesController@update'));
            Route::get('/delete/{id}', array('as' => 'manageleavestypes.destroy', 'uses' => 'ManageLeavesTypesController@destroy'));
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
