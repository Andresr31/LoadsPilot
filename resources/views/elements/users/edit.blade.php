@extends('layouts.app')
@section('title', 'Piloto Cargues - Editar usuario')

@section('content')

    <div class="row py-4 px-4">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;">
                <i class="fa fa-pen"></i> Editar Usuario
            </h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('home') }}">
                            <i class="fa fa-clipboard-list"></i>
                            Escritorio
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-list-alt"></i>
                            Módulo Usuarios
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fa fa-pen"></i>
                            Editar Usuario
                    </li>
                </ol>
            </nav>
            <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="fullname">Nombre completo</label>

                    <div class="">
                        <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ $user->fullname }}" required autocomplete="fullname" autofocus>

                        @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Correo electrónico</label>

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 pt-3">
                    <label for="role_id" class="">Rol</label>
                    <select name="role_id" id="role_id" class="form-select form-control" aria-label="Seleccione un rol..." required>
                        <option selected>Seleccione...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password">Contraseña</label>

                    <div class="">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #2471A3"> Actualizar <i class="fa fa-save mx-2"></i></button>
                </div>

            </form>
        </div>
    </div>


@endsection
