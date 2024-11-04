@extends('layouts.app')
@section('title', 'Piloto Cargues - Cargues')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;"><i class="fa fa-tasks"></i> Lista de Cargues</h1>
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
                            Lista de cargues
                    </li>

                </ol>
            </nav>
            <form action="{{ route('loads.store') }}" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary my-3" style="background-color: #2471A3">
                    <i class="fa fa-plus pr-2"></i>
                    Crear Cargue
                </button>
            </form>
            @isset($loads)
                @if (count($loads) >0)

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loads->sortByDesc('id') as $load)
                                <tr>
                                    <td>{{ $load->id }}</td>
                                    <td> @if ($load->state == 'OPEN') <small class="badge bg-success">ABIERTO</small> @else <small class="badge bg-danger">CERRADO</small> @endif</td>
                                    <td>{{ $load->date }}</td>
                                    <td>{{ $load->hour }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary px-2 btn-add-product @if ($load->state == 'CLOSE') disabled @endif" data-bs-toggle="modal" data-bs-target="#addProductModal" data-info="{{$load->id}}"> <i class="fa fa-plus-circle"></i> </a>
                                        <a href="{{ route('loads.show',$load->id)}}" class="btn btn-sm btn-light"> <i class="fa fa-search"></i> </a>
                                        <form action="{{ route('loads.destroy',$load) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>

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

  <!-- Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Agregar producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('loads.add') }}" method="post">
                @csrf
                <input type="text" name="load_id" id="load_id" hidden>
                <div class=" align-items-center py-2">
                    <div class="col-auto">
                      <label for="product_load_id" class="col-form-label">Producto (ID)</label>
                    </div>
                    <div class="col-auto">
                      <input type="number" id="product_load_id" name="product_load_id" class="form-control">
                    </div>

                    <div class="col-auto">
                        <label for="tacho_id" class="col-form-label">Tacho: </label>
                        <select class="form-select" aria-label="Seleccione un tacho..." id="tacho_id" name="tacho_id" class="my-2">
                            <option selected>Seleccione un tacho</option>
                            <option value="1">Tacho #1</option>
                            <option value="2">Tacho #2</option>
                        </select>
                    </div>

                </div>

                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-sm btn-primary my-2"><i class="fa fa-save mx-2"></i> Agregar</i></button>
                </div>

            </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div> --}}
      </div>
    </div>
  </div>
@endsection
