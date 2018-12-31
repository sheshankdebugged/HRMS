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
        $user_id = Auth::id();
        $searchQuery  = isset($_GET['search'])?trim($_GET['search']):"";
        $where   = ['status'=>1,'user_id'=>$user_id];
        
        if(!empty($searchQuery)){
            $where = [
                ['poll_question', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = polls::where($where)->paginate(10);


        // $list = polls::where(['status' => 1])->paginate(10);
        return view('hrmodule.polls.list')->with([
            'listData' => $list,
            'pageTitle' => "Polls",
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
            'pageTitle' => "Polls",
            'Addform' => "Add New Poll",
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
                'poll_question' => 'required',
                'poll_answer_1' => 'required',
                'poll_answer_2' => 'required'
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

            echo "<pre>";

       
            $input['poll_start_date'] = ($input['poll_start_date'] !="")?date('Y-m-d',strtotime($input['poll_start_date'])):$input['poll_start_date'];
            $input['poll_end_date']   = ($input['poll_end_date'] !="")?date('Y-m-d',strtotime($input['poll_end_date'])):$input['poll_end_date'];
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Polls Updated Successfully.');
                polls::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Polls  Added Successfully.');
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
        Session::flash('message', ' Polls delete successfully');
        return redirect("/polls");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'polls'), function () {
            Route::get('/', array('as' => 'polls.index', 'uses' => 'PollsController@index'));
            Route::get('/add', array('as' => 'polls.create', 'uses' => 'PollsController@create'));
            Route::post('/save', array('as' => 'polls.save', 'uses' => 'PollsController@store'));
            Route::get('/edit/{id}', array('as' => 'polls.edit', 'uses' => 'PollsController@edit'));
            Route::post('/update/{id}', array('as' => 'polls.update', 'uses' => 'PollsController@update'));
            Route::get('/delete/{id}', array('as' => 'polls.destroy', 'uses' => 'PollsController@destroy'));
        });
    }
}

