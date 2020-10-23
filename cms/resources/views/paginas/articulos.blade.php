@extends('plantilla')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">

   <div class="container-fluid">

     <div class="row mb-2">

       <div class="col-sm-6">

        <button class="btn btn-success float-left" data-toggle="modal" data-target="#crearArticulos">Crear nuevo articulos</button>

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

                      <a href="{{url('/')}}/articulos/{{{$value->id_cat}}}" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
    
                      <button class="btn btn-danger  eliminarRegistro" action="{{url('/')}}/articulos/{{$value->id_cat}}" method="DELETE" pagina="articulos">
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

            <button class="btn btn-success float-right" data-toggle="modal" data-target="#crearArticulos">Crear nuevo articulo</button>

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
<div class="modal" id="crearArticulos">

  <div class="modal-dialog">

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
  <div class="modal" id="editarArticulo">

    <div class="modal-dialog">
  
      <div class="modal-content">
  
      <form method="POST" action="{{url('/')}}/articulos/{{$value2->id_categoria}}" enctype="multipart/form-data">
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

  <script>$("#editarArticulo").modal()</script>

  @endif

@endif


@endsection