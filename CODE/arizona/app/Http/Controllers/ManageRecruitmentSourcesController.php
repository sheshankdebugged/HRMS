<?php

namespace App\Http\Controllers;

use App\Models\ManageRecruitmentSources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageRecruitmentSourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageRecruitmentSources::where(['status' => 1])->get();

        return view('hrmodule.managerecruitmentsources')->with([
            'listData' => $list,
            'pageTitle' => "Recruitment Sources",
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
                $action = 'managerecruitmentsources';
                return redirect('managerecruitmentsources
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
                Session::flash('message', 'Recruitment Source  Updated Successfully.');
                ManageRecruitmentSources::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Recruitment Source Added Successfully.');
                ManageRecruitmentSources::insertGetId($input);
            }
            return redirect('/managerecruitmentsources');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageRecruitmentSources  $manageRecruitmentSources
     * @return \Illuminate\Http\Response
     */
    public function show(ManageRecruitmentSources $manageRecruitmentSources)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageRecruitmentSources  $manageRecruitmentSources
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageRecruitmentSources $manageRecruitmentSources)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageRecruitmentSources  $manageRecruitmentSources
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageRecruitmentSources $manageRecruitmentSources)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageRecruitmentSources  $manageRecruitmentSources
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageRecruitmentSources::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Recruitment Source deleted successfully');
        return redirect("/managerecruitmentsources");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managerecruitmentsources'), function () {
            Route::get('/', array('as' => 'managerecruitmentsources.index', 'uses' => 'ManageRecruitmentSourcesController@index'));
            Route::get('/add', array('as' => 'managerecruitmentsources.create', 'uses' => 'ManageRecruitmentSourcesController@create'));
            Route::post('/save', array('as' => 'managerecruitmentsources.save', 'uses' => 'ManageRecruitmentSourcesController@store'));
            Route::get('/edit/{id}', array('as' => 'managerecruitmentsources.edit', 'uses' => 'ManageRecruitmentSourcesController@edit'));
            Route::post('/update/{id}', array('as' => 'managerecruitmentsources.create', 'uses' => 'ManageRecruitmentSourcesController@create'));
            Route::get('/delete/{id}', array('as' => 'managerecruitmentsources.destroy', 'uses' => 'ManageRecruitmentSourcesController@destroy'));
        });
    }
}
