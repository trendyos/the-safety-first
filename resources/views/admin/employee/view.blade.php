@extends('admin.layouts.app')

@section('body')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2> {{$employeeData->name}} Daily Status</h2>
                  
                </div>
            </div>
               <div class="wrapper wrapper-content animated fadeInRight">
           
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>{{$employeeData->name}} Daily Status</h5>
                            
                        </div>
                        <div class="ibox-content">
                       
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th> Project Name </th>
                                        <th>Daily Status </th>
                                        <th>Admin Feedback</th>
                                        <th>Status</th>
                                        <th>Due To</th>
                                        
                                    
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result as $key=>$val)
                                    <tr>
                                        <td>{{$val->date}}</td>
                                        <td>{{$val->projectName}}</td>
                                        <td>{{$val->description}}</td>
                                         <td class='feedcolr'>{{$val->feedback}}</td>
                                        <td>
                                            @if($val->status == 'Completed')
                                                <span class="label label-success" >Completed </span>
                                                @elseif($val->status == 'On Hold')
                                               <span class="label label-warning" >On Hold</span>
                                              
                                               @else
                                                 <span class="label label-info" >Still Pending</span>
                                               @endif</td>
                                       
                                       <td>{{$val->reason}}</td>
                                    
                                    </tr>
                                    @endforeach
                                    @if(count($result)==0)
                                    <tr>
                                        <td colspan="6" style="color:red; text-align:center">Record Not Found.....</td>
                                       
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
</div>
@endsection
