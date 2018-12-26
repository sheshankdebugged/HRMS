<?php

namespace App\Http\Controllers;

use App\Models\Memos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class MemosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = memos::where(['status' => 1])->paginate(10);
        return view('hrmodule.memos.list')->with([
            'listData' => $list,
            'pageTitle' => "Memos",
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
        return view('hrmodule.memos.add')->with([
            'action' => $action,
            'pageTitle' => "Memos",
            'Addform' => "Add New Memo",
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
                'memo_subject' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addmemos';
                return redirect('/memos/add')
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
                $file->move('./img/uploads/memos/', $input['icon_img']);
            }
            echo "<pre>";

       
            $input['memo_date'] = ($input['memo_date'] !="")?date('Y-m-d',strtotime($input['memo_date'])):$input['memo_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Memo  Updated Successfully.');
                memos::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Memo  Added Successfully.');
                memos::insertGetId($input);
            }
            return redirect('/memos');
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
        $result = memos::find($id);
        $action = 'add';
        $editname = "Edit Memo " . $result->employee;
        return view('hrmodule.memos.add')->with([
            'action' => $action,
            'pageTitle' => "memos",
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
        $memos = memos::find($id);
        $memos->status = 0;
        $memos->save();
        Session::flash('message', 'Memo delete successfully');
        return redirect("/memos");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'memos'), function () {
            Route::get('/', array('as' => 'memos.index', 'uses' => 'MemosController@index'));
            Route::get('/add', array('as' => 'memos.create', 'uses' => 'MemosController@create'));
            Route::post('/save', array('as' => 'memos.save', 'uses' => 'MemosController@store'));
            Route::get('/edit/{id}', array('as' => 'memos.edit', 'uses' => 'MemosController@edit'));
            Route::post('/update/{id}', array('as' => 'memos.update', 'uses' => 'MemosController@update'));
            Route::get('/delete/{id}', array('as' => 'memos.destroy', 'uses' => 'MemosController@destroy'));
        });
    }
}

