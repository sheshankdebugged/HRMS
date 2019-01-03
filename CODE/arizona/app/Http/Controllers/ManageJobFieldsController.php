<?php

namespace App\Http\Controllers;

use App\Models\ManageJobFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageJobFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageJobFields::where(['status' => 1])->get();

        return view('hrmodule.managejobfields')->with([
            'listData' => $list,
            'pageTitle' => "Job Fields",
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
                'job_field_title' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'managejobfields';
                return redirect('managejobfields
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
                Session::flash('message', 'Job Field  Updated Successfully.');
                ManageJobFields::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Job Field Added Successfully.');
                ManageJobFields::insertGetId($input);
            }
            return redirect('/managejobfields');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageJobFields  $manageJobFields
     * @return \Illuminate\Http\Response
     */
    public function show(ManageJobFields $manageJobFields)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageJobFields  $manageJobFields
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageJobFields $manageJobFields)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageJobFields  $manageJobFields
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageJobFields $manageJobFields)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageJobFields  $manageJobFields
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageJobFields::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Job Field deleted successfully');
        return redirect("/managejobfields");    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managejobfields'), function () {
            Route::get('/', array('as' => 'managejobfields.index', 'uses' => 'ManageJobFieldsController@index'));
            Route::get('/add', array('as' => 'managejobfields.create', 'uses' => 'ManageJobFieldsController@create'));
            Route::post('/save', array('as' => 'managejobfields.save', 'uses' => 'ManageJobFieldsController@store'));
            Route::get('/edit/{id}', array('as' => 'managejobfields.edit', 'uses' => 'ManageJobFieldsController@edit'));
            Route::post('/update/{id}', array('as' => 'managejobfields.create', 'uses' => 'ManageJobFieldsController@create'));
            Route::get('/delete/{id}', array('as' => 'managejobfields.destroy', 'uses' => 'ManageJobFieldsController@destroy'));
        });
    }
}
