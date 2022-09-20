@extends('vendor.layouts.app')

@section('body')

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-7">
                
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>User  Details</h5>
                            
                        </div>
                        <div class="ibox-content">
                       
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Name</label>

                                    <div class="col-sm-10"><input type="text" value="{{ $result->name ?? old('name') }}" name="name" class="form-control">
                                  </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Mobile No.</label>

                                    <div class="col-sm-10"><input type="text" value="{{ $result->mobile ?? old('mobile') }}" name="mobile" class="form-control">
                                   
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Email</label>

                                    <div class="col-sm-10"><input type="text" value="{{ $result->email ?? old('email') }}" name="email" class="form-control">
                                    </div>
                                  
                                </div>


                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Vendor Name</label>

                                    <div class="col-sm-10"><input type="text" value="{{$vendorName}}" name="companyName" class="form-control">
                                    </div>
                                  
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Address </label>

                                    <div class="col-sm-10">   <input type="text" name="name" class="form-control" value="{{$result->address}}" row="2" readonly> 
                                    </div>
                                  
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">City Name</label>

                                    <div class="col-sm-10"> <input type="text" name="name" class="form-control" value="{{$result->city}}" readonly> 
                                    </div>
                                  
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">State </label>

                                    <div class="col-sm-10">  
                                        <input type="text" name="name" class="form-control" value="{{$result->state}}" readonly> 
                                    </div>
                                  
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Pincode Name</label>

                                    <div class="col-sm-10">    
                                     <input type="text" name="name" class="form-control" value="{{$result->pincode}}" readonly> 
                                    </div>
                                  
                                </div>




                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Image</label>

                                <div class="col-sm-10">
                                <!--     <input type="file" name="image" class="form-control">
                                <br> -->
                            <img src="{{ asset('/'.$result->image)  }}" height="150px;"/></div>
                                </div>


                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Joined Date  </label>

                                    <div class="col-sm-10"> 
                                        <input type="text" name="name" class="form-control" value="{{ \Carbon\Carbon::parse($result->created_at)->format('d F Y') }}" readonly> 
                                    </div>
                                  
                                </div>

                                <div class="hr-line-dashed"></div>


                              
                        </div>
                    
                    
                </div>
            </div>

                <div class="col-lg-5">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>User Order  Details</h5>
                            
                        </div>
                        <div class="ibox-content">
                       
                                
                                        
                         
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>

                                            <th>#Order Id</th>
                                           
                                            <th>Product Name  </th>
                                            <th>Description </th>
                                            <th>Purchase Date  </th>
                                            <th>Total Cost(INR) </th>
                                           
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                           @foreach($purchaseDetails as $details) 
                                           @php
                                           $product = App\Product::where('id',$details->package_id)->first();
                                           @endphp
                                        <tr>
                                            <td>{{$details->id}}</td>  
                                            <                                           
                                            <td>{{$product->name}}</td>
                                            <td>{{substr($product->description, 0, 10)}}...</td>
                                            <td>{{$details->created_at}}</td>  
                                            <td>{{$details->price}}</td>
                                          
                                          
                                           
                                           
                                            <td><a href="#" title="View"><i class="fa fa-eye" ></i></a></td>
                                        </tr>
                                        @endforeach
                                       
                                       
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                     

                             <!--    <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Order Id </label>

                                    <div class="col-lg-10">
                                        <input type="text" name="orderId"  class="form-control"> 
                                   
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Product Name </label>

                                    <div class="col-lg-10">
                                        <input type="text"  name="product_name" class="form-control"> 
                                   
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Transaction Id  </label>

                                    <div class="col-lg-10">
                                        <input type="text"  name="Transactionid" class="form-control"> 
                                   
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Desciption  </label>

                                    <div class="col-lg-10">
                                        <input type="text"  name="Desciption" class="form-control"> 
                                   
                                    </div>
                                </div>

                                    <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Purchase Date  </label>

                                    <div class="col-lg-10">
                                        <input type="text"  name="purchase date " class="form-control"> 
                                   
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Total Cost </label>

                                    <div class="col-lg-10">
                                        <input type="text"  name="cost" class="form-control"> 
                                   
                                    </div>
                                </div>
 -->
                               

                               
                                
                            
                        </div>
                    </div>
                </div>
            </div>
            </div>
            
            
        </div>
@endsection
