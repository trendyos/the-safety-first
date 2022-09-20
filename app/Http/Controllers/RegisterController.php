<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\User;
use \App\State;
use \App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function index($id,$slug){
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result = User::where(['id'=>$id,'is_admin'=>0])->first();
        if($result){
            return view('register',compact('states','result'));
        }else {
            echo "Form Envalid";
        }
        
    }
    
    
    public function employmentIndex($id,$slug){
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result = User::where(['id'=>$id,'is_admin'=>0])->first();
        if($result){
            return view('employment_register',compact('states','result'));
        }else {
            echo "Form Envalid";
        }
        
    }
    
    
    public function employeeRegister(RegisterRequest $request, $id,$slug){
       
         $slugNew =  Str::slug($request->email);

         $prefix =User::where('is_deleted',0)->where('id',$id)->first();

        $email = $request->email.$prefix->perifix;
        $alreadyExistUser = User::where('is_deleted',0)->where('email',$email)->first();
        if($alreadyExistUser){
            return redirect('registration/'.$id.'/'.$slug)->with('failed','Employee Already Registered With This Email');
        }
        
        $lastId = User::where('is_admin',2)->orderBy('id','desc')->first();
        
//echo $lastId;die;
        $slugg = str_replace("-at-gmailcom","",$slugNew);
        $data = new User;
        $data->company_id = $id;
        $data->name = $request->name;
        $data->slug = $slugg;
        $data->country = 'India';
        $data->state_id = 0;
        $data->address = "";
        $data->employee_code = $request->employee_code;
        
        $data->mobile = $request->mobile;
        $data->is_admin = 2;
        $data->email = $email;
        $data->password = Hash::make($request->password);
        $data->gender = $request->gender;
        $data->designation = $request->designation;
        if(!empty($lastId)){
        $data->code = $lastId->code + 1;
        }else{
            $data->code = 1;
        }
        $data->unique_code = 'AHS'.$data->code;
        
        if($data->save()){
            return redirect('registration/'.$id.'/'.$slug)->with('success','Employee Created successfully');
        } else {
            return redirect()->back()->with('failed','Employee Created Faild. Please try again letter');
        }

        
    }
    
    
    
    public function preEmployeeRegister(RegisterRequest $request, $id,$slug){
         $slugNew =  Str::slug($request->email);

$lastId = User::where('is_admin',4)->orderBy('id','desc')->first();
        $email = $request->email;
        $data = new User;
        $data->company_id = $id;
        $data->name = $request->name;
        $data->slug = $slugNew;
        $data->country = 'India';
        $data->state_id = 0;
        $data->address = "";
        $data->employee_code = $request->employee_code;
        
        $data->mobile = $request->mobile;
        $data->is_admin = 4;
        $data->email = $email;
        $data->password = Hash::make($request->password);
        $data->gender = $request->gender;
        $data->designation = $request->designation;
        if(!empty($lastId)){
        $data->code = $lastId->code + 1;
        }else{
            $data->code = 1;
        }
        $data->unique_code = 'AHS/PR'.$data->code;
        
        if($data->save()){
            return redirect('employment-registration/'.$id.'/'.$slug)->with('success','Employee Created successfully');
        } else {
            return redirect()->back()->with('failed','Employee Created Faild. Please try again letter');
        }

        
    }

    
}
