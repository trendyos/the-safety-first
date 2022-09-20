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
                            <h5>{{$pageName}} List </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_id">
                                    <thead>
                                    <tr>

                                        <th width="10%">Project No.</th>
                                         <th width="15%">Category Name</th>
                                         <th width="15%">Project Name</th>
                                          <th width="10%">Project Start Date</th>
                                          <th width="10%">Project End Date</th>
                                        <th width="10%">Cost </th>
                                          <th width="10%">Status </th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($result as $key=>$val)
                                   
                                   <?php
                                            $todayDate = date("Y-m-d");
                                            ?>
                                    @if($todayDate > $val->end_date && $val->status == "In Process")
                                    <tr class="chngeColor">
                                        @else
                                        <tr>  @endif
                                       <?php
                                            $month = date('m');
                                            $projectNo = 'TOS/'.$month.'/'.$val->id;
                                        ?>
                                        <td>
                                            {{ $projectNo }}</td>
                                        <td>{{$val->categoryName}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->start_date}}</td>
                                         <td>{{$val->end_date}}</td>
                                        
                                         <td>{{$val->cost}}</td>
                                            <td>{{ $val->status}}</td>
                                          
					
                                        <td>
                                                  
                                         @if($val->status == 'In Process' ||  $val->status == 'On Hold')
							
							
							<button  onclick="status('{{$val->id}}')"; data-toggle="modal" data-target="#myModalStatus" class="btn btn-success" type="button">Status</button>
								
						
							@endif 
                                        {!! Html::decode(link_to_route('admin.edit.project','<i class="fa fa-pencil"></i>',[$val->id],['class'=>'btn btn-primary','title'=>'Edit'])) !!}
                                    
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


<div class="modal inmodal" id="myModalStatus" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"  >Status</h4>
                                        </div>
                                        {{ Form::open(['route'=>['admin.status.project'],'class'=>'classname','id'=>'myForm','files'=>'true'])}}
                                        @csrf
                                       
                                        <div class="modal-body ">
                                            <input type="hidden" value="" class="project_id" name="project_id"/>
                                       <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label"> Status</label>

                                    <div class="col-sm-10">
                                         {{ Form::select('status', ['Finished'=>'Finished','On Hold'=>'On Hold','Cancelled'=>'Cancelled'],'', ['class'=>'form-control status','onchange'=>'changeProjectStatus()','placeholder'=>'Select Status']) }}
                                    <span class="" style="color:red"> {{ $errors->first('relation')}} <span>
                                </div>
                                      
                                    </div>
                                    
                                     <div class="form-group  row reason_div" style="display:none;">
                                            <label class="col-sm-2 col-form-label"> Reason</label>

                                    <div class="col-sm-10">
                                        {!! Form::textarea('reason', null, ['class'=>'form-control','rows'=>'3']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('relation')}} <span>
                                </div>
                                      
                                    </div>
                                        
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <a href="javascript:void(0)" style="display:none;" class="btn btn-sm btn-primary float-right buy_now" >Save changes</a> 

                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        {{ Form::close() }}       
                                    </div>
                                </div>
                            </div>
                            <script>
                                function status(id){
                                    $('.project_id').val(id);
                                }
                                function changeProjectStatus(){
                                   var status =  $('.status').val();
                                    if(status == 'Finished'){
                                        $('.reason_div').hide();
                                    }else{
                                         $('.reason_div').show();
                                    }
                                    }
                                
                            </script>
@endsection
