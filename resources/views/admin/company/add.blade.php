@extends('admin.layouts.app')

@section('body')
<style>
    div#table_id_wrapper a.btn.btn-warning {
    padding: 0px 5px;
}
</style>
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
                           
  {!! Form::open(['role' => 'form','route' => "admin.save.company",'class' => 'mws-form','method' => 'post', 'files' => true]) !!}

                      
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Company Name*</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('company', '',['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('company')}} <span>
                                </div>
                                <label class="col-sm-2 col-form-label">Email*</label>

                                    <div class="col-sm-4">
                                        {!! Form::text('email', '',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('email')}} <span>

                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Password*</label>

                                    <div class="col-sm-4"><input type="password" value="" name="password" class="form-control">
                                    <span class="" style="color:red"> {{ $errors->first('password')}} <span>

                                    </div>
                                    <label class="col-sm-2 col-form-label">Logo</label>

                                <div class="col-sm-4"><input type="file" name="image" class="form-control">
                              </div>
                                </div>
                             
     
     <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Address*</label>

                                    <div class="col-sm-4">
                                        {!! Form::textarea('address', null, ['class'=>'form-control','rows'=>'2']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('address')}} <span>

                                    </div>
                                    
                                    
                                    <label class="col-sm-2 col-form-label">City</label>

                                    <div class="col-sm-4">
                                      {!! Form::text('city','',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('city')}} <span>

                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    
                                    <label class="col-sm-2 col-form-label">State</label>

                                    <div class="col-sm-4">
                                      {!! Form::text('state','',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('state')}} <span>

                                    </div>
                                    <label class="col-sm-2 col-form-label">Pin Code</label>

                                    <div class="col-sm-4">
                                      {!! Form::text('pincode','',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('pincode')}} <span>

                                    </div>
                                </div>
      <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Contact Person Name*</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('contact_person_name', '',['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('contact_person_name')}} <span>
                                </div>
                                <label class="col-sm-2 col-form-label">Contact Person Mobile*</label>

                                    <div class="col-sm-4">
                                        {!! Form::number('contact_person_mobile', '',['class' => 'form-control','onKeyPress'=>"if(this.value.length==10) return false;"]) !!}
                                    <span class="" style="color:red"> {{ $errors->first('contact_person_mobile')}} <span>

                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label"> Contact Person Email</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('contact_person_email', '',['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('contact_person_email')}} <span>
                                </div>
                                
                                </div>
                                
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Alternate Contact Person Name</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('alter_contact_person_name', '',['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('alter_contact_person_name')}} <span>
                                </div>
                                <label class="col-sm-2 col-form-label">Alternate Contact Person Mobile</label>

                                    <div class="col-sm-4">
                                        {!! Form::number('alter_contact_person_mobile', '',['class' => 'form-control','onKeyPress'=>"if(this.value.length==10) return false;"]) !!}
                                    <span class="" style="color:red"> {{ $errors->first('alter_contact_person_mobile')}} <span>

                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Alternate Contact Person Email</label>

                                    <div class="col-sm-4">
                                       {!! Form::text('alter_contact_person_email', '',['class' => 'form-control', 'style'=>"text-transform:capitalize"]) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('alter_contact_person_email')}} <span>
                                </div>
                                
                                </div>
                                
                             
                                

                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white btn-sm" type="reset">Reset</button>
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    
                    
                </div>
            </div>
                
            </div>
            
            
        </div>
        
        
         <div class="wrapper wrapper-content animated fadeInRight">
           
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 id="LearningPartnersList">{{$pageName}} List </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_id">
                                    <thead>
                                    <tr>

                                        <th width="5%">#</th>
                                        <th>Logo </th>
                                        <th width="10%">Company Name </th>
                                        <th width="10%">Email </th>
                                         
                                        <th width="10%">Address</th>
                                        <th width="5%">City</th>
                                        <th width="5%">State</th>
                                        <th width="5%">Pincode</th>
                                       
                                        <th width="8%">Contact Person Name</th>
                                        <th width="5%">Contact Person Mobile</th>
                                        
                                        <th width="10%">Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($result as $key=>$val)
                                   
                                    <tr>
                                        <td>{{$key+ 1}}</td>
                                        <td><img src="{{env('APP_URL')}}{{$val->image}}" height="50px" width="50px"/></td>
                                        <td>{{$val->company}}</td>
                                        <td>{{$val->email}}</td>
                                        
                                        <td>{{$val->address}}</td>
                                        <td>{{$val->city}}</td>
                                        <td>{{$val->state}}</td>
                                        <td>{{$val->pincode}}</td>
                                        
                                         <td>{{$val->contact_person_name}}</td>
                                         
                                        <td >{{$val->contact_person_mobile}}
                                           </td>
                                           
                                        
                                             <td>
							@if($val->status	== 1)
								<span class="label label-success" >Activated </span>
							@else
								<span class="label label-warning" >Deactivated </span>
							@endif
						</td>
					
					
                                        <td>
                                            @if($val->status == 1)
							
								{!! Html::decode(link_to_route('admin.status.company','<i class="fa fa-ban"></i>',[$val->id, 0],['class'=>'btn btn-success','title'=>'Click To Deactivate' ,'onclick'=>'return changeStatus();'])) !!}
							@else
							
								
									{!! Html::decode(link_to_route('admin.status.company','<i class="fa fa-check"></i>',[$val->id, 1],['class'=>'btn btn-success','title'=>'Click To Activate','onclick'=>'return changeStatus();'])) !!}
							@endif 

                                    
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
@endsection
