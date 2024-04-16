@extends('layouts.master')
@section('content')
<div class="container">
        <div id="content">

            <form action="signup" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4>Đăng kí</h4>
                        <div class="space20">&nbsp;</div>
                        @if(Session::has('success'))
                   
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                    
                     
                        @endif
                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input name="email" type="email" id="email" value="{{old('email')}}" required>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>

                        <div class="form-block">
                            <label for="fullname">Fullname*</label>
                            <input name="fullname" type="text" id="fullname"   value="{{old('fullname')}}"  required>
                            @error('fullname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-block">
                            <label for="adress">Address*</label>
                            <input name="address" type="text" id="adress"   value="{{old('address')}}" required>
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-block">
                            <label for="phone">Phone*</label>
                            <input name="phone" type="text" id="phone"  value="{{old('phone')}}" >
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                        </div>
                        <div class="form-block">
                            <label for="password">Password*</label>
                            <input name="password" type="text" id="password"  value="{{old('password')}}" required>
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-block">
                            <label for="repassword">Re password*</label>
                            <input  name="repassword" type="text" id="repassword"  value="{{old('repassword')}}" required>
                            @error('repassword')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Register</button>
                            <a class="p-2" href="{{route('getlogin')}}">Đã có tài khoản? <span class="text-primary"> Login </span></a>
                            
                        </div>
                        
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

    @endsection


    <!-- include js files -->
    <script src="assets/dest/js/jquery.js"></script>
    <script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="assets/dest/vendors/animo/Animo.js"></script>
    <script src="assets/dest/vendors/dug/dug.js"></script>
    <script src="assets/dest/js/scripts.min.js"></script>
    <!--customjs-->
    <script type="text/javascript">
        $(function() {
            // this will get the full URL at the address bar
            var url = window.location.href;

            // passes on every "a" tag
            $(".main-menu a").each(function() {
                // checks if its the same on the address bar
                if (url == (this.href)) {
                    $(this).closest("li").addClass("active");
                    $(this).parents('li').addClass('parent-active');
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            'use strict';

            // color box

            //color
            jQuery('#style-selector').animate({
                left: '-213px'
            });

            jQuery('#style-selector a.close').click(function(e) {
                e.preventDefault();
                var div = jQuery('#style-selector');
                if (div.css('left') === '-213px') {
                    jQuery('#style-selector').animate({
                        left: '0'
                    });
                    jQuery(this).removeClass('icon-angle-left');
                    jQuery(this).addClass('icon-angle-right');
                } else {
                    jQuery('#style-selector').animate({
                        left: '-213px'
                    });
                    jQuery(this).removeClass('icon-angle-right');
                    jQuery(this).addClass('icon-angle-left');
                }
            });
        });
    </script>
</body>

</html>