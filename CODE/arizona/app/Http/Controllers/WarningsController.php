<?php

namespace App\Http\Controllers;

use App\Models\Warnings;
use App\Models\Employees;
use App\Models\WarningType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class WarningsController extends Controller
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
                ['warning_to', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
         $list =Warnings::where($where)->paginate(10);
        //   $list = warnings::where(['status'=>1])->paginate(10);
         return view('hrmodule.warnings.list')->with([
            'listData' => $list,
            'pageTitle'=>"Warnings"
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
        return view('hrmodule.warnings.add')->with([
            'action' => $action,
            'pageTitle'=>"Warnings",
            'Addform'  =>"Add New Warnings",
            'master' => $master
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 	bs@hopmanhome.com, triproserv@gmail.com adam.mckinnon75@outlook.com
     */
    public function store(Request $request)
    {
        // die('I am here');
        $user_id = Auth::id();
        if($request->all()){

            $validator = Validator::make($request->all(), [
                'subject' => 'required'
            ]);
           if ($validator->fails()) {
                $action = 'warnings';
                return redirect('/warnings')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                         'action' => $action
                    ]);
            }

            $input = $request->all();
            echo "<pre>";

       
            $input['warning_date'] = ($input['warning_date'] !="")?date('Y-m-d',strtotime($input['warning_date'])):$input['warning_date'];
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Warning Updated Successfully.');
                Warnings::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Warning  Added Successfully.');
                Warnings::insertGetId($input);
            }
            return redirect('/warnings');
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
        $result = Warnings::find($id);
        $action = 'add';
        $editname = "Edit ".$result->assignment_name;
        return view('hrmodule.warnings.add')->with([
            'action' => $action,
            'pageTitle'=>"Warnings",
            'Addform'  =>$editname,
            'result'  =>$result,
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
        $warnings = Warnings::find($id);
        $warnings->status = 0;
        $warnings->save();
        Session::flash('message', 'Warning delete successfully');
        return redirect("/warnings");
    }


    /**
     * For Setting Job Posts Routes
     */
    static function routes() {
          Route::group(array('prefix' => 'warnings'), function() {
            Route::get('/', array('as' => 'warnings.index', 'uses' => 'WarningsController@index'));
            Route::get('/add', array('as' => 'warnings.create', 'uses' => 'WarningsController@create'));
            Route::post('/save', array('as' => 'warnings.save', 'uses' => 'WarningsController@store'));
            Route::get('/edit/{id}', array('as' => 'warnings.edit', 'uses' => 'WarningsController@edit'));
            Route::post('/update/{id}', array('as' => 'warnings.update', 'uses' => 'WarningsController@create'));
            Route::get('/delete/{id}', array('as' => 'warnings.destroy', 'uses' => 'WarningsController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();
              $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
              $master['WarningType']             = WarningType::where(['status' => 1])->get()->toArray();
            //   $master['Grade']                   = Grade::where(['status' => 1])->get()->toArray();
        return $master;
    }
}
