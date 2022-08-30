
<!DOCTYPE html >
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

  <title>@yield('title')</title>
  <!-- Favicons -->
  <link href="{{ asset("uploads/users/0c97d99873a2162b4cabbb19ac34a28d.jpg") }}" rel="icon">
  <link href="{{ asset("uploads/users/0c97d99873a2162b4cabbb19ac34a28d.jpg") }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300&family=Open+Sans:wght@300&family=PT+Sans:wght@700&display=swap" rel="stylesheet">



<!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset("vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
  <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link href="{{ asset("css/select2.min.css") }}">
  <script src="{{ asset("js/app.js") }}" defer></script>

    @yield("etra_style")


    <style>
        body{
            font-family: 'Battambang', cursive;
            font-family: 'Open Sans', sans-serif;
            font-family: 'PT Sans', sans-serif;
            font-size: 14px;
          
        }
        .pagination > .page-item > .page-link{
            box-shadow: none;
            outline: 0;
            /* border-radius: 50px; */
            border:none
        }
        .bradcum-show h5,label{
            padding: 0;
            margin: 0
        }
    </style>
</head>

<body >

  <!-- ======= Header ======= -->
  @include('systems.include.ahead')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('systems.include.asside')

  <!-- End Sidebar-->

  <main id="main" class="main">

    @yield('content')

  </main>
  <!-- End #main -->

{{-- modal for sale product that click on button sale product
this modal will pop up on screen that user or administrator
also can item product and submit sale --}}



  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset("js/select2.min.js") }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>



@yield('extra_script')





</body>


</html>
