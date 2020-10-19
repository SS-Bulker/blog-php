@extends('plantilla')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">

   <div class="container-fluid">

     <div class="row mb-2">

       <div class="col-sm-6">

         <h1>Administradores</h1>

       </div>

       <div class="col-sm-6">

         <ol class="breadcrumb float-sm-right">

         <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

           <li class="breadcrumb-item active">Administradores</li>

         </ol>

       </div>

     </div>

   </div><!-- /.container-fluid -->

 </section>

 <!-- Main content -->
 <section class="content">

   <div class="container-fluid">

     <div class="row">

       <div class="col-12">
         <!-- Default box -->
         <div class="card card-primary card-outline">

           <div class="card-header">

            <button type="button" class="btn btn-success float-left">Crear nuevo administrador</button>

             <div class="card-tools">

               <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                 <i class="fas fa-minus"></i></button>

               <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                 
                 <i class="fas fa-times"></i></button>

             </div>

           </div>

           <div class="card-body">

            <table class="table table-bordered table-triped" width="100%">

              <thead>

                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th width="100px">Foto</th>
                  <th>Rol</th>
                  <th>Accíones</th>
                </tr>

              </thead>
              <tbody>
                @foreach($administradores as $key => $value)
                
                <tr>
                <td>{{($key+1)}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td><img src="{{$value->foto}}" alt="" class="img-fluid rounded-circle"></td>
                <td>{{$value->rol}}</td>
                <td>
                  <div class="boton-group">
                    <button type="button" class="btn btn-warning float-left"><i class="fas fa-pencil-alt"></i></button>
                    <button type="button" class="btn btn-danger float-left"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </td>
                </tr>

                @endforeach
              </tbody>

            </table>

            

           </div>
           <!-- /.card-body -->
           <div class="card-footer">

            <button type="button" class="btn btn-success float-right">Crear nuevo administrador</button>

           </div>
           <!-- /.card-footer-->
         </div>
         <!-- /.card -->
       </div>

     </div>

   </div>

 </section>
 <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection