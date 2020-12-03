@extends('plantilla')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">

   <div class="container-fluid">

     <div class="row mb-2">

       <div class="col-sm-6">

         <h1>Banner</h1>

       </div>

       <div class="col-sm-6">

         <ol class="breadcrumb float-sm-right">

         <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

           <li class="breadcrumb-item active">Banner</li>

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

           <button class="btn btn-success float-left" data-toggle="modal" data-target="#crearBanner">Añadir foto al banner</button>

             <div class="card-tools">

               <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                 <i class="fas fa-minus"></i></button>

               <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">

                 <i class="fas fa-times"></i></button>

             </div>

           </div>

           <div class="card-body">
               <table class="table table-bordered table-striped dt-responsive" id="tablaBanner" width="100%" >
                    <thead>
                        <tr>
                            <th width="10px">#</th>
                            <th>Banner</th>
                            <th>Página</th>
                            <th>Titulo</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   <tbody>
                       @foreach($banner as $key => $value)
                           <tr>
                               <td>{{$key+1}}</td>
                               {{-- Img Banner --}}
                               <td>
                                   <img src="{{url('/')}}/{{$value->img_banner}}" width="600px" height="250px" alt="">
                               </td>
                               {{-- Pagina banner --}}
                               <td>{{$value->pagina_banner}}</td>
                               {{-- Titulo banner --}}
                              <td>{{$value->titulo_banner}}</td>
                               {{-- Descripcion banner --}}
                               <td width="100px">{{$value->descripcion_banner}}</td>
                               {{-- Acciones banner --}}
                               <td>
                                   <a href="{{url('/')}}/banner/{{$value->id_banner}}" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                                   <button class="btn btn-danger eliminarRegistro" pagina="banner" method="DELETE" action="{{url('/')}}/banner/{{$value->id_banner}}">
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
           <div class="card-footer">

               <button class="btn btn-success float-right" data-toggle="modal" data-target="#crearBanner">Añadir foto al banner</button>

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

<!-- Modal para añadir imagen al banner -->
<div class="modal" id="crearBanner">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST" action="{{ url('/') }}/banner" enctype="multipart/form-data">
                @csrf

                <div class="modal-header bg-info">

                    <h3 class="card-title">Agregar banner</h3>

                    <div class="card-tools">

                        <button type="button" class="btn btn-tool close" data-dismiss="modal">

                            <i class="fas fa-times"></i></button>

                    </div>

                </div>

                <div class="modal-body">
                    <!-- Modal para crear un nuevo banner-->

                    {{-- Titulo del banner --}}
                    <div class="form-group">
                        <label for="">Titulo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <i class="fas fa-stream"></i>
                            </div>
                            <input id="titulo_banner" type="text" class="form-control @error('titulo_banner') is-invalid @enderror" name="titulo_banner" value="{{ old('titulo_banner') }}" autocomplete="titulo_banner" placeholder="Ingresa un nombre para el banner" autofocus>
                                @error('titulo_banner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    {{-- Descripcion banner --}}
                    <div class="form-group">
                        <label for="">Descripción:</label>
                        <div class="input-group mb-3">
                            <textarea name="descripcion_banner" id="" cols="80" rows="10" placeholder="Ingresa una descripcion para el banner">{{old('descripcion_banner')}}</textarea>
                                @error('descripcion_banner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    {{-- Pagina Banner --}}
                    <div class="form-group">
                        <label for="">Pagina:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <i class="fas fa-pager"></i>
                            </div>
                            <input id="pagina_banner" type="text" class="form-control @error('pagina_banner') is-invalid @enderror" name="pagina_banner" placeholder="Ingresa la pagina donde va a estar el banner (interno o inicial)" required autocomplete="pagina_banner">
                                @error('pagina_banner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    {{-- Portada articulo --}}
                    <hr class="pb-2">
                    <div class="form-group my-2 text-center">

                        <div class="btn btn-default btn-file">

                            <i class="fas fa-paperclip"></i> Adjuntar imagen para el banner

                            <input type="file" name="img_banner" required>

                        </div>

                        <br>

                        <img class="previsualizarImg_img_banner img-fluid py-2">

                        <p class="help-block small">Dimensiones: 680px * 400px | Peso Max. 2MB | Formato: JPG o PNG</p>

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

{{-- Modal para editar el banenr --}}
@if(isset($status))
    @if($status == 200)
        @foreach($editarBanner as $banner)
            <div class="modal" id="editarBanner">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="{{ url('/') }}/banner/{{$banner->id_banner}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="modal-header bg-info">

                                <h3 class="card-title">Agregar banner</h3>

                                <div class="card-tools">

                                    <button type="button" class="btn btn-tool close" data-dismiss="modal">

                                        <i class="fas fa-times"></i></button>

                                </div>

                            </div>

                            <div class="modal-body">
                                <!-- Modal para crear un nuevo banner-->

                                {{-- Titulo del banner --}}
                                <div class="form-group">
                                    <label for="">Titulo:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append input-group-text">
                                            <i class="fas fa-stream"></i>
                                        </div>
                                        <input id="titulo_banner" type="text" class="form-control @error('titulo_banner') is-invalid @enderror" name="titulo_banner" value="{{ old('titulo_banner', $banner->titulo_banner) }}" autocomplete="titulo_banner" placeholder="Ingresa un nombre para el banner" autofocus>
                                        @error('titulo_banner')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Descripcion banner --}}
                                <div class="form-group">
                                    <label for="">Descripción:</label>
                                    <div class="input-group mb-3">
                                        <textarea name="descripcion_banner" id="" cols="80" rows="10" placeholder="Ingresa una descripcion para el banner">{{old('descripcion_banner', $banner->descripcion_banner)}}</textarea>
                                        @error('descripcion_banner')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pagina Banner --}}
                                <div class="form-group">
                                    <label for="">Pagina:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append input-group-text">
                                            <i class="fas fa-pager"></i>
                                        </div>
                                        <input id="pagina_banner" type="text" class="form-control @error('pagina_banner') is-invalid @enderror" value="{{old('pagina_banner', $banner->pagina_banner)}}" name="pagina_banner" placeholder="Ingresa la pagina donde va a estar el banner (interno o inicial)" required autocomplete="pagina_banner">
                                        @error('pagina_banner')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Portada articulo --}}
                                <hr class="pb-2">
                                <div class="form-group my-2 text-center">

                                    <div class="btn btn-default btn-file">

                                        <i class="fas fa-paperclip"></i> Adjuntar imagen para el banner

                                        <input type="file" name="img_banner">

                                    </div>

                                    <br>

                                    <img class="previsualizarImg_img_banner img-fluid py-2"  src="{{url('/')}}/{{$banner->img_banner}}">

                                    <input type="hidden" value="{{$banner->img_banner}}" name="imagen_actual">

                                    <p class="help-block small">Dimensiones: 680px * 400px | Peso Max. 2MB | Formato: JPG o PNG</p>

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
        <script>$('#editarBanner').modal()</script>
    @elseif($status == 404)
        @if(Session::has('error-buscando-banner'))
            <script>
                notie.alert({
                    type: 2,
                    text: 'No pudimos encontrar este banner',
                    time: 7
                })
            </script>
        @endif
    @endif
@endif

{{-- Alertas --}}

@if(Session::has('creado-banner'))
    <script>
        notie.alert({
            type: 1,
            text: 'El banner ha sido creado exitosamente',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-crear-banner'))
    <script>
        notie.alert({
            type: 3,
            text: 'No fue posible crear el banner',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-validacion-banner'))
    <script>
        notie.alert({
            type: 2,
            text: 'Hubo un error validando los datos',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-actualizar-banner'))
    <script>
        notie.alert({
            type: 3,
            text: 'No pudimos actualizar el banner',
            time: 7
        })
    </script>
@endif

@if(Session::has('actualizado-banner'))
    <script>
        notie.alert({
            type: 1,
            text: 'El banner ha sido actualizado satisfactoriamente',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-actualizar-banner'))
    <script>
        notie.alert({
            type: 3,
            text: 'Error al intentar actualizar el banner',
            time: 7
        })
    </script>
@endif

@if(Session::has('error-eliminar-banner'))
    <script>
        notie.alert({
            type: 3,
            text: 'Error al intentar el banner',
            time: 7
        })
    </script>
@endif

@endsection
