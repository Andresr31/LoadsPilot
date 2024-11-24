<table>
    <thead>
        <tr>
            <th scope="col"># Tacho</th>
            <th scope="col">MAT</th>
            <th scope="col">REF</th>
            <th scope="col">LOT</th>
            <th scope="col">CANT (KG)</th>
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
