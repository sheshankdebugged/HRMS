<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class ComplaintsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = complaints::where(['status' => 1])->paginate(10);
        return view('hrmodule.complaints.list')->with([
            'listData' => $list,
            'pageTitle' => "Complaints",
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('hrmodule.complaints.add')->with([
            'action' => $action,
            'pageTitle' => "Complaints",
            'Addform' => "Add New Complaint",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *     bs@hopmanhome.com, triproserv@gmail.com adam.mckinnon75@outlook.com
     */
    public function store(Request $request)
    {

        $user_id = Auth::id();
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                // 'poll_question' => 'required',
                // 'poll_answer_1' => 'required',
                // 'poll_answer_2' => 'required'
            ]);
            if ($validator->fails()) {
                $action = 'addcomplaints';
                return redirect('/complaints/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();
            if (request()->hasFile('icon_img')) {
                $file = request()->file('icon_img');
                $input['icon_img'] = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./img/uploads/complaints/', $input['icon_img']);
            }

            echo "<pre>";

       
            // $input['promotion_date'] = ($input['promotion_date'] !="")?date('Y-m-d',strtotime($input['promotion_date'])):$input['promotion_date'];
            // $input['poll_end_date']   = ($input['poll_end_date'] !="")?date('Y-m-d',strtotime($input['poll_end_date'])):$input['poll_end_date'];
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Complaints Updated Successfully.');
                Complaints::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Complaints  Added Successfully.');
                complaints::insertGetId($input);
            }
            return redirect('/complaints');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $action = 'edit';
        $result = complaints::find($id);
        $action = 'add';
        $editname = "Edit Complaint " . $result->employee;
        return view('hrmodule.complaints.add')->with([
            'action' => $action,
            'pageTitle' => "complaints",
            'Addform' => $editname,
            'result' => $result,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaints = complaints::find($id);
        $complaints->status = 0;
        $complaints->save();
        Session::flash('message', ' Complaints delete successfully');
        return redirect("/complaints");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'complaints'), function () {
            Route::get('/', array('as' => 'complaints.index', 'uses' => 'complaintsController@index'));
            Route::get('/add', array('as' => 'complaints.create', 'uses' => 'complaintsController@create'));
            Route::post('/save', array('as' => 'complaints.save', 'uses' => 'complaintsController@store'));
            Route::get('/edit/{id}', array('as' => 'complaints.edit', 'uses' => 'complaintsController@edit'));
            Route::post('/update/{id}', array('as' => 'complaints.update', 'uses' => 'complaintsController@update'));
            Route::get('/delete/{id}', array('as' => 'complaints.destroy', 'uses' => 'complaintsController@destroy'));
        });
    }
}
