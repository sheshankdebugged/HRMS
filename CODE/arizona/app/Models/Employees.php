<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\Eloquent\Builder;

class Employees extends Model
{
    protected $table = 'employees';

 
   function getCountGender($where){

   
       return ['total_female'=>DB::table('employees')->where('gender_id', '1')->count(),
               'total_male'=>DB::table('employees')->where('gender_id', '2')->count()   
             ] ;

   }

   function getCountEmployeetype($where){

   return  DB::select("SELECT
    employee_type.name,
    COUNT(employee_type.id) AS Total
  FROM
    employees
  Inner JOIN employee_type ON employee_type.id = employees.employee_type_id $where"); 

   }


   function getCountEmployeeCategory($where){

    return  DB::select("SELECT
      employee_category.name,
      COUNT(employee_category.id) AS Total
    FROM
      employees
    Inner JOIN employee_category ON employee_category.id = employees.employee_type_id $where"); 

     }


     /*
      * 
      */

     function getEmployeeRecord($where){

      return  DB::select("SELECT
      employees.*,
      departments.department_name as department_name,
      stations.station_name as station_name,
      companies.company_name as company_name,
      employee_designation.name as designation_name
    FROM
      employees
    Left JOIN departments ON    departments.id = employees.department_id 
    Left JOIN stations    ON    stations.id = employees.station_id 
    Left JOIN companies   ON    companies.id = employees.company_id 
    Left JOIN employee_designation   ON    employee_designation.id = employees.employee_designation_id 
    
    $where"); 


     }

    function  getCountEmployeeDesgination($where){

      return  DB::select("SELECT
       employee_designation.name as designation_name,
      COUNT(employee_designation.id) AS Total
    FROM
      employees
    Inner JOIN employee_designation ON employee_designation.id = employees.employee_type_id $where"); 

    }

    function  getCountEmployeeDepartments($where){
      return  DB::select("SELECT
      departments.department_name as department_name,
      COUNT(departments.id) AS Total
    FROM
      employees
    Inner JOIN departments ON departments.id = employees.department_id $where"); 

    }

    function getCountEmployeeStations($where){

      return  DB::select("SELECT
      stations.station_name,
      COUNT(stations.id) AS Total
      FROM
      employees
      Inner JOIN stations ON stations.id = employees.station_id $where"); 

    }
     
     
   

}
