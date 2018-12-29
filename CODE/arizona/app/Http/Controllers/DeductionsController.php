<?php

namespace App\Http\Controllers;

use App\Models\Deductions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;


class DeductionsController extends Controller
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
                ['deductions_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = deductions::where($where)->paginate(10);

        // $list = deductions::where(['status' => 1])->paginate(10);
        return view('hrmodule.deductions.list')->with([
            'listData' => $list,
            'pageTitle' => "Deductions",
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
        return view('hrmodule.deductions.add')->with([
            'action' => $action,
            'pageTitle' => "Deductions",
            'Addform' => "Add New Deduction",
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
                'deductions_title' => 'required',
                'deductions_date' => 'required',
                'deductions_amount' => 'required',                   
            ]);
            if ($validator->fails()) {
                $action = 'adddeductions';
                return redirect('/deductions/add')
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
                $file->move('./img/uploads/deductions/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['deductions_date'] = ($input['deductions_date'] !="")?date('Y-m-d',strtotime($input['deductions_date'])):$input['deductions_date'];
            // $input['repayment_start_date'] = ($input['repayment_start_date'] !="")?date('Y-m-d',strtotime($input['repayment_start_date'])):$input['repayment_start_date'];

            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Deduction Updated Successfully.');
                deductions::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Deduction  Added Successfully.');
                deductions::insertGetId($input);
            }
            return redirect('/deductions');
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
        $result = deductions::find($id);
        $action = 'add';
        $editname = "Edit Deduction " . $result->employee;
        return view('hrmodule.deductions.add')->with([
            'action' => $action,
            'pageTitle' => "Deductions",
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
        $deductions = deductions::find($id);
        $deductions->status = 0;
        $deductions->save();
        Session::flash('message', ' Deduction delete successfully');
        return redirect("/deductions");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'deductions'), function () {
            Route::get('/', array('as' => 'deductions.index', 'uses' => 'DeductionsController@index'));
            Route::get('/add', array('as' => 'deductions.create', 'uses' => 'DeductionsController@create'));
            Route::post('/save', array('as' => 'deductions.save', 'uses' => 'DeductionsController@store'));
            Route::get('/edit/{id}', array('as' => 'deductions.edit', 'uses' => 'DeductionsController@edit'));
            Route::post('/update/{id}', array('as' => 'deductions.update', 'uses' => 'DeductionsController@update'));
            Route::get('/delete/{id}', array('as' => 'deductions.destroy', 'uses' => 'DeductionsController@destroy'));
        });
    }
}

