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
                        <form method="POST" action="{{ route('admin.save.coupon') }}" enctype="multipart/form-data">
                        @csrf
                             <div class="form-group  row"><label class="col-sm-2 col-form-label">Select Type*</label>
    
                                        <div class="col-sm-4"> 
                                            {{ Form::select('coupon_type', ['percent'=>'Percent','date'=>'Date Wise'],'', ['class'=>'form-control coupon_type','onchange'=>'changeCouponType()']) }}
                                <span class="" style="color:red"> {{ $errors->first('coupon_type')}} <span>
                                    </div>
                                   
                              
                              
                                </div>
                             
                                <div class="form-group  row">
                                    
                                <label class="col-sm-2 col-form-label">Coupon Name*</label>

                                    <div class="col-sm-4">
                                         {!! Form::text('name', '',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('name')}} <span>
                                </div>
                                
                                <label class="col-sm-2 col-form-label"> Coupon Code*</label>

                                    <div class="col-sm-4"> {!! Form::text('code', '',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('code')}} <span>
                                </div>

                                </div>
                                
                                 <div class="form-group  row percent_div">
                                    
                                <label class="col-sm-2 col-form-label">Percent(%)</label>

                                    <div class="col-sm-4">
                                         {!! Form::number('percent', '',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('percent')}} <span>
                                </div>
                                
                               

                                </div>
                                
                                 <div class="form-group  row date_div" style="display:none;">
                                       
                                <label class="col-sm-2 col-form-label">Amount</label>

                                    <div class="col-sm-4">
                                         {!! Form::number('amount', '',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('amount')}} <span>
                                </div> 
                                <label class="col-sm-2 col-form-label">Date</label>

                                    <div class="col-sm-4">
                                         {!! Form::date('date', '',['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('date')}} <span>
                                </div>
                                
                               

                                </div>
                                   
                                    <div class="hr-line-dashed"></div>



                              
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white btn-sm" type="reset">Reset</button>
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    </div>
                                </div>
                            </form>
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
                            <h5>{{$pageName}} List </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_id">
                                    <thead>
                                    <tr>

                                        <th width="5%">#</th>
                                        <th width="10%">Coupon Name </th>
                                          <th width="10%">Coupon Code </th>
                                            <th width="10%">Coupon Type </th>
                                             <th width="10%">Percent(%) </th>
                                              <th width="10%">Amount </th>
                                               <th width="10%">Expiry Date </th>
                                               <th width="10%">Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($result as $key=>$val)
                                   
                                    <tr>
                                        <td>{{$key+ 1}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->code}}</td>
                                        <td>
                                            @if($val->coupon_type == 'percent')
                                             Percent
                                            @else
                                            Date Wise
                                            @endif
                                            </td>
                                            <td>{{$val->percent}}</td>
                                            <td>{{$val->amount}}</td>
                                            <td>{{$val->date}}</td>
                                        
					  <td>
							@if($val->status	== 1)
								<span class="label label-success" >Activated </span>
							@else
								<span class="label label-warning" >Deactivated </span>
							@endif
						</td>
                                        <td>
                                            @if($val->status == 1)
							
								{!! Html::decode(link_to_route('admin.status.coupon','<i class="fa fa-ban"></i>',[$val->id, 0],['class'=>'btn btn-success','title'=>'Click To Deactivate' ,'onclick'=>'return changeStatus();'])) !!}
							@else
							
								
									{!! Html::decode(link_to_route('admin.status.coupon','<i class="fa fa-check"></i>',[$val->id, 1],['class'=>'btn btn-success','title'=>'Click To Activate','onclick'=>'return changeStatus();'])) !!}
							@endif 
                                       
                                        {!! Html::decode(link_to_route('admin.edit.coupon','<i class="fa fa-pencil"></i>',[$val->id],['class'=>'btn btn-primary','title'=>'Edit'])) !!}
                                         {!! Html::decode(link_to_route('admin.delete.coupon','<i class="fa fa-trash"></i>',[$val->id],['class'=>'btn btn-warning','title'=>'Delete','onclick'=>'return deleteConfirm();'])) !!}
                                    
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
<script>
   function changeCouponType(){
      
       var coupon_type = $('.coupon_type').val();
       if(coupon_type == 'percent'){
           $('.percent_div').show();
            $('.date_div').hide();
       }else if(coupon_type == 'date'){
            $('.percent_div').hide();
            $('.date_div').show();
       }
       
   }
</script>
@endsection
