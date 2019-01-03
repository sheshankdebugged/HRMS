<?php

namespace App\Http\Controllers;

use App\Models\ManageTrainingSubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageTrainingSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageTrainingSubjects::where(['status' => 1])->get();

        return view('hrmodule.managetrainingsubjects')->with([
            'listData' => $list,
            'pageTitle' => "Training Subjects",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->all()) {
            $validator = Validator::make($request->all(), [
                'value' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'managetrainingsubjects';
                return redirect('managetrainingsubjects
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
                Session::flash('message', 'Training Subject  Updated Successfully.');
                ManageTrainingSubjects::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Training Subject Added Successfully.');
                ManageTrainingSubjects::insertGetId($input);
            }
            return redirect('/managetrainingsubjects');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageTrainingSubjects  $manageTrainingSubjects
     * @return \Illuminate\Http\Response
     */
    public function show(ManageTrainingSubjects $manageTrainingSubjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageTrainingSubjects  $manageTrainingSubjects
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageTrainingSubjects $manageTrainingSubjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageTrainingSubjects  $manageTrainingSubjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageTrainingSubjects $manageTrainingSubjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageTrainingSubjects  $manageTrainingSubjects
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageTrainingSubjects::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Training Subject deleted successfully');
        return redirect("/managetrainingsubjects");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managetrainingsubjects'), function () {
            Route::get('/', array('as' => 'managetrainingsubjects.index', 'uses' => 'ManageTrainingSubjectsController@index'));
            Route::get('/add', array('as' => 'managetrainingsubjects.create', 'uses' => 'ManageTrainingSubjectsController@create'));
            Route::post('/save', array('as' => 'managetrainingsubjects.save', 'uses' => 'ManageTrainingSubjectsController@store'));
            Route::get('/edit/{id}', array('as' => 'managetrainingsubjects.edit', 'uses' => 'ManageTrainingSubjectsController@edit'));
            Route::post('/update/{id}', array('as' => 'managetrainingsubjects.create', 'uses' => 'ManageTrainingSubjectsController@create'));
            Route::get('/delete/{id}', array('as' => 'managetrainingsubjects.destroy', 'uses' => 'ManageTrainingSubjectsController@destroy'));
        });
    }
}
