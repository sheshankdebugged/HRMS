<?php

namespace App\Http\Controllers;

use App\Models\ManageTrainingTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageTrainingTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageTrainingTypes::where(['status' => 1])->get();

        return view('hrmodule.managetrainingtypes')->with([
            'listData' => $list,
            'pageTitle' => "Training Types",
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
                $action = 'managetrainingtypes';
                return redirect('managetrainingtypes
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
                Session::flash('message', 'Training Type  Updated Successfully.');
                ManageTrainingTypes::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Training Type Added Successfully.');
                ManageTrainingTypes::insertGetId($input);
            }
            return redirect('/managetrainingtypes');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageTrainingTypes  $manageTrainingTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ManageTrainingTypes $manageTrainingTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageTrainingTypes  $manageTrainingTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageTrainingTypes $manageTrainingTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageTrainingTypes  $manageTrainingTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageTrainingTypes $manageTrainingTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageTrainingTypes  $manageTrainingTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageTrainingTypes::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Training Type deleted successfully');
        return redirect("/managetrainingtypes");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managetrainingtypes'), function () {
            Route::get('/', array('as' => 'managetrainingtypes.index', 'uses' => 'ManageTrainingTypesController@index'));
            Route::get('/add', array('as' => 'managetrainingtypes.create', 'uses' => 'ManageTrainingTypesController@create'));
            Route::post('/save', array('as' => 'managetrainingtypes.save', 'uses' => 'ManageTrainingTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'managetrainingtypes.edit', 'uses' => 'ManageTrainingTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'managetrainingtypes.create', 'uses' => 'ManageTrainingTypesController@create'));
            Route::get('/delete/{id}', array('as' => 'managetrainingtypes.destroy', 'uses' => 'ManageTrainingTypesController@destroy'));
        });
    }
}
