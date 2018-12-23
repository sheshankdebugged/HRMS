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
use App\Models\Companies;

class CompaniesController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = Companies::where(['status'=>1])->paginate(10);
        return view('hrmodule.companies.list')->with([
            'listData' => $list,
            'pageTitle'=>"Companies"
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
        return view('hrmodule.companies.add')->with([
            'action' => $action,
            'pageTitle'=>"Companies",
            'Addform'  =>"Add New Company"
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
        if($request->all()){

            $validator = Validator::make($request->all(), [
                'company_name' => 'required',


            ]);
            if ($validator->fails()) {
                $action = 'addcompanies';
                return redirect('/addcompanies')
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
                $file->move('./img/uploads/Companies/', $input['icon_img']);
            }

            $input['status']=  1;
            unset($input['_token']);
            if($input['id']>0){
                $input['updated_at']=date("Y-m-d H:i:s");
                Session::flash('message', 'Companie  Updated Successfully.');
                Companies::where('id', $input['id'])->update($input);
            }else{
                unset($input['id']);
                $input['created_at']=date("Y-m-d H:i:s");
                $input['updated_at']=date("Y-m-d H:i:s");
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
        $editname = "Edit ".$result->company_name;
        return view('hrmodule.companies.add')->with([
            'action' => $action,
            'pageTitle'=>"Companies",
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
        $Companies = Companies::find($id);
        $Companies->status = 0;
        $Companies->save();
        Session::flash('message', 'Company delete successfully');
        return redirect("/companies");
    }
}
