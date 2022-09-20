@extends('vendor.layouts.app')

@section('body')


<div class="wrapper wrapper-content">
  
            <div class="container">


         
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5> User List </h5>
                                
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                   
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>

                                            
                                            
                                            <th>User Name </th>
                                            <th>Email  </th>
                                              <th>Phone  </th>
                                            <th>Vendor Name </th>                                        
                                            <th>Joined Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                         
                                            @foreach($result  as $user)
                                        <tr>
                                            
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->mobile}}</td>
                                            <td>{{Auth::user()->company}}</td>
                                              
                                              <td>  {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</td>
                                    
                                            <td>
                                              
                                              <a href="{{url('vendor/user-details/'.$user->id)}}" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>   
                                             </td>


                                             </td>

                                        </tr>
                                        @endforeach

                                    
                                       
                                   
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

     
           
                            

@endsection

