@extends('admin.index')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="order-details">
        <div class="actions mt-2 mb-3">
            @if ($order->status === 'pending')
                <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>
                </form>
            @endif
            @if ($order->status !== 'cancelled')
                @if (!$order->is_shipped)
                <form action="{{ route('admin.orders.ship', $order->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Ship</button>
                </form>
                @else
                    <button class="btn-success">Shipped</button>
                @endif
                @if (!$order->is_invoiced)
                <form action="{{ route('admin.orders.invoice', $order->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Invoice</button>
                </form>
                @else
                    <button type="submit" class="btn-success">Invoiced</button>
                @endif
            @endif
            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
            </form>
        </div>
        <h2>Order Details</h2>
        <div class="order-info">
            <div class="info-row">
                <span class="info-label">Order ID:</span>
                <span class="info-value">{{ $order->id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Order Date:</span>
                <span class="info-value">{{ $order->created_at }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value">{{ $order->status }}</span>
            </div>
        </div>
        @if($order->address)
        <h2>Address</h2>
        <table class="address-table mt-3">
            <tr>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>City</th>
                <th>District</th>
                <th>Ward</th>
                @if($order->address->note)
                    <th>Note</th>
                @endif
            </tr>
            <tr>
                <td>{{ $order->address->full_name }}</td>
                <td>{{ $order->address->phone }}</td>
                <td>{{ $order->address->email }}</td>
                <td>{{ $order->address->address }}</td>
                <td>{{ $order->address->city }}</td>
                <td>{{ $order->address->district }}</td>
                <td>{{ $order->address->ward }}</td>
                <td>{{ $order->address->note }}</td>
            </tr>
        </table>

        @endif
        @if($order->items)
        <h2 class="mt-5 mb-3">Items</h2>
        <table class="items-table">
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            @foreach ($order->items as $item)
                <tr>
                    <td><img src="{{asset("img/product/".$item->product->images->first()->image)}}" alt="{{$item->product->name}}" width="64" height="64"></td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <th>{{__('Total Price')}}</th>
                <td>{{ $order->total_price }}</td>
            </tr>
        </table>
        @endif
    </div>
    <style>
        .address-table,.items-table {
            width: 100%;
        }

        .order-info {
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: bold;
            margin-right: 10px;
        }

        .address {
            margin-bottom: 20px;
        }

        .items {
            margin-bottom: 20px;
        }

        .item {
            margin-bottom: 10px;
        }

        .total-price {
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            background-color: #3490dc;
            color: #fff;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2779bd;
        }

    </style>

@endsection
