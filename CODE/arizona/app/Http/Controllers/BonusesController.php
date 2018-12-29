<?php

namespace App\Http\Controllers;

use App\Models\Bonuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class BonusesController extends Controller
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
                ['bonuses_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = bonuses::where($where)->paginate(10);

        // $list = bonuses::where(['status' => 1])->paginate(10);
        return view('hrmodule.bonuses.list')->with([
            'listData' => $list,
            'pageTitle' => "Bonuses",
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
        return view('hrmodule.bonuses.add')->with([
            'action' => $action,
            'pageTitle' => "Bonuses",
            'Addform' => "Add New Bonus",
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
                'bonuses_title' => 'required',
                'bonuses_amount' => 'required',
                'bonuses_date' => 'required'                 
            ]);
            if ($validator->fails()) {
                $action = 'addbonuses';
                return redirect('/bonuses/add')
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
                $file->move('./img/uploads/bonuses/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['bonuses_date'] = ($input['bonuses_date'] !="")?date('Y-m-d',strtotime($input['bonuses_date'])):$input['bonuses_date'];
            // $input['repayment_start_date'] = ($input['repayment_start_date'] !="")?date('Y-m-d',strtotime($input['repayment_start_date'])):$input['repayment_start_date'];

            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Bonus Updated Successfully.');
                bonuses::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Bonus  Added Successfully.');
                bonuses::insertGetId($input);
            }
            return redirect('/bonuses');
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
        $result = bonuses::find($id);
        $action = 'add';
        $editname = "Edit Bonus " . $result->employee;
        return view('hrmodule.bonuses.add')->with([
            'action' => $action,
            'pageTitle' => "Bonuses",
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
        $bonuses = bonuses::find($id);
        $bonuses->status = 0;
        $bonuses->save();
        Session::flash('message', ' Bonus delete successfully');
        return redirect("/bonuses");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'bonuses'), function () {
            Route::get('/', array('as' => 'bonuses.index', 'uses' => 'BonusesController@index'));
            Route::get('/add', array('as' => 'bonuses.create', 'uses' => 'BonusesController@create'));
            Route::post('/save', array('as' => 'bonuses.save', 'uses' => 'BonusesController@store'));
            Route::get('/edit/{id}', array('as' => 'bonuses.edit', 'uses' => 'BonusesController@edit'));
            Route::post('/update/{id}', array('as' => 'bonuses.update', 'uses' => 'BonusesController@update'));
            Route::get('/delete/{id}', array('as' => 'bonuses.destroy', 'uses' => 'BonusesController@destroy'));
        });
    }
}

