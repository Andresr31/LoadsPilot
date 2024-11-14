@extends('layouts.app')
@section('title', 'Piloto Cargues - Cargues')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;"><i class="fa fa-tasks"></i> Registrar productos - Cargue #{{$load->id}}</h1>
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
                        <a href="{{ url('loads') }}">
                            <i class="fa fa-list"></i>
                            Gargues
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('loads/product') }}">
                            <i class="fa fa-list"></i>
                            Lista cargues
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <i class="fa fa-plus"></i>
                        Registrar productoss
                </li>

                </ol>
            </nav>

            <form action="{{ route('loads.add') }}" id="formRegisterLoadProduct" method="POST">
                @csrf
                <input type="text" name="load_id" id="load_id" value="{{$load->id}}" hidden>
                <div class="mb-3">
                    <label for="tacho_id" class="col-form-label">Tacho: </label>
                    <select class="form-select" aria-label="Seleccione un tacho..." id="tacho_id" name="tacho_id" class="my-2">
                        <option selected>Seleccione un tacho</option>
                        <option value="1">Tacho #1</option>
                        <option value="2">Tacho #2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-4">
                            <input type="number" id="product_load_id" name="product_load_id" class="form-control" placeholder="ID Producto">
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button id="start_reader" class="btn btn-primary btn-carges" type="button" style="background-color: #2471A3">Scan QR</button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button id="close_reader" class="btn btn-primary btn-cargues" type="button" style="background-color: #2471A3">Cerrar Scan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div id="reader"></div>
                </div>

                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #2471A3"> Agregar producto <i class="fa fa-save mx-2"></i></button>
                </div>

            </form>
            @isset($products)
                @if (count($products) >0)

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col"># Tacho</th>
                                <th scope="col">MAT</th>
                                <th scope="col">REF</th>
                                <th scope="col">LOT</th>
                                <th scope="col">FF</th>
                                <th scope="col">FV</th>
                                <th scope="col">Agregado en:</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products->sortByDesc('id') as $product)
                                <tr>
                                    <td>{{ $product->tacho->description }}</td>
                                    <td>{{ $product->product->material }}</td>
                                    <td>{{ $product->product->reference }}</td>
                                    <td>{{ $product->product->lote }}</td>
                                    <td>{{ $product->product->date_of_manufacture }}</td>
                                    <td>{{ $product->product->expiration_date }}</td>
                                    <td>{{ explode(" ",$product->created_at)[0]}}</td>
                                    <td>
                                        <form action="{{ route('loads.deleteProductLoad',$product->id) }}" method="post" class="d-inline">
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
                        Aún no hay productos registrados en el cargue actual
                    </div>
                @endif


            @endisset
    </div>


@endsection
