<?php
    $code = (request()->code) ? request()->code : 403;
    $err = Config::get('gds_error_code.'.$code);

    if($err){
        $title = $err['title'];
        $message = $err['message'];
    }else{
        $code = '404';
        $title = 'Erm. Page not found.';
        $message = 'We suggest you to go to the homepage while we solve this issue.';
    }

?>

<!DOCTYPE html>
<html lang="en" >
   <head>
      @include('elements.head')
   </head>
   <body class="g-sidenav-show bg-gray-100 error-page">
      <main class="main-content max-height-vh-100 h-100">
         <main class="main-content  mt-0">
            <section class="my-10">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6 my-auto">
                        <h1 class="display-1 text-bolder text-gradient text-danger">Error {{ $code }}</h1>
                        <h2>{{ $title }}</h2>
                        <p class="lead">{{ $message }}</p>
                        <a type="button" class="btn bg-gradient-dark mt-4" href="{{ route('home') }}">Go to Homepage</a>
                     </div>
                     <div class="col-lg-6 my-auto position-relative">
                        <img class="w-100 position-relative" src="{{ asset('assets/img/illustrations/error-404.png') }}" alt="404-error">
                     </div>
                  </div>
               </div>
            </section>
         </main>
         <footer class="footer py-5">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 mb-4 mx-auto text-center">
                     <a href="https://gds.pro.vn/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                     Company
                     </a>
                     <a href="https://gds.pro.vn/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                     About Us
                     </a>
                     <a href="https://gds.pro.vn/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                     Team
                     </a>
                     <a href="https://gds.pro.vn/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                     Products
                     </a>
                     <a href="https://gds.pro.vn/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                     Blog
                     </a>
                  </div>
               </div>
            </div>
         </footer>
      </main>
      @include('elements.script')
   </body>
</html>
