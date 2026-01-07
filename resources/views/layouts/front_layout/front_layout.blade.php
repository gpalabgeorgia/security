<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Secure - Security Systems">
    <title>Secure - Security Systems</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="assets/css/libraries.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
<div class="wrapper">
    <div class="preloader">
        <div class="loading"><span></span><span></span><span></span><span></span></div>
    </div><!-- /.preloader -->
    <!-- =========================
            Header
        =========================== -->
    @include('layouts.front_layout.front_header')

    @yield('content')
    <!-- ========================
      Footer
    ========================== -->
    @include('layouts.front_layout.front_footer')
</div><!-- /.wrapper -->
<div class="search-popup">
    <button type="button" class="search-popup__close"><i class="fas fa-times"></i></button>
    <form class="search-popup__form">
        <label>
            <input type="text" class="search-popup__form__input" placeholder="Type Words Then Enter">
        </label>
        <button class="search-popup__btn"><i class="icon-search"></i></button>
    </form>
</div><!-- /. search-popup -->

<!--<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>-->
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<!--<script src="fontawesome/js/all.js"></script>-->
<!--<script src="fontawesome/js/brands.js"></script>-->
<!--<script src="fontawesome/js/fontawesome.js"></script>-->
<!--<script src="fontawesome/js/regular.js"></script>-->
<!--<script src="fontawesome/js/solid.js"></script>-->
<!--<script src="fontawesome/js/v4-shims.js"></script>-->
</body>

</html>
