@extends('hr.layouts.app')

@section('body')
<style>
.btn.btn-danger {
    background-color: #53a5d5 !important;
    border-color: #53a5d5 !important;
}
.label-danger{
    background-color: #53a5d5 !important;
    border-color: #53a5d5 !important;
}
.text-danger {
    color: #3761d8 !important;
}
   div#page-wrapper {
        background-color: #fff;
}.stat-list li {
    font-size: 16px;
}.stat-list li {
    font-size: 16px;
    padding: 3px 10px;
}.stat-list li {
    margin-top: 0;
}.stat-list li:nth-of-type(even) {
    background: #f9f9f9;
}li.lazur-bg a {
    color: white !important;
}.stat-list li a {
    color: #6c6c6c;
}
.stat-list li:nth-of-type(odd) {
    background: #1c84c6;
}
.btn.btn-danger {
    background-color: #53a5d5 !important;
    border-color: #53a5d5 !important;
}
.label-info{
    background-color: #ffff !important;
    border-color: #ffff !important;
    color: #53a5d5 !important;
}
.text-info {
    color: #53a5d5 !important;
}
.ibox-title{
    color: #ffff;
    background-color: #53a5d5 !important;
        padding: 7px 10px 6px 15px !important;
    min-height: 35px !important;
}
.ibox-tools {
    display: block;
    float: none;
    margin-top: 0;
    position: absolute;
    top: 10px;
    
}
.ibox-content{
    background-color: #f4f5f7 !important;
    
}
button.btn.btn-xs.btn-white {
    color: #0a76b5;
}
.ibox{
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;
}
.btnblod {
    padding: 13px;
    font-size: 14px;
}
.btn-warning {
    color: #ffffff;
    background-color: #53a5d5;
    border-color: #53a5d5;
}

.ibox-title.bcwhite {
    background: #ffff !important;
}

.ibox-img-top {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
    @media (min-width: 992px)
.col-lg-3 {
   
    max-width: 20% !important;
}
</style>

<div class="wrapper wrapper-content">
       
            <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                          
                            <h5>All Vendors <small>(Total: &nbsp;{{(count($vendors))}}&nbsp;)</small></h5>
                        </div>
                        @if(count($vendors)> 0)
                        @foreach($vendors as $vendor)
                         <div class="col">
                            <div class="ibox" >
                                <img class="ibox-img-top" src="{{asset('/'.$vendor->image)}}" width="50px" height="50px" >
                                <div class="ibox-body text-center">
                                   Name:{{(ucwords($vendor->name))}}
                                   <br>
                                       
                                    <a href="{{url('learning-partner/show-vendor/'.$vendor->slug)}}" class="btn btn-success">View Details</a>
                                </div>
                            </div>
                        </div>
                     
                        @endforeach
                       
                         <h5><a href="#allVendors" style="margin:20px;">View All Vendors</a> </h5>
                         @else
                         <div class="col-sm-4">
                            <div class="ibox" >
                               No data!
                            </div>
                        </div>
                          @endif

                    </div>
                </div>

           

                <div class="col-md-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                           
                            <h5>Certification Done</h5>
                        </div>
                        <div class="ibox-content">
                                    <h1 class="no-margins">{{count($certificate)}}</h1>
                                   <!--  <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                                    <small>Certification Done</small>
                        </div>
                    </div>
                </div>

           
                   
                <div class="col-md-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            
                            <h5>Total Products</h5>
                        </div>
                        <div class="ibox-content">

                           <h1 class="no-margins">{{count($products)}}</h1>
                                   <!--  <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                                    <small>Total products</small>


                        </div>
                    </div>
                </div>
                
            </div>


              <!-- Start analytics section  -->

            <div class="row">
               <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Analytics(Pie Chart ) </h5>

                        </div>
                        <div class="ibox-content">
                            <div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="doughnutChart" height="207" style="display: block; width: 445px; height: 207px;" width="445" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


               <!--  <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Monthly Revenue </h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barChart" height="212" width="455" style="width: 455px; height: 212px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
         
                <!-- end analytics section  -->
 

                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title" id="allVendors">
                                <h5>All Vendors  </h5>
                                
                            </div>
                            <div class="ibox-content">
                               
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Logo  </th>
                                            <th>Vendor Name  </th>
                                            <th>Email Address </th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Pincode</th>
                                            <th>Contact Person Name </th>
                                            <th>Contact Person Mobile</th>
                                            <th>Status</th>
                                            <th>Joining Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($vendors as $key => $val)
                                        <tr>
                                        <td>{{$key+ 1}}</td>
                                        <td><img src="{{asset('/'.$val->image)}}" height="50px" width="50px"/></td>
                                        <td>{{$val->company}}</td>
                                        <td>{{$val->email}}</td>
                                        <td>{{$val->city}}</td>
                                         <td>{{$val->state}}</td>
                                        <td>{{$val->pincode}}</td>
                            
                                         <td>{{$val->contact_person_name}}</td>
                                         
                                        <td >{{$val->contact_person_mobile}}
                                           </td>
                                           
                                        
                                             <td>
                            @if($val->status    == 1)
                                <span class="label label-success" >Activated </span>
                            @else
                                <span class="label label-warning" >Deactivated </span>
                            @endif
                        </td>

                         <td >{{ \Carbon\Carbon::parse($val->created_at)->format('j F, Y') }}
                                           </td> 
                    
                    
                                        <td>
                                    @if($val->status == 1)
                            
                                {!! Html::decode(link_to_route('hr.status.vendor','<i class="fa fa-ban"></i>',[$val->id, 0],['class'=>'btn btn-success','title'=>'Click To Deactivate' ,'onclick'=>'return changeStatus();'])) !!}
                            @else
                            
                                
                                {!! Html::decode(link_to_route('hr.status.vendor','<i class="fa fa-check"></i>',[$val->id, 1],['class'=>'btn btn-success','title'=>'Click To Activate','onclick'=>'return changeStatus();'])) !!}
                            @endif 
                               <!--  <a href="{{url('learning-partner/edit-vendor/'.$val->slug)}}" style="margin-top: 5px;" class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a> -->
                                  <a href="{{url('learning-partner/show-vendor/'.$val->slug)}}" style="margin-top: 5px;" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>
                                

                              
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

        </div>
        <script>
             $(document).ready(function() {


                // FOR PIE CHART 
         var totalvendors = "{{count($vendors)}}";
         var totalproducts = "{{count($products)}}";
         var totalcertificate = "{{count($certificate)}}";

           var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [
                            totalvendors,totalproducts,totalcertificate
                               
                            ],
                            backgroundColor: [
                                "#FDB45C",
                                "#46BFBD",
                                "#dc3545"
                                
                            ],
                        }],
                        labels: [
                            "Vendors",
                            "Products",
                            "Certificates"
                        ]
                    },
                    options: {
                        // responsive: true
                                segmentShowStroke: true,
                                segmentStrokeColor: "#fff",
                                segmentStrokeWidth: 2,
                                percentageInnerCutout: 45, // This is 0 for Pie charts
                                animationSteps: 100,
                                animationEasing: "easeOutBounce",
                                animateRotate: true,
                                animateScale: false
                    }
                };

            window.onload = function() {
                var ctx = document.getElementById("doughnutChart").getContext("2d");
                window.myPie = new Chart(ctx, config);
            };

            // for bar chart 

              
                const ctx = document.getElementById('barChart');
                const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                     labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
                    datasets: [{
                        label: 'No Of Sales',
                        data: [12, 19, 3, 5, 2, 3,10,15,30,20,16,21],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                           
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


        });
        </script>
     
           
                            

@endsection

