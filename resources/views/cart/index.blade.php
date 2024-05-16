@extends('header.dashboard')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .quantity input {
        width: 30px;
        text-align: center;
    }

    .nut {
        background-color: rgb(20, 20, 231);
        color: white;
        border: 1px solid #ddd;
        padding: 5px 10px;

    }
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Shopping Cart</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td>{{ $id }}</td>
                            <td><img src="{{ asset('images/' . $item['image']) }}" width="50" height="50"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ $item['price'] }}</td>
                            <td>${{ $item['total_price'] }}</td>
                            <td>
                                <form action="{{ route('carts.update', ['id' => $id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Cập Nhật</button>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                </form>
                                <form action="{{ route('carts.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="phone_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa?')">Remove</button>
                                </form>
                                <!-- <span class="cart-item-quantity">{{ $cart[$id]['quantity'] }}</span> -->
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="5">Total:</th>
                        <td>${{ array_sum(array_column($cart, 'total_price')) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection