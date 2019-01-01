<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Companies;
use App\Models\Stations;
use App\Models\Departments;
use App\Models\EmployeeType;
use App\Models\EmployeeCategory;
use App\Models\EmployeeDesignation;
use App\Models\Employees;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();  
        $master = $this->getmasterfields();
        $list ="";
        return view('hrmodule.dashboard')->with([
            'result' => $this->getResult(),
            'pageTitle' => "Dashboard page",
            'master' => $master,
        ]);
    }



    /*
     * This function return all record
    */
    function getResult($where=array()){

        $obj = new Employees();
        $result = array();
        $result['EmployeeGender'] = $obj->getCountGender($where);
        $result['EmployeeAgeBye'] = $obj->getCountEmployeetype($where);
        echo "<pre>";
        print_r( $result);
        return $result;

        
    }

    
    /*
     *  Employee filter 
     * 
    */

    public function getmasterfields()
    {
        $user_id = Auth::id();
        $master = array();
        $master['Companies']               = Companies::where(['status' => 1,'user_id'=>$user_id])->get()->toArray();
        // $master['Divisions']               = Divisions::where(['status' => 1])->get()->toArray();
        $master['Stations']                = Stations::where(['status'=>1,'user_id'=>$user_id])->get()->toArray();
        $master['Departments']             = Departments::where(['status'=>1,'user_id'=>$user_id])->get()->toArray();
       // $master['EmployeeType']            = EmployeeType::where(['status'=>1,'user_id'=>$user_id])->get()->toArray();
        $master['EmployeeCategory']        = [];//EmployeeCategory::where(['status'=>1])->get()->toArray();
        $master['EmployeeDesignation']     = [];//EmployeeDesignation::where(['status'=>1])->get()->toArray();
        return $master;
    }
 




    
}


