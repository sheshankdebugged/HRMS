<?php

namespace App\Http\Controllers;

use App\Models\ManageQualificationDegrees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;


class ManageQualificationDegreesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageQualificationDegrees::where(['status' => 1])->get();

        return view('hrmodule.managequalificationdegrees')->with([
            'listData' => $list,
            'pageTitle' => "Qualification Degree",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "yes";
        die();
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
                $action = 'managequalificationdegrees';
                return redirect('managequalificationdegrees
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
                Session::flash('message', 'Qualification Degree  Updated Successfully.');
                ManageQualificationDegrees::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Qualification Degree Added Successfully.');
                ManageQualificationDegrees::insertGetId($input);
            }
            return redirect('/managequalificationdegrees');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageQualificationDegrees  $manageManageQualificationDegrees
     * @return \Illuminate\Http\Response
     */
    public function show(ManageQualificationDegrees $manageManageQualificationDegrees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageQualificationDegrees  $manageManageQualificationDegrees
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageQualificationDegrees $manageManageQualificationDegrees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageQualificationDegrees  $manageManageQualificationDegrees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageQualificationDegrees $manageManageQualificationDegrees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageQualificationDegrees  $manageManageQualificationDegrees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageQualificationDegrees::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Qualification Degree deleted successfully');
        return redirect("/managequalificationdegrees");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managequalificationdegrees'), function () {
            Route::get('/', array('as' => 'managequalificationdegrees.index', 'uses' => 'ManageQualificationDegreesController@index'));
            Route::get('/add', array('as' => 'managequalificationdegrees.create', 'uses' => 'ManageQualificationDegreesController@create'));
            Route::post('/save', array('as' => 'managequalificationdegrees.save', 'uses' => 'ManageQualificationDegreesController@store'));
            Route::get('/edit/{id}', array('as' => 'managequalificationdegrees.edit', 'uses' => 'ManageQualificationDegreesController@edit'));
            Route::post('/update/{id}', array('as' => 'managequalificationdegrees.create', 'uses' => 'ManageQualificationDegreesController@create'));
            Route::get('/delete/{id}', array('as' => 'managequalificationdegrees.destroy', 'uses' => 'ManageQualificationDegreesController@destroy'));
        });
    }
    // public function getmasterfields()
    // {
    //     $master = array();
    //     $master['ManageQualificationDegrees']  = ManageQualificationDegrees::where(['status'=>1])->get()->toArray();
    //     return $master;
    // }
}
