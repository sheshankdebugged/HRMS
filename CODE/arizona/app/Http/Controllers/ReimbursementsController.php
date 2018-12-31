<?php

namespace App\Http\Controllers;

use App\Models\Reimbursements;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;


class ReimbursementsController extends Controller
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
                ['reimbursements_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = reimbursements::where($where)->paginate(10);

        // $list = reimbursements::where(['status' => 1])->paginate(10);
        return view('hrmodule.reimbursements.list')->with([
            'listData' => $list,
            'pageTitle' => "Reimbursements",
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

        return view('hrmodule.reimbursements.add')->with([
            'action' => $action,
            'pageTitle' => "Reimbursements",
            'Addform' => "Add New Reimbursement",
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
                'reimbursements_title' => 'required',
                'reimbursements_date' => 'required',
                // 'reimbursements_amount' => 'required',                   
            ]);
            if ($validator->fails()) {
                $action = 'addreimbursements';
                return redirect('/reimbursements/add')
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
                $file->move('./img/uploads/reimbursements/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['reimbursements_date'] = ($input['reimbursements_date'] !="")?date('Y-m-d',strtotime($input['reimbursements_date'])):$input['reimbursements_date'];
            // $input['repayment_start_date'] = ($input['repayment_start_date'] !="")?date('Y-m-d',strtotime($input['repayment_start_date'])):$input['repayment_start_date'];

            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Reimbursement Updated Successfully.');
                reimbursements::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Reimbursement  Added Successfully.');
                reimbursements::insertGetId($input);
            }
            return redirect('/reimbursements');
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
        $result = reimbursements::find($id);
        $action = 'add';
        $editname = "Edit Reimbursement " . $result->employee;
        return view('hrmodule.reimbursements.add')->with([
            'action' => $action,
            'pageTitle' => "Reimbursements",
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
        $reimbursements = reimbursements::find($id);
        $reimbursements->status = 0;
        $reimbursements->save();
        Session::flash('message', ' Reimbursement delete successfully');
        return redirect("/reimbursements");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'reimbursements'), function () {
            Route::get('/', array('as' => 'reimbursements.index', 'uses' => 'ReimbursementsController@index'));
            Route::get('/add', array('as' => 'reimbursements.create', 'uses' => 'ReimbursementsController@create'));
            Route::post('/save', array('as' => 'reimbursements.save', 'uses' => 'ReimbursementsController@store'));
            Route::get('/edit/{id}', array('as' => 'reimbursements.edit', 'uses' => 'ReimbursementsController@edit'));
            Route::post('/update/{id}', array('as' => 'reimbursements.update', 'uses' => 'ReimbursementsController@update'));
            Route::get('/delete/{id}', array('as' => 'reimbursements.destroy', 'uses' => 'ReimbursementsController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
        $master['EmployeeName'] = Employees::where(['status' => 1])->get()->toArray();
       
        return $master;
    }
}

