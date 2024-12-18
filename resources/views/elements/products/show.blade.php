@extends('layouts.app')
@section('title', 'Piloto Cargues - Ver Producto')

@section('content')

    <div class="row py-4 px-4">
        <div class="col-md-10 offset-md-1">
            <h1 style="color: #0146cf;">
                <i class="fa fa-search"></i> Ver Producto
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
                        <i class="fa fa-search"></i>
                            Ver Producto
                    </li>
                </ol>
            </nav>
            <div>

                <div class="mb-3">
                    <label for="material">Material <strong>(MAT)</strong></label>

                    <div class="">
                        <input id="material" type="text" class="form-control" name="material" value="{{ $product->material }}" disabled>

                    </div>
                </div>

                <div class="mb-3">
                    <label for="reference">Referencia <strong>(REF)</strong></label>

                    <div class="">
                        <input id="reference" type="text" class="form-control" name="reference" value="{{ $product->reference}}" disabled>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="lote">Lote <strong>(LOT ALPINA)</strong></label>

                    <div class="">
                        <input id="lote" type="text" class="form-control" name="lote" value="{{ $product->lote }}" disabled>
                    </div>
                </div>

                @if ($product->date_of_manufacture)
                <div class="mb-3">
                    <label for="date_of_manufacture">Fecha de fabricación <strong>(FF)</strong></label>

                    <div class="">
                        <input id="date_of_manufacture" type="text" class="form-control" name="date_of_manufacture" value="{{ $product->date_of_manufacture }}" disabled>
                    </div>
                </div>
                @endif


                @if ($product->expiration_date)
                <div class="mb-3">
                    <label for="expiration_date">Fecha de vencimiento <strong>(FV)</strong></label>

                    <div class="">
                        <input id="expiration_date" type="text" class="form-control" name="expiration_date" value="{{ $product->expiration_date }}" disabled>
                    </div>
                </div>
                @endif


                @if ($product->amount)
                <div class="mb-3">
                    <label for="amount">Cantidad (Kg) <strong>(CANT)</strong></label>

                    <div class="">
                        <input id="amount" type="text" class="form-control" name="amount" value="{{$product->amount }}" disabled>
                    </div>
                </div>
                @endif

                @if ($product->lote_provider)
                <div class="mb-3">
                    <label for="lote_provider">Lote proveedor <strong>(LOT PROVEE)</strong> </label>

                    <div class="">
                        <input id="lote_provider" type="text" class="form-control" name="lote_provider" value="{{$product->lote_provider }}" disabled>
                    </div>
                </div>
                @endif

                @if ($product->responsible)
                <div class="mb-3">
                    <label for="responsible">Responsable <strong>(RESP)</strong> </label>

                    <div class="">
                        <input id="responsible" type="text" class="form-control" name="responsible" value="{{$product->responsible }}" disabled>
                    </div>
                </div>
                @endif


                <div class="mb-3">
                    <label for="qr">QR</label>
                    <div class="text-center my-3">
                        <img id="qr" src="{{ asset($product->qr_url) }}" alt="no-qr" class="img-thumbnail" id="preview" width="220px">
                    </div>

                </div>


                <div class="d-grid gap-2 mb-3">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-block" style="background-color: #2471A3"><i class="fa fa-arrow-left mx-2"></i> Volver </a>
                </div>

            </form>
        </div>
    </div>


@endsection
