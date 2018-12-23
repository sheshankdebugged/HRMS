<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Form;
use Validator;
use Session;
use App\Models\Departments; 

class DepartmentsController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $list = Departments::where(['status'=>1])->paginate(10);
        return view('hrmodule.Departments.list')->with([
            'listData' => $list,
            'pageTitle'=>"Departments"
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
        return view('hrmodule.Departments.add')->with([
            'action' => $action,
            'pageTitle'=>"Departments",
            'Addform'  =>"Add New Company"
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
       
        $user_id =  Auth::user()->id;
        if($request->all()){ 

            $validator = Validator::make($request->all(), [
                'company_name' => 'required',
               
                
            ]);  
           if ($validator->fails()) {
                $action = 'addDepartments';
                return redirect('/addDepartments')
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
                $file->move('./img/uploads/Departments/', $input['icon_img']);    
            }
        
            $input['status']=  1;
            $input['user_id'] =  $user_id;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Companie  Updated Successfully.');
                Departments::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Companie  Added Successfully.');
                Departments::insertGetId($input);
            }
            return redirect('/Departments');
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
        $result = Departments::find($id);
        $action = 'add';
        $editname = "Edit ".$result->company_name;
        return view('hrmodule.Departments.add')->with([
            'action' => $action,
            'pageTitle'=>"Departments",
            'Addform'  =>$editname,
            'result'  =>$result
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
        $Departments = Departments::find($id);
        $Departments->status = 0;
        $Departments->save();
        Session::flash('message', 'Company delete successfully');
        return redirect("/Departments");
    }
}
