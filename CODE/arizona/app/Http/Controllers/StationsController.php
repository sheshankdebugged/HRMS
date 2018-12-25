<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Form;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use App\Models\Stations;
use App\Models\Companies;



class StationsController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $list =Stations::where(['status'=>1])->paginate(10);
        return view('hrmodule.stations.list')->with([
            'listData' => $list,
            'pageTitle'=>"Stations"
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
            'pageTitle'=>"Stations",
            'Addform'  =>"Add New Station",
            'master'  =>$master
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 	bs@hopmanhome.com, triproserv@gmail.com adam.mckinnon75@outlook.com
     */
    public function store(Request $request)
    {
       
        $user_id = Auth::id();
        if($request->all()){ 

            $validator = Validator::make($request->all(), [
                'station_name' => 'required',
               
                
            ]);  
           if ($validator->fails()) {
                $action = 'addstations';
                return redirect('/addstations')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                         'action' => $action
                    ]);
            }

            $input = $request->all();
            if (request()->hasFile('icon_img')) {
                $file = request()->file('icon_img');
                $input['icon_img'] = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./img/uploads/stations/', $input['icon_img']);    
            }
        
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Stations  Updated Successfully.');
              
                 Stations::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Stations  Added Successfully.');
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
        $result =Stations::find($id);
        $action = 'add';
        $editname = "Edit ".$result->company_name;
        $master = $this->getmasterfields();
        return view('hrmodule.stations.add')->with([
            'action' => $action,
            'pageTitle'=>"stations",
            'Addform'  =>$editname,
            'result'  =>$result,
            'master'  =>$master
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
        $stations =Stations::find($id);
        $stations->status = 0;
        $stations->save();
        Session::flash('message', 'Company delete successfully');
        return redirect("/stations");
    }

    /*
     *
    */
    function getmasterfields(){

            $master                     = array();
            $master['Companies']        = Companies::where(['status'=>1])->get()->toArray();
            return $master;
    }

    
}
