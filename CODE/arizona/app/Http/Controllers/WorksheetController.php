<?php

namespace App\Http\Controllers;

use App\Models\Worksheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class WorksheetController extends Controller
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
                ['Worksheet_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = worksheet::where($where)->paginate(10);

        // $list = worksheet::where(['status' => 1])->paginate(10);
        return view('hrmodule.worksheet.list')->with([
            'listData' => $list,
            'pageTitle' => "worksheet",
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
        return view('hrmodule.worksheet.add')->with([
            'action' => $action,
            'pageTitle' => "worksheet",
            'Addform' => "Add New Worksheet",
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
                $action = 'addworksheet';
                return redirect('/worksheet/add')
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
                $file->move('./img/uploads/worksheet/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['worksheet_date'] = ($input['worksheet_date'] !="")?date('Y-m-d',strtotime($input['worksheet_date'])):$input['worksheet_date'];
            
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'worksheet Updated Successfully.');
                worksheet::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'worksheet  Added Successfully.');
                worksheet::insertGetId($input);
            }
            return redirect('/worksheet');
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
        $result = worksheet::find($id);
        $action = 'add';
        $editname = "Edit Worksheet " . $result->employee;
        return view('hrmodule.worksheet.add')->with([
            'action' => $action,
            'pageTitle' => "worksheet",
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
        $worksheet = worksheet::find($id);
        $worksheet->status = 0;
        $worksheet->save();
        Session::flash('message', ' worksheet delete successfully');
        return redirect("/worksheet");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'worksheet'), function () {
            Route::get('/', array('as' => 'worksheet.index', 'uses' => 'WorksheetController@index'));
            Route::get('/add', array('as' => 'worksheet.create', 'uses' => 'WorksheetController@create'));
            Route::post('/save', array('as' => 'worksheet.save', 'uses' => 'WorksheetController@store'));
            Route::get('/edit/{id}', array('as' => 'worksheet.edit', 'uses' => 'WorksheetController@edit'));
            Route::post('/update/{id}', array('as' => 'worksheet.update', 'uses' => 'WorksheetController@update'));
            Route::get('/delete/{id}', array('as' => 'worksheet.destroy', 'uses' => 'WorksheetController@destroy'));
        });
    }
}

