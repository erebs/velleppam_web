<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https:/fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    
    <!-- PAGE TITLE HERE -->
    <title>Admin |  @yield('title')</title>
    
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{asset('/admin/images/login.png')}}">
    <link href="{{asset('/admin/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/admin/vendor/nouislider/nouislider.min.css')}}">
    <link href="{{asset('/admin/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <!-- Style css -->
    <link href="{{asset('/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/style1.css')}}" rel="stylesheet">
    
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            
            <a href="/administrator/dashboard" class="brand-logo">
                <img src="{{asset('/admin/images/login.jpg')}}" style="width: 100%;">
            </a>
            <div class="brand-title">
                    <h2 class="">Fillow.</h2>
                    <span class="brand-sub-title">@soengsouy</span>
                </div>

            
        
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        
        <!--**********************************
            Chat box start
        ***********************************-->
        <div class="chatbox">
            <div class="chatbox-close"></div>
            <div class="custom-tab-1">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#notes">Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#alerts">Alerts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#chat">Chat</a>
                    </li>
                </ul>
                
            </div>
        </div>
        <!--**********************************
            Chat box End
        ***********************************-->
        
        <!--**********************************
            Header start
        ***********************************-->
        <div class="header border-bottom">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                @yield('head1')
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item d-flex align-items-center">
                                <div class="input-group search-area">
                                    <input type="text" class="form-control" placeholder="Search here...">
                                    <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                                </div>
                            </li>


                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                   <svg width="28" height="28" viewbox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.076 6.24662C26.962 5.48439 26.5787 4.78822 25.9955 4.28434C25.4123 3.78045 24.6679 3.50219 23.8971 3.5H4.10289C3.33217 3.50219 2.58775 3.78045 2.00456 4.28434C1.42137 4.78822 1.03803 5.48439 0.924011 6.24662L14 14.7079L27.076 6.24662Z" fill="#717579"></path>
                                    <path d="M14.4751 16.485C14.3336 16.5765 14.1686 16.6252 14 16.6252C13.8314 16.6252 13.6664 16.5765 13.5249 16.485L0.875 8.30025V21.2721C0.875926 22.1279 1.2163 22.9484 1.82145 23.5536C2.42659 24.1587 3.24707 24.4991 4.10288 24.5H23.8971C24.7529 24.4991 25.5734 24.1587 26.1786 23.5536C26.7837 22.9484 27.1241 22.1279 27.125 21.2721V8.29938L14.4751 16.485Z" fill="#717579"></path>
                                </svg>

                               
                                    <span class="badge light text-white bg-warning rounded-circle">0</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div id="DZ_W_Notification1" class="widget-media dlab-scroll p-3" style="height:380px;">
                                        <ul class="timeline">
                                            
                                            <li style="cursor:pointer;">
                                                <div class="timeline-panel">
                                                    <!-- <div class="media me-2">
                                                        <img alt="image" width="50" src="images/avatar/1.jpg">
                                                    </div> -->
                                                    <div class="media-body">
                                                        <h6 class="mb-1"></h6>
                                                        <small class="d-block"></small>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            
                                            
                                             
                                           
                                        </ul>
                                    </div>
                                    <!-- <a class="all-notification" href="javascript:void(0);">See all notifications <i class="ti-arrow-end"></i></a> -->
                                </div>
                            </li>
                            


                              
                            
                            
                            
                           
                           
                           
                            
                            <li class="nav-item dropdown  header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <img src="{{ asset('admin/img/'.Auth::guard('admin')->user()->profile_image)}}" width="56" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="/administrator/edit-profile" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ms-2">Edit Profile </span>
                                    </a>
                                     <a href="/administrator/change-password" class="dropdown-item ai-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M13.828 2.828a4 4 0 1 1 5.657 5.657L7.414 21.9a2 2 0 0 1-2.828 0L2.12 19.88a2 2 0 0 1 0-2.828l11.293-11.293z"/>
                                        <path d="M20 14l-2.879 2.879a1 1 0 0 1-1.414-1.414L18.586 13H15a1 1 0 0 1 0-2h3.586l-2.879-2.879a1 1 0 1 1 1.414-1.414L20 10z"/>
                                    </svg>
                                    <span class="ms-2">Change Password</span>
                                </a>

                                    <a href="/administrator/logout" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <!-- <li><a class="has-arrow active " href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.html">Dashboard Light</a></li>
                            <li><a href="index-2.html">Dashboard Dark</a></li>
                            <li><a href="project-page.html">Project</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="kanban.html">Kanban</a></li>
                            <li><a href="calendar-page.html">Calendar</a></li>
                            <li><a href="message.html">Messages</a></li>    
                        </ul>

                    </li> -->
                     <li><a href="/administrator/dashboard" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    </li>

                 <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                            <span class="nav-text">Menu</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/administrator/approval-pending">Approval Pending</a></li>
                            <li><a href="/administrator/rejected-apps">Rejected</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-receipt"></i>
                            <span class="nav-text">Bills</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/administrator/approval-pending">Approval Pending</a></li>
                            <li><a href="/administrator/rejected-apps">Rejected</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-users"></i>
                            <span class="nav-text">Staffs</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/administrator/approval-pending">Approval Pending</a></li>
                            <li><a href="/administrator/rejected-apps">Rejected</a></li>
                        </ul>
                    </li>
                    
                    



                    
                   
                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-cog"></i>
                            <span class="nav-text">Settings</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/administrator/change-password">Change password</a></li>
                            <li><a href="/administrator/logout">Logout</a></li>
                        </ul>
                    </li>                     
                </ul>
                
                
                <div class="copyright">
                    <p><strong>Velleppakkari Restaurent</strong> © 2023 All Rights Reserved</p>
                    {{-- <p class="fs-12">Made with <span class="heart"></span> by ERE Business Solutions Pvt.Ltd</p> --}}
                </div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
    
    




 @yield('contents')









        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
    
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="" target="_blank">Arun</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

    


  </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
 <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
 <script src="{{asset('/admin/vendor/global/global.min.js') }}"></script>
    <script src="{{asset('/admin/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- <script src="{{asset('/admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script> -->
    
    <!-- Apex Chart -->
    <!-- <script src="{{asset('/admin/vendor/apexchart/apexchart.js') }}"></script>
    
    <script src="{{asset('/admin/vendor/chart.js/Chart.bundle.min.js') }}"></script> --> 
    
    <!-- Chart piety plugin files -->
     <!-- <script src="{{asset('/admin/vendor/peity/jquery.peity.min.js') }}"></script> -->
    <!-- Dashboard 1 -->
    <script src="{{asset('/admin/js/dashboard/dashboard-1.js') }}"></script>
    
    <script src="{{asset('/admin/vendor/owl-carousel/owl.carousel.js') }}"></script>
    
    <script src="{{asset('/admin/js/custom.min.js') }}"></script>
    <script src="{{asset('/admin/js/dlabnav-init.js') }}"></script>
    <!-- <script src="{{asset('/admin/js/demo.js') }}"></script>
    <script src="{{asset('/admin/js/styleSwitcher.js') }}"></script> -->


    <script src="{{asset('/admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/admin/js/plugins-init/datatables.init.js')}}"></script>



  <script src="{{asset('/admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
  <script src="{{ asset('js/sweetalert.js') }}"></script>

  
</body>
</html>

<script type="text/javascript">
     $('#a2').hide();
      $('#b2').hide();
     $('#ab2').hide();
     $('#ab4').hide();
     $('#ab6').hide();
       $('#ab8').hide();
     $('#submitButton1').hide();
 $('#desc').ckeditor();
$('#msgtext').focus(); 
    

</script>

<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Select the textarea element by its ID
        var textarea = document.getElementById("msgtext");

        // Set the focus on the textarea
        textarea.focus();
    });
</script>
