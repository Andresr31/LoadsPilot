@extends('layouts.app')
@section('title', 'Piloto Cargues - Cargues')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;"><i class="fa fa-tasks"></i> Registrar productos</h1>
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
                            <i class="fa fa-tasks"></i>
                            Registrar productos
                    </li>

                </ol>
            </nav>
            @isset($loads)
                @if (count($loads) >0)

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                {{-- <th scope="col">Estado</th> --}}
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loads->sortByDesc('id') as $load)
                                @if ($load->state == 'OPEN')
                                    <tr>
                                        <td>{{ $load->id }}</td>
                                        {{-- <td> @if ($load->state == 'OPEN') <small class="badge bg-success">ABIERTO</small> @else <small class="badge bg-danger">CERRADO</small> @endif</td> --}}
                                        <td>{{ $load->date }}</td>
                                        <td>{{ $load->hour }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary px-2" href="{{route('loads.registerProduct',$load->id)}}" > <i class="fa fa-plus"></i> Seleccionar </a>

                                        </td>

                                    </tr>
                                @endif


                            @endforeach
                        </tbody>

                    </table>
                    {{ $loads->links() }}
                @else
                    <div class="alert alert-warning my-4" role="alert">
                        Aún no hay cargues registrados
                    </div>
                @endif


            @endisset

        </div>
    </div>


@endsection
