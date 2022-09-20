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
									    	 <a href="javascript:void(0);" onclick="del_doc_row('{{$counterDoc}}');" class="btn btn-danger btn-small" >
			<i class="fa fa-trash-o"></i>
		</a>
			
									</td>
								
									
									
								</tr>