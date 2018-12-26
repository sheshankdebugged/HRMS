<?php

namespace App\Http\Controllers;

use App\Models\JobInterviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class JobInterviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $list = JobInterviews::where(['status' => 1, 'user_id' => $user_id])->paginate(10);
        return view('hrmodule.jobinterview.list')->with([
            'listData' => $list,
            'pageTitle' => "Job Interviews",
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
        return view('hrmodule.jobinterview.add')->with([
            'action' => $action,
            'pageTitle' => "Job Interviews",
            'Addform' => "Add New Job Interviews
            ",
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
        $user_id = Auth::id();
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'test_title' => 'required',

            ]);

            if ($validator->fails()) {
                $action = 'addjobinterviews';
                return redirect('/jobinterviews/add')
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
                $file->move('./img/uploads/jobinterview/', $input['icon_img']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'JobInterview  Updated Successfully.');
                JobInterviews::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'JobInterview  Added Successfully.');
                JobInterviews::insertGetId($input);
            }
            return redirect('/jobinterviews');
        }
    }





    public function edit($id)
    {
        $action = 'edit';
        $result = JobInterviews::find($id);
        $action = 'add';
        $editname = "Edit " . $result->test_title;
        return view('hrmodule.jobinterview.add')->with([
            'action' => $action,
            'pageTitle' => "Job Interviews",
            'Addform' => $editname,
            'result' => $result,
        ]);
    }


    public function destroy($id)
    {
        $jobinterview = JobInterviews::find($id);
        $jobinterview->status = 0;
        $jobinterview->save();
        Session::flash('message', 'Job Interview delete successfully');
        return redirect("/jobinterviews");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'jobinterviews'), function () {
            Route::get('/', array('as' => 'jobinterviews.index', 'uses' => 'JobInterviewsController@index'));
            Route::get('/add', array('as' => 'jobinterviews.create', 'uses' => 'JobInterviewsController@create'));
            Route::post('/save', array('as' => 'jobinterviews.save', 'uses' => 'JobInterviewsController@store'));
            Route::get('/edit/{id}', array('as' => 'jobinterviews.edit', 'uses' => 'JobInterviewsController@edit'));
            Route::post('/update/{id}', array('as' => 'jobinterviews.update', 'uses' => 'JobInterviewsController@update'));
            Route::get('/delete/{id}', array('as' => 'jobinterviews.destroy', 'uses' => 'JobInterviewsController@destroy'));
        });
    }
}
