@extends('layouts.app')
@section('title', 'Piloto Cargues - Ver usuario')

@section('content')

    <div class="row py-4 px-4">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;">
                <i class="fa fa-search"></i> Ver Usuario
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
                        <i class="fa fa-search"></i>
                            Ver Usuario
                    </li>
                </ol>
            </nav>
            <div>

                <div class="mb-3">
                    <label for="fullname">Nombre completo</label>

                    <div class="">
                        <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ $user->fullname }}" disabled>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Correo electrónico</label>

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" disabled>
                    </div>
                </div>

                <div class="mb-3 pt-3">
                    <div class="">
                        <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ $user->role->name }}" disabled>
                    </div>
                </div>


                <div class="d-grid gap-2 mb-3">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-block" style="background-color: #2471A3"><i class="fa fa-arrow-left mx-2"></i> Volver </a>
                </div>

            </form>
        </div>
    </div>


@endsection
