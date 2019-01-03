<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;


class ManageSkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = Skills::where(['status' => 1])->get();

        return view('hrmodule.manageskills')->with([
            'listData' => $list,
            'pageTitle' => "Skills",
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
                $action = 'manageskills';
                return redirect('manageskills
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
                Session::flash('message', 'Skills  Updated Successfully.');
                Skills::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Skills Added Successfully.');
                Skills::insertGetId($input);
            }
            return redirect('/manageskills');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageSkills  $manageSkills
     * @return \Illuminate\Http\Response
     */
    public function show(ManageSkills $manageSkills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageSkills  $manageSkills
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageSkills $manageSkills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageSkills  $manageSkills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageSkills $manageSkills)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageSkills  $manageSkills
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = Skills::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Skill deleted successfully');
        return redirect("/manageskills");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'manageskills'), function () {
            Route::get('/', array('as' => 'manageskills.index', 'uses' => 'ManageSkillsController@index'));
            Route::get('/add', array('as' => 'manageskills.create', 'uses' => 'ManageSkillsController@create'));
            Route::post('/save', array('as' => 'manageskills.save', 'uses' => 'ManageSkillsController@store'));
            Route::get('/edit/{id}', array('as' => 'manageskills.edit', 'uses' => 'ManageSkillsController@edit'));
            Route::post('/update/{id}', array('as' => 'manageskills.create', 'uses' => 'ManageSkillsController@create'));
            Route::get('/delete/{id}', array('as' => 'manageskills.destroy', 'uses' => 'ManageSkillsController@destroy'));
        });
    }
    // public function getmasterfields()
    // {
    //     $master = array();
    //     $master['Skills']  = Skills::where(['status'=>1])->get()->toArray();
    //     return $master;
    // }
}
