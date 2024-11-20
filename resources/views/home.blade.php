@extends('layouts.app')
@section('title','Piloto Cargues - Home')
@section('content')

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <img class="my-2 img-top-card img-fluid" width="500px" src="{{ asset('images/elements/dashboard.svg') }}" alt="Img dahsboard">
                <div class="card-header-cargues text-center">
                    <h4>
                        <i class="fa fa-clipboard-list"></i>
                        Escritorio
                        |
                        <small>
                            <i class="fas fa-user-ninja"></i> {{Auth::user()->role->name}}
                        </small>
                    </h4>
                </div>
                <div class="card-body row">

                    <div class="col-md-4 my-4">
                        <div class="card text-center">
                            <img src="{{ asset('images/elements/bg-users.svg') }}" alt="users" width="200px" class="my-2 img-top-card">
                            <div class="card-body">
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-block" style="background-color: #2471A3">
                                    <i class="fa fa-users"></i>
                                    Módulo Usuarios
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 my-4">
                        <div class="card text-center">
                            <img src="{{ asset('images/elements/bg-products.svg') }}" alt="products" width="200px" class="my-2 img-top-card pt-2">
                            <div class="card-body">
                                <a href="{{ route('products.index') }}" class="btn btn-primary btn-block" style="background-color: #2471A3">
                                    <i class="fa fa-list-alt"></i>
                                    Módulo Productos
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 my-4">
                        <div class="card text-center">
                            <img src="{{ asset('images/elements/bg-cargues.svg') }}" alt="products" width="200px" class="my-2 img-top-card">
                            <div class="card-body">
                                <a href="{{ route('loads.index') }}" class="btn btn-primary btn-block" style="background-color: #2471A3">
                                    <i class="fa fa-tasks"></i>
                                    Módulo Cargues
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
