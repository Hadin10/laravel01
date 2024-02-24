<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $sum = 0; 
        @endphp
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->price }}</td>
        </tr>
        @php
            $sum += $product->price;
        @endphp
        @endforeach
    <tr>
        <td></td>
        <td style="font-weight: bold; padding-left: 10px;">Total Cost:</td>
        <td style="font-weight: bold;">{{ $sum }}</td>
    </tr>

    </tbody>
</table>

</body>
</html>
