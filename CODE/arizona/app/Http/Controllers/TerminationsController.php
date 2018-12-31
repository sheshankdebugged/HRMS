<?php

namespace App\Http\Controllers;

use App\Models\Terminations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;


class TerminationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
        $user_id = Auth::id();
        $searchQuery  = isset($_GET['search'])?trim($_GET['search']):"";
        $where   = ['status'=>1,'user_id'=>$user_id];
        
        if(!empty($searchQuery)){
            $where = [
                ['termination_date', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =  terminations::where($where)->paginate(10);


        // $list = terminations::where(['status' => 1])->paginate(10);
        return view('hrmodule.terminations.list')->with([
            'listData' => $list,
            'pageTitle' => "Terminations",
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
        return view('hrmodule.terminations.add')->with([
            'action' => $action,
            'pageTitle' => "Terminations",
            'Addform' => "Add New Termination",
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
                'employee_terminated' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addterminations';
                return redirect('/terminations/add')
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
                $file->move('./img/uploads/terminations/', $input['icon_img']);
            }
            echo "<pre>";

       
            $input['termination_date'] = ($input['termination_date'] !="")?date('Y-m-d',strtotime($input['termination_date'])):$input['termination_date'];
            $input['notice_date'] = ($input['notice_date'] !="")?date('Y-m-d',strtotime($input['notice_date'])):$input['notice_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Termination  Updated Successfully.');
                terminations::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Termination  Added Successfully.');
                terminations::insertGetId($input);
            }
            return redirect('/terminations');
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
        $result = terminations::find($id);
        $action = 'add';
        $editname = "Edit Termination " . $result->employee;
        return view('hrmodule.terminations.add')->with([
            'action' => $action,
            'pageTitle' => "Terminations",
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
        $terminations = terminations::find($id);
        $terminations->status = 0;
        $terminations->save();
        Session::flash('message', 'Termination delete successfully');
        return redirect("/terminations");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'terminations'), function () {
            Route::get('/', array('as' => 'terminations.index', 'uses' => 'TerminationsController@index'));
            Route::get('/add', array('as' => 'terminations.create', 'uses' => 'TerminationsController@create'));
            Route::post('/save', array('as' => 'terminations.save', 'uses' => 'TerminationsController@store'));
            Route::get('/edit/{id}', array('as' => 'terminations.edit', 'uses' => 'TerminationsController@edit'));
            Route::post('/update/{id}', array('as' => 'terminations.update', 'uses' => 'TerminationsController@update'));
            Route::get('/delete/{id}', array('as' => 'terminations.destroy', 'uses' => 'TerminationsController@destroy'));
        });
    }
}

