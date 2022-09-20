@extends('admin.layouts.app')

@section('body')
<style>
    .ibox-test {
  
  background: linear-gradient(45deg, #558d7f, #96a787);


</style>
<div class="wrapper wrapper-content">
            <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{url('admin/learning-partners-list')}}">

                        
                        <div class="ibox ">
                        <div class="ibox-title">
                            <div class="ibox-tools">
                                <span class="label label-success float-right">Monthly</span>
                            </div>
                            <h5>Learning Partners </h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{count($learningPartners)}}
                              
                            </h1>
                            <div class="stat-percent font-bold text-success">{{$PartnersCount}} <i class="fa fa-level-up"></i></div>
                            <small>Total partners</small>
                        </div>
                    </div>

                    </a>
                   
                </div>

                <div class="col-md-3">
                     <a href="{{url('admin/vendors-list')}}">

                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="ibox-tools">
                                <span class="label label-info float-right">Monthly</span>
                            </div>
                            <h5>Vendors</h5>
                        </div>
                        <div class="ibox-content">
                                    <h1 class="no-margins">{{count($vendors) }}
                                  
                        </h1>
                                    <div class="stat-percent font-bold text-info">{{$VendorsCount}} <i class="fa fa-level-up"></i></div>
                                    <small>Total vendors </small>
                        </div>
                    </div>
                </a>
                </div>


                   <div class="col-md-3">
                    <a href="{{url('admin/employee-list')}}">

                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="ibox-tools">
                                <span class="label label-info float-right">Monthly</span>
                            </div>
                            <h5>Users</h5>
                        </div>
                        <div class="ibox-content">
                                    <h1 class="no-margins">{{count($users) }}
                                  
                        </h1>
                                    <div class="stat-percent font-bold text-info">{{$UsersCount}} <i class="fa fa-level-up"></i></div>
                                    <small>Total users </small>
                        </div>
                    </div>
                </a>
                </div>



                   <div class="col-md-3">
                     <a href="{{url('admin/learning-module-list')}}">

                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="ibox-tools">
                                <span class="label label-info float-right">Monthly</span>
                            </div>
                         <h5>Learning Modules </h5>
                        </div>
                        <div class="ibox-content">
                                    <h1 class="no-margins">{{count($learningModules) }}
                                  
                        </h1>
                                    <div class="stat-percent font-bold text-info">{{$PartnersCount}} <i class="fa fa-level-up"></i></div>
                                    <small>Total learning modules </small>
                        </div>
                    </div>
                </a>
                </div>

               
            </div>
            <!-- Start Latest Users  -->

              <!-- Start analytics section  -->

            <div class="row">
               <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Test Analytics </h5>

                        </div>
                        <div class="ibox-content">
                            <div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="doughnutChart" height="207" style="display: block; width: 445px; height: 207px;" width="445" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> Monthly Users Joined  </h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barChart" height="212" width="455" style="width: 455px; height: 212px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
                <!-- end analytics section  -->
 

         <div class="wrapper wrapper-content animated fadeInRight">
           
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Latest User Register </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_id">
                                    <thead>
                                    <tr>

                                      <th width="10%">Image  </th>
                                        <th width="10%">Name </th>
                                         <th width="5%">Email</th>
                                        <th width="10%">Mobile</th>
                                      
                                        <th width="10%">Status</th>
                                        <th width="10%">Action</th>
                                      
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $key=>$val)
                                   
                                    <tr>

                                         <td><img src="{{asset('/'.$val->image)}}" class="img-rounded" height="25px;" ></td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->email}}</td>
                                        <td>{{$val->mobile}}</td>
                                       
                                         
                                             <td>
                            @if($val->status    == 1)
                                <span class="label label-success" >Activated </span>
                            @else
                                <span class="label label-warning" >Deactivated </span>
                            @endif
                        </td>
                    
                    
                              
        <td>
                        @if($val->status == 1)
                            
                                {!! Html::decode(link_to_route('admin.status.employee','<i class="fa fa-ban"></i>',[$val->id, 0],['class'=>'btn btn-success','title'=>'Click To Deactivate' ,'onclick'=>'return changeStatus();'])) !!}
                            @else
                            
                                
                                    {!! Html::decode(link_to_route('admin.status.employee','<i class="fa fa-check"></i>',[$val->id, 1],['class'=>'btn btn-success','title'=>'Click To Activate','onclick'=>'return changeStatus();'])) !!}
                            @endif 
                             

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

        </div>
   {{Html::script('public/assest/js/plugins/chartJs/Chart.min.js')}}
        <script>
             $(document).ready(function() {
           
// FOR PIE CHART 
         var in_process = "{{$InProcessResult}}";
         var pass = "{{$PassResult}}";
         var failed = "{{$FailResult}}";

           var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [
                            in_process,pass,failed
                               
                            ],
                            backgroundColor: [
                                "#FDB45C",
                                "#46BFBD",
                                "#dc3545"
                                
                            ],
                        }],
                        labels: [
                            "In Process",
                            "Passed",
                            "Fail"
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
                     labels: [ 
                    
              @foreach($monthlyUsers as $key => $user) 
             
              @php
              echo '"' . $user['monthname'] . '"';
              @endphp
           
                 @if (!$loop->last)
                 ,
                 @endif
                @endforeach

            ],
                    datasets: [{
                        label: 'Users Joined',
                        data: [
                         @foreach($monthlyUsers as $key => $user) 
                          {{$user['count']}}
                         
                             @if (!$loop->last)
                             ,
                             @endif
                         @endforeach
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                             'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                             'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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
