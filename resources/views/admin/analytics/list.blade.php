@extends('admin.layouts.app')

@section('body')

         <div class="wrapper wrapper-content animated fadeInRight">
           
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>{{$pageName}} List </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_id">
                                    <thead>
                                    <tr>

                                        <th width="5%">#</th>
                                        <th width="10%">Employee Name </th>
                                         <th width="5%">Email</th>
                                        <th width="10%">Mobile</th>
                                        <th width="8%">Address</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($result as $key=>$val)
                                   
                                    <tr>
                                        <td>{{$key+ 1}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->email}}</td>
                                        <td>{{$val->mobile}}</td>
                                         <td>{{$val->address}}</td>
                                         
                                             <td>
							@if($val->status	== 1)
								<span class="label label-success" >Activated </span>
							@else
								<span class="label label-warning" >Deactivated </span>
							@endif
						</td>
					
					
                                        <td>
                                            @if($val->status == 1)
							
								{!! Html::decode(link_to_route('admin.status.employee','<i class="fa fa-ban"></i>',[$val->id, 0],['class'=>'btn btn-success','title'=>'Click To Deactivate' ,'onclick'=>'return changeStatus();'])) !!}
							@else
							
								
									{!! Html::decode(link_to_route('admin.status.employee','<i class="fa fa-check"></i>',[$val->id, 1],['class'=>'btn btn-success','title'=>'Click To Activate','onclick'=>'return changeStatus();'])) !!}
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
