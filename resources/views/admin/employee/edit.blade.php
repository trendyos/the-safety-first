@extends('admin.layouts.app')

@section('body')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{{$method}}  {{$pageName}}</h2>
                  
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
          
            <div class="col-lg-12">
                
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>{{$method}}  {{$pageName}}</h5>
                            
                        </div>
                        <div class="ibox-content">
                        {{ Form::open(['route'=>['admin.update.employee',$result->id],'class'=>'classname','method' => 'post','id'=>'myForm','files'=>'true'])}}


                      
                        @csrf
                        <input type="hidden" value="{{ $result->id }}" name="user_id">
                       <div class="form-group  row"><label class="col-sm-2 col-form-label">Employee Name*</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('name', $result->name,['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('name')}} <span>
                                </div>
                                <label class="col-sm-2 col-form-label">Email*</label>

                                    <div class="col-sm-4">
                                        {!! Form::text('email', $result->email,['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('email')}} <span>

                                    </div>
                                </div>
                        
                                  <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Password(leave Blank If not want to update)</label>

                                    <div class="col-sm-4">
                                       {!! Form::password('password',['class' => 'form-control']) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('password')}} <span>
                                </div>
                                <label class="col-sm-2 col-form-label">Contact No.</label>

                                    <div class="col-sm-4">
                                        {!! Form::text('mobile', $result->mobile,['class' => 'form-control','onKeyPress'=>"if(this.value.length==10) return false;"]) !!}
                                    <span class="" style="color:red"> {{ $errors->first('designation')}} <span>

                                    </div>
                                </div>
                             
    
     <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Address</label>

                                    <div class="col-sm-4">
                                        {!! Form::textarea('address', $result->address, ['class'=>'form-control','rows'=>'2']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('address')}} <span>

                                    </div>
                                    
                                </div>
                               

                                
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white btn-sm" type="reset">Reset</button>
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                        </div>
                    
                    
                </div>
            </div>
                
            </div>
            
            
        </div>
@endsection
