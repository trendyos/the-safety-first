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
                        {{ Form::open(['route'=>['admin.update.learning',$result->id],'class'=>'classname','id'=>'myForm','files'=>'true'])}}


                      
                        @csrf
                        <input type="hidden" value="{{ $result->id }}" name="user_id">
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Select Company*</label>
    
                                        <div class="col-sm-4"> 
                                            {{ Form::select('company_id', $companyes,$result->company_id, ['class'=>'form-control','placeholder'=>'Select Company']) }}
                                <span class="" style="color:red"> {{ $errors->first('company_id')}} <span>
                                    </div>
                                   
                              
                              
                                </div>
                             
    
     <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Product Name*</label>

                                    <div class="col-sm-4">
                                         {!! Form::text('name', $result->name,['class' => 'form-control']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('name')}} <span>

                                    </div>
                                   <label class="col-sm-2 col-form-label">Examination Cost*</label>

                                    <div class="col-sm-4">
                                       {!! Form::number('cost', $result->cost,['class' => 'form-control']) !!}
                                        
                                    <span class="" style="color:red"> {{ $errors->first('cost')}} <span>
                                </div>
                                    
                                </div>
                                
                          
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    
                                    <label class="col-sm-2 col-form-label">Product Description</label>

                                    <div class="col-sm-4">
                                        {!! Form::textarea('description', $result->description, ['class'=>'form-control','rows'=>'2']) !!}
                                    <span class="" style="color:red"> {{ $errors->first('description')}} <span>

                                    </div>
                                    <label class="col-sm-2 col-form-label">Product Image</label>

                                <div class="col-sm-4"><input type="file" name="image" class="form-control">
                                <br>
                                <img src="{{$result->image}}" height="50px;"/>
                                </div>
                                </div> 
                               
                             
                             
                             
                                <div class="form-group  row">
                               
                                    
                                             
                              <div class="col-md-12">
						  Upload Pdf
						    <input style="float:right;" type="button" value="Add More" class="btn btn-primary btn-sm add_more_btn" onclick="add_more_pdf_section();"/>
						<?php $counterPdf = 0; ?>
						
							<table class="table table-bordered pdfSectionRow">
								
							
								<thead>
									<th width="40%"><center>{{ trans("Title") }}</center></th> 
									<th width="40%"><center>{{ trans("Document") }}</center></th> 
								   
								</thead>
							  
								
								
								@if(!$pdfData->isEmpty())
							    @foreach($pdfData as $key => $value)
							
								
									<tr class="panel panel-default delete_add_more_pdf_section_{{$value->id}}" rel="{{$value->id}}">
								    
								    <td>		
										<div class="mws-form-item">
										 {!! Form::text("pdf[$value->id][title]",isset($value->title) ? $value->title : '', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('charge'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::file("pdf[$value->id][file]", ['class'=>'form-control']) !!}
										 @if(!empty($value->document))
                                                <a href="{{env('APP_URL')}}{{$value->document}}" download>
                                                  <i class="fa fa-download"></i>
                                                </a>
                                            @endif
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
										</div>  
									</td>
								    
									
									
								</tr>
								
								@endforeach
								@else
								
								<tr class="panel panel-default delete_add_more_pdf_section_{{$counterPdf}}" rel="{{$counterPdf}}">
								
									<td>		
										<div class="mws-form-item">
										 {!! Form::text("pdf[$counterPdf][title]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('charge'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::file("pdf[$counterPdf][file]", ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
										</div>  
									</td>
								
									
									
								</tr>
								
								@endif
								
								
								
								
							</table>
							</div>
							</div>
							<div class="form-group  row">
							<div class="col-md-12">
						  Upload PPT
						    <input style="float:right;" type="button" value="Add More" class="btn btn-primary btn-sm add_more_btn" onclick="add_more_ppt_section();"/>
						<?php $counterPpt = 0; ?>
					
							<table class="table table-bordered pptSectionRow">
								
							
								<thead>
									<th width="40%"><center>{{ trans("Title") }}</center></th> 
									<th width="40%"><center>{{ trans("Document") }}</center></th> 
								   
								</thead>
							  
									@if(!$pptData->isEmpty())
							    @foreach($pptData as $key => $value)
							
								
									<tr class="panel panel-default delete_add_more_ppt_section_{{$value->id}}" rel="{{$value->id}}">
								    
								    <td>		
										<div class="mws-form-item">
										 {!! Form::text("ppt[$value->id][title]",isset($value->title) ? $value->title : '', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('charge'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::file("ppt[$value->id][file]", ['class'=>'form-control']) !!}
										 @if(!empty($value->document))
                                                <a href="{{env('APP_URL')}}{{$value->document}}" download>
                                                  <i class="fa fa-download"></i>
                                                </a>
                                            @endif
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
										</div>  
									</td>
								    
									
									
								</tr>
								
								@endforeach
								@else
								
									<tr class="panel panel-default delete_add_more_ppt_section_{{$counterPpt}}" rel="{{$counterPpt}}">
								    <td>		
										<div class="mws-form-item">
										 {!! Form::text("ppt[$counterPpt][title]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('title'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::file("ppt[$counterPpt][file]", ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('file'); ?>
											</div>
										</div>  
									</td>
								
								
									
									
								</tr>
								
								@endif
								
							
								
							</table>
							</div>
							  
                                    </div>
                                    
                                    
                                     <div class="form-group  row">
                               
                                    
                                             
                              <div class="col-md-12">
						  Upload Word Document
						    <input style="float:right;" type="button" value="Add More" class="btn btn-primary btn-sm add_more_btn" onclick="add_more_doc_section();"/>
						<?php $counterDoc = 0; ?>
						
							<table class="table table-bordered docSectionRow">
								
							
								<thead>
									<th width="40%"><center>{{ trans("Title") }}</center></th> 
									<th width="40%"><center>{{ trans("Document") }}</center></th> 
								   
								</thead>
							  
									@if(!$docData->isEmpty())
							    @foreach($docData as $key => $value)
							
								
									<tr class="panel panel-default delete_add_more_doc_section_{{$value->id}}" rel="{{$value->id}}">
								    
								    <td>		
										<div class="mws-form-item">
										 {!! Form::text("doc[$value->id][title]",isset($value->title) ? $value->title : '', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('charge'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::file("doc[$value->id][file]", ['class'=>'form-control']) !!}
										 @if(!empty($value->document))
                                                <a href="{{env('APP_URL')}}{{$value->document}}" download>
                                                  <i class="fa fa-download"></i>
                                                </a>
                                            @endif
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
										</div>  
									</td>
								    
									
									
								</tr>
								
								@endforeach
								@else
									<tr class="panel panel-default delete_add_more_doc_section_{{$counterDoc}}" rel="{{$counterDoc}}">
								
									<td>		
										<div class="mws-form-item">
										 {!! Form::text("doc[$counterDoc][title]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('charge'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::file("doc[$counterDoc][file]", ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
										</div>  
									</td>
									
									<td>
									    
									</td>
								
									
									
								</tr>
								
								@endif
								
								
							
								
							</table>
							</div>
							</div>
							<div class="form-group  row">
							<div class="col-md-12">
						  Upload Videos
						  <input style="float:right;" type="button" value="Add More" class="btn btn-primary btn-sm add_more_btn" onclick="add_more_video_section();"/>
						    
						<?php $counterVideo = 0; ?>
					
							<table class="table table-bordered videoSectionRow">
								
							
								<thead>
									<th width="40%"><center>{{ trans("Title") }}</center></th> 
									<th width="40%"><center>{{ trans("Url") }}</center></th> 
								   
								</thead>
							  	@if(!$videoData->isEmpty())
							    @foreach($videoData as $key => $value)
							
								
								
								<tr class="panel panel-default delete_add_more_video_section_{{$value->id}}" rel="{{$value->id}}">
								    <td>		
										<div class="mws-form-item">
										 {!! Form::text("video[$value->id][title]",isset($value->title) ? $value->title : '', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('title'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::text("video[$value->id][url]",isset($value->url) ? $value->url : '', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('file'); ?>
											</div>
										</div>  
									</td>
								
									
								
									
									
								</tr>
								
								@endforeach
								@else
								<tr class="panel panel-default delete_add_more_video_section_{{$counterVideo}}" rel="{{$counterVideo}}">
								    <td>		
										<div class="mws-form-item">
										 {!! Form::text("video[$counterVideo][title]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('title'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::text("video[$counterVideo][url]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('file'); ?>
											</div>
										</div>  
									</td>
									
									
								
									
									
								</tr>
								@endif
								
								
							</table>
							</div>
							  
                                    </div>

                                    
                                    
                                    <div class="form-group  row">
                               
                                    
                                             
                              <div class="col-md-12">
						  Question Answer
						   <input style="float:right;" type="button" value="Add More" class="btn btn-primary btn-sm add_more_btn" onclick="add_more_question_section();"/>
						    
						<?php $counterQueAns = 0; ?>
						
							<table class="table table-bordered questionSectionRow">
								
							
								<thead>
									<th width="45%"><center>{{ trans("Question") }}</center></th> 
									<th width="45%"><center>{{ trans("Answer") }}</center></th> 
								   
								</thead>
							  
									@if(!$questionData->isEmpty())
							    @foreach($questionData as $key => $value)
							
								<tr class="panel panel-default delete_add_more_question_section_{{$value->id}}" rel="{{$value->id}}">
								
									<td>		
										<div class="mws-form-item">
										 {!! Form::text("queans[$value->id][question]",isset($value->question) ? $value->question : '', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('charge'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::text("queans[$value->id][answer]",isset($value->answer) ? $value->answer : '', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
										</div>  
									</td>
									
								
									
									
								</tr>
								
								@endforeach
								@else
								<tr class="panel panel-default delete_add_more_question_section_{{$counterQueAns}}" rel="{{$counterQueAns}}">
								
									<td>		
										<div class="mws-form-item">
										 {!! Form::text("queans[$counterQueAns][question]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('charge'); ?>
											</div>
										</div>  
									</td>
									<td>		
										<div class="mws-form-item">
										 {!! Form::text("queans[$counterQueAns][answer]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
										</div>  
									</td>
									
								
									
									
								</tr>
								@endif
								
								
							</table>
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
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
    function add_more_pdf_section(){  
		$('#loader_img').show();
		var get_last_id	=	$(".pdfSectionRow").find('tr').last().attr('rel');
		var counter  	= 	parseInt(get_last_id) + 1; 
		 $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
	    $.ajax({
			url			:	'{{ route("ajaxRequest.addMorePdfSection") }}',
			type		:	'post',
			data		:	{'counter':counter},
			success		:	function(response){ 
				$('.pdfSectionRow' ).find('tr').last().after(response); 
				$('#loader_img').hide();
			},
			error:function(response){ 
				$('#loader_img').hide();
			}
		});
	}
	
	
		
	
	
	function del_pdf_row(row_id) {
	    url = $(this).attr('href');
          
                    
                     swal({
                title: "Are you sure?",
                text: "Want to remove this?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {
                $('.delete_add_more_pdf_section_'+row_id).remove(); 
                
            });
        }
	
	function add_more_ppt_section(){  
		$('#loader_img').show();
		var get_last_id	=	$(".pptSectionRow").find('tr').last().attr('rel');
		var counter  	= 	parseInt(get_last_id) + 1; 
		 $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
	    $.ajax({
			url			:	'{{ route("ajaxRequest.addMorePptSection") }}',
			type		:	'post',
			data		:	{'counter':counter},
			success		:	function(response){ 
				$('.pptSectionRow' ).find('tr').last().after(response); 
				$('#loader_img').hide();
			},
			error:function(response){ 
				$('#loader_img').hide();
			}
		});
	}
	
	function del_ppt_row(row_id) {
	    url = $(this).attr('href');
          
                    
                     swal({
                title: "Are you sure?",
                text: "Want to remove this?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {
                $('.delete_add_more_ppt_section_'+row_id).remove(); 
                
            });
        }
        
        
        
        	function add_more_doc_section(){  
		$('#loader_img').show();
		var get_last_id	=	$(".docSectionRow").find('tr').last().attr('rel');
		var counter  	= 	parseInt(get_last_id) + 1; 
		 $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
	    $.ajax({
			url			:	'{{ route("ajaxRequest.addMoreDocSection") }}',
			type		:	'post',
			data		:	{'counter':counter},
			success		:	function(response){ 
				$('.docSectionRow' ).find('tr').last().after(response); 
				$('#loader_img').hide();
			},
			error:function(response){ 
				$('#loader_img').hide();
			}
		});
	}
	
	function del_doc_row(row_id) {
	    url = $(this).attr('href');
          
                    
                     swal({
                title: "Are you sure?",
                text: "Want to remove this?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {
                $('.delete_add_more_doc_section_'+row_id).remove(); 
                
            });
        }
        
        
        	function add_more_video_section(){  
		$('#loader_img').show();
		var get_last_id	=	$(".videoSectionRow").find('tr').last().attr('rel');
		var counter  	= 	parseInt(get_last_id) + 1; 
		 $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
	    $.ajax({
			url			:	'{{ route("ajaxRequest.addMoreVideoSection") }}',
			type		:	'post',
			data		:	{'counter':counter},
			success		:	function(response){ 
				$('.videoSectionRow' ).find('tr').last().after(response); 
				$('#loader_img').hide();
			},
			error:function(response){ 
				$('#loader_img').hide();
			}
		});
	}
	
	function del_video_row(row_id) {
	    url = $(this).attr('href');
          
                    
                     swal({
                title: "Are you sure?",
                text: "Want to remove this?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {
                $('.delete_add_more_video_section_'+row_id).remove(); 
                
            });
        }
        
        
        	function add_more_question_section(){  
		$('#loader_img').show();
		var get_last_id	=	$(".questionSectionRow").find('tr').last().attr('rel');
		var counter  	= 	parseInt(get_last_id) + 1; 
		 $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
	    $.ajax({
			url			:	'{{ route("ajaxRequest.addMoreQuestionSection") }}',
			type		:	'post',
			data		:	{'counter':counter},
			success		:	function(response){ 
				$('.questionSectionRow' ).find('tr').last().after(response); 
				$('#loader_img').hide();
			},
			error:function(response){ 
				$('#loader_img').hide();
			}
		});
	}
	
	function del_question_answer_row(row_id) {
	    url = $(this).attr('href');
          
                    
                     swal({
                title: "Are you sure?",
                text: "Want to remove this?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {
                $('.delete_add_more_question_section_'+row_id).remove(); 
                
            });
        }
        
</script>
@endsection
