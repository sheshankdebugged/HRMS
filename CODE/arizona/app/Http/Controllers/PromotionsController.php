<?php

namespace App\Http\Controllers;

use App\Models\Promotions;
use App\Models\Employees;
use App\Models\EmployeeDesignation;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class PromotionsController extends Controller
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
                ['promotion_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = promotions::where($where)->paginate(10);

        // $list = promotions::where(['status' => 1])->paginate(10);
        return view('hrmodule.promotions.list')->with([
            'listData' => $list,
            'pageTitle' => "Promotions",
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
        return view('hrmodule.promotions.add')->with([
            'action' => $action,
            'pageTitle' => "Promotions",
            'Addform' => "Add New Promotion",
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
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'employee_id' => 'required',
                 'promotion_title' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'addpromotions';
                return redirect('/promotions/add')
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
                $file->move('./img/uploads/promotions/', $input['icon_img']);
            }

            echo "<pre>";

       
            $input['promotion_date'] = ($input['promotion_date'] !="")?date('Y-m-d',strtotime($input['promotion_date'])):$input['promotion_date'];
            // $input['poll_end_date']   = ($input['poll_end_date'] !="")?date('Y-m-d',strtotime($input['poll_end_date'])):$input['poll_end_date'];
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Promotions Updated Successfully.');
                Promotions::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Promotions  Added Successfully.');
                Promotions::insertGetId($input);
            }
            return redirect('/promotions');
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
        $result = Promotions::find($id);
        $action = 'add';
        $editname = "Edit  " . $result->employee_id;
        return view('hrmodule.promotions.add')->with([
            'action' => $action,
            'pageTitle' => "Promotions",
            'Addform' => $editname,
            'result' => $result,
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
        $promotions = Promotions::find($id);
        $promotions->status = 0;
        $promotions->save();
        Session::flash('message', ' Promotions delete successfully');
        return redirect("/promotions");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'promotions'), function () {
            Route::get('/', array('as' => 'promotions.index', 'uses' => 'PromotionsController@index'));
            Route::get('/add', array('as' => 'promotions.create', 'uses' => 'PromotionsController@create'));
            Route::post('/save', array('as' => 'promotions.save', 'uses' => 'PromotionsController@store'));
            Route::get('/edit/{id}', array('as' => 'promotions.edit', 'uses' => 'PromotionsController@edit'));
            Route::post('/update/{id}', array('as' => 'promotions.update', 'uses' => 'PromotionsController@update'));
            Route::get('/delete/{id}', array('as' => 'promotions.destroy', 'uses' => 'PromotionsController@destroy'));
        });
    }
    public function getmasterfields()
    {
        $master = array();
              $master['Employees']               = Employees::where(['status' => 1])->get()->toArray();
              $master['EmployeeDesignation']     = EmployeeDesignation::where(['status' => 1])->get()->toArray();
              $master['Grade']                   = Grade::where(['status' => 1])->get()->toArray();
        return $master;
    }
}

