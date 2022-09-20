<?php
   
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use \App\User;
use \App\Country;
use \App\City;
use \App\State;
use \App\Product;
use \App\ProductQuestion;
use \App\ProductVideo;
use \App\ProductDocument;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Response;
use \App\Http\Resources\StateResource;
use \App\Http\Resources\CityResource;
use \App\Http\Resources\LoginUserResource;
use Carbon\Carbon;
use Mail;
use DB;
use App\Mail\ForgotPasswordOtp;
use Illuminate\Validation\Rule;

class CommanController extends Controller
{
     public function getVendor(){

        $vendors = User::where('is_admin',3)->select('name','id')->get();
      
        if(count($vendors) > 0)
        return array('status' =>true, 'data' => $vendors,'message' => 'Show Vendor List Successfully....', 'errors'=>[]);
        else
        return array('status' =>false, 'data' => [],'message' => 'Vendor list not Found.', 'errors'=>[]);
        
    }
    //register user  
    public function RegisterUser(Request $request){
        //echo "";die;
        $input = $request->all();
        $rules = [
            'name'   =>  'required',
            'mobile'   =>  'required|unique:users,mobile',
            'email'   =>  'required|email|unique:users,email',
            'password'   =>  'required|min:6',
             'aadhar'   =>  'required|unique:users,aadhar_number|min:12',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return ['status'=>0, 'message'=>$validator->errors()->first(), 'data'=>"", 'errors'=>$validator->errors()->all()];
        } else {

                $name = $request->input('name');
                $mobile = $request->input('mobile');
                $email = $request->input('email');
                $password = $request->input('password');
                $aadhar = $request->input('aadhar');

                $insert = new User;
                $insert->name = $name;
                $insert->email = $email;
                $insert->mobile = $mobile;
                $insert->aadhar_number = $aadhar;
                $insert->password = Hash::make($password);
                $insert->is_admin = 4;
                if($insert->save()){
                    return ['status'=>true, 'message'=>"User Created Successfully", 'data'=>$insert, 'errors'=>[]];
                } else {
                    return ['status'=>false, 'message'=>"User Created Faild", 'data'=>"", 'errors'=>[]];
                }
        }
    } 


// login after register
     public function login(Request $request){

        $input = $request->all();
        $rules = [
            'mobile'   =>  'required|exists:users,mobile',
            'password'   =>  'required|min:6',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return ['status'=>0, 'message'=>$validator->errors()->first(), 'data'=>"", 'errors'=>$validator->errors()->all()];
        } else {
            $is_login = Auth::attempt(['mobile' => $request->input('mobile'), 'password' => $request->input('password')]);
           // dd($is_login);
            if($is_login){
                $is_loginData = array(
                     'user_id' => Auth::user()->id,
                       'name' => Auth::user()->name,
                       'email' =>Auth::user()->email,
                      'mobile' => Auth::user()->mobile 
                );
              
                if($is_loginData ){
                    return ['status'=>true, 'message'=>"Login Successfully", 'data'=>$is_loginData, 'errors'=>[]];
                } else {
                    return ['status'=>false, 'message'=>"Please Enter Valid password...", 'data'=>"", 'errors'=>[]];
                }
            } else {
                return ['status'=>false, 'message'=>"Invalid Login Credentials...", 'data'=>"", 'errors'=>[]];
            }
            
        }

    }

// get otp form
     public function getOtpForm()
    {
               if (\View::exists('emails.password-reset-form')) {
                 return ['status'=>true, 'message'=>"success", 'errors'=>[]];
                } else {
                    return ['status'=>false, 'message'=>"no view found...", 'errors'=>[]];
                }

    }
// send otp to email  

    public function SendOtpToEmail(Request $request){
       
        $input = $request->all();
        $rules = [
            'email'   =>  'required',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return ['status'=>0, 'message'=>$validator->errors()->first(), 'data'=>"", 'errors'=>$validator->errors()->all()];
        } else {

        $otp=rand(111111,999999);

                $userData =User::where([ 'email'=>$request->email ])->first();
                if (isset($userData->id)) {
                  $userData->otp=$otp;
                  $userData->save();
                     
            // send otp in email  
                     $data['title'] = "OTP";
                        $data['FromEmail'] = "tos@tossas.in";
                        $data['subject'] = 'OTP For Password Reset';
                        $data['name'] = $userData->name;
                        $data['email'] = $userData->email;
                        $data['otp'] = $userData->otp;
                        Mail::to([$userData->email])->send(new ForgotPasswordOtp($data));
            
               
         // email end
              $email_Content = array(
                        'otp' => $userData->otp,
                    );

                return ['status'=>true, 'message'=>"Mail sent. Please check your email.", 'data'=>$email_Content, 'errors'=>[]];
                } else{
                     return ['status'=>false, 'message'=>"Email Not Registered...", 'errors'=>[]];
                }
            }
        }

  // show reset password form 
          public function getPasswordResetForm()
    {
               if (\View::exists('emails.password-reset-form')) {
                 return ['status'=>1, 'message'=>"success", 'errors'=>[]];
                } else {
                    return ['status'=>0, 'message'=>"no view found...", 'errors'=>[]];
                }

    }

        // reset password

       public function ResetPassword(Request $request){
       
        $input = $request->all();
        $rules = [
            'otp'  =>  'required',
            'new_password' =>'required',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return ['status'=>0, 'message'=>$validator->errors()->first(), 'data'=>"", 'errors'=>$validator->errors()->all()];
        } else {

       
            $userData =User::where([ 'otp'=>$request->otp ])->first();
                if (isset($userData->id)) {
                  $userData->password= Hash::make($request->new_password);
                  $userData->otp=Null;
                  $userData->save();
                     
          
                return ['status'=>true, 'message'=>"Password Reset Succesfully..", 'data'=>[], 'errors'=>[]];
                } else{
                     return ['status'=>false, 'message'=>"Wrong Otp...", 'errors'=>[]];
                }
            }
        }

// show change  password form 
          public function ShowChangePasswordForm()
    {
               if (\View::exists('emails.password-reset-form')) {
                 return ['status'=>1, 'message'=>"success", 'errors'=>[]];
                } else {
                    return ['status'=>0, 'message'=>"no view found...", 'errors'=>[]];
                }

    }

// update password after logged in
     public function UpdatePassword(Request $request){


        $input = $request->all();
        $rules = [
            'user_id' =>'required',
            'old_password'  =>  'required',
            'new_password' => 'required|confirmed|min:6|different:old_password',
            'new_password_confirmation' => 'required|min:6',
        ];
        $messages = [

            'old_password.required'  =>  'Enter Your Current Password',
            'new_password.required' => 'Enter New Password',
            'new_password.old_password' => 'You used this password recently. Please choose a different one',
            'new_password_confirmation.required' => 'Please Type Again New Password ,Min 6 Charactor',
            'new_password.confirmed' => 'Confirm Password Must Be Same',

        ];

        $validator = Validator::make($input, $rules,$messages);
        if ($validator->fails()) {
            return ['status'=>0, 'message'=>$validator->errors()->first(), 'data'=>"", 'errors'=>$validator->errors()->all()];
        } else {

        $user = User::where('id',$request->user_id)->first();
        if (isset($user->id)) {

      // check if current password matched

      if (Hash::check($request->old_password, $user->password)) { 
           $user->password = Hash::make($request->new_password);

            if($user->save()){
            return ['status'=>true, 'message'=>"Password Changed Succesfully..", 'data'=>[], 'errors'=>[]];
                } else{
            return ['status'=>false, 'message'=>"Failed to Change Password,Try Again....", 'errors'=>[]];
         }

        }else{
            return ['status'=>false, 'message'=>"Password  Doesn't match..", 'data'=>[], 'errors'=>[]];
         }

    }else{
            return ['status'=>false, 'message'=>"User Doesn't exists..", 'data'=>[], 'errors'=>[]];
         }

}
}

// Get All Courses Data 

    public function getAllCourses(){
   
    try {
        $products = Product::select('name','description','cost')->whereNull('deleted_at')->where('is_deleted',0)->latest()->get();
        if (count($products) > 0 ) {
             return response()->json([
                'status'  => true,
                'message' => "Data Loaded Successfully",
                'data' => $products,
                'errors' => ""
            ]);
        } else{
             return response()->json([
                'status'  => false,
                'message' => "No Data Found",
                'data' => "",
                'errors' => "",
                
            ]);

        }
    }catch(\Exception $ex) {
            return response()->json([
                'status'  => false,
                'message' => 'No Data Found',
                'data' => "",
                'errors' => $ex->getMessage(),
            ]);
        }
        
 }    
       // get courses details for single item 
  
   public function getCourseDetails($id){
   
    try {

      $courseData = Product::where('id',$id ?? Null)->whereNull('deleted_at')->where('is_deleted',0)->select('id','name','description','cost')->first();
      
        $docData = ProductDocument::where('product_id',$courseData->id ?? Null)->get();
        $videoData = ProductVideo::where('product_id',$courseData->id ?? Null)->get();     
        $questionData = ProductQuestion::where('product_id',$courseData->id ?? Null)->get();
        if(!empty($questionData)){
            foreach($questionData as $questionsData){
                $questionsData->answers  = DB::table('product_question_answers')->where('question_id',$questionsData->id)->get();
                 
            }
            
        }

        if (isset($courseData) ) {
             return response()->json([
                'status'  => true,
                'message' => 'Course Details Show Successfully',
                'data' => ([
                          'course' => $courseData,
                          'documents' => $docData,
                          'videos' => $videoData,
                          'questions' => $questionData,
                ]),
                'errors' => "",
            ]);
        } else{
             return response()->json([
                'status'  => false,
                'message' => 'No Data Found',
                'data' => "",
                'errors' => "",
               
            ]);

        }
    }catch(\Exception $ex) {
            return response()->json([
                'status'  => false,
                'data' => "",
                'message' => "Something Went Wrong Please try later",
                'errors'=>$ex->getMessage().' '.$ex->getLine(),
            ]);
        }
        
 }          
    //update user profile  
 public function UpdateUserProfile(Request $request,$id){
        //dd($request->all());
        $requestData = $request->all();
        $image = $request->file('image');
        $validator = Validator::make($requestData, [
           
             'name' => 'required',
             'email' => 'required|unique:users,email,'.$id,
             'mobile'   =>'required|unique:users,mobile,'.$id,
            
        ]);
         if ($validator->fails()) {
            return ['status'=>0, 'message'=>$validator->errors()->first(), 'data'=>"", 'errors'=>$validator->errors()->all()];
        } 

        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $user = User::where('id',$id)->where('is_deleted',0)->whereNull('deleted_at')->firstOrFail();

        if ($user->count() > 0 ){

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

            //update user  image            
            if(isset($image) && !empty($image)){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/company');
            $image->move($destinationPath, $imageName);
            $imagePath = 'public/uploads/company/'.$imageName;
            }else{
                $imagePath = "public/assest/dummy.jpg";
            }

        $user->image =  $imagePath ;
        $user->save();

        DB::commit();
        return response()->json([
                'status'  => true,
                'message' => 'Profile Updated',
                'data' => "",
                'errors' => "",                 
                ]);  
            }else{
                 return response()->json([
                    'status'  => false,                   
                    'message' => 'User Not Exist',
                    'data' => "",
                    'errors' => "",  
                ]);

            }
               
        } catch(\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'status' => false,                  
                     'message' => 'User Not Exist',
                    'data' => "",
                    'errors' => $ex->getMessage().' '.$ex->getLine(),
                ]);
            }
        } else {
            DB::rollback();
            return response()->json([
                'status'=>false,
                'data' => "",
                'message' => $ex->getMessage().' '.$ex->getLine(),
                'errors'=>$validator->errors(),
            ]);
        }
    }
 //logout user
 public function logout () {
       
        auth()->logout();
        if( auth()->logout()){
        return response()->json([
                'status'  => true,
                'message' => 'Logout Successfully',
                'data' => "",
                'errors' => "",                 
                ]);  
            }else{
                 return response()->json([
                    'status'  => false,                   
                    'message' => 'Failed to  logout',
                    'data' => "",
                    'errors' => "",  
                ]);

            }
       
    }
  

}

