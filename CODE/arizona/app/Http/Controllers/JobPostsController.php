<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\ApprovalLevel;
use App\Models\Departments;
use App\Models\Companies;
use App\Models\Employees;
use App\Models\Stations;
use App\Models\JobPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use App\Models\CandidateAgeRange;
use App\Models\JobType;
use App\Models\JobField;
use Session;
use Validator;

class JobPostsController extends Controller
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
                ['job_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = JobPosts::where($where)->paginate(10);
        // $list['job_post_closing_date'] = date('MM d, y', strtotime($list['job_post_closing_date']))
        return view('hrmodule.jobposts.list')->with([
            'listData' => $list,
            'pageTitle' => "Job Posts",
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPosts  $jobPosts
     * @return \Illuminate\Http\Response
     */
    public function show(JobPosts $jobPosts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobPosts  $jobPosts
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'edit';
       
        $result = JobPosts::find($id);
        $action = 'add';
        $editname = "Edit " . $result->job_title;
        $master = $this->getmasterfields();
        return view('hrmodule.jobposts.add')->with([
            'action' => $action,
            'pageTitle' => "Job Posts",
            'Addform' => $editname,
            'result' => $result,
            'master' => $master,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPosts  $jobPosts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobPosts $jobPosts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Models\JobPosts  $jobPosts
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

    /**
     * For Setting Job Posts Routes
     */
    public static function routes()
    {
        Route::group(array('prefix' => 'jobposts'), function () {
            Route::get('/', array('as' => 'jobposts.index', 'uses' => 'JobPostsController@index'));
            Route::get('/add', array('as' => 'jobposts.create', 'uses' => 'JobPostsController@create'));
            Route::post('/save', array('as' => 'jobposts.save', 'uses' => 'JobPostsController@store'));
            Route::get('/edit/{id}', array('as' => 'jobposts.edit', 'uses' => 'JobPostsController@edit'));
            Route::post('/update/{id}', array('as' => 'jobposts.create', 'uses' => 'JobPostsController@create'));
            Route::get('/delete/{id}', array('as' => 'jobposts.destroy', 'uses' => 'JobPostsController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();
        $master['JobType']             = JobType::where(['status'=>1])->get()->toArray();
        $master['CandidateAgeRange']   = CandidateAgeRange::where(['status'=>1])->get()->toArray();
        $master['Countries']             = Countries::where(['status'=>1])->get()->toArray();
        $master['JobField']             = JobField::where(['status'=>1])->get()->toArray();
        $master['ApprovalLevel']             = ApprovalLevel::where(['status'=>1])->get()->toArray();
        $master['Companies']            = Companies::where(['status' => 1])->get()->toArray();
        $master['Stations'] = Stations::where(['status' => 1])->get()->toArray();
        $master['Departments'] = Departments::where(['status' => 1])->get()->toArray();
        $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
        return $master;
    }
}
