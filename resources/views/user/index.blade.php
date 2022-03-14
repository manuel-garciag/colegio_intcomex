@extends('layouts.app')

@section('template_title')
Usuarios
@endsection

@section('script_content')
<script src="{{ asset('js/users.js') }}" defer></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Usuarios') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear Nuevo') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->rol_name }}</td>

                                    <td>
                                        <?php
                                        if (auth()->user()->rols_id == 1) {
                                            switch ($user->rol_id) {
                                                case '2':
                                                    //Docente
                                                    echo '<a onclick="setSubjectUser(2,' . $user->id . ')" class="btn btn-warning btn-sm mb-2 "> Asignar Materia </a>';
                                                    break;
                                                case '3':
                                                    //Estudiante
                                                    echo '<a onclick="setSubjectUser(3,' . $user->id . ')" class="btn btn-warning btn-sm mb-2 "> Asignar Materia </a>';
                                                    break;
                                            }
                                        }
                                        ?>
                                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('users.show',$user->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL ASIGNAR MATERIAS -->
<div class="modal fade" id="assign_subject" tabindex="-1" aria-labelledby="assign_subjectLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assign_subjectLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id_user" id="id_user">
                    <input type="hidden" name="rol_user" id="rol_user">
                    <label for="subject">Seleccione la asignatura a asignar:</label>
                    <select name="subject" id="subject" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="saveSubject()" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL ASIGNAR MATERIAS -->

@endsection