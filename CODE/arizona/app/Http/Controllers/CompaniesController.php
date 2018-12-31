<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\CompanyType;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Form;
use Session;
use Validator;

class CompaniesController extends Controller
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
                ['company_name', 'LIKE', "%$searchQuery%"],
                ['status', '=', 1],
                ['user_id', '=', $user_id],
            ];   
        }

        $list = Companies::where($where)->paginate(10);
        return view('hrmodule.companies.list')->with([
            'listData' => $list,
            'pageTitle' => "Companies",
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
        return view('hrmodule.companies.add')->with([
            'action' => $action,
            'pageTitle' => "Companies",
            'Addform' => "Add New Company",
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
                'company_name' => 'required'
            ]);
            if ($validator->fails()) {
                $action = 'addcompanies';
                return redirect('companies/add')
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

            $input['status'] = 1;
            $input['user_id'] = $user_id;
            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Companie  Updated Successfully.');
                Companies::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Companie  Added Successfully.');
                Companies::insertGetId($input);
            }
            return redirect('/companies');
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
        $result = Companies::find($id);
        $action = 'add';
        $master = $this->getmasterfields();
        $editname = "Edit " . $result->company_name;
        return view('hrmodule.companies.add')->with([
            'action' => $action,
            'pageTitle' => "Companies",
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
        $Companies = Companies::find($id);
        $Companies->status = 0;
        $Companies->save();
        Session::flash('message', 'Company deletd successfully');
        return redirect("/companies");
    }
    public static function routes()
    {
            Route::group(array('prefix' => 'companies'), function () {
            Route::get('/', array('as' => 'companies.index', 'uses' => 'CompaniesController@index'));
            Route::get('/add', array('as' => 'companies.create', 'uses' => 'CompaniesController@create'));
            Route::post('/save', array('as' => 'companies.save', 'uses' => 'CompaniesController@store'));
            Route::get('/edit/{id}', array('as' => 'companies.edit', 'uses' => 'CompaniesController@edit'));
            Route::post('/update/{id}', array('as' => 'companies.update', 'uses' => 'CompaniesController@update'));
            Route::get('/delete/{id}', array('as' => 'companies.destroy', 'uses' => 'CompaniesController@destroy'));
        });
    }

    /*
     *
     */

    public function getmasterfields()
    {
        $master = array();
        $master['CompanyType']             = CompanyType::where(['status' => 1])->get()->toArray();
        $master['Countries']               = Countries::where(['status' => 1])->get()->toArray();
        // $master['Stations']                = Stations::where(['status'=>1])->get()->toArray();
        // $master['Departments']             = Departments::where(['status'=>1])->get()->toArray();
        // $master['EmployeeType']            = EmployeeType::where(['status'=>1])->get()->toArray();
        // $master['EmployeeCategory']        = [];//EmployeeCategory::where(['status'=>1])->get()->toArray();
        // $master['EmployeeDesignation']     = [];//EmployeeDesignation::where(['status'=>1])->get()->toArray();
        return $master;
    }
}
