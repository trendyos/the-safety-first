@extends('vendor.layouts.app')

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
        padding: 7px 90px 6px 15px !important;
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
    @media (min-width: 992px)
.col-lg-3 {
   
    max-width: 20% !important;
}
</style>

<div class="wrapper wrapper-content">
    <!--    <center><div class="logo" style="text-align:center;">{{Html::image(Auth::user()->image,'', ['class'=>'','height'=>'100','width'=>'200'])}}</img></div></center> -->
            <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                          
                            <h5>Certification In Process</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{count($InprocessCertificate)}}</h1>
                          <!--   <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                            <small>Certification in Process</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                           
                            <h5>Certification Done</h5>
                        </div>
                        <div class="ibox-content">
                                    <h1 class="no-margins">{{count($PassCertificate)}}</h1>
                                   <!--  <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                                    <small>Certification Done</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            
                            <h5>Certification Cancelled</h5>
                        </div>
                        <div class="ibox-content">

                           <h1 class="no-margins">{{count($CancelledCertificate)}}</h1>
                                  <!--   <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                                    <small>Certification Cancelled</small>


                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            
                            <h5>Products</h5>
                        </div>
                        <div class="ibox-content">

                           <h1 class="no-margins">{{count($products)}}</h1>
                                 <!--    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                                    <small>Total Products</small>


                        </div>
                    </div>
                </div>
            </div>

                          <!-- Start analytics section  -->

            <div class="row">
               <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5> Analytics(Pie Chart) </h5>

                        </div>
                        <div class="ibox-content">
                            <div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="doughnutChart" height="207" style="display: block; width: 445px; height: 207px;" width="445" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
         
                <!-- end analytics section  -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Latest User Register </h5>
                                
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>

                                            
                                            
                                            <th>User Name </th>
                                            <th>Email  </th>
                                              <th>Phone  </th>
                                            <th>Vendor Name </th>                                        
                                            <th>Joined Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                         
                                            @foreach($allUsers  as $user)
                                        <tr>
                                            
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->mobile}}</td>
                                            <td>{{Auth::user()->company}}</td>
                                              
                                              <td>  {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</td>
                                    
                                            <td>
                                              
                                              <a href="{{url('vendor/user-details/'.$user->id)}}" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>   
                                             </td>


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
         var in_process = "{{count($InprocessCertificate)}}";
          var pass = "{{count($PassCertificate)}}";
          var failed = "{{count($CancelledCertificate)}}";
          var products ="{{count($products)}}";


           var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [in_process, pass,failed,products ],
                            backgroundColor: [
                                "#FDB45C",
                                "#46BFBD",
                                "#dc3545"
                                
                            ],
                        }],
                        labels: [
                            "In Process",
                            "Passed",
                            "Fail",
                            "Products",
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



        });
        </script>
     
           
                            

@endsection

