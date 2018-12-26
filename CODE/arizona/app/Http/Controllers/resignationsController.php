<?php

namespace App\Http\Controllers;

use App\Models\resignations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;


class resignationsController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = Resignations::where(['status'=>1])->paginate(10);
        return view('hrmodule.resignations.list')->with([
            'listData' => $list,
            'pageTitle'=>"Resignations"
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
        return view('hrmodule.resignations.add')->with([
            'action' => $action,
            'pageTitle'=>"Resignations",
            'Addform'  =>"Add New Resignations"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 	bs@hopmanhome.com, triproserv@gmail.com adam.mckinnon75@outlook.com
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if($request->all()){

            $validator = Validator::make($request->all(), [
                'resigning_employee' => 'required',
            ]);
           if ($validator->fails()) {
                $action = 'addresignations';
                return redirect('/resignations/add')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                         'action' => $action
                    ]);
            }

            $input = $request->all();
            echo "<pre>";

       
            $input['resignation_date'] = ($input['resignation_date'] !="")?date('Y-m-d H:i:s',strtotime($input['resignation_date'])):$input['resignation_date'];
            $input['notice_date']   = ($input['notice_date'] !="")?date('Y-m-d H:i:s',strtotime($input['notice_date'])):$input['notice_date'];
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Resignation Updated Successfully.');
                resignations::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Resignation Added Successfully.');
                resignations::insertGetId($input);
            }
            return redirect('/resignations');
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
        $result = Resignations::find($id);
        $action = 'add';
        $editname = "Edit ".$result->assignment_name;
        return view('hrmodule.Resignations.add')->with([
            'action' => $action,
            'pageTitle'=>"Resignation",
            'Addform'  =>$editname,
            'result'  =>$result
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
        $resignations = Resignations::find($id);
        $resignations->status = 0;
        $resignations->save();
        Session::flash('message', 'Resignation delete successfully');
        return redirect("/resignations");
    }


    /**
     * For Setting Job Posts Routes
     */
    static function routes() {
          Route::group(array('prefix' => 'resignations'), function() {
            Route::get('/', array('as' => 'resignations.index', 'uses' => 'ResignationsController@index'));
            Route::get('/add', array('as' => 'resignations.create', 'uses' => 'ResignationsController@create'));
            Route::post('/save', array('as' => 'resignations.save', 'uses' => 'ResignationsController@store'));
            Route::get('/edit/{id}', array('as' => 'resignations.edit', 'uses' => 'ResignationsController@edit'));
            Route::post('/update/{id}', array('as' => 'resignations.create', 'uses' => 'ResignationsController@create'));
            Route::get('/delete/{id}', array('as' => 'resignations.destroy', 'uses' => 'ResignationsController@destroy'));
        });

    }
}
