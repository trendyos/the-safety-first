@extends('admin.layouts.app')

@section('body')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2> Diagnostic Centers List</h2>
                   
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
           
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Diagnostic Centers List </h5>
                            <div class="ibox-tools">
                               
                            </div>
                        </div>
                        <div class="ibox-content">
                        
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Diagnostic Center Name</th>
                                        <th>Email</th>
                                        <th>
                                            Alternate Email
                                        </th>
                                        <th>Phone</th>
                                        <th>
                                            Alternate Phone
                                        </th>
                                        <th>Address</th>

                                        <th>City Name </th>
                                        <th>State Name </th>
                                        
                                        <th>Contact Person Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result as $key=>$val)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->email}}</td>
                                        <td>{{$val->alternate_email}}</td>
                                        <td>{{$val->phone}}</td>
                                        <td>{{$val->alternate_phone}}</td>
                                        <td>{{$val->address}}</td>
                                        <td>{{$val->city}}</td>
                                        <td>{{$val->state}}</td>
                                        <td>
                                        <!--{!! Html::decode(link_to_route('admin.edit.dc','<i class="fa fa-pencil"></i>',[$val->id],['class'=>'btn btn-primary','title'=>'Edit'])) !!}-->
                                        <!--{!! Html::decode(link_to_route('admin.delete.dc','<i class="fa fa-trash"></i>',[$val->id],['class'=>'btn btn-danger','title'=>'Delete','onclick'=>'return deleteConfirm();'])) !!}-->
                                    {{$val->contect_person}}
                                    </td>
                                     <td>
							@if($val->is_active	== 1)
								<span class="label label-success" >Activated </span>
							@else
								<span class="label label-warning" >Deactivated </span>
							@endif
						</td>
						<td>
						    @if($val->is_active == 1)
							
								{!! Html::decode(link_to_route('admin.status.dc','<i class="fa fa-ban"></i>',[$val->id, 0],['class'=>'btn btn-success','title'=>'Click To Deactivate'])) !!}
							@else
							
								
									{!! Html::decode(link_to_route('admin.status.dc','<i class="fa fa-check"></i>',[$val->id, 1],['class'=>'btn btn-success','title'=>'Click To Activate'])) !!}
							@endif 
						</td>
                                    </tr>
                                    @endforeach
                                    <!--tr>
                                        <td colspan="9"></td>
                                       
                                    </tr-->
                                    
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
</div>
@endsection
