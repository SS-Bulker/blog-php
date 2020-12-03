@extends('plantilla')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">

   <div class="container-fluid">

     <div class="row mb-2">

       <div class="col-sm-6">

         <h1>Opiniones</h1>

       </div>

       <div class="col-sm-6">

         <ol class="breadcrumb float-sm-right">

         <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

           <li class="breadcrumb-item active">Opiniones</li>

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

             <h3 class="card-title">Title</h3>

             <div class="card-tools">

               <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                 <i class="fas fa-minus"></i></button>

               <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">

                 <i class="fas fa-times"></i></button>

             </div>

           </div>

           <div class="card-body">

               <table class="table table-bordered table-striped dt-responsive" id="tablaOpiniones" width="100%" >
                   <thead>
                   <tr>

                       <th width="10px">#</th>
                       <th>Articulo</th>
                       <th>Nombre</th>
                       <th>Correo</th>
                       <th>Foto</th>
                       <th>Opinión</th>
                       <th>Fecha de la opinión</th>
                       <th>Aprobación</th>
                       <th>Administrador</th>
                       <th>Respuesta</th>
                       <th>Fecha respuesta</th>
                       <th>Acciones</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($opiniones as $key => $value)
                       <tr>
                           {{-- Id de la opinion --}}
                           <td>{{$key+1}}</td>
                           {{-- Titulo del articulo (INNER JOIN) --}}
                           <td width="100px">{{$value->titulo_articulo}}</td>
                           {{-- Nombre --}}
                           <td>{{$value->nombre_opinion}}</td>
                           {{-- Correo opiniones --}}
                           <td>{{$value->correo_opinion}}</td>
                           {{-- Foto opinion --}}
                           <td>
                               <img src="{{url('/')}}/{{$value->foto_opinion}}" alt="" width="100px" class="rounded-circle">
                           </td>
                           {{-- Contenido Opinión --}}
                           <td width="250px">{{$value->contenido_opinion}}</td>
                           {{-- Fecha opinion --}}
                           <td>{{$value->fecha_opinion}}</td>
                           {{-- Aprobación --}}
                           @if($value->aprobacion_opinion === 0)
                               <td><a href="#" class="btn btn-danger">Por aprobar</a></td>
                           @else
                               <td><a href="#" class="btn btn-success">Aprobado</a></td>
                           @endif
                           {{-- Rol del administrador --}}
                           <td>{{$value->rol}}</td>
                           {{-- Respuesta opinion --}}
                           <td>{{$value->respuesta_opinion}}</td>
                           {{-- Fecha respuesta opinion --}}
                           <td>{!! $value->fecha_respuesta !!}</td>
                           {{-- Acciones --}}
                           <td>
                               <a href="{{url('/')}}/opiniones/{{$value->id_opinion}}" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                               <button class="btn btn-danger eliminarRegistro" action="{{url('/')}}/opiniones/{{$value->id_opinion}}" method="DELETE" pagina="opiniones">
                                   @csrf
                                   <i class="fas fa-trash-alt"></i
                               </button>
                           </td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>

           </div>
           <!-- /.card-body -->
         </div>
         <!-- /.card -->
       </div>

     </div>

   </div>

 </section>
 <!-- /.content -->
</div>
<!-- /.content-wrapper -->

{{-- Modal para editar una opinion --}}
@if(isset($status))
    @if($status == 200)
        {{-- Aqui va la ventana modal para editar una opinion --}}
        @foreach($opinion as $key => $valueOpinion)
        <div class="modal" id="editarOpinion">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                    <form method="POST" action="{{url('/')}}/opiniones/{{$valueOpinion->id_opinion}}" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="modal-header bg-info">

                            <h3 class="card-title">Editar opinion</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-tool close" data-dismiss="modal">

                                    <i class="fas fa-times"></i></button>

                            </div>

                        </div>

                        <div class="modal-body">

                            {{-- nombre opinion --}}
                            <div class="form-group">
                                <label for="">Nombre del usuario</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" name="nombre_opinion" id="" readonly="readonly" disabled="disabled" value="{{old('nombre_opinion', $valueOpinion->nombre_opinion)}}" placeholder="Nombre del usuario que realizo la opinión">
                                </div>
                            </div>

                            {{-- correo opinion --}}
                            <div class="form-group">
                                <label for="">Correo del usuario</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" name="correo_opinion" id="" readonly="readonly" disabled="disabled" value="{{old('correo_opinion', $valueOpinion->correo_opinion)}}" placeholder="Ingrese un titulo para el articulo">
                                </div>

                            </div>
                            {{-- Titulo del articulo --}}
                            <div class="form-group">
                                <label for="">Titulo del articulo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append input-group-text">
                                        <i class="far fa-newspaper"></i>
                                    </div>
                                    <input type="text" class="form-control" name="titulo_articulo" id="" readonly="readonly" disabled="disabled" value="{{old('titulo_articulo', $valueOpinion->titulo_articulo)}}" placeholder="Ingrese una descripción para el articulo" maxlength="220">
                                </div>
                            </div>

                            {{-- Estado de la opinion --}}
                            <div class="form-group">
                                <label for="">El estado de la opinion es: <span class="badge badge-primary"> @if($valueOpinion->aprobacion_opinion == 1) Aprobada @else Por aprobar @endif</span></label>
                                <br>
                                <label for="">¿Desea cambair el estado de la opinión?</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append input-group-text">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <select name="aprobacion_opinion" id="" class="form-control">
                                        <option value="{{$valueOpinion->aprobacion_opinion}}">Seleccione</option>
                                        <option value="0">Pendiente de aprobar</option>
                                        <option value="1">Aprobar opinión</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Contenido opinion --}}
                            <hr class="pb-2">
                            <div class="form-group">
                                <label for="">Contendio de la opinión <span class="small">Fecha de la opinión: {{$valueOpinion->fecha_opinion}}</span></label>
                                <div class="input-group mb-3">
                                    <textarea name="contenido_opinion" class="form-control" cols="80" rows="10" id="">{{old('contenido_opinion', $valueOpinion->contenido_opinion)}}</textarea>
                                </div>
                            </div>

                            {{-- Respuesta opinión --}}
                            <hr class="pb-2">
                            <div class="form-group">
                                <label for="">Añadir una respuesta</label>
                                <div class="input-group mb-3">
                                    <textarea name="respuesta_opinion" class="form-control" cols="80" rows="10" id="">{{old('respuesta_opinion', $valueOpinion->respuesta_opinion)}}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer d-flex justify-content-between">

                            <div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
        @endforeach
        <script>$("#editarOpinion").modal()</script>
        @elseif($status == 404)
        <script>
            notie.alert({
                type: 2,
                text: 'No pudimos encontrar esta opinión',
                time: 7
            })
        </script>
    @endif
@endif

{{-- Alertas --}}
@if(Session::has('error-eliminar-opinion'))
    <script>
        notie.alert({
            type: 3,
            text: 'No se pudo eliminar este producto',
            time: 7
        })
    </script>
@endif

@if(Session::has('editado-opinion'))
    <script>
        notie.alert({
            type: 1,
            text: 'La opinion fue editada satisfactoriamente',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-opinion'))
    <script>
        notie.alert({
            type: 2,
            text: 'Error al editar la opinion',
            time: 7
        })
    </script>
@endif
@endsection
