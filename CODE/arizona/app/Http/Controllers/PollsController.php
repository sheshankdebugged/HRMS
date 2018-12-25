<?php

namespace App\Http\Controllers;

use App\Models\Polls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class PollsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = polls::where(['status' => 1])->paginate(10);
        return view('hrmodule.polls.list')->with([
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
        return view('hrmodule.polls.add')->with([
            'action' => $action,
            'pageTitle' => "polls",
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
                $action = 'addpolls';
                return redirect('/polls/add')
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
                $file->move('./img/uploads/polls/', $input['icon_img']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Companie  Updated Successfully.');
                polls::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Companie  Added Successfully.');
                polls::insertGetId($input);
            }
            return redirect('/polls');
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
        $result = polls::find($id);
        $action = 'add';
        $editname = "Edit Transfer " . $result->employee;
        return view('hrmodule.polls.add')->with([
            'action' => $action,
            'pageTitle' => "polls",
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
        $polls = polls::find($id);
        $polls->status = 0;
        $polls->save();
        Session::flash('message', 'Contracts delete successfully');
        return redirect("/polls");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'polls'), function () {
            Route::get('/', array('as' => 'polls.index', 'uses' => 'pollsController@index'));
            Route::get('/add', array('as' => 'polls.create', 'uses' => 'pollsController@create'));
            Route::post('/save', array('as' => 'polls.save', 'uses' => 'pollsController@store'));
            Route::get('/edit/{id}', array('as' => 'polls.edit', 'uses' => 'pollsController@edit'));
            Route::post('/update/{id}', array('as' => 'polls.update', 'uses' => 'pollsController@update'));
            Route::get('/delete/{id}', array('as' => 'polls.destroy', 'uses' => 'pollsController@destroy'));
        });
    }
}

