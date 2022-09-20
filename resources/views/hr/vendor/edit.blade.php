@extends('hr.layouts.app')

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
                        {{ Form::open(['route'=>['hr.update.vendor',$result->id],'class'=>'classname','id'=>'myForm','files'=>'true'])}}


                      
                        @csrf
                        <input type="hidden" value="{{ $result->id }}" name="user_id">
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Vendor Name*</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('name',$result->name,['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('name')}} <span>
                                </div>
                                <label class="col-sm-2 col-form-label">Email</label>

                                    <div class="col-sm-4">
                                        {!! Form::text('email', $result->email,['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('email')}} <span>

                                    </div>
                                </div>
                        
                                <div class="hr-line-dashed"></div>
                                <span style="color:red">(if you want Change Password then fill password otherwise leave password)</span>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Password</label>
                                

                                    <div class="col-sm-4"><input type="password" value="" name="password" class="form-control">
                                    <span class="" style="color:red"> {{ $errors->first('password')}} <span>

                                    </div>
                                    <label class="col-sm-2 col-form-label">Image</label>

                                <div class="col-sm-4"><input type="file" name="image" class="form-control">
                                <br>
                                <img src="{{env('APP_URL')}}{{$result->image}}" height="50px;"/></div>
                                </div>
                                  <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Address*</label>

                                    <div class="col-sm-4">
                                        {!! Form::textarea('address', $result->address, ['class'=>'form-control','rows'=>'2']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('address')}} <span>

                                    </div>
                                    
                                    <label class="col-sm-2 col-form-label">City</label>

                                    <div class="col-sm-4">
                                      {!! Form::text('city',$result->city,['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('city')}} <span>

                                    </div>
                                </div>
                                
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    
                                    <label class="col-sm-2 col-form-label">State</label>

                                    <div class="col-sm-4">
                                      {!! Form::text('state', $result->state,['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('state')}} <span>

                                    </div>
                                    <label class="col-sm-2 col-form-label">Pin Code</label>

                                    <div class="col-sm-4">
                                      {!! Form::text('pincode', $result->pincode,['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('pincode')}} <span>

                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Contact Person Name*</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('contact_person_name', $result->contact_person_name,['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('contact_person_name')}} <span>
                                </div>
                                <label class="col-sm-2 col-form-label">Contact Person Mobile*</label>

                                    <div class="col-sm-4">
                                        {!! Form::number('contact_person_mobile', $result->contact_person_mobile,['class' => 'form-control','onKeyPress'=>"if(this.value.length==10) return false;"]) !!}
                                    <span class="" style="color:red"> {{ $errors->first('contact_person_mobile')}} <span>

                                    </div>
                                </div>
                               <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label"> Contact Person Email</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('contact_person_email', $result->contact_person_email,['class' => 'form-control']) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('contact_person_email')}} <span>
                                </div>
                                
                                </div>
                                
                                
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Alternate Contact Person Name</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('alter_contact_person_name',  $result->alter_contact_person_name,['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('alter_contact_person_name')}} <span>
                                </div>
                                <label class="col-sm-2 col-form-label">Alternate Contact Person Mobile</label>

                                    <div class="col-sm-4">
                                        {!! Form::number('alter_contact_person_mobile',  $result->alter_contact_person_mobile,['class' => 'form-control','onKeyPress'=>"if(this.value.length==10) return false;"]) !!}
                                    <span class="" style="color:red"> {{ $errors->first('alter_contact_person_mobile')}} <span>

                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Alternate Contact Person Email</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('alter_contact_person_email', $result->alter_contact_person_email,['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('alter_contact_person_email')}} <span>
                                </div>
                                
                                </div>
                                
                                  <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    
                                    <label class="col-sm-2 col-form-label">Select Courses</label>
    
                                        <div class="col-sm-10"> 
                                        @foreach($courseAll as $course)
                                <input type="checkbox" name="course_id[]" 
                                {{in_array($course->id, explode(',',$result->course_id))?"checked":null}}
                                value="{{ $course->id}}" id="inlineCheckbox{{$course->id}}"> {{ $course->name}} &nbsp;
                                &nbsp;
                                &nbsp;
                                     @endforeach
                                     <br/>
                                     <span class="" style="color:red"> {{ $errors->first('course_id')}} <span>
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
