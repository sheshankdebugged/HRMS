<?php

namespace App\Http\Controllers;

use App\Models\Providentfunds;
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

class ProvidentfundsController extends Controller
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
                ['provident_fund_type', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = providentfunds::where($where)->paginate(10);

        // $list = providentfunds::where(['status' => 1])->paginate(10);
        return view('hrmodule.providentfunds.list')->with([
            'listData' => $list,
            'pageTitle' => "Provident funds",
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
        return view('hrmodule.providentfunds.add')->with([
            'action' => $action,
            'pageTitle' => "Provident funds",
            'Addform' => "Add New Provident funds",
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
               
            ]);
            if ($validator->fails()) {
                $action = 'addprovidentfunds';
                return redirect('/providentfunds/add')
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
                $file->move('./img/uploads/providentfunds/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            // $input['providentfunds_date'] = ($input['providentfunds_date'] !="")?date('Y-m-d',strtotime($input['providentfunds_date'])):$input['providentfunds_date'];
            
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Provident funds Updated Successfully.');
                providentfunds::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Provident funds  Added Successfully.');
                providentfunds::insertGetId($input);
            }
            return redirect('/providentfunds');
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
        $result = providentfunds::find($id);
        $action = 'add';
        $editname = "Edit providentfunds " . $result->employee;
        return view('hrmodule.providentfunds.add')->with([
            'action' => $action,
            'pageTitle' => "Provident funds",
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
        $providentfunds = providentfunds::find($id);
        $providentfunds->status = 0;
        $providentfunds->save();
        Session::flash('message', ' Provident funds delete successfully');
        return redirect("/providentfunds");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'providentfunds'), function () {
            Route::get('/', array('as' => 'providentfunds.index', 'uses' => 'ProvidentfundsController@index'));
            Route::get('/add', array('as' => 'providentfunds.create', 'uses' => 'ProvidentfundsController@create'));
            Route::post('/save', array('as' => 'providentfunds.save', 'uses' => 'ProvidentfundsController@store'));
            Route::get('/edit/{id}', array('as' => 'providentfunds.edit', 'uses' => 'ProvidentfundsController@edit'));
            Route::post('/update/{id}', array('as' => 'providentfunds.update', 'uses' => 'ProvidentfundsController@update'));
            Route::get('/delete/{id}', array('as' => 'providentfunds.destroy', 'uses' => 'ProvidentfundsController@destroy'));
        });
    }
}

