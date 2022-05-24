@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? 'Mostrar usuario' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Usuario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" onclick="history.go(-1)" > Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                        <div class="form-group">
                            <strong>Rol:</strong>
                            <?php
                                switch ($user->rols_id ) {
                                    case 1:
                                        echo 'Admin';
                                        break;
                                    case 2:
                                        echo 'Docente';
                                        break;
                                    case 3:
                                        echo 'Estudiante';
                                        break;
                                    default:
                                        echo 'Ocurrio un error al consultar el usuario, por favor actualice e intente nuevamente.';
                                        break;
                                }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
