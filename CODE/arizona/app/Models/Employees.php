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

    

  /*return  DB::select('SELECT
  employee_type.name,
  COUNT(employee_type.id) AS Total
FROM
  employees
Inner JOIN employee_type ON employee_type.id = employees.employee_type_id'); */

return  DB::table('employees')
->join('employee_type', 'employee_type.id', '=', 'employees.employee_type_id')
->select('employee_type.name as name',DB::raw('count(employee_type.id) as total'))

->get();



/*
 SELECT
  employee_type.name,
  COUNT(employee_type.id) AS Total
FROM
  employees
Inner JOIN employee_type ON employee_type.id = employees.employee_type_id
*/
   }


}
