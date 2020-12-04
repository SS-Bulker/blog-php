@extends('plantilla')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">

   <div class="container-fluid">

     <div class="row mb-2">

       <div class="col-sm-6">

         <h1>Anuncios</h1>

       </div>

       <div class="col-sm-6">

         <ol class="breadcrumb float-sm-right">

         <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

           <li class="breadcrumb-item active">Anuncios</li>

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

               <button class="btn btn-success float-left" data-toggle="modal" data-target="#crearAnuncio">Crear un nuevo anuncio</button>

             <div class="card-tools">

               <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                 <i class="fas fa-minus"></i></button>

               <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">

                 <i class="fas fa-times"></i></button>

             </div>

           </div>

           <div class="card-body">

               <table class="table table-bordered table-striped dt-responsive" id="tablaAnuncios" width="100%">
                   <thead>
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>Pagina</th>
                            <th>Acciones</th>
                        </tr>
                   </thead>
                   <tbody>
                   @foreach($anuncios as $key => $value)
                       <tr>
                           <td width="100px">{{$key + 1}}</td>
                           <td>{!! $value->codigo_anuncio !!}</td>
                           <td>{{$value->pagina_anuncio}}</td>
                           <td>
                               <a href="{{url('/')}}/anuncios/{{$value->id_anuncio}}" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                               <button class="btn btn-danger eliminarRegistro" method="DELETE" pagina="anuncios" action="{{url('/')}}/anuncios/{{$value->id_anuncios}}">
                                   @csrf
                                   <i class="fas fa-trash-alt"></i>
                               </button>
                           </td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>

           </div>
           <!-- /.card-body -->
           <div class="card-footer">

               <button class="btn btn-success float-right" data-toggle="modal" data-target="#crearAnuncio">Crear un nuevo anuncio</button>

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

{{-- Modal para crear un nuevo anuncio --}}
<div class="modal" id="crearAnuncio">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ url('/') }}/anuncios" enctype="multipart/form-data">
                @csrf

                <div class="modal-header bg-info">

                    <h3 class="card-title">Agregar anuncio</h3>

                    <div class="card-tools">

                        <button type="button" class="btn btn-tool close" data-dismiss="modal">

                            <i class="fas fa-times"></i></button>

                    </div>

                </div>

                <div class="modal-body">
                    <!-- Modal para crear un nuevo banner-->

                    {{-- Pagina del anunciio --}}
                    <div class="form-group">
                        <label for="">Pagina del anuncio:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <i class="fas fa-stream"></i>
                            </div>
                            <input id="pagina_anuncio" type="text" class="form-control @error('pagina_anuncio') is-invalid @enderror" name="pagina_anuncio" value="{{ old('tpagina_anuncio') }}" autocomplete="pagina_anuncio" placeholder="Ingresa la pagina donde quieres que este el anuncio" autofocus required>
                            @error('pagina_anuncio')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Anuncio --}}
                    <div class="form-group">
                        <label for="">Anuncio:</label>
                        <div class="input-group mb-3">
                            <textarea name="codigo_anuncio" class="summernote-anuncios" id="" cols="80" rows="10" placeholder="Ingresa toda la información del anuncio" required>{{old('codigo_anuncio')}}</textarea>
                            @error('codigo_anuncio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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

{{--  Modal para editar un anuncio --}}
@if(isset($status))
    @if($status == 200)
        @foreach($anuncio as $key => $valueAnuncio)
            <div class="modal" id="editarAnuncio">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="{{ url('/') }}/anuncios/{{$valueAnuncio->id_anuncio}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="modal-header bg-info">

                                <h3 class="card-title">Editar anuncio</h3>

                                <div class="card-tools">

                                    <button type="button" class="btn btn-tool close" data-dismiss="modal">

                                        <i class="fas fa-times"></i></button>

                                </div>

                            </div>

                            <div class="modal-body">
                                <!-- Modal para crear un nuevo banner-->

                                {{-- Pagina del anunciio --}}
                                <div class="form-group">
                                    <label for="">Pagina del anuncio:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append input-group-text">
                                            <i class="fas fa-stream"></i>
                                        </div>
                                        <input id="pagina_anuncio" type="text" class="form-control @error('pagina_anuncio') is-invalid @enderror" name="pagina_anuncio" value="{{ old('pagina_anuncio', $valueAnuncio->pagina_anuncio) }}" autocomplete="pagina_anuncio" placeholder="Ingresa la pagina donde quieres que este el anuncio" autofocus required>
                                        @error('pagina_anuncio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Anuncio --}}
                                <div class="form-group">
                                    <label for="">Anuncio:</label>
                                    <div class="input-group mb-3">
                                        <textarea name="codigo_anuncio" class="summernote-anuncios" id="" cols="80" rows="10" placeholder="Ingresa toda la información del anuncio" required>{{old('codigo_anuncio', $valueAnuncio->codigo_anuncio)}}</textarea>
                                        @error('codigo_anuncio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
        <script>$('#editarAnuncio').modal()</script>
        @elseif($status == 404)
        <script>
            notie.alert({
                type: 2,
                text: 'No pudimos encontrar este anuncio',
                time: 7
            })
        </script>
    @endif
@endif
{{-- Alertas --}}

@if(Session::has('creado-anuncio'))
    <script>
        notie.alert({
            type: 1,
            text: 'El anuncio fue creado exitosamente',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-creando-anuncio'))
    <script>
        notie.alert({
            type: 3,
            text: 'Hubo un error creando el anuncio',
            time: 7
        })
    </script>
@endif

@if(Session::has('actualizado-anuncio'))
    <script>
        notie.alert({
            type: 1,
            text: 'Se ha actualizado el anuncio correctamente',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-actualizar-anuncio'))
    <script>
        notie.alert({
            type: 3,
            text: 'Hubo un error actualizando el anuncio',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-validacion-anuncios'))
    <script>
        notie.alert({
            type: 2,
            text: 'Hubo un error validando los datos',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-eliminar-anuncio'))
    <script>
        notie.alert({
            type: 3,
            text: 'Error al eliminar el anuncio',
            time: 7
        })
    </script>
@endif

@endsection
