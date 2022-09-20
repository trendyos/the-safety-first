@extends('admin.layouts.app')

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
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_id">
                                    <thead>
                                    <tr>

                                        <th width="5%">#</th>
                                        <th>Image </th>
                                        <th>Company Name </th>
                                        <th width="8%">Head of Company </th>
                                        <th width="8%">Email </th>
                                        <th width="7%">Prfix  Domain</th>
                                        <th width="10%">Address</th>
                                        <th width="5%">Products</th>
                                        <th width="10%">Status</th>
                                       
                                        <!--<th width="5%">Company Feedback</th>-->
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($result as $key=>$val)
                                   
                                    <tr>
                                        <td>{{$key+ 1}}</td>
                                        <td><img src="{{env('APP_URL')}}{{$val->image}}" height="50px" width="50px"/></td>
                                        <td>{{$val->company}}</td>
                                        <td>{{$val->name}}</td>
                                         <td>{{$val->email}}</td>
                                        <td>{{$val->perifix}}</td>
                                        <td>{{$val->address}}</td>
                                         
                                        <td >{{$val->products}}
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
                                       

                                        {!! Html::decode(link_to_route('admin.edit.company','<i class="fa fa-pencil"></i>',[$val->slug],['class'=>'btn btn-primary','title'=>'Edit'])) !!}
                                        {!! Html::decode(link_to_route('admin.delete.company','<i class="fa fa-trash"></i>',[$val->slug],['class'=>'btn btn-danger','title'=>'Delete','onclick'=>'return deleteConfirm();'])) !!}
                                    
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
