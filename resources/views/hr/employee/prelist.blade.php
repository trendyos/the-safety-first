@extends('hr.layouts.app')

@section('body')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2> {{$pageName}} {{$method}}</h2>
                   
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
           
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>{{$pageName}} {{$method}} </h5>
                            
                        </div>
                        <div class="ibox-content">
                        <!--<form method="get" action="{{ route('hr.list.employee') }}" enctype="multipart/form-data">-->
                        <!--    @csrf-->
                        <!--    <div class="row">-->
                            
                               
                          

                        <!--        <div class="col-sm-4">-->
                        <!--        <label class="form-label">Name</label>-->
                        <!--            <div class="input-group">-->
                        <!--                <input placeholder="Search Name" type="text" value="{{ $_GET['name'] ?? ''}}" name="name" class="form-control form-control-sm"> <span class="input-group-append"> -->
                        <!--        </div>-->

                        <!--        </div>-->
                        <!--        <div class="col-sm-4">-->
                        <!--        <label class="form-label">Email</label>-->
                        <!--            <div class="input-group">-->
                        <!--                <input placeholder="Search Email" type="text" value="{{ $_GET['email'] ?? ''}}" name="email" class="form-control form-control-sm"> <span class="input-group-append"> -->
                        <!--        </div>-->

                        <!--        </div>-->
                        <!--        <div class="col-sm-4">-->
                        <!--        <label class="form-label">State</label>-->
                        <!--            <div class="input-group">-->
                        <!--            {{ Form::select('state_id', $states,$selectState, ['class'=>'form-control','placeholder'=>'Select State']) }}-->
                        <!--            <button type="submit" class="btn btn-sm btn-primary">Search! <button type="reset" class="btn btn-sm btn-warning">Reset!-->
                        <!--            </button> </span>-->
                        <!--                    </div>-->

                        <!--        </div>-->
                                


                                
                        <!--    </div>-->
                        <!--    </form>-->
                            <div class="table-responsive">
                                <table class="table table-striped" id="table_id">
                                    <thead>
                                    <tr>

                                        <th>#</th>
                                      
                                        <th> Name </th>
                                        <th>Employee Code</th>
                                        <th> Mobile No. </th>
                                        <th> Email </th>
                                       
                                        <th>Gender</th>
                                        <th>Designation</th>
                                        
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result as $key=>$val)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                       
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->employee_code}}</td>
                                        <td>{{$val->mobile}}</td>
                                        <td>{{$val->email}}</td>
                                        
                                        <td>{{$val->gender}}</td>
                                        <td>{{$val->designation}}</td>
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
@endsection
