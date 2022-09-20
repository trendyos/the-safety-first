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
									
									<td>
									   <a href="javascript:void(0);" onclick="del_pdf_row('{{$counterPdf}}');" class="btn btn-danger btn-small" >
			<i class="fa fa-trash-o"></i>
		</a>
									</td>
								
									
									
								</tr>