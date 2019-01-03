<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\OrganizationDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\GeneralSettings;
use App\Models\TimeZone;
use App\Models\DateFormat;
use App\Models\TimeFormat;

class OrganizationDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $user_id = Auth::id();
        $master = $this->getmasterfields();
        $timezone = $this->gettimezone();
        $dateformat = $this->getdateformat();
        $timeformat = $this->gettimeformat();
        // echo $user_id;
        // die();

        // echo "$user_id";
        // $list = OrganizationDetails::where(['user_id' => $user_id])->paginate(10);
        $list = OrganizationDetails::where(['status' => 1, 'user_id' => $user_id])->get();
        $list1 = GeneralSettings::where(['status' => 1])->get();


        return view('hrmodule.setting')->with([
            'listData' => $list[0],
            'pageTitle' => "Organization Details",
            'master' => $master,
            'listData1'=> $list1,
            'timezone'=> $timezone,
            'dateformat'=> $dateformat,
            'timeformat'=> $timeformat
        ]);
        //return view('hrmodule.setting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // die('yes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        die();
        $master = $this->getmasterfields();
        if ($request->all()) {
            // $validator = Validator::make($request->all(), [
            //     'job_title' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     $action = 'addjobpost';
            //     return redirect('jobposts/add
            //     ')
            //         ->withErrors($validator)
            //         ->withInput()
            //         ->with([
            //             'action' => $action,
            //         ]);
            // }

            $input = $request->all();

             echo "$input";
            // print_r($input); die;

            // $input['status'] = 1;
            // $input['user_id'] = Auth::id();

            // unset($input['_token']);
            // if ($input['id'] > 0) {
            //     $input['updated_at'] = date("Y-m-d H:i:s");
            //     Session::flash('message', 'Job Post  Updated Successfully.');
            //     JobPosts::where('id', $input['id'])->update($input);
            // } else {
            //     unset($input['id']);
            //     $input['created_at'] = date("Y-m-d H:i:s");
            //     $input['updated_at'] = date("Y-m-d H:i:s");
            //     Session::flash('message', 'Job Post Added Successfully.');
            //     JobPosts::insertGetId($input);
            // }
            return redirect('/setting');

        }
    }
    public function storegeneral()
    {
        die('yes');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationDetails  $OrganizationDetails
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationDetails $OrganizationDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationDetails  $OrganizationDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationDetails $OrganizationDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationDetails  $OrganizationDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationDetails $OrganizationDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationDetails  $OrganizationDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationDetails $OrganizationDetails)
    {
        //
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'setting'), function () {
            Route::get('/', array('as' => 'organizationdetails.index', 'uses' => 'OrganizationDetailsController@index'));
            Route::get('/add', array('as' => 'organizationdetails.create', 'uses' => 'OrganizationDetailsController@create'));
            Route::post('/save', array('as' => 'organizationdetails.save', 'uses' => 'OrganizationDetailsController@store'));
            Route::post('/savegeneral', array('as' => 'organizationdetails.savegeneral', 'uses' => 'OrganizationDetailsController@storegeneral'));
            Route::get('/edit/{id}', array('as' => 'organizationdetails.edit', 'uses' => 'OrganizationDetailsController@edit'));
            Route::post('/update/{id}', array('as' => 'organizationdetails.create', 'uses' => 'OrganizationDetailsController@create'));
            Route::get('/delete/{id}', array('as' => 'organizationdetails.destroy', 'uses' => 'OrganizationDetailsController@destroy'));
        });

    }
    public function getmasterfields()
    {
        $master = array();

        $master['Countries'] = Countries::where(['status' => 1])->get()->toArray();
        return $master;
    }
    public function gettimezone()
    {
        $timezone = array();

        $timezone['TimeZone'] = TimeZone::where(['status' => 1])->get()->toArray();
        return $timezone;
    }
    public function getdateformat()
    {
        $dateformat = array();

        $dateformat['DateFormat'] = DateFormat::where(['status' => 1])->get()->toArray();
        return $dateformat;
    }
    public function gettimeformat()
    {
        $timeformat = array();

        $timeformat['TimeFormat'] = TimeFormat::where(['status' => 1])->get()->toArray();
        return $timeformat;
    }
}
