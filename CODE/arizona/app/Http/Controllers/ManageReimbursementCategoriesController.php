<?php

namespace App\Http\Controllers;

use App\Models\ManageReimbursementCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageReimbursementCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageReimbursementCategories::where(['status' => 1])->get();

        return view('hrmodule.managereimbursementcategories')->with([
            'listData' => $list,
            'pageTitle' => "Reimbursement Categories",
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
                $action = 'managereimbursementcategories';
                return redirect('managereimbursementcategories
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
                Session::flash('message', 'Reimbursement Categorie  Updated Successfully.');
                ManageReimbursementCategories::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Reimbursement Categorie Added Successfully.');
                ManageReimbursementCategories::insertGetId($input);
            }
            return redirect('/managereimbursementcategories');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageReimbursementCategories  $manageReimbursementCategories
     * @return \Illuminate\Http\Response
     */
    public function show(ManageReimbursementCategories $manageReimbursementCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageReimbursementCategories  $manageReimbursementCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageReimbursementCategories $manageReimbursementCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageReimbursementCategories  $manageReimbursementCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageReimbursementCategories $manageReimbursementCategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageReimbursementCategories  $manageReimbursementCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageReimbursementCategories::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Reimbursement Categorie deleted successfully');
        return redirect("/managereimbursementcategories");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managereimbursementcategories'), function () {
            Route::get('/', array('as' => 'managereimbursementcategories.index', 'uses' => 'ManageReimbursementCategoriesController@index'));
            Route::get('/add', array('as' => 'managereimbursementcategories.create', 'uses' => 'ManageReimbursementCategoriesController@create'));
            Route::post('/save', array('as' => 'managereimbursementcategories.save', 'uses' => 'ManageReimbursementCategoriesController@store'));
            Route::get('/edit/{id}', array('as' => 'managereimbursementcategories.edit', 'uses' => 'ManageReimbursementCategoriesController@edit'));
            Route::post('/update/{id}', array('as' => 'managereimbursementcategories.create', 'uses' => 'ManageReimbursementCategoriesController@create'));
            Route::get('/delete/{id}', array('as' => 'managereimbursementcategories.destroy', 'uses' => 'ManageReimbursementCategoriesController@destroy'));
        });
    }
}
