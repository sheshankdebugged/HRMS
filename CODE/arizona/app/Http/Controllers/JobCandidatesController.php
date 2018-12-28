<?php

namespace App\Http\Controllers;

use App\Models\JobCandidates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\JobPosts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class JobCandidatesController extends Controller
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
                ['test_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $user_id = Auth::id();
        $list = JobCandidates::where($where)->paginate(10);
        return view('hrmodule.jobcandidates.list')->with([
            'listData' => $list,
            'pageTitle' => "Job Candidates",
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
        return view('hrmodule.jobcandidates.add')->with([
            'action' => $action,
            'pageTitle' => "Job Candidates",
            'Addform' => "Add New Job Candidates
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
                $action = 'addjobcandidates';
                return redirect('/jobcandidates/add')
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
                $file->move('./img/uploads/jobcandidates/', $input['icon_img']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Job Candidates  Updated Successfully.');
                JobCandidates::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Job Candidates  Added Successfully.');
                JobCandidates::insertGetId($input);
            }
            return redirect('/jobcandidates');
        }
    }





    public function edit($id)
    {
        $action = 'edit';
        $result = JobCandidates::find($id);
        $action = 'add';
        $editname = "Edit " . $result->test_title;
        return view('hrmodule.jobcandidates.add')->with([
            'action' => $action,
            'pageTitle' => "Job Candidates",
            'Addform' => $editname,
            'result' => $result,
        ]);
    }


    public function destroy($id)
    {
        $jobcandidates = JobCandidates::find($id);
        $jobcandidates->status = 0;
        $jobcandidates->save();
        Session::flash('message', 'Job Candidates delete successfully');
        return redirect("/Job Candidates");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'jobcandidates'), function () {
            Route::get('/', array('as' => 'jobcandidates.index', 'uses' => 'JobCandidatesController@index'));
            Route::get('/add', array('as' => 'jobcandidates.create', 'uses' => 'JobCandidatesController@create'));
            Route::post('/save', array('as' => 'jobcandidates.save', 'uses' => 'JobCandidatesController@store'));
            Route::get('/edit/{id}', array('as' => 'jobcandidates.edit', 'uses' => 'JobCandidatesController@edit'));
            Route::post('/update/{id}', array('as' => 'jobcandidates.update', 'uses' => 'JobCandidatesController@update'));
            Route::get('/delete/{id}', array('as' => 'jobcandidates.destroy', 'uses' => 'JobCandidatesController@destroy'));
        });
    }
}
