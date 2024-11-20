@extends('layouts.app')
@section('title', 'Piloto Cargues - Productos')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;"><i class="fa fa-list-alt"></i> Lista de Productos</h1>
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
                            <i class="fa fa-list-alt"></i>
                            Módulo productos
                    </li>

                </ol>
            </nav>
            <a href="{{ route('products.create') }}" class="btn btn-primary my-3" style="background-color: #2471A3">
                <i class="fa fa-plus pr-2"></i>
                Agregar Productos
            </a>
            @isset($products)
                @if (count($products) >0)
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Material (MAT)</th>
                                <th scope="col">Referencia (REF)</th>
                                <th scope="col">Cantidad (Kg) (CANT)</th>
                                <th scope="col">Fecha de fabricación (FF)</th>
                                <th scope="col">Fecha de vencimiento (FV)</th>
                                <th scope="col">Fecha de creación </th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->material }}</td>
                                    <td>{{ $product->reference }}</td>
                                    <td>{{ $product->amount }}</td>
                                    <td>{{ $product->date_of_manufacture }}</td>
                                    <td>{{ $product->expiration_date }}</td>
                                    <td>{{explode(" ",$product->created_at)[0] }}</td>
                                    <td>
                                        <a href="{{ route('products.show',$product->id)}}" class="btn btn-sm btn-light"> <i class="fa fa-search"></i> </a>
                                        <a href="{{ route('products.edit',$product->id)}}" class="btn btn-sm btn-light"> <i class="fa fa-pen"></i> </a>
                                        <form action="{{ route('products.destroy',$product) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{ $products->links() }}
                @else
                    <div class="alert alert-warning my-4" role="alert">
                        Aún no hay productos registrados
                    </div>
                @endif


            @endisset

        </div>
    </div>
@endsection
