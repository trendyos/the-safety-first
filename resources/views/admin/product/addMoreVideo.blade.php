
								
								
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
									<td>		
											 <a href="javascript:void(0);" onclick="del_video_row('{{$counterVideo}}');" class="btn btn-danger btn-small" >
			<i class="fa fa-trash-o"></i>
		</a>
			
									</td>
									
								
									
									
								</tr>