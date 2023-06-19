@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ $product->name }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li><strong>Category: </strong>{{ $product->category->name }}</li>
                        <li><strong>Description: </strong>{!! $product->description !!}</li>
                        <li><strong>Price: </strong>{{ $product->price }}</li>
                        <li><strong>Quantity: </strong>{{ $product->quantity }}</li>
                        <li><strong>Featured: </strong>{{ $product->is_featured ? 'Yes' : 'No' }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        @foreach($product->images as $image)
                            <div class="col-md-6">
                                <img src="{{ asset('img/product/'.$image->image) }}" alt="{{ $product->name }} image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <h3>Product Info</h3>
            <div class="row">
                <div class="col-md-6">
                    <p>{!! $product->info->specifications !!}</p>
                </div>
                <div class="col-md-6">
                    <p>{{ $product->info->features }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to list</a>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

@endsection
