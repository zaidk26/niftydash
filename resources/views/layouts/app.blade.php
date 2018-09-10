<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>

     <!-- User Info 
          Access this info in Vue to check user info -->
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Icon Set -->
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

  <div class="wrapper" id="app">
    <!-- Sidebar -->
    @auth
      <side-menu-component 
        system="{{ config('app.name') }}">
      </side-menu-component>
    @endauth

    <!-- Page Content -->
    <div id="content">          
      @auth
        <top-menu-component></top-menu-component>
      @endauth

      <div class="container-fluid mt-5">  
        <div class="row">
          
          @yield('content')
        
        </div> <!-- /row -->          
      </div> <!-- /container -->         
    </div> <!-- /content -->     
  </div> <!-- /wrapper -->      
   
</body>
</html>
