<?php

namespace App\Http\Controllers;

use App\Models\ManageRecruitmentScreeningParameters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageRecruitmentScreeningParametersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageRecruitmentScreeningParameters::where(['status' => 1])->get();

        return view('hrmodule.managerecruitmentscreeningparameters')->with([
            'listData' => $list,
            'pageTitle' => "Recruitment Screening Parameters",
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
                $action = 'managerecruitmentscreeningparameters';
                return redirect('managerecruitmentscreeningparameters
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
                Session::flash('message', 'Recruitment Screening Parameter  Updated Successfully.');
                ManageRecruitmentScreeningParameters::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Recruitment Screening Parameter Added Successfully.');
                ManageRecruitmentScreeningParameters::insertGetId($input);
            }
            return redirect('/managerecruitmentscreeningparameters');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageRecruitmentScreeningParameters  $manageRecruitmentScreeningParameters
     * @return \Illuminate\Http\Response
     */
    public function show(ManageRecruitmentScreeningParameters $manageRecruitmentScreeningParameters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageRecruitmentScreeningParameters  $manageRecruitmentScreeningParameters
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageRecruitmentScreeningParameters $manageRecruitmentScreeningParameters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageRecruitmentScreeningParameters  $manageRecruitmentScreeningParameters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageRecruitmentScreeningParameters $manageRecruitmentScreeningParameters)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageRecruitmentScreeningParameters  $manageRecruitmentScreeningParameters
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageRecruitmentScreeningParameters::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Recruitment Screening Parameter deleted successfully');
        return redirect("/managerecruitmentscreeningparameters");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managerecruitmentscreeningparameters'), function () {
            Route::get('/', array('as' => 'managerecruitmentscreeningparameters.index', 'uses' => 'ManageRecruitmentScreeningParametersController@index'));
            Route::get('/add', array('as' => 'managerecruitmentscreeningparameters.create', 'uses' => 'ManageRecruitmentScreeningParametersController@create'));
            Route::post('/save', array('as' => 'managerecruitmentscreeningparameters.save', 'uses' => 'ManageRecruitmentScreeningParametersController@store'));
            Route::get('/edit/{id}', array('as' => 'managerecruitmentscreeningparameters.edit', 'uses' => 'ManageRecruitmentScreeningParametersController@edit'));
            Route::post('/update/{id}', array('as' => 'managerecruitmentscreeningparameters.create', 'uses' => 'ManageRecruitmentScreeningParametersController@create'));
            Route::get('/delete/{id}', array('as' => 'managerecruitmentscreeningparameters.destroy', 'uses' => 'ManageRecruitmentScreeningParametersController@destroy'));
        });
    }
}
