@extends('admin.index')

@section('content')

    <div class="card">
        <div class="card-header">
            Edit Product
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" id="name" required>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" required>{{ $product->description }}</textarea>
                    <script>CKEDITOR.replace('description');</script>
                    @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror" id="price" step="1" required>
                    @error('price')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="special_price">Special Price</label>
                    <input type="number" name="special_price" value="{{ $product->special_price }}" class="form-control @error('special_price') is-invalid @enderror" id="special_price" step="1">
                    @error('special_price')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control @error('quantity') is-invalid @enderror" id="quantity" required>
                    @error('quantity')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control" id="category_id" required>
                        @foreach($categories as $id=>$name)
                            <option value="{{ $id }}" {{ $product->category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_featured">Featured</label>
                    <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="form-control @error('is_featured') is-invalid @enderror" id="is_featured">
                    @error('is_featured')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <h3>Product Info</h3>
                <div class="form-group">
                    <label for="specifications">Specifications</label>
                    <textarea name="specifications" class="form-control @error('specifications') is-invalid @enderror" id="specifications">{{ $product->info->specifications }}</textarea>
                    <script>CKEDITOR.replace('specifications');</script>
                    @error('specifications')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="features">Features</label>
                    <textarea name="features" class="form-control @error('features') is-invalid @enderror" id="features">{{ $product->info->features }}</textarea>
                    @error('features')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="size">{{__('Choose Size')}}</label>
                    <select name="size" id="size" class="form-control" required>
                        @foreach ($sizes as $key=>$size)
                            <option value="{{ $key }}" {{ $product->info->size == $key ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                    </select>
                </div>
                <div class="form-group">
                    <label for="color">{{__('Choose Color')}}</label>
                    <select name="color" id="color" class="form-control" required>
                        @foreach ($colors as $key=>$color)
                            <option value="{{ $key }}" {{ $product->info->color == $key ? 'selected' : '' }}>{{ $color }}</option>
                        @endforeach
                    </select>
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">{{__('Choose Brand')}}</label>
                    <select name="brand" id="brand" class="form-control" required>
                        @foreach ($brands as $key=>$brand)
                            <option value="{{ $key }}" {{ $product->info->brand == $key ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                    </select>
                </div>
                <div class="form-group">
                    <label for="deals_of_the_week">{{__('Deals of the Week')}}</label>
                    <input type="checkbox" value="1" {{ $product->info->deals_of_the_week ? 'checked' : '' }} name="deals_of_the_week" id="deals_of_the_week" class="form-check-input">
                </div>
                <div class="form-group">
                    <label for="coming_soon">{{__('Coming Products')}}</label>
                    <input type="checkbox" value="1" {{ $product->info->coming_soon ? 'checked' : '' }} name="coming_soon" id="coming_soon" class="form-check-input">
                </div>
                <hr>
                <h3>Product Images</h3>
                <div class="form-group">
                    <label>Existing Images</label>
                    <div class="row">
                        @foreach($product->images as $image)
                            <div class="col-md-4" id="image-{{ $image->id }}">
                                <div class="card mb-3">
                                    <img src="{{ asset('img/product/'.$image->image) }}" class="card-img-top" alt="{{$image->image}}">
                                    <div class="card-body">
                                        <button class="btn btn-danger btn-sm delete-image" data-id="{{ $image->id }}" data-url="{{ route('admin.products.removeImage', $image->id) }}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>New Images</label>
                    <input type="file" name="images[]" class="form-control-file" multiple>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.delete-image').click(function(e) {
                e.preventDefault();

                if (confirm('Are you sure you want to delete this image?')) {
                    var id = $(this).data('id');
                    var url = $(this).data('url');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#image-' + id).remove();
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection

