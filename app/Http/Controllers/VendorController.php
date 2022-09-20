<?php

namespace App\Http\Controllers;

use Auth;
use \App\User;
use \App\Package;
use \App\Booking;
use \App\Event;
use \App\State;
use \App\DailySatus;
use \App\AssignEvent;
use \App\BlackDate;
use \App\PackageTest;
use \App\TestAssignPackage;
use \App\EventParticipate;
use \App\Feedback;
use \App\Product;
use \App\ProductQuestion;
use \App\ProductVideo;
use \App\ProductDocument;
use \App\AssignProduct;

use \App\City;
use \App\Dc;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use \App\Http\Requests\UsersRequest;
use \App\Http\Requests\PasswordRequest;
use \App\Http\Requests\DailyStatusRequest;

use Illuminate\Support\Facades\Hash;
class VendorController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        //$userId= =auth()->user()->id;
        $this->paginate = 10;
    }
    public function login()
    {
        auth()->logout();
        //echo "asdfasdf";die;
        if(isset(Auth::user()->id)){
            if(Auth::user()->is_admin==0){
                return redirect()->route('hr.home');
            } else if(Auth::user()->is_admin==1){
                return redirect()->route('admin.home');
            } else if(Auth::user()->is_admin==2){
                return redirect()->route('employee.home');
            } else if(Auth::user()->is_admin==4){
                return redirect()->route('employee.home');
            }
        } else {
            return view('vendor.login');
        }
        
    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/vendor/login');
    }


    public function index(){
        $user = Auth::user();
        $allUsers = User::where('company_id', $user->id)->where('is_deleted',0)->latest()->get();
      
       
         $products = Product::where('company_id',$user->id)->get();

          $products =Product::leftJoin('users', 'products.company_id', '=', 'users.id')
                            ->whereRaw("find_in_set('".Auth::user()->course_id."',products.id)")
                            ->select('products.*','users.name as companyName');
        
        $products=$products->orderBy('products.id','desc')->get();

          $PassCertificate = DB::table('test_exam_results')
                            ->where('company_id', $user->id)
                            ->where('status','Pass')
                            ->get();
         $InprocessCertificate = DB::table('test_exam_results')
                            ->where('company_id', $user->id)
                            ->where('status','InProcess')
                            ->get();
        $CancelledCertificate = DB::table('test_exam_results')
                            ->where('company_id', $user->id)
                            ->where('status','Fail')
                            ->get();
       
        return view('vendor.home',compact('allUsers','products','PassCertificate','InprocessCertificate','CancelledCertificate'));
    }
    public function updateProfile(){

        $loginUser = Auth::user()->id;
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result  =  User::where('id',$loginUser)->first();

        $companyName  =  User::where('id',$result->company_id)->first();
      //  print_r($result);

        return view('vendor.updateProfile', compact('result','states'));
    }

    public function updateProfileSave(Request $request){
    

        $image = $request->file('image');

        $data = User::where('id',Auth::user()->id)->first();

        //echo '<pre>';print_r($data);die;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        
        if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/company');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/company/'.$imageName;
            $data->image=$imagePath;
        }
        if($data->save()){
            return redirect()->back()->with('success','Profile Updated successfully');
        } else {
            return redirect()->back()->with('failed','Profile Update Faild successfully');
        }


    }

    public function updatePassword(PasswordRequest $request){


        $data = User::where('id',Auth::user()->id)->first();

        $data->password = Hash::make($request->password);
        if($data->save()){
            return redirect()->back()->with('success','Change Password successfully');
        } else {
            return redirect()->back()->with('failed','Change Password Faild');
        }

    }





 public function listEmployee(){
        $selectState = "";
        // $result =User::join('states', 'users.state_id', '=', 'states.id')->select('users.*','states.name as stateName')->where('users.is_admin',0);
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result =User::join('users as u', 'users.company_id', '=', 'u.id')->select('users.*','u.company as companyName')
        ->where('users.is_deleted',0)->where('users.company_id',Auth::user()->id);
         
        if(isset($_GET['name']) && !empty($_GET['name']))
        $result=$result->where('users.name','LIKE','%'.$_GET['name'].'%');
        if(isset($_GET['email']) && !empty($_GET['email']))
        $result=$result->where('users.email','=',$_GET['email']);
        if(isset($_GET['state_id']) && !empty($_GET['state_id'])){
            $result=$result->where('users.state_id','=',$_GET['state_id']);
            $selectState = $_GET['state_id'];
        }
              
        $result=$result->orderBy('id','desc')->get();
        $total=0;
        $page=0;
        $pageName = 'Employee';
        $method = 'View List';
        
         return view('vendor.employee.list',compact('result','page','total','pageName','method','states','selectState'));
    }
    
     public function listProduct(){
        $selectState = "";
        // $result =User::join('states', 'users.state_id', '=', 'states.id')->select('users.*','states.name as stateName')->where('users.is_admin',0);
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result =Product::leftJoin('users', 'products.company_id', '=', 'users.id')
                            ->whereRaw("find_in_set('".Auth::user()->course_id."',products.id)")
                            ->select('products.*','users.name as companyName');
        
        $result=$result->orderBy('products.id','desc')->get();
        $total=0;
        
        $page=0;
        $pageName = 'Product';
        $method = 'View List';
        
         return view('vendor.product.list',compact('result','page','total','pageName','method','states','selectState'));
    }
    
     public function viewProduct($id = NULL){
        $pageName = 'Product';
        $method = 'View';
        $result = Product::where(['id'=>$id,'is_deleted'=>0])->first();
        $companyes =User::where('is_deleted',0)->where('is_admin',0)->where('status',1)->pluck('name','id');
        $pdfData = ProductDocument::where('product_id',$id)->where('type','pdf')->get();
        $pptData = ProductDocument::where('product_id',$id)->where('type','ppt')->get();
        $docData = ProductDocument::where('product_id',$id)->where('type','doc')->get();
        $videoData = ProductVideo::where('product_id',$id)->get();
        //echo '<pre/>';print_r($videoData);die;
        $questionData = ProductQuestion::where('product_id',$id)->get();
        return view('vendor.product.view',compact('pageName','method','result','companyes','pdfData','pptData','docData','videoData','questionData'));
    }

 public function viewUserDetails($id=NULL){
      // $request = $request->all();
      $user = Auth::user(); 
       $vendorName = $user->company;
     $result =User::where('id',$id)->where('company_id',$user->id)->where('is_deleted',0)->first();
        $purchaseDetails =Booking::where('user_id',$id)->where('company_id',$user->id)->get();
      
        return view('vendor.employee.view_user',compact('result','vendorName','purchaseDetails'));
    }

    
    



}
