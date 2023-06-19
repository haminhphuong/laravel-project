@extends('admin.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Create Product</h1>

                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach ($categories as $id=>$name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                        <script>CKEDITOR.replace('description');</script>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" step="1">
                    </div>

                    <div class="form-group">
                        <label for="special_price">Special Price</label>
                        <input type="number" name="special_price" id="special_price" class="form-control" step="1">
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="0">
                    </div>

                    <div class="form-group">
                        <label for="is_featured">Is Featured</label>
                        <input type="checkbox" value="1" name="is_featured" id="is_featured" class="form-check-input">
                    </div>

                    <div class="form-group">
                        <label for="images">Images</label>
                        <input type="file" name="images[]" id="images" class="form-control-file" multiple>
                    </div>
                    <h3>Product Info</h3>
                    <div class="form-group">
                        <label for="specifications">Specifications</label>
                        <textarea name="specifications" class="form-control" id="specifications"></textarea>
                        <script>CKEDITOR.replace('specifications');</script>
                    </div>
                    <div class="form-group">
                        <label for="features">Features</label>
                        <textarea name="features" class="form-control" id="features"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="size">{{__('Choose Size')}}</label>
                        <select name="size" id="size" class="form-control" required>
                            @foreach ($sizes as $key=>$size)
                                <option value="{{ $key }}">{{ $size }}</option>
                            @endforeach
                        </select>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color">{{__('Choose Color')}}</label>
                        <select name="color" id="color" class="form-control" required>
                            @foreach ($colors as $key=>$color)
                                <option value="{{ $key }}">{{ $color }}</option>
                            @endforeach
                        </select>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">{{__('Choose Brand')}}</label>
                        <select name="brand" id="brand" class="form-control" required>
                            @foreach ($brands as $key=>$brand)
                                <option value="{{ $key }}">{{ $brand }}</option>
                            @endforeach
                        </select>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deals_of_the_week">{{__('Deals of the Week')}}</label>
                        <input type="checkbox" value="1" name="deals_of_the_week" id="deals_of_the_week" class="form-check-input">
                    </div>
                    <div class="form-group">
                        <label for="coming_soon">{{__('Coming Products')}}</label>
                        <input type="checkbox" value="1" name="coming_soon" id="coming_soon" class="form-check-input">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

            </div>
        </div>
    </div>
@endsection
