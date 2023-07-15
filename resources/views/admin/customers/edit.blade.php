@extends('admin.index')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <style>
        .form-group {
            margin-bottom: 20px;
        }
        .nice-select{
            width: 100%;
        }
        .select-scroll .list{
            height: 250px;
            overflow: auto;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h4>Edit <?= $user->name ?></h4>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="450" height="450">
        </div>
        <div class="card-body">
            <form action="{{ route('admin.customers.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="col-md-6">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="col-md-12 form-group">
                    <label for="email">Phone number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" id="phone" name="phone" placeholder="{{__('Phone number')}}" required aria-invalid="true">
                    @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label for="city">City</label>
                    <select class="country_select select-scroll" id="city" name="city">
                            <?php if(!$city): ?>
                        <option value="">{{ __('------ Please Select ------') }}</option>
                        <?php endif;?>
                        @foreach($provinces as $province)
                            <option value="{{ $province['ma']}}" {{$province['ma'] == $city ? 'selected' : ''}}>{{ $province['ten'] }}</option>
                        @endforeach
                    </select>
                    @error('city')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label for="district">District</label>
                    <select class="country_select select-scroll" id="district" name="district">
                        <option value="1">District</option>
                    </select>
                    @error('district')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label for="ward">Ward</label>
                    <select class="country_select select-scroll" id="ward" name="ward">
                        <option value="1">Ward</option>
                    </select>
                    @error('ward')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-12">
                    <label for="avatar">Avatar</label>
                    <input type="file" id="avatar" name="avatar" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" value="Update" class="btn-warning btn">
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
    <script src="{{ asset('js/gmaps.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(document).ready(function(){
            // gọi hàm xử lý khi trang được tải lần đầu
            $('#city').trigger('change');
        });
        $('#city').change(function(){
            var province_id = $(this).val();
            // var selectedOption = $(this).find('option:selected');
            // $("#city_address").val(selectedOption.text());
            $.ajax({
                url: '/api/get-districts/' + province_id,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    var districts = response.districts;
                    var districtDropdown = $('#district');
                    var list = $("#district").siblings(".nice-select.country_select").find(".list");
                    var current = $("#district").siblings(".nice-select.country_select").find(".current");
                    list.empty();
                    districtDropdown.empty(); // xóa tất cả các option cũ
                    let i = 0;
                    $.each(districts, function(key, value){
                        var selected = i == 0 ? "focus selected" : "";
                        if(i == 0) current.html(value) ;
                        districtDropdown.append('<option value="' + key + '">' + value + '</option>');
                        var html = '<li data-value="' + key + '" class="option ' + selected + '">' + value + '</li>';
                        list.append(html);
                        i++;
                    });
                    $('#district').trigger('change');
                }

            });
                <?php if($district): ?>
            setTimeout(function (){
                $('#district option').each(function (){
                    if($(this).val() === '<?= $district ?>'){
                        $(this).prop('selected',true);
                        $('#district').trigger('change');
                        let dis = $("#district").siblings(".nice-select.country_select").find('.list [data-value="<?= $district ?>"]');
                        dis.siblings(".option").removeClass('focus selected');
                        dis.addClass('focus selected');
                        $("#district").siblings(".nice-select.country_select").find(".current").html(dis.text());
                    }
                })
            },700)
            <?php endif; ?>
        });
        $('#district').on('change',function() {
            var districtId = $(this).val();

            $.ajax({
                type: 'GET',
                url: '/api/get-wards/' + districtId,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var wards = response.wards;
                    var list = $("#ward").siblings(".nice-select.country_select").find(".list");
                    var current = $("#ward").siblings(".nice-select.country_select").find(".current");
                    // Xóa danh sách xã cũ
                    $('#ward').empty();
                    list.empty();
                    let i=0;
                    $.each(wards, function(key, value) {
                        var selected = i == 0 ? "focus selected" : "";
                        if(i == 0) current.html(value) ;
                        $('#ward').append('<option value="' + key + '">' + value + '</option>');
                        var html = '<li data-value="' + key + '" class="option ' + selected + '">' + value + '</li>';
                        list.append(html);
                        i++;
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
                <?php if($ward): ?>
            setTimeout(function (){
                $('#ward option').each(function (){
                    $(this).prop('selected',true);
                    if($(this).val() === '<?= $ward ?>'){
                        let ward = $("#ward").siblings(".nice-select.country_select").find('.list [data-value="<?= $ward ?>"]');
                        ward.siblings(".option").removeClass('selected focus');
                        ward.addClass('focus selected');
                        $("#ward").siblings(".nice-select.country_select").find(".current").html(ward.text());
                    }
                })
            },700)
            <?php endif; ?>

        });
    </script>
@endsection

