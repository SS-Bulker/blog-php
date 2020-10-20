<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="{{$blog[0]['icono']}}">

  <title>Blog del viajero | Dashboard ~ CMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Notie -->
  <link rel="stylesheet" href="{{url('/')}}/css/plugins/notie.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/summernote/summernote-bs4.css">
  <!-- DataTables -->
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/dataTables.bootstrap4.min.css">	
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/responsive.bootstrap.min.css">
  <!-- Tags input -->
  <link rel="stylesheet" href="{{url('/')}}/css/plugins/tagsinput.css">
  {{-- CSS AdminLTE --}}
	<link rel="stylesheet" href="{{ url('/') }}/css/plugins/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed">


{{-- Fontawesome --}}
<script src="https://kit.fontawesome.com/e632f1f723.js" crossorigin="anonymous"></script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Notie Js -->
<script src="{{url('/')}}/js/plugins/notie.js"></script>
<!-- Summernote -->
<script src="{{url('/')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Tags inputs -->
<script src="{{url('/')}}/js/plugins/tagsinput.js"></script>
<!-- Sweet Alert -->
<script src="{{url('/')}}/js/plugins/sweetalert.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('/')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="{{ url('/') }}/js/plugins/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/js/plugins/dataTables.bootstrap4.min.js"></script> 
<script src="{{ url('/') }}/js/plugins/dataTables.responsive.min.js"></script>
<script src="{{ url('/') }}/js/plugins/responsive.bootstrap.min.js"></script>	
<!-- AdminLTE App -->
<script src="{{url('/')}}/dist/js/adminlte.js"></script>





  <!-- wrapper -->
<div class="wrapper">

  @include('modulos.header')

  @include('modulos.sidebar')

  @yield('content')

  @include('modulos.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<input type="hidden" id="ruta" value="{{url('/')}}">

<!-- Codigo propio -->
<script src="{{url('/')}}/js/codigo.js"></script>

</body>
</html>
