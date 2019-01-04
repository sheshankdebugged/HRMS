<?php

namespace App\Http\Controllers;

use App\Models\OnBoardingSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationType;
use App\Models\Employees;
use App\Models\OnBoardingNotifications;
use App\Models\OnBoardingChecklist;
use App\Models\EmployeeOnBoardingTasks;
use Validator;
use Session;

class OnBoardingSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = OnBoardingSettings::where(['status' => 1])->get();
        $notification= OnBoardingNotifications::where(['status' => 1])->get();
        $check= OnBoardingChecklist::where(['status' => 1])->get();
        $task= EmployeeOnBoardingTasks::where(['status' => 1])->get();
        $master = $this->getmasterfields();

        return view('hrmodule.onboarding.onboardingsettings')->with([
            'listData' => $list,
            'notificationlist' =>$notification,
            'checklist' =>$check,
            'tasklist' =>$task,
            'pageTitle' => "Onboarding ",
            'title' => "Onboarding Settings",
            'Addform' => "Add New Notification",
            'checklist'=> "Add New Checklist Item",
            'employeetask' => "Add New Task",
            'master' => $master,
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

        return view('hrmodule.jobposts.add')->with([
            'action' => $action,
            'pageTitle' => "Job Posts",
            'Addform' => "Add New Job Post",
            'master' => $master,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $master = $this->getmasterfields();
        if ($request->all()) {
            $validator = Validator::make($request->all(), [
                'job_title' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'addjobpost';
                return redirect('jobposts/add
                ')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();

            // echo "<pre>";
            // print_r($input); die;

            $input['status'] = 1;
            $input['user_id'] = Auth::id();

            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Job Post  Updated Successfully.');
                JobPosts::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Job Post Added Successfully.');
                JobPosts::insertGetId($input);
            }
            return redirect('/jobposts');

        }
    }
    public function storenotification(Request $request)
    {
        $master = $this->getmasterfields();
        if ($request->all()) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'onboardingsettings';
                return redirect('onboardingsettings
                ')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();

            // echo "<pre>";
            // print_r($input); die;

            $input['status'] = 1;
            $input['user_id'] = Auth::id();

            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Notification has been added successfully.');
                OnBoardingNotifications::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Notification has been added successfully.');
                OnBoardingNotifications::insertGetId($input);
            }
            return redirect('/onboardingsettings?tab=2');

        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OnBoardingSettings  $onBoardingSettings
     * @return \Illuminate\Http\Response
     */
    public function show(OnBoardingSettings $onBoardingSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OnBoardingSettings  $onBoardingSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(OnBoardingSettings $onBoardingSettings)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OnBoardingSettings  $onBoardingSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnBoardingSettings $onBoardingSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OnBoardingSettings  $onBoardingSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = JobPosts::find($id);
        $job->is_deleted = 1;
        $job->updated_at = date('Y-m-d H:i:s');
        $job->save();
        Session::flash('message', 'Job Post deleted successfully');
        return redirect("/jobposts");
    }
    public function destroynotification($id)
    {
        $job = OnBoardingNotifications::find($id);
        $job->is_deleted = 1;
        $job->updated_at = date('Y-m-d H:i:s');
        $job->save();
        Session::flash('message', 'Notification has been deleted successfully');
        return redirect("/OnBoardingNotifications");
    }
        public static function routes()
    {
        Route::group(array('prefix' => 'onboardingsettings'), function () {
            Route::get('/', array('as' => 'onboardingsettings.index', 'uses' => 'OnBoardingSettingsController@index'));
            Route::get('/add', array('as' => 'onboardingsettings.create', 'uses' => 'OnBoardingSettingsController@create'));
            Route::post('/save', array('as' => 'onboardingsettings.save', 'uses' => 'OnBoardingSettingsController@store'));
            Route::post('/savenotification', array('as' => 'onboardingsettings.savenotification', 'uses' => 'OnBoardingSettingsController@storenotification'));
            Route::get('/edit/{id}', array('as' => 'onboardingsettings.edit', 'uses' => 'OnBoardingSettingsController@edit'));
            Route::post('/update/{id}', array('as' => 'onboardingsettings.create', 'uses' => 'OnBoardingSettingsController@create'));
            Route::get('/delete/{id}', array('as' => 'onboardingsettings.destroy', 'uses' => 'OnBoardingSettingsController@destroy'));
            Route::get('/deletenotification/{id}', array('as' => 'onboardingsettings.destroynotification', 'uses' => 'OnBoardingSettingsController@destroynotification'));

        });
    }
    public function getmasterfields()
    {
        $master = array();
        $master['Employees']             = Employees::where(['status'=>1])->get()->toArray();
        $master['NotificationType']   = NotificationType::where(['status'=>1])->get()->toArray();
        return $master;
    }
}
