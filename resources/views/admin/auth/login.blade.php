
<link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">

<div class="panda">
    <div class="ear"></div>
    <div class="face">
        <div class="eye-shade"></div>
        <div class="eye-white">
            <div class="eye-ball"></div>
        </div>
        <div class="eye-shade rgt"></div>
        <div class="eye-white rgt">
            <div class="eye-ball"></div>
        </div>
        <div class="nose"></div>
        <div class="mouth"></div>
    </div>
    <div class="body"> </div>
    <div class="foot">
        <div class="finger"></div>
    </div>
    <div class="foot rgt">
        <div class="finger"></div>
    </div>
</div>
<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <div class="hand"></div>
    <div class="hand rgt"></div>
    <h1>Panda Login</h1>
    <div class="form-group">
        <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus required="required" class="form-control"/>
        <label class="form-label" for="email">{{__('Email')}}</label>
    </div>
    <div class="form-group">
        <input id="password" type="password" name="password" required="required" class="form-control"/>
        <label class="form-label" for="password">Password</label>
        <p class="alert">Invalid Credentials..!!</p>
        <button class="btn" type="submit">{{__('Login')}} </button>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"/>
<script>

    $('#password').focusin(function(){
        $('form').addClass('up')
    });
    $('#password').focusout(function(){
        $('form').removeClass('up')
    });

    // Panda Eye move
    $(document).on( "mousemove", function( event ) {
        var dw = $(document).width() / 15;
        var dh = $(document).height() / 15;
        var x = event.pageX/ dw;
        var y = event.pageY/ dh;
        $('.eye-ball').css({
            width : x,
            height : y
        });
    });

    // validation


    $('.btn').click(function(){
        $('form').addClass('wrong-entry');
        setTimeout(function(){
            $('form').removeClass('wrong-entry');
        },3000 );
    });
</script>
