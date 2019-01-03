<?php

namespace App\Http\Controllers;

use App\Models\ManagePolicyTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManagePolicyTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManagePolicyTypes::where(['status' => 1])->get();

        return view('hrmodule.managepolicytypes')->with([
            'listData' => $list,
            'pageTitle' => "Policy Types",
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
                $action = 'managepolicytypes';
                return redirect('managepolicytypes
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
                Session::flash('message', 'Policy Type  Updated Successfully.');
                ManagePolicyTypes::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Policy Type Added Successfully.');
                ManagePolicyTypes::insertGetId($input);
            }
            return redirect('/managepolicytypes');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagePolicyTypes  $managePolicyTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ManagePolicyTypes $managePolicyTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagePolicyTypes  $managePolicyTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ManagePolicyTypes $managePolicyTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManagePolicyTypes  $managePolicyTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManagePolicyTypes $managePolicyTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagePolicyTypes  $managePolicyTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $policytype = ManagePolicyTypes::find($id);
        $policytype->status = 0;
        $policytype->updated_at = date('Y-m-d H:i:s');
        $policytype->save();
        Session::flash('message', 'Policy Type deleted successfully');
        return redirect("/managepolicytypes");
    }
        public static function routes()
    {
        Route::group(array('prefix' => 'managepolicytypes'), function () {
            Route::get('/', array('as' => 'managepolicytypes.index', 'uses' => 'ManagePolicyTypesController@index'));
            Route::get('/add', array('as' => 'managepolicytypes.create', 'uses' => 'ManagePolicyTypesController@create'));
            Route::post('/save', array('as' => 'managepolicytypes.save', 'uses' => 'ManagePolicyTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'managepolicytypes.edit', 'uses' => 'ManagePolicyTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'managepolicytypes.create', 'uses' => 'ManagePolicyTypesController@create'));
            Route::get('/delete/{id}', array('as' => 'managepolicytypes.destroy', 'uses' => 'ManagePolicyTypesController@destroy'));
        });
    }
}
