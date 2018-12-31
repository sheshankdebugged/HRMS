<?php

namespace App\Http\Controllers;

use App\Models\Overtimes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class OvertimesController extends Controller
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
                ['overtimes_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = overtimes::where($where)->paginate(10);

        // $list = overtimes::where(['status' => 1])->paginate(10);
        return view('hrmodule.overtimes.list')->with([
            'listData' => $list,
            'pageTitle' => "Overtimes",
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
        return view('hrmodule.overtimes.add')->with([
            'action' => $action,
            'pageTitle' => "Overtimes",
            'Addform' => "Add New Overtime",
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
                'employee_name' => 'required',
                'overtimes_title' => 'required',
                'overtimes_date' => 'required',
                    
            ]);
            if ($validator->fails()) {
                $action = 'addovertimes';
                return redirect('/overtimes/add')
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
                $file->move('./img/uploads/overtimes/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['overtimes_date'] = ($input['overtimes_date'] !="")?date('Y-m-d',strtotime($input['overtimes_date'])):$input['overtimes_date'];
            
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Overtime Updated Successfully.');
                overtimes::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Overtime  Added Successfully.');
                overtimes::insertGetId($input);
            }
            return redirect('/overtimes');
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
        $result = overtimes::find($id);
        $action = 'add';
        $editname = "Edit overtimes " . $result->employee;
        return view('hrmodule.overtimes.add')->with([
            'action' => $action,
            'pageTitle' => "Overtimes",
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
        $overtimes = overtimes::find($id);
        $overtimes->status = 0;
        $overtimes->save();
        Session::flash('message', ' Overtime delete successfully');
        return redirect("/overtimes");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'overtimes'), function () {
            Route::get('/', array('as' => 'overtimes.index', 'uses' => 'OvertimesController@index'));
            Route::get('/add', array('as' => 'overtimes.create', 'uses' => 'OvertimesController@create'));
            Route::post('/save', array('as' => 'overtimes.save', 'uses' => 'OvertimesController@store'));
            Route::get('/edit/{id}', array('as' => 'overtimes.edit', 'uses' => 'OvertimesController@edit'));
            Route::post('/update/{id}', array('as' => 'overtimes.update', 'uses' => 'OvertimesController@update'));
            Route::get('/delete/{id}', array('as' => 'overtimes.destroy', 'uses' => 'OvertimesController@destroy'));
        });
    }
}

