@extends('layouts.app')
@section('title', 'Piloto Cargues - Cargues')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;"><i class="fa fa-tasks"></i> Cargues</h1>
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
                            <i class="fa fa-tasks"></i>
                            Módulo Cargues
                    </li>

                </ol>
            </nav>

            <div class="card-body row">

                <div class="col-md-4 my-4">
                    <div class="card text-center">
                        <img src="{{ asset('images/elements/bg-cargues.svg') }}" alt="users" width="200px" class="my-2 img-top-card">
                        <div class="card-body">
                            <a href="{{ route('loads.indexLoad') }}" class="btn btn-primary btn-block" style="background-color: #2471A3">
                                <i class="fa fa-tasks"></i>
                                Gestionar Cargues
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 my-4">
                    <div class="card text-center">
                        <img src="{{ asset('images/elements/bg-products.svg') }}" alt="products" width="200px" class="my-2 img-top-card pt-2">
                        <div class="card-body">
                            <a href="{{ route('loads.product.show') }}" class="btn btn-primary btn-block" style="background-color: #2471A3">
                                <i class="fa fa-list-alt"></i>
                                Registrar Productos
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
