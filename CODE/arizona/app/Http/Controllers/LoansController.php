<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class LoansController extends Controller
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
                ['loans_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = loans::where($where)->paginate(10);

        // $list = loans::where(['status' => 1])->paginate(10);
        return view('hrmodule.loans.list')->with([
            'listData' => $list,
            'pageTitle' => "Loans",
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
        return view('hrmodule.loans.add')->with([
            'action' => $action,
            'pageTitle' => "Loans",
            'Addform' => "Add New Loan",
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
                'loans_title' => 'required',
                'loans_date' => 'required',
                'monthly_repayment_amount' => 'required',
                'repayment_start_date' => 'required'                    
            ]);
            if ($validator->fails()) {
                $action = 'addloans';
                return redirect('/loans/add')
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
                $file->move('./img/uploads/loans/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['loans_date'] = ($input['loans_date'] !="")?date('Y-m-d',strtotime($input['loans_date'])):$input['loans_date'];
            $input['repayment_start_date'] = ($input['repayment_start_date'] !="")?date('Y-m-d',strtotime($input['repayment_start_date'])):$input['repayment_start_date'];

            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Loan Updated Successfully.');
                loans::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Loan  Added Successfully.');
                loans::insertGetId($input);
            }
            return redirect('/loans');
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
        $result = loans::find($id);
        $action = 'add';
        $editname = "Edit loans " . $result->employee;
        return view('hrmodule.loans.add')->with([
            'action' => $action,
            'pageTitle' => "Loans",
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
        $loans = loans::find($id);
        $loans->status = 0;
        $loans->save();
        Session::flash('message', ' Loan delete successfully');
        return redirect("/loans");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'loans'), function () {
            Route::get('/', array('as' => 'loans.index', 'uses' => 'LoansController@index'));
            Route::get('/add', array('as' => 'loans.create', 'uses' => 'LoansController@create'));
            Route::post('/save', array('as' => 'loans.save', 'uses' => 'LoansController@store'));
            Route::get('/edit/{id}', array('as' => 'loans.edit', 'uses' => 'LoansController@edit'));
            Route::post('/update/{id}', array('as' => 'loans.update', 'uses' => 'LoansController@update'));
            Route::get('/delete/{id}', array('as' => 'loans.destroy', 'uses' => 'LoansController@destroy'));
        });
    }
}

