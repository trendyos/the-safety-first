<?php
  
namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
   
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  
    use AuthenticatesUsers;
  
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
   
    public function login(Request $request)
    {   
      //  echo 223;die;
      // auth()->logout();
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'is_admin' => 1)))
        {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }


    public function hr_login(Request $request)
    {   
       // echo "asdfasd";die;
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'is_admin' => 0)))
        {
            if (auth()->user()->is_admin == 0) {
                return redirect()->route('hr.home');
            }
        }else{
            return redirect()->route('company.login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
    public function vendor_login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'is_admin' => 3,'status'=>1)))
        {
           
            if (auth()->user()->is_admin == 3) {
                return redirect()->route('vendor.home');
            } 
        
        }else{
            echo 11111;die;
            return redirect()->route('vendor.login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
    
    
    public function employment_user_login(Request $request)
    {   
       
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'is_admin' => 4)))
        {
            if (auth()->user()->is_admin == 4) {
              
                return redirect()->route('employee.home');
            } 
         //   else if(auth()->user()->is_admin == 3) {
           //     return redirect()->route('call_center.home');
          //  }
        }else{
            return redirect()->route('employeementuser.login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
    
    public function call_center_login(Request $request)
    {   
       // echo "asdfasd";die;
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'is_admin' => 3)))
        {
            if (auth()->user()->is_admin == 3) {
              
                return redirect()->route('call_center.home');
            } 
         //   else if(auth()->user()->is_admin == 3) {
           //     return redirect()->route('call_center.home');
          //  }
        }else{
            return redirect()->route('call.center.login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
    



}