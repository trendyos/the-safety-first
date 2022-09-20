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

                                         <th width="15%">Company Name</th>
                                         <th width="15%">Product Name</th>
                                        <th width="10%">Examination Cost </th>
                                        <th width="15%">Description </th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
       

                                    @foreach($result as $key=>$val)
                                   
                                    <tr>
                                       @php
                                        $userName = App\User::where('id',$val->company_id)->first()->name ?? Null;
                                       @endphp
                                       
                                        <td>{{ $userName }}</td>
                                        <td>{{$val->name}}</td>
                                        
                                         <td>{{$val->cost}}</td>
                                         <td>{{$val->description}}</td>
                                          
					
                                        <td>
                                              {!! Html::decode(link_to_route('admin.edit.learning','<i class="fa fa-pencil"></i>',[$val->id],['class'=>'btn btn-primary','title'=>'Edit'])) !!}  
                                              {!! Html::decode(link_to_route('admin.view.learning','<i class="fa fa-eye"></i>',[$val->id],['class'=>'btn btn-success','title'=>'View'])) !!}  
                                    
                                       
                                    
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

                                  
@endsection
