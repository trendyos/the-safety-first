<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Auth;
use \App\User;

class CommanController extends Controller
{
     public function __construct()
    {
        echo 343;die;
        //$this->middleware('guest')->except('logout');
        //$userId= =auth()->user()->id;
        $this->paginate = 10;
    }
    
     public function getVendor(){

        $vendors = User::where('is_admin',3)->get();
      
        if(count($vendors) > 0)
        return array('status' =>1, 'data' => $vendors,'message' => 'Show Vendor List Successfully....', 'errors'=>[]);
        else
        return array('status' =>1, 'data' => [],'message' => 'Vendor list not Found.', 'errors'=>[]);
        
    }
}