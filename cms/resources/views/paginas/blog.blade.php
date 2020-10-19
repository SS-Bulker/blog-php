 @extends('plantilla')

 @section('content')
 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Blog</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

          <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

            <li class="breadcrumb-item active">Blog</li>

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

          @foreach($blog as $element)
                
          @endforeach

        <form action="{{url('/')}}/blog/{{$element->id}}" method="POST">

          @method('PUT')

          @csrf

          <!-- Default box -->
          <div class="card card-primary card-outline">

            <div class="card-header">

              <button type="submit" class="btn btn-primary float-left">Guardar cambios</button>

              <div class="card-tools">

                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  
                  <i class="fas fa-times"></i></button>

              </div>

            </div>

            <div class="card-body">

              <div class="row">
                
                <div class="col-lg-7">

                  <div class="card">

                    <div class="card-body">
                        {{-- DOMINIO --}}
                        <div class="input-group mb-3">

                          <div class="input-group-append">

                            <span class="input-group-text">Dominio</span>

                          </div>

                          <input type="text" class="form-control" name="dominio" value="{{$element->dominio}}" required>

                        </div>
                        {{-- SERVIDOR --}}
                        <div class="input-group mb-3">

                          <div class="input-group-append">

                            <span class="input-group-text">Servidor</span>

                          </div>

                          <input type="text" class="form-control" name="servidor" value="{{$element->servidor}}" required>

                        </div>
                        {{-- TITULO --}}
                        <div class="input-group mb-3">

                          <div class="input-group-append">

                            <span class="input-group-text">Título</span>

                          </div>

                          <input type="text" class="form-control" name="titulo" value="{{$element->titulo}}" required>

                        </div>
                        {{-- DESCRIPCION --}}
                        <div class="input-group mb-3">

                          <div class="input-group-append">

                            <span class="input-group-text">Descripción</span>

                          </div>

                          <textarea class="form-control" name="descripcion" rows="5">{{$element->descripcion}}</textarea>

                        </div>

                        <hr class="pb-2">

                        {{-- PALABRAS CLAVES --}}
                        <div class="form-group mb-3">

                          <label>Palabras claves</label>

                          @php
                            $tags = json_decode($element->palabras_claves, true);

                            $palabras_claves = '';

                            foreach ($tags as $key => $value) {
                              $palabras_claves .= $value.",";
                            }
                          @endphp

                          <input type="text" class="form-control" name="palabras_claves" value="{{$palabras_claves}}" data-role="tagsinput" required>

                        </div>

                        <hr class="pb-2">

                        {{-- REDES SOCIALES --}}
                          <label>Redes sociales</label>

                          <div class="row">

                            <div class="col-5">

                              <div class="input-group mb-3">

                                <div class="input-group-append">

                                  <span class="input-group-text">Icono</span>

                                </div>

                                <select name="form-control" id="icono-red">

                                  <option value="fab fa-facebook-f, #1475E0">Facebook</option>

                                  <option value="fab fa-instagram, #B18768">Instagram</option>

                                  <option value="fab fa-twitter, #00A6FF">Twitter</option>

                                  <option value="fab fa-youtube, #F95F62">Youtube</option>

                                  <option value="fab fa-snapchat-ghost, #FF9052">SnapChat</option>

                                  <option value="fab fa-linkedin-in, #0E76A8">Linkedin</option>

                                </select>

                              </div>

                            </div>
                            {{-- FIN 5 COL --}}

                            {{-- COL 5 URL --}}
                            <div class="col-5">

                              <div class="input-group mb-3">

                                <div class="input-group-append">

                                  <span class="input-group-text">Url</span>

                                </div>

                                <input type="text" class="form-control" id="url_red">

                              </div>

                            </div>
                            {{-- FIN 5 COL --}}
                            {{-- BOTON AGREGAR RED SOCIAL --}}
                            <div class="col-2">

                              <button type="button" class="btn btn-primary w-100 agregarRed">Agregar</button>

                            </div>
                            {{-- FIN BOTON AGREGAR RED SOCIAL FIN COL 2 --}}

                          </div>
                          {{-- FIN DEL ROW --}}

                          {{-- ROW VISUALIZAR REDES SOCIALES --}}
                          <div class="row">

                          @php
                            $redes = json_decode($element->redes_sociales, true);

                            foreach ($redes as $key => $value) {
                              
                              echo '<div class="col-lg-12">

                              <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                  <div class="input-group-text text-white" style="background:'.$value['background'].'">

                                    <i class="'.$value['icono'].'"></i>

                                  </div>

                                </div>

                                <input type="text" class="form-control" value="'.$value['url'].'">

                                <div class="input-group-prepend">

                                  <div class="input-group-text" style="background: red; color: white; cursor: pointer;">

                                    <span class="bg-danger px-2 rounded-circle">&times;</span>

                                  </div>

                                </div>

                              </div>

                            </div>';

                            }
                          @endphp

                          </div>
                          {{-- FIN ROW VISUALIZAR REDES SOCIALES --}}


                    </div>

                  </div>

                </div>

                <div class="col-lg-5">

                  <div class="card">
                    
                    <div class="card-body">
                      
                      <div class="row">

                        <div class="col-lg-12">

                          {{-- CAMBIAR LOGO --}}
                          <div class="form-group my-2 text-center">

                            <div class="btn btn-default btn-file mb-3">

                              <i class="fas fa-paperclip"></i> Adjuntar imagen de logo

                              <input type="file" class="form-control" name="logo">

                            </div>

                            <img src="{{url('/')}}/{{$element->logo}}" alt=""class="img-fluid py-2 bg-secondary">

                            <p class="help-block small mt-3">Dimensiones: 700px * 200px | Peso maximo: 2mb | Fomrato: JPG o PNG</p>

                          </div>

                          <hr class="pd-2">

                          {{-- CAMBIAR PORTADA --}}
                          <div class="form-group my-2 text-center">

                            <div class="btn btn-default btn-file mb-3">

                              <i class="fas fa-paperclip"></i> Adjuntar imagen de portada

                              <input type="file" class="form-control" name="portada">

                            </div>

                            <img src="{{url('/')}}/{{$element->portada}}" alt=""class="img-fluid py-2 bg-secondary">

                            <p class="help-block small mt-3">Dimensiones: 700px * 420px | Peso maximo: 2mb | Fomrato: JPG o PNG</p>

                          </div>

                          <hr class="pd-2">

                          {{-- CAMBIAR ICONO --}}
                          <div class="form-group my-2 text-center">

                            <div class="btn btn-default btn-file mb-3">

                              <i class="fas fa-paperclip"></i> Adjuntar imagen de icono

                              <input type="file" class="form-control" name="icono">

                            </div>

                            <br>

                            <img src="{{url('/')}}/{{$element->icono}}" alt=""class="img-fluid py-2 rounded-circle">

                            <p class="help-block small mt-3">Dimensiones: 150px * 150px | Peso maximo: 2mb | Fomrato: JPG o PNG</p>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="col-lg-6">
                  {{-- SOBRE MI --}}
                  <div class="card">
                    
                    <div class="card-body">

                      <label for="">Sobre mi <span class="small">(Intro)</span></label>

                    <textarea class="form-control summernote-sm" name="sobre_mi" id=""  rows="10">{{$element->sobre_mi}}</textarea>

                    </div>

                  </div>

                </div>

                <div class="col-lg-6">
                  {{-- SOBRE MI COMPLETO --}}
                  <div class="card">
                    
                    <div class="card-body">

                      <label for="">Sobre mi completo <span class="small">(Completo)</span></label>


                      <textarea class="form-control summernote-smc" name="sobre_mi_completo" id="" rows="10">{{$element->sobre_mi_completo}}</textarea>

                    </div>

                  </div>

                </div>

              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">

              <button type="submit" class="btn btn-primary float-right">Guardar cambios</button>

            </div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
          </form>

        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@if(Session::has('no-validacion'))

<script>

  notie.alert({
    type: 2,
    text: '¡Hay campos no válidos en el formulario!',
    time: 7
  })

</script>

@endif

@if(Session::has('ok-editado'))

<script>

  notie.alert({
    type: 1,
    text: '¡El blog ha sido actualizado corectamente!',
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