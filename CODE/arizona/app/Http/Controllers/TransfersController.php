<?php

namespace App\Http\Controllers;

use App\Models\Transfers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class TransfersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = transfers::where(['status' => 1])->paginate(10);
        return view('hrmodule.transfers.list')->with([
            'listData' => $list,
            'pageTitle' => "Transfers",
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
        return view('hrmodule.transfers.add')->with([
            'action' => $action,
            'pageTitle' => "transfers",
            'Addform' => "Add New Transfer",
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
                'employee_to_transfer' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addtransfers';
                return redirect('/transfers/add')
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
                $file->move('./img/uploads/transfers/', $input['icon_img']);
            }
            echo "<pre>";

       
            $input['transfer_date'] = ($input['transfer_date'] !="")?date('Y-m-d',strtotime($input['transfer_date'])):$input['transfer_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Transfer  Updated Successfully.');
                transfers::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Transfer  Added Successfully.');
                transfers::insertGetId($input);
            }
            return redirect('/transfers');
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
        $result = transfers::find($id);
        $action = 'add';
        $editname = "Edit Transfer " . $result->employee;
        return view('hrmodule.transfers.add')->with([
            'action' => $action,
            'pageTitle' => "transfers",
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
        $transfers = transfers::find($id);
        $transfers->status = 0;
        $transfers->save();
        Session::flash('message', 'Transfers delete successfully');
        return redirect("/transfers");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'transfers'), function () {
            Route::get('/', array('as' => 'transfers.index', 'uses' => 'TransfersController@index'));
            Route::get('/add', array('as' => 'transfers.create', 'uses' => 'TransfersController@create'));
            Route::post('/save', array('as' => 'transfers.save', 'uses' => 'TransfersController@store'));
            Route::get('/edit/{id}', array('as' => 'transfers.edit', 'uses' => 'TransfersController@edit'));
            Route::post('/update/{id}', array('as' => 'transfers.update', 'uses' => 'TransfersController@update'));
            Route::get('/delete/{id}', array('as' => 'transfers.destroy', 'uses' => 'TransfersController@destroy'));
        });
    }
}

