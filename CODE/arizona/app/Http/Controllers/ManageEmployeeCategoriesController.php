<?php

namespace App\Http\Controllers;

use App\Models\ManageEmployeeCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageEmployeeCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = manageEmployeeCategories::where(['status' => 1])->get();

        return view('hrmodule.manageemployeecategories')->with([
            'listData' => $list,
            'pageTitle' => "Employee Catagories",
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
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'manageemployeecategories';
                return redirect('manageemployeecategories
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
                Session::flash('message', 'Employee Catagorie Updated Successfully.');
                manageEmployeeCategories::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Catagorie Added Successfully.');
                manageEmployeeCategories::insertGetId($input);
            }
            return redirect('/manageemployeecategories');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageEmployeeCategories  $manageEmployeeCategories
     * @return \Illuminate\Http\Response
     */
    public function show(ManageEmployeeCategories $manageEmployeeCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageEmployeeCategories  $manageEmployeeCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageEmployeeCategories $manageEmployeeCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageEmployeeCategories  $manageEmployeeCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageEmployeeCategories $manageEmployeeCategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageEmployeeCategories  $manageEmployeeCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = manageEmployeeCategories::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Employee Categorie deleted successfully');
        return redirect("/manageemployeecategories");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'manageemployeecategories'), function () {
            Route::get('/', array('as' => 'manageemployeecategories.index', 'uses' => 'manageEmployeeCategoriesController@index'));
            Route::get('/add', array('as' => 'manageemployeecategories.create', 'uses' => 'manageEmployeeCategoriesController@create'));
            Route::post('/save', array('as' => 'manageemployeecategories.save', 'uses' => 'manageEmployeeCategoriesController@store'));
            Route::get('/edit/{id}', array('as' => 'manageemployeecategories.edit', 'uses' => 'manageEmployeeCategoriesController@edit'));
            Route::post('/update/{id}', array('as' => 'manageemployeecategories.create', 'uses' => 'manageEmployeeCategoriesController@create'));
            Route::get('/delete/{id}', array('as' => 'manageemployeecategories.destroy', 'uses' => 'manageEmployeeCategoriesController@destroy'));
        });
    }
}
