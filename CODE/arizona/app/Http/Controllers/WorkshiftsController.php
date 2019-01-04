<?php

namespace App\Http\Controllers;

use App\Models\WorkShifts;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class WorkshiftsController extends Controller
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
                ['title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =workshifts::where($where)->paginate(10);

        // $list = workshifts::where(['status'=>1])->paginate(10);
        return view('hrmodule.workshifts.list')->with([
            'listData' => $list,
            'pageTitle'=>"Work Shifts"
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
        return view('hrmodule.workshifts.add')->with([
            'action' => $action,
            'pageTitle'=>"Work Shifts",
            'Addform'  =>"Add New Work Shift"
        ]);
        // $action = 'add';
        // return view('hrmodule.specificdaysOff.add')->with([
        //     'action' => $action,
        //     'pageTitle'=>"Work Shifts",
        //     'Addform'  =>"Specific Days Off"
        // ]);

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
                'title' => 'required',


            ]);
           if ($validator->fails()) {
                $action = 'addworkshifts';
                return redirect('/addworkshifts')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                         'action' => $action
                    ]);
            }

            $input = $request->all();
            echo "<pre>";

       
            // $input['start_date'] = ($input['start_date'] !="")?date('Y-m-d',strtotime($input['start_date'])):$input['start_date'];
            // $input['due_date']   = ($input['due_date'] !="")?date('Y-m-d',strtotime($input['due_date'])):$input['due_date'];
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Work shift Updated Successfully.');
                workshifts::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Work shift  Added Successfully.');
                workshifts::insertGetId($input);
            }
            return redirect('/workshifts');
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
        $result = workshifts::find($id);
        $action = 'add';
        $editname = "Edit ".$result->Workshift_name;
        return view('hrmodule.workshifts.add')->with([
            'action' => $action,
            'pageTitle'=>"Work Shifts",
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
        $workshifts = workshifts::find($id);
        $workshifts->status = 0;
        $workshifts->save();
        Session::flash('message', 'Workshift delete successfully');
        return redirect("/workshifts");
    }


    /**
     * For Setting Job Posts Routes
     */
    static function routes() {
          Route::group(array('prefix' => 'workshifts'), function() {
            Route::get('/', array('as' => 'workshifts.index', 'uses' => 'WorkshiftsController@index'));
            Route::get('/add', array('as' => 'workshifts.create', 'uses' => 'WorkshiftsController@create'));
            Route::post('/save', array('as' => 'workshifts.save', 'uses' => 'WorkshiftsController@store'));
            Route::get('/edit/{id}', array('as' => 'workshifts.edit', 'uses' => 'WorkshiftsController@edit'));
            Route::post('/update/{id}', array('as' => 'workshifts.create', 'uses' => 'WorkshiftsController@create'));
            Route::get('/delete/{id}', array('as' => 'workshifts.destroy', 'uses' => 'WorkshiftsController@destroy'));
        });

    }
}
