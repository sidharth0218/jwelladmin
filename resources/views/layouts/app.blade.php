<html lang="en">
@include('layouts.header')
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
@include('layouts.sidebar')
@yield('dashboard')
@yield('login')    
@yield('register')
@include('layouts.footer')
</body>
<!-- [Body] end -->

</html>