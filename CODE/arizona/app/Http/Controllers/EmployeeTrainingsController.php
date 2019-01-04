<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTrainings;
use App\Models\Employees;
use App\Models\ManageTrainingTypes;
use App\Models\ManageTrainingSubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class EmployeeTrainingsController extends Controller
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
        
        // if(!empty($searchQuery)){
        //     $where = [
        //         ['employeedesignations_title', 'LIKE', "%$searchQuery%"],
        //         ['status', '=', 1],
        //         ['user_id', '=', $user_id],
        //     ];   
        // }
        $list = EmployeeTrainings::where($where)->paginate(10);

          return view('hrmodule.employeetrainings.list')->with([
            'listData' => $list,
            'pageTitle' => "Employee Trainings",
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
        return view('hrmodule.employeetrainings.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Trainings",
            'Addform' => "Add New Employee Trainings",
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
                'training_title' => 'required', 
                'training_start_date' => 'required', 
                'training_end_date' => 'required'                              
            ]);
            if ($validator->fails()) {
                $action = 'addemployeegroups';
                return redirect('/employeetrainings/add')
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
                $file->move('./img/uploads/employeetrainings/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Trainings Updated Successfully.');
                EmployeeTrainings::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Trainings  Added Successfully.');
                EmployeeTrainings::insertGetId($input);
            }
            return redirect('/employeetrainings');
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
        $result =  EmployeeTrainings::find($id);
        $action = 'add';
        $editname = "Edit Employee Training ";
        return view('hrmodule.employeetrainings.add')->with([
            'action' => $action,
            'pageTitle' => "Employee Trainings",
            'Addform' => $editname,
            'result' => $result,
            'master'  =>  $master
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
        $employeetrainings = EmployeeTrainings::find($id);
        $employeetrainings->status = 0;
        $employeetrainings->save();
        Session::flash('message', 'Employee Trainings delete successfully');
        return redirect("/employeetrainings");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'employeetrainings'), function () {
            Route::get('/', array('as' => 'employeetrainings.index', 'uses' => 'EmployeeTrainingsController@index'));
            Route::get('/add', array('as' => 'employeetrainings.create', 'uses' => 'EmployeeTrainingsController@create'));
            Route::post('/save', array('as' => 'employeetrainings.save', 'uses' => 'EmployeeTrainingsController@store'));
            Route::get('/edit/{id}', array('as' => 'employeetrainings.edit', 'uses' => 'EmployeeTrainingsController@edit'));
            Route::post('/update/{id}', array('as' => 'employeetrainings.update', 'uses' => 'EmployeeTrainingsController@update'));
            Route::get('/delete/{id}', array('as' => 'employeetrainings.destroy', 'uses' => 'EmployeeTrainingsController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
        $master['Employees'] = Employees::where(['status' => 1])->get()->toArray();
        $master['TrainingTypes'] = ManageTrainingTypes::where(['status' => 1])->get()->toArray();
        $master['TrainingSubjects'] = ManageTrainingSubjects::where(['status' => 1])->get()->toArray();
      
        return $master;
    }
}

