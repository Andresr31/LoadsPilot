@extends('layouts.app')
@section('title', 'Piloto Cargues - Ver Cargue')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;"><i class="fa fa-tasks"></i> Ver Cargue</h1>
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
                        <a href="{{ route('loads.indexLoad') }}">
                            <i class="fa fa-tasks"></i>
                            Módulo Cargues
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fa fa-search"></i>
                            Ver Cargue
                    </li>

                </ol>
            </nav>
            <form action="{{ route('loads.close') }}" method="post" class="d-inline">
                @csrf
                <input type="text" name="load_id" id="load_id" value="{{$load->id}}" hidden>
                <button type="submit" class="btn btn-primary my-3" style="background-color: #2471A3">
                    <i class="fa fa-minus-circle pr-2"></i>
                    Cerrar Cargue
                </button>
                <a href="{{ route('loads.generatePDF',$load->id) }}" class="btn btn-primary my-3" style="background-color: #2471A3">
                    <i class="fa fa-file-pdf"></i>
                    Exportar PDF
                </a>
                <a href="{{ route('loads.generateExcel',$load->id)  }}" class="btn btn-primary my-3" style="background-color: #2471A3">
					<i class="fa fa-file-excel"></i>
					Exportar Excel
				</a>
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
                                <th scope="col">CANT</th>
                                <th scope="col">FF</th>
                                <th scope="col">FV</th>
                                <th scope="col">Agregado en:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products->sortByDesc('id') as $product)
                                <tr>
                                    <td>{{ $product->tacho->description }}</td>
                                    <td>{{ $product->product->material }}</td>
                                    <td>{{ $product->product->reference }}</td>
                                    <td>{{ $product->product->lote }}</td>
                                    <td>{{ $product->product->amount }}</td>
                                    <td>{{ $product->product->date_of_manufacture }}</td>
                                    <td>{{ $product->product->expiration_date }}</td>
                                    <td>{{ explode(" ",$product->created_at)[0]}}</td>
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
    </div>

@endsection
