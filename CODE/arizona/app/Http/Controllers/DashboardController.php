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
        $user_id = Auth::id();
        $where   = "where employees.user_id = $user_id and employees.status =1 ";
        $where  .=  $this->filterRequest();
        $result['EmployeeGender']        = $obj->getCountGender($where);
        $result['EmployeeRecord']        = json_decode(json_encode($obj->getEmployeeRecord($where)), true); 
        $result['EmployeeType']          = json_decode(json_encode($obj->getCountEmployeetype($where)), true);
        $result['EmployessByCategory']   = json_decode(json_encode($obj->getCountEmployeeCategory($where)), true);
        $result['EmployessDesgination']  = json_decode(json_encode($obj->getCountEmployeeDesgination($where)), true);  
        $result['EmployessDepartments']  = json_decode(json_encode($obj->getCountEmployeeDepartments($where)), true);  
        $result['EmployessStations']     = json_decode(json_encode($obj->getCountEmployeeStations($where)), true);  
 

        
        return  $result;
        
    }

    

     function filterRequest(){
        
       
        if(isset($_GET)){

            $companies ="";

            if(!empty($_GET['companies'])){

                $implodeCompanies =implode(',',$_GET['companies']);
                $companies ="AND employees.company_id in ($implodeCompanies)";
            }

            $status ="";
           
            if(!empty($_GET['status'])){
                
                $status ="AND employees.status =".$_GET['status'];
            }
             
            $stations ="";
            if(!empty($_GET['stations'])){
                
                $implodestations =implode(',',$_GET['stations']);  
                $stations ="AND employees.station_id =".$implodestations;
            }
            
            $departments ="";
            if(!empty($_GET['departments'])){

                $implodedepartments =implode(',',$_GET['departments']);
                $departments ="AND employees.station_id =".$implodedepartments;
            }

            return $companies."  ".$status."  ".$departments."  ".$stations;
        }

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


