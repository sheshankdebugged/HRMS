<?php

namespace App\Http\Controllers;

use App\Models\Achievements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class AchievementsController extends Controller
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
                ['achievement_title', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list = achievements::where($where)->paginate(10);



        // $list = achievements::where(['status' => 1])->paginate(10);
        return view('hrmodule.achievements.list')->with([
            'listData' => $list,
            'pageTitle' => "Achievements",
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
        return view('hrmodule.achievements.add')->with([
            'action' => $action,
            'pageTitle' => "Achievements",
            'Addform' => "Add New Achievement",
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
                'achievement_title' => 'required'
                
            ]);
            if ($validator->fails()) {
                $action = 'addachievements';
                return redirect('/achievements/add')
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
                $file->move('./img/uploads/achievements/', $input['icon_img']);
            }

            echo "<pre>";

       
            $input['achievement_date'] = ($input['achievement_date'] !="")?date('Y-m-d',strtotime($input['achievement_date'])):$input['achievement_date'];
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Achievements Updated Successfully.');
                achievements::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Achievements  Added Successfully.');
                achievements::insertGetId($input);
            }
            return redirect('/achievements');
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
        $result = achievements::find($id);
        $action = 'add';
        $editname = "Edit Achievement " . $result->employee;
        return view('hrmodule.achievements.add')->with([
            'action' => $action,
            'pageTitle' => "Achievements",
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
        $achievements = achievements::find($id);
        $achievements->status = 0;
        $achievements->save();
        Session::flash('message', 'Achievements delete successfully');
        return redirect("/achievements");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'achievements'), function () {
            Route::get('/', array('as' => 'achievements.index', 'uses' => 'AchievementsController@index'));
            Route::get('/add', array('as' => 'achievements.create', 'uses' => 'AchievementsController@create'));
            Route::post('/save', array('as' => 'achievements.save', 'uses' => 'AchievementsController@store'));
            Route::get('/edit/{id}', array('as' => 'achievements.edit', 'uses' => 'AchievementsController@edit'));
            Route::post('/update/{id}', array('as' => 'achievements.update', 'uses' => 'AchievementsController@update'));
            Route::get('/delete/{id}', array('as' => 'achievements.destroy', 'uses' => 'AchievementsController@destroy'));
        });
    }
}

