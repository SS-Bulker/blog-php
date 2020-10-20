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

            <button class="btn btn-success float-left" data-toggle="modal" data-target="#crearAdministrador">Crear nuevo administrador</button>

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
                @if($value->foto == '')
                <td><img src="{{url('/')}}/img/administradores/admin.png" alt="" class="img-fluid rounded-circle"></td>
                @else  
                <td><img src="{{url('/')}}/{{$value->foto}}" alt="" class="img-fluid rounded-circle"></td>
                @endif
                @if($value->rol == '')
                  <td>administrador</td>
                  @else
                  <td>{{$value->rol}}</td>
                @endif
                
                <td>
                  <div class="boton-group">
                  <a href="{{url('/')}}/administradores/{{{$value->id}}}" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>
                    <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </td>
                </tr>

                @endforeach
              </tbody>

            </table>

            

           </div>
           <!-- /.card-body -->
           <div class="card-footer">

            <button class="btn btn-success float-right" data-toggle="modal" data-target="#crearAdministrador">Crear nuevo administrador</button>

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

<!-- Modal para crear administradores -->
<div class="modal" id="crearAdministrador">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="modal-header bg-info">

          <h3 class="card-title">Agregar un nuevo tercero</h3>

          <div class="card-tools">

            <button type="button" class="btn btn-tool close" data-dismiss="modal">
              
              <i class="fas fa-times"></i></button>

          </div>

        </div>

        <div class="modal-body">
          <!-- Modal para editar al usuario -->

          {{-- Nombre --}}
            <div class="input-group mb-3">
                <div class="input-group-append input-group-text">
                  <i class="fas fa-users"></i>
                </div>

                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Ingresa el nombre completo del administrador" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

            {{-- Correo --}}
            <div class="input-group mb-3">
                <div class="input-group-append input-group-text">
                  <i class="fas fa-envelope"></i>
                </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Ingresa el correo electronico del administrador" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>

            {{-- Contraseña --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-key"></i>
              </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña minimo de 8 caracteres" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            {{-- Confirmar COntraseña --}}
            <div class="input-group mb-3">
              <div class="input-group-append input-group-text">
                <i class="fas fa-key"></i>
              </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirma la contraseña para el administrador" required autocomplete="new-password">
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


<!-- Modal para editar administradores -->
@if(isset($status))

  @if($status == 200)

    @foreach($administrador as $key => $value)

      <div class="modal" id="editarAdministrador">

        <div class="modal-dialog">
      
          <div class="modal-content">
      
          <form method="POST" action="{{url('/')}}/administradores/{{$value->id}}" enctype="multipart/form-data">

              @method('PUT')
              @csrf
      
              <div class="modal-header bg-info">
      
                <h3 class="card-title">Editar tercero</h3>
      
                <div class="card-tools">
      
                  <button type="button" class="btn btn-tool close" data-dismiss="modal">
                    
                    <i class="fas fa-times"></i></button>
      
                </div>
      
              </div>
      
              <div class="modal-body">
                <!-- Modal para editar al usuario -->
      
                {{-- Nombre --}}
                  <div class="input-group mb-3">
                      <div class="input-group-append input-group-text">
                        <i class="fas fa-users"></i>
                      </div>
      
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $value->name }}" autocomplete="name" placeholder="Ingresa el nombre completo del administrador" autofocus>
      
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
      
                  {{-- Correo --}}
                  <div class="input-group mb-3">
                      <div class="input-group-append input-group-text">
                        <i class="fas fa-envelope"></i>
                      </div>
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $value->email }}" placeholder="Ingresa el correo electronico del administrador" autocomplete="email">
      
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                    </div>

                    {{-- ROL --}}
                  <div class="input-group mb-3">

                    <div class="input-group-append input-group-text">
                      <i class="fas fa-list-ul"></i>
                    </div>
                      <select name="rol" id="" class="form-control" required>

                        @if($value->rol == 'administrador' || $value->rol == '')
                          <option value="administrador">administrador</option>
                          <option value="editor">editor</option>
                          @else
                          <option value="editor">editor</option>
                          <option value="administrador">administrador</option>
                        @endif

                      </select>

                  </div>

                  {{-- Contraseña --}}
                  <div class="input-group mb-3">
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-key"></i>
                    </div>
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña minimo de 8 caracteres" autocomplete="new-password">
      
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                  </div>

                        <input type="hidden" value="{{$value->password}}" name="password_actual">
      
                  {{-- Confirmar COntraseña --}}
                  <div class="input-group mb-3">
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-key"></i>
                    </div>
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirma la contraseña para el administrador" autocomplete="new-password">
                    </div>

                  {{-- FOTO --}}
                  <hr class="pb-2">

                  <div class="form-group my-2 text-center">

                    <div class="btn btn-default btn-file">

                      <i class="fas fa-paperclip"></i> Adjuntar foto

                      <input type="file" name="foto">

                    </div>

                    <br>

                    @if($value->foto == '')
                      
                      <img src="{{url('/')}}/img/administradores/admin.png" alt="" class="previsualizarImg_foto img-fluid py-2 w-25 rounded-circle">

                      @else

                      <img src="{{url('/')}}/{{$value->foto}}" alt="" class="previsualizarImg_foto img-fluid py-2 w-25 rounded-circle">

                    @endif

                    <input type="hidden" value="{{$value->foto}}" name="imagen_actual">

                    <p class="help-block small">Dimensiones: 200px * 200px | Peso Max. 2MB | FOrmato: JPG o PNG</p>

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

    <script>

      $('#editarAdministrador').modal();

    </script>

    @else

  {{$status}}
    
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
