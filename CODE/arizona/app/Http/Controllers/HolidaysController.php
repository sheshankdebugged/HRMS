<?php

namespace App\Http\Controllers;

use App\Models\Holidays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class HolidaysController extends Controller
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
                ['holiday_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = holidays::where($where)->paginate(10);

        //

        // $list = holidays::where(['status' => 1])->paginate(10);

        // echo "<pre>";
        //print_r($list);

        // die;
        return view('hrmodule.holidays.list')->with([
            'listData' => $list,
            'pageTitle' => "Holidays",
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
        return view('hrmodule.holidays.add')->with([
            'action' => $action,
            'pageTitle' => "Holidays",
            'Addform' => "Add New holidays",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'holiday_title' => 'required',

            ]);
            if ($validator->fails()) {
                $action = 'addholidays';
                return redirect('/holidays/add')
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
                $file->move('./img/uploads/Companies/', $input['icon_img']);
            }
            $input['holiday_start_date'] = ($input['holiday_start_date'] !="")?date('Y-m-d',strtotime($input['holiday_start_date'])):$input['holiday_start_date'];
            $input['holiday_end_date'] = ($input['holiday_end_date'] !="")?date('Y-m-d',strtotime($input['holiday_end_date'])):$input['holiday_end_date'];
            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Holiday  Updated Successfully.');
                holidays::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Holiday  Added Successfully.');
                holidays::insertGetId($input);
            }
            return redirect('/holidays');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\holidays  $holidays
     * @return \Illuminate\Http\Response
     */
    public function show(holidays $holidays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\holidays  $holidays
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $action = 'edit';
        $result = holidays::find($id);
        $action = 'add';
        $editname = "Edit " . $result->holiday_title;
        return view('hrmodule.holidays.add')->with([
            'action' => $action,
            'pageTitle' => "Holiday",
            'Addform' => $editname,
            'result' => $result,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\holidays  $holidays
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, holidays $holidays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\holidays  $holidays
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Companies = holidays::find($id);
        $Companies->status = 0;
        $Companies->save();
        Session::flash('message', 'Holiday delete successfully');
        return redirect("/holidays");
    }
    public static function routes()
    {
           Route::group(array('prefix' => 'holidays'), function () {
            Route::get('/', array('as' => 'holidays.index', 'uses' => 'HolidaysController@index'));
            Route::get('/add', array('as' => 'holidays.create', 'uses' => 'HolidaysController@create'));
            Route::post('/save', array('as' => 'holidays.save', 'uses' => 'HolidaysController@store'));
            Route::get('/edit/{id}', array('as' => 'holidays.edit', 'uses' => 'HolidaysController@edit'));
            Route::post('/update/{id}', array('as' => 'holidays.update', 'uses' => 'HolidaysController@update'));
            Route::get('/delete/{id}', array('as' => 'holidays.destroy', 'uses' => 'HolidaysController@destroy'));
        });

    }
}
