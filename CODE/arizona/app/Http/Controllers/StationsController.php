<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Divisions;
use App\Models\Stations;
use App\Models\StationTypes;
use App\Models\Employees;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class StationsController extends Controller
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
                ['station_name', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }
        $list =Stations::where($where)->paginate(10);
        return view('hrmodule.stations.list')->with([
            'listData' => $list,
            'pageTitle' => "Stations",
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
        return view('hrmodule.stations.add')->with([
            'action' => $action,
            'pageTitle' => "Stations",
            'Addform' => "Add New Station",
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
                'station_name' => 'required'
            ]);
            if ($validator->fails()) {
                $action = 'addstations';
                return redirect('/stations/add')
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
                $file->move('./img/uploads/stations/', $input['icon_img']);
            }

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Station Updated Successfully.');

                Stations::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Station Added Successfully.');
                Stations::insertGetId($input);
            }
            return redirect('/stations');
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
        $result = Stations::find($id);
        $action = 'add';
        $editname = "Edit " . $result->company_name;
        $master = $this->getmasterfields();
        return view('hrmodule.stations.add')->with([
            'action' => $action,
            'pageTitle' => "stations",
            'Addform' => $editname,
            'result' => $result,
            'master' => $master,
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
        $stations = Stations::find($id);
        $stations->status = 0;
        $stations->save();
        Session::flash('message', 'Station Deleted Successfully');
        return redirect("/stations");
    }

    /*
     *
    */
    function getmasterfields(){
            $master                     = array();
            $master['Companies']        = Companies::where(['status'=>1])->get()->toArray();
            $master['Employees']        = Employees::where(['status'=>1])->get()->toArray();
            $master['Divisions']        = Divisions::where(['status'=>1])->get()->toArray();
            $master['StationTypes']     = StationTypes::where(['status'=>1])->get()->toArray();
            $master['Countries']        = Countries::where(['status' => 1])->get()->toArray();
            return $master;
    }

    public static function routes()
    {
           Route::group(array('prefix' => 'stations'), function () {
            Route::get('/', array('as' => 'stations.index', 'uses' => 'StationsController@index'));
            Route::get('/add', array('as' => 'stations.create', 'uses' => 'StationsController@create'));
            Route::post('/save', array('as' => 'stations.save', 'uses' => 'StationsController@store'));
            Route::get('/edit/{id}', array('as' => 'stations.edit', 'uses' => 'StationsController@edit'));
            Route::post('/update/{id}', array('as' => 'stations.update', 'uses' => 'StationsController@update'));
            Route::get('/delete/{id}', array('as' => 'stations.destroy', 'uses' => 'StationsController@destroy'));
        });

    }
}
