
@php
    $seo = DB::table('seos')->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    @php
      $website_info = DB::table('website_settings')->first();
    @endphp
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @if ($website_info !== Null)
  <title>{{ $website_info->website_name }}</title>
  @else
  <title>Testing Site</title>
  @endif

  <meta name="csrf-token" content="{{ csrf_token() }}">
        
        @isset($seo)
            
        
        <meta property="og:type" content="Website">
        <meta property="og:title" content="{{ $seo->meta_title }}">
        <meta property="og:description" content="{{ $seo->meta_description }}">


        <meta name="author" content="{{ $seo->meta_author }}">
        <meta name="keyword" content="{{ $seo->meta_keyword }}">
        <meta name="description" content="{{ $seo->meta_description }}">
        <meta name="google-verification" content="{{ $seo->google_verification }}">
        <meta name="google-analytics" content="{{ $seo->google_analytics }}">
        <meta name="alexa-analytics" content="{{ $seo->alexa_analytics }}">
        <title>{{ $seo->meta_title }}</title>
        @endisset


  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.css')}}">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
   
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset ('backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset ('backend/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset ('backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset ('backend/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset ('backend/plugins/dropzone/min/dropzone.min.css')}}">
   
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  
<div class="wrapper">

  {{-- <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  
 @auth
 <!-- Navbar -->
 @include('admin.layouts.partial.navbar')
 <!-- /.navbar -->
 @include('admin.layouts.partial.sidebar')

 
 
 <!-- Main Sidebar Container -->
 @endauth

  @yield('content')



  @include('admin.layouts.partial.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


{{-- Share js file --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="{{ asset('js/share.js') }}"></script>

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset ('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset ('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset ('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset ('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset ('backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{ asset ('backend/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset ('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset ('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{ asset ('backend/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{ asset ('backend/plugins/dropzone/min/dropzone.min.js')}}"></script>
<!-- AdminLTE App -->
{{-- <script src="{{ asset ('backend/dist/js/adminlte.min.js')}}"></script> --}}
{{-- print this function --}}
<script src="{{ asset('backend/plugins/print_this/printThis.js') }}" ></script>



<!-- Sweet alert init js-->
<script src="{{ asset('backend/dist/js/sweet-alerts.init.js') }}"></script>

  {{-- Sweet Alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="{{ asset('backend/dist/js/code.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

{{-- before logout showing alert message --}}

<script>
  @if (Session::has('messege'))
  var type="{{Session::get('alert-type','info')}}"
  switch(type){
      case 'info':
          toastr.info("{{ Session::get('messege') }}");
          break;
      case 'success':
          toastr.success("{{ Session::get('messege') }}");
          break;
      case 'warning':
          toastr.warning("{{ Session::get('messege') }}");
          break;
      case 'error':
          toastr.error("{{ Session::get('messege') }}");
          break;
  }   
  @endif
</script>

<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>


</body>
</html>