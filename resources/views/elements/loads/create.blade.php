@extends('layouts.app')
@section('title', 'Piloto Cargues - Crear producto')

@section('content')

    <div class="row py-4 px-4">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;">
                <i class="fa fa-plus"></i> Agregar Producto
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
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-list-alt"></i>
                            Módulo Productos
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fa fa-plus"></i>
                            Adicionar Producto
                    </li>
                </ol>
            </nav>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="material">Material <strong>(MAT)</strong></label>

                    <div class="">
                        <input id="material" type="text" class="form-control @error('material') is-invalid @enderror" name="material" value="{{ old('material') }}" required autofocus>

                        @error('material')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="reference">Referencia <strong>(REF)</strong></label>

                    <div class="">
                        <input id="reference" type="text" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ old('reference') }}" required autocomplete="reference" autofocus>

                        @error('reference')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="lote">Lote <strong>(LOT ALPINA)</strong></label>

                    <div class="">
                        <input id="lote" type="text" class="form-control @error('lote') is-invalid @enderror" name="lote" value="{{ old('lote') }}" required autocomplete="lote" autofocus>

                        @error('lote')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date_of_manufacture">Fecha de fabricación <strong>(FF)</strong></label>

                    <div class="">
                        <input id="date_of_manufacture" type="date" class="form-control @error('date_of_manufacture') is-invalid @enderror" name="date_of_manufacture" value="{{ old('date_of_manufacture') }}" required autocomplete="date_of_manufacture" autofocus>

                        @error('date_of_manufacture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="expiration_date">Fecha de vencimiento <strong>(FV)</strong></label>

                    <div class="">
                        <input id="expiration_date" type="date" class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date" value="{{ old('expiration_date') }}" required autocomplete="expiration_date" autofocus>

                        @error('expiration_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="amount">Cantidad <strong>(CANT)</strong></label>

                    <div class="">
                        <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>

                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>



                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #2471A3"> Agregar <i class="fa fa-save mx-2"></i></button>
                </div>

            </form>
        </div>
    </div>


@endsection
