<!DOCTYPE html>
<?php /*
<title>{{ config('app.name', 'Laravel') }}</title>
    {{ Html::style('public/assest/css/bootstrap.min.css')}}
    {{ Html::style('public/assest/font-awesome/css/font-awesome.css')}}

    {{ Html::style('public/assest/css/animate.css')}}
    {{ Html::style('public/assest/css/style.css')}}
    */ ?>

<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.3/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2019 06:58:20 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
 <link rel="icon" href="{{env('APP_URL')}}public/fav-icon.png" sizes="32x32" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{ Html::style('public/assest/css/bootstrap.min.css')}}
    {{ Html::style('public/assest/font-awesome/css/font-awesome.css')}}

    {{ Html::style('public/assest/css/animate.css')}}
    {{ Html::style('public/assest/css/style.css')}}
    {{ Html::script('public/assest/datapicker/jquery-3.5.0.min.js')}}
    {{ Html::style('public/assest/datapicker/zebra_datepicker.min.css')}}
     {{ Html::style('public/assest/css/plugins/sweetalert/sweetalert.css')}}
    
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&family=Nuosu+SIL&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.min.css" integrity="sha512-OivR4OdSsE1onDm/i3J3Hpsm5GmOVvr9r49K3jJ0dnsxVzZgaOJ5MfxEAxCyGrzWozL9uJGKz6un3A7L+redIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .Zebra_DatePicker{ z-index:99999 !important; }
        .Zebra_DatePicker_Icon{ top: 9px!important; }
          input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
    
}
img.img_logo {
    border-radius: 10px !important;
    height: 60px !important;
    width: auto !important;
}
        </style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
  
  
  
</head>
<?php
    $result  = DB::table('users')->where('id', '=', Auth::user()->id)->first();
    $companyDetails  = DB::table('users')->where('id', '=', Auth::user()->id)->first();
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
      $url = trim($uri, '/');
  

    ?>
<body>
   <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        {{Html::image($result->image,'', ['class'=>'','height'=>'100','width'=>'100'])}}
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="text-muted text-xs block">{{$result->name}} </span>
                        </a>
                    </div>
                    <div class="logo-element">
                    {{Html::image($result->image,'', ['class'=>'','height'=>'20'])}}
                    </div>
                </li>
               
                <li <?php if($url=='vendor/dashboard') { ?> class="active" <?php } ?>>
                    <a href="{{ route('vendor.home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                 <li <?php if($url=='vendor/product-list') { ?> class="active" <?php } ?>>
                    <a href="{{ route('vendor.list.product') }}"><i class="fa fa-users"></i> <span class="nav-label">Learning Management</span></a>
                </li>
               
                <li <?php if($url=='vendor/employee-list') { ?> class="active" <?php } ?>>
                    <a href="{{ route('vendor.list.employee') }}"><i class="fa fa-users"></i> <span class="nav-label">User Management</span></a>
                </li>
                <li <?php if($url=='vendor/update-profile') { ?> class="active" <?php } ?>>
                    <a href="{{ route('vendor.update.profile') }}"><i class="fa fa-user-o"></i> <span class="nav-label">Profile Update</span></a>
                </li>
               
               
                <li class="">
                <a class="" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span>
                                    </a>

                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
           
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to {{$companyDetails->name}}</span>
                </li>
                <li>
                {{Html::image($companyDetails->image,'', ['class'=>'','height'=>'40','width'=>'40'])}}
                </li>
               


                <li>
                <a class="" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                    </a>
                   
                </li>
               
            </ul>

        </nav>
        </div>
<form id="logout-form" action="{{ route('vendor.logout') }}" method="POST" class="d-none">

        
                                        @csrf
                                    </form>
                                    
        @include('vendor.layouts.adminError')
            @yield('body')
      
        <!--    <div class="footer">-->
        <!--    <div class="float-right">-->
        <!--       <strong>Version</strong> 1.0-->
        <!--    </div>-->
        <!--    <div>-->
        <!--        <strong>Copyright</strong> AHC Company-->
        <!--    </div>-->
        <!--</div>-->
        </div>
        
    </div>
   
    <!-- Mainly scripts -->
    {{Html::script('public/assest/js/jquery-3.1.1.min.js')}}
    {{Html::script('public/assest/js/popper.min.js')}}
    {{Html::script('public/assest/js/bootstrap.js')}}
    {{Html::script('public/assest/js/plugins/metisMenu/jquery.metisMenu.js')}}
    

    <!-- Flot {{Html::script('public/assest/js/plugins/slimscroll/jquery.slimscroll.min.js')}}
-->
    {{Html::script('public/assest/js/plugins/flot/jquery.flot.js')}}
    {{Html::script('public/assest/js/plugins/flot/jquery.flot.tooltip.min.js')}}
    {{Html::script('public/assest/js/plugins/flot/jquery.flot.spline.js')}}
    {{Html::script('public/assest/js/plugins/flot/jquery.flot.resize.js')}}
    {{Html::script('public/assest/js/plugins/flot/jquery.flot.pie.js')}}
    {{Html::script('public/assest/js/plugins/flot/jquery.flot.symbol.js')}}
    {{Html::script('public/assest/js/plugins/flot/jquery.flot.time.js')}}

    <!-- Peity -->
    {{Html::script('public/assest/js/plugins/peity/jquery.peity.min.js')}}
    {{Html::script('public/assest/js/demo/peity-demo.js')}}

    <!-- Custom and plugin javascript -->
    {{Html::script('public/assest/js/inspinia.js')}}
    {{Html::script('public/assest/js/plugins/pace/pace.min.js')}}

    <!-- jQuery UI -->
    {{Html::script('public/assest/js/plugins/jquery-ui/jquery-ui.min.js')}}

    <!-- Jvectormap -->
    {{Html::script('public/assest/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}
    {{Html::script('public/assest/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}
{{Html::script('public/assest/js/plugins/chartJs/Chart.min.js')}}
    <!-- EayPIE -->
    {{Html::script('public/assest/js/plugins/easypiechart/jquery.easypiechart.js')}}

    <!-- Sparkline -->
    {{Html::script('public/assest/js/plugins/sparkline/jquery.sparkline.min.js')}}

    <!-- Sparkline demo data  -->
    {{Html::script('public/assest/js/demo/sparkline-demo.js')}}

    {{ Html::script('public/assest/datapicker/zebra_datepicker.min.js')}}
    {{ Html::script('public/assest/datapicker/zebra_pin.min.js')}}
    {{ Html::script('public/assest/js/plugins/sweetalert/sweetalert.min.js')}}



  
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
    <script>

        



                    $('#datepickerr').Zebra_DatePicker({
                        disabled_dates: [
                            
                                
                              ],
                                              // all days, all months, all years as long
                                                        // as the weekday is 0 or 6 (Sunday or Saturday)
                    });
                    
                     $('#from').Zebra_DatePicker({
                    
                                              // all days, all months, all years as long
                                                        // as the weekday is 0 or 6 (Sunday or Saturday)
                    });
                    
                     $('#to').Zebra_DatePicker({
                                              // all days, all months, all years as long
                                                        // as the weekday is 0 or 6 (Sunday or Saturday)
                    });
                    
                     $('#efrom').Zebra_DatePicker({
                    
                                              // all days, all months, all years as long
                                                        // as the weekday is 0 or 6 (Sunday or Saturday)
                    });
                    
                     $('#eto').Zebra_DatePicker({
                                              // all days, all months, all years as long
                                                        // as the weekday is 0 or 6 (Sunday or Saturday)
                    });
</script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable(
                {
        order: [[0, 'desc']],
    });

       
           
        });
    </script>
    <script>
      function deleteConfirm() {
        if (!confirm('Are you sure you want to delete?')) {
          return false
        }
      }
    </script>
    
     <script>
      function changeStatus() {
        if (!confirm('Are you sure you want to change status?')) {
          return false
        }
      }
    </script>
</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.3/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2019 06:58:23 GMT -->
</html>
    {{ Html::script('public/assest/datapicker/zebra_datepicker.min.js')}}
    {{ Html::script('public/assest/datapicker/zebra_pin.min.js')}}
<?php
 
date_default_timezone_set('Asia/Kolkata');
$today =  date('d m Y');
$yes=Date('d m Y', strtotime('+1 days'));
$NewDateNextDay=Date('d m Y', strtotime('+2 days'));



 $dissableDate = "'$today','$yes','$NewDateNextDay',";

?>
    
    <script>

 $('#datepickerrr').Zebra_DatePicker({
                    
                    });
</script>