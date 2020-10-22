@extends('plantilla')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">

   <div class="container-fluid">

     <div class="row mb-2">

       <div class="col-sm-6">

        <button class="btn btn-success float-left" data-toggle="modal" data-target="#crearCategorias">Crear nueva categoria</button>

       </div>

       <div class="col-sm-6">

         <ol class="breadcrumb float-sm-right">

         <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

           <li class="breadcrumb-item active">Categorias</li>

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

             <h3 class="card-title">Categorias</h3>

             <div class="card-tools">

               <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                 <i class="fas fa-minus"></i></button>

               <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                 
                 <i class="fas fa-times"></i></button>

             </div>

           </div>

           <div class="card-body">

            <table class="table table-bordered table-triped dt-responsive" width="100%" id="tablaCategorias">

              <thead>

                <tr>
                  <th>#</th>
                  <th>Titulo categoria</th>
                  <th>Descripción categoria</th>
                  <th>Palabras claves</th>
                  <th>Ruta categoria</th>
                  <th width="200px">Foto</th>
                  <th>Accíones</th>
                </tr>

              </thead>
              <tbody>
                @foreach($categorias as $key => $value)
                <tr>
                  <td>{{($key+1)}}</td>
                  {{-- Titulo categoria --}}
                  <td>{{$value->titulo_categoria}}</td>
                  {{-- Descripcion categoria --}}
                  <td>{{$value->descripcion_categoria}}</td>
                  {{-- Palabras claves --}}
                  <td>
                    @php
                      $tags = json_decode($value->p_claves_categoria, true);

                      $palabras_claves = '<h5>';

                      foreach ($tags as $element ) {
                        $palabras_claves .= '<span class="badge badge-secondary mx-1">'.$element.'</span>';
                      }

                      $palabras_claves .= '</h5>';

                      echo $palabras_claves;
                    @endphp
                  </td>
                  {{-- Ruta categoria --}}
                  <td class="validarRuta">{{$value->ruta_categoria}}</td>
                  {{-- Imagen categoria --}}
                  <td>
                    <img src="{{url('/')}}/{{$value->img_categoria}}" alt="" class="img-fluid">
                  </td>
                  {{-- Acciones categoria --}}
                  <td>
                    <div class="boton-group">

                      <a href="{{url('/')}}/categorias/{{{$value->id_categoria}}}" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
    
                      <button class="btn btn-danger  eliminarRegistro" action="{{url('/')}}/categorias/{{$value->id_categoria}}" method="DELETE" pagina="categorias">
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

            <button class="btn btn-success float-right" data-toggle="modal" data-target="#crearCategorias">Crear nueva categoria</button>

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

<!-- Modal para crear categorias -->
<div class="modal" id="crearCategorias">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="POST" action="{{ url('/') }}/categorias" enctype="multipart/form-data">
        @csrf

        <div class="modal-header bg-info">

          <h3 class="card-title">Crear una nueva categoria</h3>

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

              <input id="name" type="text" class="form-control" name="titulo_categoria" value="{{ old('titulo_categoria') }}" required  placeholder="Ingresa un titulo para la categoria" autofocus>

            </div>

            {{-- descripcion categoria --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-pencil-alt"></i>
              </div>

              <input type="text" class="form-control" name="descripcion_categoria" id="" value="{{ old('descripcion_categoria') }}" required placeholder="Ingresa una descripción para esta categoria" maxlength="30">
              
            </div>

            {{-- ruta categoria --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-link"></i>
              </div>

                  <input id="text" type="text" class="form-control inputRuta" name="ruta_categoria" value="{{ old('ruta_categoria') }}" placeholder="Ingresa la ruta para esta categoria" required>

            </div>

            {{-- palabras claves categoria --}}
            <hr class="pb-2">

            <div class="input-group mb-3">
              <label for="">Palabras Claves <span class="small">(Separar por comas)</span></label>

              <input id="name" type="text" class="form-control" value="categoria" name="p_claves_categoria" data-role="tagsinput" required>

            </div>

            {{-- Foto categoria --}}
                <hr class="pb-2">

                <div class="form-group my-2 text-center">

                  <div class="btn btn-default btn-file">

                    <i class="fas fa-paperclip"></i> Adjuntar imagen de la categoria

                    <input type="file" name="img_categoria" required>

                  </div>

                  <br>

                  <img class="previsualizarImg_img_categoria img-fluid py-2">

                  <p class="help-block small">Dimensiones: 1024px * 576px | Peso Max. 2MB | Formato: JPG o PNG</p>

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

<!-- Modal para editar categorias -->
@if(isset($status))
  @if($status == 200)
  @foreach($categoria as $key2 => $value2)
  <div class="modal" id="editarCategoria">

    <div class="modal-dialog">
  
      <div class="modal-content">
  
      <form method="POST" action="{{url('/')}}/categorias/{{$value2->id_categoria}}" enctype="multipart/form-data">
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
  
                <input id="name" type="text" class="form-control" name="titulo_categoria" value="{{ $value2->titulo_categoria }}" required  placeholder="Ingresa un titulo para la categoria" autofocus>
  
              </div>
  
              {{-- descripcion categoria --}}
              <div class="input-group mb-3">
                <div class="input-group-append input-group-text">
                  <i class="fas fa-pencil-alt"></i>
                </div>
  
                <input type="text" class="form-control" name="descripcion_categoria" id="" value="{{ $value2->descripcion_categoria }}" required placeholder="Ingresa una descripción para esta categoria" maxlength="30">
                
              </div>
  
              {{-- ruta categoria --}}
              <div class="input-group mb-3">
                <div class="input-group-append input-group-text">
                  <i class="fas fa-link"></i>
                </div>
  
                    <input id="text" type="text" class="form-control inputRuta" name="ruta_categoria" value="{{ $value2->ruta_categoria }}" placeholder="Ingresa la ruta para esta categoria" required>
  
              </div>
  
              {{-- palabras claves categoria --}}
              <hr class="pb-2">
  
              <div class="input-group mb-3">
                <label for="">Palabras Claves <span class="small">(Separar por comas)</span></label>

                @php
                      $tags = json_decode($value2->p_claves_categoria, true);

                      $palabras_claves_editar = '';

                      foreach ($tags as $element ) {
                        $palabras_claves_editar .= $element.',';
                      }

                @endphp
  
                    <input id="name" type="text" class="form-control" value="{{$palabras_claves_editar}}" name="p_claves_categoria" data-role="tagsinput" required>
  
              </div>
  
              {{-- Foto categoria --}}
                  <hr class="pb-2">
  
                  <div class="form-group my-2 text-center">
  
                    <div class="btn btn-default btn-file">
  
                      <i class="fas fa-paperclip"></i> Adjuntar imagen de la categoria
  
                      <input type="file" name="img_categoria">
  
                    </div>
  
                    <br>
  
                  <img class="previsualizarImg_img_categoria img-fluid py-2" src="{{url('/')}}/{{$value2->img_categoria}}">

                  <input type="hidden" value="{{$value2->img_categoria}}" name="imagen_actual">
  
                    <p class="help-block small">Dimensiones: 1024px * 576px | Peso Max. 2MB | Formato: JPG o PNG</p>
  
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

  <script>$("#editarCategoria").modal()</script>

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