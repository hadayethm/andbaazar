<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('frontend')}}/assets/images/favicon/fav.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('frontend')}}/assets/images/favicon/fav.png" type="image/x-icon">
    <title>Andbaazar Admin Login</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/fontawesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/themify.css">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/slick-theme.css">

    <!-- jsgrid css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/jsgrid.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/admin.css">

</head>
<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">
    <div class="authentication-box">
        <div class="container">
            <div class="row">
                <div class="col-md-5 p-0 card-left">
                    <div class="card bg-primary">
                        <div class="svg-icon">

                        </div>

                        <div class="single-item">
                            <div>
                                <div>
                                    <h3>Welcome to Multikart</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-0 card-right">
                    <div class="card tab2-card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="top-profile-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><span class="icon-user mr-2"></span>Login</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><span class="icon-unlock mr-2"></span>Register</a>
                                </li> -->
                            </ul>
                            <!-- <div class="tab-content" id="top-tabContent"> -->
                                <!-- <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab"> -->
                                    <div class="alert">
                                        @include('flash::message')
                                    </div>

                                    <form class="form-horizontal auth-form" method="post" action="{{ action('AuthController@userAuth') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="userName">Email or Phone No :</label>
                                            <input required name="userName" type="text" class="form-control" placeholder="xxxxx@xxx.xxx / xxxxxxxxxx" id="userName" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password :</label>
                                            <input required="" name="password" type="password" class="form-control" placeholder="Password" id="password" autocomplete="off">
                                        </div>
                                        <div class="form-terms">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" name="remember_me" id="customControlAutosizing">
                                                <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                                                <a href="#" class="btn btn-default forgot-pass">lost your password</a>
                                            </div>
                                        </div>
                                        <div class="form-button">
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                       </div>
                   </div>
               </div>
          </div>
      </div>

    <!-- latest jquery-->
    <script src="{{asset('frontend')}}/assets/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('frontend')}}/assets/js/popper.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/bootstrap.js"></script>

    <!-- feather icon js-->
    <script src="{{asset('frontend')}}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/icons/feather-icon/feather-icon.js"></script>

    <!-- Sidebar jquery-->
    <script src="{{asset('frontend')}}/assets/js/sidebar-menu.js"></script>
    <script src="{{asset('frontend')}}/assets/js/slick.js"></script>

    <!-- Jsgrid js-->
    <script src="{{asset('frontend')}}/assets/js/jsgrid/jsgrid.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/jsgrid/griddata-invoice.js"></script>
    <script src="{{asset('frontend')}}/assets/js/jsgrid/jsgrid-invoice.js"></script>

    <!-- lazyload js-->
    <script src="{{asset('frontend')}}/assets/js/lazysizes.min.js"></script>

    <!--right sidebar js-->
    <script src="{{asset('frontend')}}/assets/js/chat-menu.js"></script>

    <!--script admin-->
    <script src="{{asset('frontend')}}/assets/js/admin-script.js"></script>
    <script>
        $('.single-item').slick({
                arrows: false,
                dots: true
            }
        );

        $('div.alert').delay(3000).fadeOut(350);
    </script>

    </body>
    </html>
