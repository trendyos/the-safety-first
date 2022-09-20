
									
								
									
									
								</tr>
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
										    <div class="row">
										    <div class="col-sm-1">{{Form::checkbox("queans[$counterQueAns][answer][0][value]",1,false,['class'=>''])}}</div>
										     <div class="col-sm-10">

										    {!! Form::text("queans[$counterQueAns][answer][0][option]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
											</div>
											</div>
										</div>  
											<div class="mws-form-item">
										    <div class="row">
										    <div class="col-sm-1">{{Form::checkbox("queans[$counterQueAns][answer][1][value]",1,false,['class'=>''])}}</div>
										     <div class="col-sm-10">

										    {!! Form::text("queans[$counterQueAns][answer][1][option]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
											</div>
											</div>
										</div>  
											<div class="mws-form-item">
										    <div class="row">
										    <div class="col-sm-1">{{Form::checkbox("queans[$counterQueAns][answer][2][value]",1,false,['class'=>''])}}</div>
										     <div class="col-sm-10">

										    {!! Form::text("queans[$counterQueAns][answer][2][option]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
											</div>
											</div>
										</div>  
											<div class="mws-form-item">
										    <div class="row">
										    <div class="col-sm-1">
										         {{Form::checkbox("queans[$counterQueAns][answer][3][value]",1,false,['class'=>''])}}</div>
										     <div class="col-sm-10">

										    {!! Form::text("queans[$counterQueAns][answer][3][option]",'', ['class'=>'form-control']) !!}
											<div class="error-message help-inline">
												<?php echo $errors->first('remark'); ?>
											</div>
											</div>
											</div>
										</div>  
									</td>
									
									<td>
									    	 <a href="javascript:void(0);" onclick="del_question_answer_row('{{$counterQueAns}}');" class="btn btn-danger btn-small" >
			<i class="fa fa-trash-o"></i>
		</a>
			
									</td>
								
									
									
								</tr>