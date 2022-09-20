<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use \App\User;
use \App\State;
use \App\Event;
use \App\Package;
use \App\Booking;
use \App\Assignpackage;
use \App\AssignEvent;
use \App\EventParticipate;
use \App\Dependent;
use \App\Faq;
use \App\Product;
use \App\ProductQuestion;
use \App\TestExamResult;
use \App\ProductVideo;
use \App\ProductDocument;
use \App\Http\Requests\EventRequest;
use Illuminate\Support\Str;

use Mail;
use DataTables;
 use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Http\Requests\UsersRequest;
use \App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use \App\Http\Requests\Company\VendorRequest;
use \App\Http\Requests\Company\UpdateVendorRequest;

use App\Mail\CreateCompany;

class CompanyController extends Controller
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
            }
        } else {
            return view('hr.login');
        }
        
    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/learning-partner/login');
    }
    
         public function help(){

        return view('hr.help');
    }
    
     public function listFeedback(){


        $result =Feedback::join('bookings', 'feedback.booking_id', '=', 'bookings.id')
        ->join('packages', 'bookings.package_id', '=', 'packages.id')
        ->join('users', 'users.id', '=', 'feedback.employee_id')
        ->join('users as u', 'u.id', '=', 'feedback.company_id')
        ->select('feedback.*','u.company as cname','users.employee_code','users.name as username', 'packages.name as packageName');
        
        $result->where(['feedback.company_id'=>Auth::user()->id]);


      

        $result=$result->orderBy('feedback.id','desc');
        $total=$result->count();
        $result=$result->paginate($this->paginate);
        $page=$result->perPage()*($result->currentPage()-1);
 
        $pageName = 'Employee Feedback';
        $method = 'View List';
       // echo "<pre>";
        //print_r($result);die;
        return view('hr.feedback.list',compact('result','page','total','pageName','method'));
    }
    
    
    // learning Partner dashboard
    public function index(){

        $user = Auth::user();
        $vendors = User::where('company_id', $user->id)->where('is_deleted',0)->take(1)->get();
      
       
         $products = Product::where('company_id',$user->id)->get();

        $certificate=User::join('test_exam_results', 'test_exam_results.user_id', '=', 'users.company_id')
                        ->where('test_exam_results.status','Pass')
                        ->where('users.company_id', $user->id)
                        ->get();
       
         $monthlyRevenue = User::select(
                            DB::raw("(COUNT(*)) as count"),
                            DB::raw("MONTHNAME(created_at) as month_name")
                        )
                        ->where('company_id', $user->id)->where('is_deleted',0)
                        ->whereYear('created_at', date('Y'))
                        ->groupBy('month_name')
                        ->get()
                        ->toArray();
  
       
       return view('hr.home',compact('vendors','products','certificate','monthlyRevenue'));
    }
    public function updateProfile(){

        $loginUser = Auth::user()->id;
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result  =  User::where('id',$loginUser)->first();
      //  print_r($result);

        return view('hr.updateProfile', compact('result','states'));
    }

    public function updateProfileSave(UsersRequest $request){

        $image = $request->file('image');
        $data = User::where('id',Auth::user()->id)->first();
        $data->company = $request->company;
        $data->name = $request->company;
        $data->city = $request->city;
        $data->state = $request->state;
         $data->address = $request->address;
        if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/company');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/company/'.$imageName;
            $data->image=$imagePath;
        }
        if($data->save()){
            return redirect()->route('hr.updateProfile')->with('success','Profile Updated successfully');
        } else {
            return redirect()->back()->with('failed','Profile Update Faild successfully');
        }
    }

    public function updatePassword(PasswordRequest $request){


        $data = User::where('id',Auth::user()->id)->first();
        $data->password = Hash::make($request->password);
        if($data->save()){
            return redirect()->route('hr.updateProfile')->with('success','Change Password successfully');
        } else {
            return redirect()->back()->with('failed','Change Password Faild successfully');
        }

    }

    

    public function listEmployee(){
        $selectState = "";
        // $result =User::join('states', 'users.state_id', '=', 'states.id')->select('users.*','states.name as stateName')->where('users.is_admin',0);
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result =User::join('users as u', 'users.company_id', '=', 'u.id')->select('users.*','u.company as companyName')
        ->where('users.is_deleted',0)->where('users.is_admin',2)->where('users.company_id',Auth::user()->id);

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
        
         return view('hr.employee.list',compact('result','page','total','pageName','method','states','selectState'));
    }
    
     public function listProduct(){
        $selectState = "";
        // $result =User::join('states', 'users.state_id', '=', 'states.id')->select('users.*','states.name as stateName')->where('users.is_admin',0);
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result =Product::leftJoin('users', 'products.company_id', '=', 'users.id')->where('products.company_id',Auth::user()->id)->select('products.*','users.name as companyName');
        
        $result=$result->orderBy('products.id','desc')->get();
        $total=0;
        
        $page=0;
        $pageName = 'Product';
        $method = 'View List';
        
         return view('hr.product.list',compact('result','page','total','pageName','method','states','selectState'));
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
        return view('hr.product.view',compact('pageName','method','result','companyes','pdfData','pptData','docData','videoData','questionData'));
    }
    
    
  public function addVendor(){
        $pageName = 'Vendor';
        $method = 'Add New';
        $courseAll =Product::where('is_deleted',0)->where('company_id',Auth::user()->id)->get();
        $result =User::leftJoin('states', 'users.state_id', '=', 'states.id')->select('users.*','states.name as stateName')->where('users.is_admin',3)->where('users.company_id',Auth::user()->id);
        $result=$result->where('users.is_deleted',0);
        
        if(isset($_GET['company']) && !empty($_GET['company']))
        $result=$result->where('users.company','LIKE','%'.$_GET['company'].'%');
         
        $selectState ="";
        if(isset($_GET['state']) && !empty($_GET['state'])){
            $result=$result->where('users.state_id','=',$_GET['state']);
            $selectState =$_GET['state'];
        }
        if(isset($_GET['email']) && !empty($_GET['email']))
        $result=$result->where('users.email','LIKE','%'.$_GET['email'].'%');
           
        $result=$result->orderBy('users.id','desc')->get();
        $total=0;
        
        $page=0;
        return view('hr.vendor.add',compact('pageName','method','result','total','page','courseAll'));
    }
    
    public function saveVendor(VendorRequest $request){
        $image = $request->file('image');
        $slug =  Str::slug($request->name);
        $data = new User;
        $data->company = $request->name;
        $data->name = $request->name;
        $data->slug = $slug;
        $data->city = $request->city;
        $data->address = $request->address;
         $data->state = $request->state;
          $data->pincode = $request->pincode;
        $data->is_admin = 3;
         $data->company_id = Auth::user()->id;
        $data->email = $request->email;
        $data->contact_person_name = $request->contact_person_name;
        $data->contact_person_mobile = $request->contact_person_mobile;
        $data->contact_person_email = $request->contact_person_email;
        
         $data->alter_contact_person_name = $request->alter_contact_person_name;
        $data->alter_contact_person_mobile = $request->alter_contact_person_mobile;
        $data->alter_contact_person_email = $request->alter_contact_person_email;
         if($request->course_id){
            $data->course_id = implode(',', $request->course_id);
        }
        $data->password = Hash::make($request->password);
        if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/company');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/company/'.$imageName;
            $data->image=$imagePath;
        }
        
        if($data->save()){
            if(!empty($request->email)){
                     $empDetail = User::where('id',$data->id)->first();
                     $empay['title'] = "Register Vendor";
                        $empay['FromEmail'] = "tos@tossas.in";
                        $empay['subject'] = 'Register Vendor';
                          $empay['name'] = $empDetail->name;
                          $empay['email'] = $empDetail->email;
                        Mail::to([$empDetail->email])->send(new CreateCompany($empay));
            
               
            }
            return redirect()->route('hr.new.vendor')->with('success','New Vendor Created successfully');
        } else {
            return redirect()->back()->with('failed','New Vendor Created Faild. Please try again letter');
        }
    }
    
    
     public function editVendor($slug = NULL){
        $pageName = 'Vendor';
        $method = 'Edit';
         $courseAll =Product::where('is_deleted',0)->where('company_id',Auth::user()->id)->get();
        $result = User::where(['slug'=>$slug,'is_deleted'=>0,'is_admin'=>3])->first();
        return view('hr.vendor.edit',compact('pageName','method','result','courseAll'));
    }
// Show Single vendor detail
      public function showVendorDetails($slug = NULL){
        $pageName = 'Vendor';
        $method = 'Edit';
         $courseAll =Product::where('is_deleted',0)->where('company_id',Auth::user()->id)->get();
        $result = User::where(['slug'=>$slug,'is_deleted'=>0,'is_admin'=>3])->first();
        return view('hr.vendor.view',compact('pageName','method','result','courseAll'));
    }

    
    public function updateVendor(UpdateVendorRequest $request,$slug=NULL){
        $image = $request->file('image');

        $data = User::where(['id'=>$slug,'is_admin'=>3,'is_deleted'=>0])->first();

        
        $slugg = Str::slug($request->name);
        $data->company = $request->name;
        $data->name = $request->name;
        $data->slug = $slugg;
         $data->city = $request->city;
        $data->address = $request->address;
         $data->state = $request->state;
          $data->pincode = $request->pincode;
        $data->email = $request->email;
        $data->contact_person_name = $request->contact_person_name;
        $data->contact_person_mobile = $request->contact_person_mobile;
        $data->contact_person_email = $request->contact_person_email;
         $data->alter_contact_person_name = $request->alter_contact_person_name;
        $data->alter_contact_person_mobile = $request->alter_contact_person_mobile;
        $data->alter_contact_person_email = $request->alter_contact_person_email;
          if($request->course_id){
            $data->course_id = implode(',', $request->course_id);
        }
          if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/company');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/company/'.$imageName;
            $data->image=$imagePath;
        }
        if($data->save()){
            return redirect()->route('hr.new.vendor')->with('success','Vendor Updated successfully');
        } else {
            return redirect()->back()->with('failed','New Vendor Created Faild. Please try again letter');
        }
    }
    
    
    public function deleteVendor($slug = NULL){

        $data = User::where(['slug'=>$slug,'is_deleted'=>0])->first();
        $data->is_deleted = 1;
        if($data->save()){
            
            
            User::find($data->id)->delete();
            return redirect()->route('hr.new.vendor')->with('failed','Vendor Deleted successfully');
        } else {
            return redirect()->back()->with('failed','Change Password Faild successfully');
        }
    }
    
    public function updateVendorStatus($id = 0, $status=NULL){
        $data = User::where(['id'=>$id])->first();
        $data->status = $status;
       
        if($data->save()){
            return redirect()->back()->with('success','Vendor Status updated successfully');
        } else {
            return redirect()->back()->with('failed','Vendor Status  Faild to change. Please try again letter');
        }
    }

    
}
