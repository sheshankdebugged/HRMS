<?php

namespace App\Http\Controllers;

use App\Models\Adjustments;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class AdjustmentsController extends Controller
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
                ['employee', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = Adjustments::where($where)->paginate(10);


        // $list = employeesexit::where(['status' => 1])->paginate(10);
        return view('hrmodule.adjustments.list')->with([
            'listData' => $list,
            'pageTitle' => "Adjustments",
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
        return view('hrmodule.adjustments.add')->with([
            'action' => $action,
            'pageTitle' => "Adjustments",
            'Addform' => "Add New Adjustments",
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
                'employee_name' => 'required',
                'amount' => 'required',
                'date' => 'required',
                // 'organization_share' => 'required',
                // 'expiry_date' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addadjustments';
                return redirect('adjustments/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();
            echo "<pre>";

            $input['date'] = ($input['date'] != "") ? date('Y-m-d', strtotime($input['date'])) : $input['date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                // $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Adjustments Updated Successfully.');
                Adjustments::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                // $input['created_at'] = date("Y-m-d H:i:s");
                // $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Adjustments Added Successfully.');
                Adjustments::insertGetId($input);
            }
            return redirect('/adjustments');
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
        $result = Adjustments::find($id);
        $result = Adjustments::find($id);
        $action = 'add';
        $editname = "Edit " . $result->adjustments;
        return view('hrmodule.adjustments.add')->with([
            'action' => $action,
            'pageTitle' => "Adjustments",
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
        $adjustments = Adjustments::find($id);
        $adjustments->status = 0;
        $adjustments->save();
        Session::flash('message', 'Adjustments delete successfully');
        return redirect("/adjustments");
    }

    /**
     * For Setting Job Posts Routes
     */
    public static function routes()
    {
        Route::group(array('prefix' => 'adjustments'), function () {
            Route::get('/', array('as' => 'adjustments.index', 'uses' => 'AdjustmentsController@index'));
            Route::get('/add', array('as' => 'adjustments.create', 'uses' => 'AdjustmentsController@create'));
            Route::post('/save', array('as' => 'adjustments.save', 'uses' => 'AdjustmentsController@store'));
            Route::get('/edit/{id}', array('as' => 'adjustments.edit', 'uses' => 'AdjustmentsController@edit'));
            Route::post('/update/{id}', array('as' => 'adjustments.update', 'uses' => 'AdjustmentsController@create'));
            Route::get('/delete/{id}', array('as' => 'adjustments.destroy', 'uses' => 'AdjustmentsController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();
        $master['EmployeeName'] = Employees::where(['status' => 1])->get()->toArray();
       
        return $master;
    }
}
