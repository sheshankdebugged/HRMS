<?php

namespace App\Http\Controllers;

use App\Models\commissions;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;


class CommissionsController extends Controller
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
                ['commissions_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = commissions::where($where)->paginate(10);

        // $list = commissions::where(['status' => 1])->paginate(10);
        return view('hrmodule.commissions.list')->with([
            'listData' => $list,
            'pageTitle' => "Commissions",
          

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
        return view('hrmodule.commissions.add')->with([
            'action' => $action,
            'pageTitle' => "Commissions",
            'Addform' => "Add New Commission",
            'master' => $master
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
        $master = $this->getmasterfields();
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'employee_name' => 'required',
                'commissions_title' => 'required',
                'commissions_date' => 'required',
                'commissions_amount' => 'required',                   
            ]);
            if ($validator->fails()) {
                $action = 'addcommissions';
                return redirect('/commissions/add')
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
                $file->move('./img/uploads/commissions/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['commissions_date'] = ($input['commissions_date'] !="")?date('Y-m-d',strtotime($input['commissions_date'])):$input['commissions_date'];
            // $input['repayment_start_date'] = ($input['repayment_start_date'] !="")?date('Y-m-d',strtotime($input['repayment_start_date'])):$input['repayment_start_date'];

            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Commission Updated Successfully.');
                commissions::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Commission  Added Successfully.');
                commissions::insertGetId($input);
            }
            return redirect('/commissions');
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
        $result = commissions::find($id);
        $action = 'add';
        $editname = "Edit Commission " . $result->employee;
        return view('hrmodule.commissions.add')->with([
            'action' => $action,
            'pageTitle' => "Commissions",
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
        $commissions = commissions::find($id);
        $commissions->status = 0;
        $commissions->save();
        Session::flash('message', ' Commission delete successfully');
        return redirect("/commissions");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'commissions'), function () {
            Route::get('/', array('as' => 'commissions.index', 'uses' => 'CommissionsController@index'));
            Route::get('/add', array('as' => 'commissions.create', 'uses' => 'CommissionsController@create'));
            Route::post('/save', array('as' => 'commissions.save', 'uses' => 'CommissionsController@store'));
            Route::get('/edit/{id}', array('as' => 'commissions.edit', 'uses' => 'CommissionsController@edit'));
            Route::post('/update/{id}', array('as' => 'commissions.update', 'uses' => 'CommissionsController@update'));
            Route::get('/delete/{id}', array('as' => 'commissions.destroy', 'uses' => 'CommissionsController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
        $master['EmployeeName'] = Employees::where(['status' => 1])->get()->toArray();
       
        return $master;
    }
}

