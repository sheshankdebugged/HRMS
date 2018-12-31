<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class InsuranceController extends Controller
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
        $list = Insurance::where($where)->paginate(10);


        // $list = employeesexit::where(['status' => 1])->paginate(10);
        return view('hrmodule.insurance.list')->with([
            'listData' => $list,
            'pageTitle' => "Insurance",
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

        return view('hrmodule.insurance.add')->with([
            'action' => $action,
            'pageTitle' => "Insurance",
            'Addform' => "Add New Employee Insurance",
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
                'insurance_title' => 'required',
                'employee_amount' => 'required',
                'organization_share' => 'required',
                'expiry_date' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addinsurance';
                return redirect('insurance/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();
            echo "<pre>";

            $input['expiry_date'] = ($input['expiry_date'] != "") ? date('Y-m-d', strtotime($input['expiry_date'])) : $input['expiry_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Insurance Updated Successfully.');
                Insurance::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['expiry_date'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Insurance Added Successfully.');
                Insurance::insertGetId($input);
            }
            return redirect('/insurance');
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
        $result = Insurance::find($id);
        $result = Insurance::find($id);
        $action = 'add';
        $editname = "Edit " . $result->insurance;
        return view('hrmodule.insurance.add')->with([
            'action' => $action,
            'pageTitle' => "Insurance",
            'Addform' => $editname,
            'result' => $result,
            'master' => $master,
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
        $insurance = Insurance::find($id);
        $insurance->status = 0;
        $insurance->save();
        Session::flash('message', 'Employees Insurance delete successfully');
        return redirect("/insurance");
    }

    /**
     * For Setting Job Posts Routes
     */
    public static function routes()
    {
        Route::group(array('prefix' => 'insurance'), function () {
            Route::get('/', array('as' => 'insurance.index', 'uses' => 'InsuranceController@index'));
            Route::get('/add', array('as' => 'insurance.create', 'uses' => 'InsuranceController@create'));
            Route::post('/save', array('as' => 'insurance.save', 'uses' => 'InsuranceController@store'));
            Route::get('/edit/{id}', array('as' => 'insurance.edit', 'uses' => 'InsuranceController@edit'));
            Route::post('/update/{id}', array('as' => 'insurance.update', 'uses' => 'InsuranceController@create'));
            Route::get('/delete/{id}', array('as' => 'insurance.destroy', 'uses' => 'InsuranceController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();
        $master['Employees'] = Employees::where(['status' => 1])->get()->toArray();
        $master['InsuranceType'] = Insurance::where(['status' => 1])->get()->toArray();
       
        return $master;
    }
}
