<?php

namespace App\Http\Controllers;

use App\Models\JobPostSettings;
use App\Models\ReferanceNumber;
// use App\Models\Projects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class JobPostSettingsController extends Controller
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
                ['assignment_name', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =JobPostSettings::where($where)->paginate(10);

        // $list = JobPostSettings::where(['status'=>1])->paginate(10);
        return view('hrmodule.jobpostsettings.list')->with([
            'listData' => $list,
            'pageTitle'=>"Job Post Settings"
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
        return view('hrmodule.jobpostsettings.add')->with([
            'action' => $action,
            'pageTitle'=>"Job Post Settings",
            'Addform'  =>"Add New Job Post Setting",
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
        $user_id = Auth::id();
        if($request->all()){

            $validator = Validator::make($request->all(), [
                // 'employee_id' => 'required',
                // 'assignment_name' => 'required',


            ]);
           if ($validator->fails()) {
                $action = 'addjobpostsettings';
                return redirect('jobpostsettings/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                         'action' => $action
                    ]);
            }

            $input = $request->all();
            echo "<pre>";

       
            // $input['start_date'] = ($input['start_date'] !="")?date('Y-m-d',strtotime($input['start_date'])):$input['start_date'];
            // $input['due_date']   = ($input['due_date'] !="")?date('Y-m-d',strtotime($input['due_date'])):$input['due_date'];
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Job Post Settings Updated Successfully.');
                jobpostsettings::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Job Post Settings  Added Successfully.');
                jobpostsettings::insertGetId($input);
            }
            return redirect('/jobpostsettings/add');
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
        $result = JobPostSettings::find($id);
        $action = 'add';
        $editname = "Edit ".$result->title;
        return view('hrmodule.jobpostsettings.add')->with([
            'action' => $action,
            'pageTitle'=>"Job Post Settings",
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
        $jobpostsettings = JobPostSettings::find($id);
        $jobpostsettings->status = 0;
        $jobpostsettings->save();
        Session::flash('message', 'Job Post Settings delete successfully');
        return redirect("/jobpostsettings");
    }


    /**
     * For Setting Job Posts Routes
     */
    static function routes() {
          Route::group(array('prefix' => 'jobpostsettings'), function() {
            Route::get('/', array('as' => 'jobpostsettings.index', 'uses' => 'JobPostSettingsController@index'));
            Route::get('/add', array('as' => 'jobpostsettings.create', 'uses' => 'JobPostSettingsController@create'));
            Route::post('/save', array('as' => 'jobpostsettings.save', 'uses' => 'JobPostSettingsController@store'));
            Route::get('/edit/{id}', array('as' => 'jobpostsettings.edit', 'uses' => 'JobPostSettingsController@edit'));
            Route::post('/update/{id}', array('as' => 'jobpostsettings.create', 'uses' => 'JobPostSettingsController@create'));
            Route::get('/delete/{id}', array('as' => 'jobpostsettings.destroy', 'uses' => 'JobPostSettingsController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();
        //    $master['JobPostSettings']               = JobPostSettings::where(['status' => 1])->get()->toArray();
           $master['ReferanceNumber']            = ReferanceNumber::where(['status' => 1])->get()->toArray();
              return $master;
    }
}
