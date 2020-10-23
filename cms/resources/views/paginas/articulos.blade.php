@extends('plantilla')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">

   <div class="container-fluid">

     <div class="row mb-2">

       <div class="col-sm-6">

        <button class="btn btn-success float-left" data-toggle="modal" data-target="#crearArticulo">Crear nuevo articulos</button>

       </div>

       <div class="col-sm-6">

         <ol class="breadcrumb float-sm-right">

         <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

           <li class="breadcrumb-item active">Articulos</li>

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

             <h3 class="card-title">Articulos</h3>

             <div class="card-tools">

               <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                 <i class="fas fa-minus"></i></button>

               <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                 
                 <i class="fas fa-times"></i></button>

             </div>

           </div>
           <div class="card-body">
            <table class="table table-bordered table-triped dt-responsive" width="100%" id="tablaArticulos">
              <thead>
                <tr>
                  <th width="10px">#</th>
                  <th>Categoria</th>
                  <th width="200px">Portada</th>
                  <th>Titulo</th>
                  <th>Descripción</th>
                  <th>Palabras claves</th>
                  <th>Ruta</th>
                  <th width="700px">Contenido</th>
                  <th>Accíones</th>
                </tr>
              </thead>
              <tbody>
            @foreach($articulos as $key => $value)
                <tr>
                  {{-- id articulo --}}
                  <td>{{$key+1}}</td>
                  {{-- Categoria --}}
                <td>{{$value->titulo_categoria}}</td>
                  {{-- Portada articulo --}}
                  <td>
                    <img src="{{url('/')}}/{{$value->portada_articulo}}" alt="" class="img-fluid">
                  </td>
                  {{-- Titulo articulo --}}
                  <td>{{$value->titulo_articulo}}</td>
                  {{-- descripcion articulo --}}
                    <td>{{$value->descripcion_articulo}}</td>
                  {{-- Palabras claves --}}
                  <td>
                    @php
                      $tags = json_decode($value->p_claves_articulo, true);

                      $palabras_claves = '<h5>';

                      foreach ($tags as $element ) {
                        $palabras_claves .= '<span class="badge badge-secondary mx-1">'.$element.'</span>';
                      }

                      $palabras_claves .= '</h5>';

                      echo $palabras_claves;
                    @endphp
                  </td>
                  {{-- ruta articulo --}}
                  <td class="validarRuta">{{$value->ruta_articulo}}</td>
                  {{-- contenido articulo --}}
                  <td>
                    <div class="card collapsed-card">
                      <div class="card-header">
                        <h3 class="card-title">Ver contenido</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        {{$value->contenido_articulo}}
                      </div>
                    </div>
                  </td>
                  {{-- Acciones articulo --}}
                  <td>
                    <div class="boton-group">

                      <a href="{{url('/')}}/articulos/{{{$value->id_articulo}}}" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
    
                      <button class="btn btn-danger  eliminarRegistro" action="{{url('/')}}/articulos/{{$value->id_articulo}}" method="DELETE" pagina="articulos">
                        @csrf 
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </div>
                  </td>
                </tr>
            @endforeach
              </tbody>
            </table>
           </div>
           <!-- /.card-body -->
           <div class="card-footer">

            <button class="btn btn-success float-right" data-toggle="modal" data-target="#crearArticulo">Crear nuevo articulo</button>

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

<!-- Modal para crear articulos -->
<div class="modal" id="crearArticulo">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form method="POST" action="{{ url('/') }}/articulos" enctype="multipart/form-data">
        @csrf

        <div class="modal-header bg-info">

          <h3 class="card-title">Crear una nuevo articulo</h3>

          <div class="card-tools">

            <button type="button" class="btn btn-tool close" data-dismiss="modal">
              
              <i class="fas fa-times"></i></button>

          </div>

        </div>

        <div class="modal-body">

            {{-- titulo categoria --}}
            <div class="input-group mb-3">
                <div class="input-group-append input-group-text">
                  <i class="fas fa-list-ul"></i>
                </div>

                <select name="id_cat" class="form-control" id="" required>
                  <option value="">Elige Categoria</option>
                  @foreach($categorias as $key => $value)
                    <option value="{{$value->id_categoria}}">{{$value->titulo_categoria}}</option>
                  @endforeach
                </select>
            </div>

            {{-- titulo articulo --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-list-ul"></i>
              </div>

              <input type="text" class="form-control" name="titulo_articulo" id="" value="{{ old('titulo_articulo') }}" required placeholder="Ingrese un titulo para el articulo">
              
            </div>

            {{-- descripcion articulo --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-pencil-alt"></i>
              </div>

              <input type="text" class="form-control" name="descripcion_articulo" id="" value="{{ old('descripcion_articulo') }}" required placeholder="Ingrese una descripción para el articulo" maxlength="220">
              
            </div>

            {{-- ruta articulo --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-link"></i>
              </div>

                  <input id="text" type="text" class="form-control inputRuta" name="ruta_articulo" value="{{ old('ruta_articulo') }}" placeholder="Ingresa la ruta para este articulo" required>

            </div>

            {{-- palabras claves articulo --}}
            <hr class="pb-2">
            <div class="input-group mb-3">
              <label for="">Palabras Claves <span class="small">(Separar por comas)</span></label>

              <input id="name" type="text" class="form-control" value="articulo" name="p_claves_articulo" data-role="tagsinput" required>

            </div>

            {{-- Portada articulo --}}
            <hr class="pb-2">
            <div class="form-group my-2 text-center">

              <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar portada del articulo

                <input type="file" name="img_articulo" required>

              </div>

              <br>

              <img class="previsualizarImg_img_articulo img-fluid py-2">

              <p class="help-block small">Dimensiones: 680px * 400px | Peso Max. 2MB | Formato: JPG o PNG</p>

            </div>

            {{-- Contenido categoria --}}
            <hr class="pb-2">
            <div class="input-group mb-3">

              <textarea name="contenido_articulo" class="form-control summernote-articulos" id="" required></textarea>

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

<!-- Modal para editar articulos -->
@if(isset($status))
  @if($status == 200)
  @foreach($articulo as $key => $value)
  <div class="modal" id="editarArticulo">

    <div class="modal-dialog modal-lg">
  
      <div class="modal-content">
  
      <form method="POST" action="{{url('/')}}/articulos/{{$value->id_articulo}}" enctype="multipart/form-data">
          @method('put')
          @csrf
  
          <div class="modal-header bg-info">
  
            <h3 class="card-title">Editar categoria</h3>
  
            <div class="card-tools">
  
              <button type="button" class="btn btn-tool close" data-dismiss="modal">
                
                <i class="fas fa-times"></i></button>
  
            </div>
  
          </div>
  
          <div class="modal-body">

            {{-- titulo categoria --}}
            <div class="input-group mb-3">
                <div class="input-group-append input-group-text">
                  <i class="fas fa-list-ul"></i>
                </div>

                <select name="id_cat" class="form-control" id="" required>
      
                  @foreach ($categorias as $key => $value2)

                    @if ($value2->id_categoria == $value->id_cat)

                      <option value="{{$value->id_cat}}">{{$value2->titulo_categoria}}</option>

                    @endif
               
                  @endforeach

                  @foreach ($categorias as $key => $value2)
            
                    @if ($value2->id_categoria != $value->id_cat)

                        <option value="{{$value2->id_categoria}}">{{$value2->titulo_categoria}}</option>

                    @endif

                  @endforeach
                </select>
            </div>

            {{-- titulo articulo --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-list-ul"></i>
              </div>

              <input type="text" class="form-control" name="titulo_articulo" id="" value="{{ $value->titulo_articulo }}" required placeholder="Ingrese un titulo para el articulo">
              
            </div>

            {{-- descripcion articulo --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-pencil-alt"></i>
              </div>

              <input type="text" class="form-control" name="descripcion_articulo" id="" value="{{ $value->descripcion_articulo }}" required placeholder="Ingrese una descripción para el articulo" maxlength="220">
              
            </div>

            {{-- ruta articulo --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-link"></i>
              </div>

                  <input id="text" type="text" class="form-control inputRuta" name="ruta_articulo" value="{{ $value->ruta_articulo }}" placeholder="Ingresa la ruta para este articulo" required>

            </div>

            {{-- palabras claves articulo --}}
            <hr class="pb-2">
            <div class="input-group mb-3">
              <label for="">Palabras Claves <span class="small">(Separar por comas)</span></label>

              @php
                      $tags = json_decode($value->p_claves_articulo, true);

                      $p_claves_editar = '';

                      foreach ($tags as $element ) {
                        $p_claves_editar .= $element.',';
                      }

                @endphp

              <input id="name" type="text" class="form-control" value="{{$p_claves_editar}}" name="p_claves_articulo" data-role="tagsinput" required>

            </div>

            {{-- Portada articulo --}}
            <hr class="pb-2">
            <div class="form-group my-2 text-center">

              <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar portada del articulo

                <input type="file" name="img_articulo">

              </div>

              <br>

              <img class="previsualizarImg_img_articulo img-fluid py-2" src="{{url('/')}}/{{$value->portada_articulo}}">

              <input type="hidden" value="{{$value->portada_articulo}}" name="imagen_actual">

              <p class="help-block small">Dimensiones: 680px * 400px | Peso Max. 2MB | Formato: JPG o PNG</p>

            </div>

            {{-- Contenido categoria --}}
            <hr class="pb-2">
            <div class="input-group mb-3">

              <textarea name="contenido_articulo" class="form-control summernote-editar-articulo" id="" required>{{$value->contenido_articulo}}</textarea>

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

  <script>$("#editarArticulo").modal()</script>

  @endif

@endif

@if(Session::has('no-validacion'))

<script>

  notie.alert({
    type: 2,
    text: '¡Hay campos no válidos en el formulario!',
    time: 7
  })

</script>

@endif

@if(Session::has('ok-creado'))

<script>

  notie.alert({
    type: 1,
    text: '¡La categoria ha sido creada exitosamente!',
    time: 7
  })

</script>

@endif

@if(Session::has('ok-editar'))

<script>

  notie.alert({
    type: 1,
    text: '¡El blog ha sido actualizado corectamente!',
    time: 7
  })

</script>

@endif

@if(Session::has('ok-eliminar'))

<script>

  notie.alert({
    type: 1,
    text: '¡El administrador ha sido eliminado correctamente!',
    time: 7
  })

</script>

@endif

@if(Session::has('no-borrar'))

<script>

  notie.alert({
    type: 2,
    text: '¡Este administrador no se puede borrar!',
    time: 7
  })

</script>

@endif

@if(Session::has('error'))

<script>

  notie.alert({
    type: 3,
    text: '¡Error al editar!',
    time: 7
  })

</script>

@endif


@endsection