@extends('admin.layouts.app')

@section('body')
<style>
    div#table_id_wrapper a.btn.btn-warning {
    padding: 0px 5px;
}
</style>
       
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
                                        <td><img src="{{asset($val->image)}}" height="50px" width="50px"/></td>
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
