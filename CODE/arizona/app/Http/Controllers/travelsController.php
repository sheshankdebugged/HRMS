<?php

namespace App\Http\Controllers;

use App\Models\Travels;
use App\Models\Employees;
use App\Models\EmployeeDesignation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class TravelsController extends Controller
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
                ['employee', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =  Travels::where($where)->paginate(10);


        // $list = Travels::where(['status'=>1])->paginate(10);
        return view('hrmodule.travels.list')->with([
            'listData' => $list,
            'pageTitle'=>"Travels"
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
        $master = $this->getmasterfields();
        return view('hrmodule.travels.add')->with([
            'action' => $action,
            'pageTitle'=>"Travels",
            'Addform'  =>"Add New Travels",
            'master' => $master
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
                'purpose_of_visit' => 'required',


            ]);
           if ($validator->fails()) {
                $action = 'travels';
                return redirect('/travels')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                         'action' => $action
                    ]);
            }

            $input = $request->all();
            echo "<pre>";

       
            $input['travel_start_date'] = ($input['travel_start_date'] !="")?date('Y-m-d',strtotime($input['travel_start_date'])):$input['travel_start_date'];
            $input['travel_end_date']   = ($input['travel_end_date'] !="")?date('Y-m-d',strtotime($input['travel_end_date'])):$input['travel_end_date'];
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Travels Updated Successfully.');
                Travels::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                // $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Travels  Added Successfully.');
                Travels::insertGetId($input);
            }
            return redirect('/travels');
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
        $master = $this->getmasterfields();
        $result = Travels::find($id);
        $action = 'add';
        $editname = "Edit ".$result->purpose_of_visit;
        return view('hrmodule.travels.add')->with([
            'action' => $action,
            'pageTitle'=>"Travels",
            'Addform'  =>$editname,
            'result'  =>$result,
            'master' => $master
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
        $travels = Travels::find($id);
        $travels->status = 0;
        $travels->save();
        Session::flash('message', 'Travels delete successfully');
        return redirect("/travels");
    }


    /**
     * For Setting Job Posts Routes
     */
    static function routes() {
          Route::group(array('prefix' => 'travels'), function() {
            Route::get('/', array('as' => 'travels.index', 'uses' => 'TravelsController@index'));
            Route::get('/add', array('as' => 'travels.create', 'uses' => 'TravelsController@create'));
            Route::post('/save', array('as' => 'travels.save', 'uses' => 'TravelsController@store'));
            Route::get('/edit/{id}', array('as' => 'travels.edit', 'uses' => 'TravelsController@edit'));
            Route::post('/update/{id}', array('as' => 'travels.update', 'uses' => 'TravelsController@create'));
            Route::get('/delete/{id}', array('as' => 'travels.destroy', 'uses' => 'TravelsController@destroy'));
        });

    }
    
    public function getmasterfields()
    {
        $master = array();
              $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
              $master['EmployeeDesignation']     = EmployeeDesignation::where(['status' => 1])->get()->toArray();
       
        return $master;
    }
}
