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
          <!-- Default box -->
          <div class="card card-primary card-outline">

            <div class="card-header">

              <button class="btn btn-primary float-left">Guardar cambios</button>

              <div class="card-tools">

                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  
                  <i class="fas fa-times"></i></button>

              </div>

            </div>

            <div class="card-body">

              @foreach($blog as $element)
                
              @endforeach

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

                          <input type="text" class="form-control" name="palabras_claves" value="{{$palabras_claves}}" required>

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

                            <div class="col-lg-6">

                              <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                  <div class="input-group-text text-white" style="background: #1475E0;">

                                    <i class="fab fa-facebook-f"></i>

                                  </div>

                                </div>

                                <input type="text" class="form-control" value="https://facebook.com/">

                                <div class="input-group-prepend">

                                  <div class="input-group-text" style="background: red; color: white; cursor: pointer;">

                                    <span class="bg-danger px-2 rounded-circle">&times;</span>

                                  </div>

                                </div>

                              </div>

                            </div>

                          </div>
                          {{-- FIN ROW VISUALIZAR REDES SOCIALES --}}


                    </div>

                  </div>

                </div>

                <div class="col-lg-5">

                  <div class="card">
                    
                    <div class="card-body">
                      
                    </div>

                  </div>

                </div>

              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">

              <button class="btn btn-primary float-right">Guardar cambios</button>

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