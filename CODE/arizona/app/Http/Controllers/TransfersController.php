<?php

namespace App\Http\Controllers;

use App\Models\Transfers;
use App\Models\Employees;
use App\Models\Companies;
use App\Models\Stations;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class TransfersController extends Controller
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
                ['transfer_date', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = Transfers::where($where)->paginate(10);


        // $list = Transfers::where(['status' => 1])->paginate(10);
        return view('hrmodule.transfers.list')->with([
            'listData' => $list,
            'pageTitle' => "Transfers",
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
        return view('hrmodule.transfers.add')->with([
            'action' => $action,
            'pageTitle' => "Transfers",
            'Addform' => "Add New Transfer",
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

            ]);
            if ($validator->fails()) {
                $action = 'addtransfers';
                return redirect('/transfers/add')
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
                $file->move('./img/uploads/transfers/', $input['icon_img']);
            }
            echo "<pre>";

       
            $input['transfer_date'] = ($input['transfer_date'] !="")?date('Y-m-d',strtotime($input['transfer_date'])):$input['transfer_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Transfer  Updated Successfully.');
                Transfers::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Transfer  Added Successfully.');
                Transfers::insertGetId($input);
            }
            return redirect('/transfers');
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
        $result = Transfers::find($id);
        $action = 'add';
        $editname = "Edit Transfer " . $result->employee;
        return view('hrmodule.transfers.add')->with([
            'action' => $action,
            'pageTitle' => "Transfers",
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
        $transfers = transfers::find($id);
        $transfers->status = 0;
        $transfers->save();
        Session::flash('message', 'Transfers delete successfully');
        return redirect("/transfers");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'transfers'), function () {
            Route::get('/', array('as' => 'transfers.index', 'uses' => 'TransfersController@index'));
            Route::get('/add', array('as' => 'transfers.create', 'uses' => 'TransfersController@create'));
            Route::post('/save', array('as' => 'transfers.save', 'uses' => 'TransfersController@store'));
            Route::get('/edit/{id}', array('as' => 'transfers.edit', 'uses' => 'TransfersController@edit'));
            Route::post('/update/{id}', array('as' => 'transfers.update', 'uses' => 'TransfersController@update'));
            Route::get('/delete/{id}', array('as' => 'transfers.destroy', 'uses' => 'TransfersController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
           $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
           $master['Companies']               = Companies::where(['status' => 1])->get()->toArray();
           $master['Stations']                = Stations::where(['status' => 1])->get()->toArray();
           $master['Departments']             = Departments::where(['status' => 1])->get()->toArray();
        return $master;
    }
}

