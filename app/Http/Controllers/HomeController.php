<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(isset(Auth::user()->id)){
            if(Auth::user()->is_admin==0){
                return redirect()->route('hr.home');
            } else if(Auth::user()->is_admin==1){
                return redirect()->route('admin.home');
            } else if(Auth::user()->is_admin==2){
                return redirect()->route('employee.home');
            }
        } else {
            return view('home');
        }
        
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }
    
}