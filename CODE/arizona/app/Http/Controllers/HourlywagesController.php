<?php

namespace App\Http\Controllers;

use App\Models\Hourlywages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class HourlywagesController extends Controller
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
                ['hourlywages_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = hourlywages::where($where)->paginate(10);

        // $list = hourlywages::where(['status' => 1])->paginate(10);
        return view('hrmodule.hourlywages.list')->with([
            'listData' => $list,
            'pageTitle' => "Hourly Wages",
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
        return view('hrmodule.hourlywages.add')->with([
            'action' => $action,
            'pageTitle' => "Hourly Wages",
            'Addform' => "Add New hourly wages",
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
                'hourlywages_date' => 'required',
                'hourlywages_title' => 'required',
                'regular_hours' => 'required',
                'overtime_hours' => 'required'
            ]);
            if ($validator->fails()) {
                $action = 'addhourlywages';
                return redirect('/hourlywages/add')
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
                $file->move('./img/uploads/hourlywages/', $input['icon_img']);
            }

            echo "<pre>";

       
        
            $input['hourlywages_date'] = ($input['hourlywages_date'] !="")?date('Y-m-d',strtotime($input['hourlywages_date'])):$input['hourlywages_date'];
            
            $input['status'] =  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Hourly wages Updated Successfully.');
                hourlywages::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Hourly wages  Added Successfully.');
                hourlywages::insertGetId($input);
            }
            return redirect('/hourlywages');
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
        $result = hourlywages::find($id);
        $action = 'add';
        $editname = "Edit hourlywages " . $result->employee;
        return view('hrmodule.hourlywages.add')->with([
            'action' => $action,
            'pageTitle' => "Hourly Wages",
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
        $hourlywages = hourlywages::find($id);
        $hourlywages->status = 0;
        $hourlywages->save();
        Session::flash('message', ' Hourly wages delete successfully');
        return redirect("/hourlywages");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'hourlywages'), function () {
            Route::get('/', array('as' => 'hourlywages.index', 'uses' => 'HourlywagesController@index'));
            Route::get('/add', array('as' => 'hourlywages.create', 'uses' => 'HourlywagesController@create'));
            Route::post('/save', array('as' => 'hourlywages.save', 'uses' => 'HourlywagesController@store'));
            Route::get('/edit/{id}', array('as' => 'hourlywages.edit', 'uses' => 'HourlywagesController@edit'));
            Route::post('/update/{id}', array('as' => 'hourlywages.update', 'uses' => 'HourlywagesController@update'));
            Route::get('/delete/{id}', array('as' => 'hourlywages.destroy', 'uses' => 'HourlywagesController@destroy'));
        });
    }
}

