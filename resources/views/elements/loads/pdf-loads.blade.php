<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reporte Cargue #{{$load->id}}</title>
	<style>
		table {
			border: 1px solid #aaa;
			border-collapse: collapse;
		}
		table th, table td {
			font-family: sans-serif;
			font-size: 10px;
			border: 1px solid #ccc;
			color: #333;
			padding: 4px;
		}
		table tr:nth-child(odd) {
			background-color: #eee;
		}
		table th {
			background-color: #666;
			color: #fff;
			text-align: center;
		}
	</style>
</head>
<body>
    <h1>Reporte Cargue #{{$load->id}}</h1>
    <h4>Hora: {{$load->hour}}</h4>
    <hr>
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
</body>
</html>
