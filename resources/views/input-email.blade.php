@extends('layouts.master')
@section('content')

<div class="container">
    
    <form action="{{ route('postInputEmail') }}" method="post">
        @csrf
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Reset Password</h5>
                  <div class="form-group">
                    <label for="txtEmail" class="mb-2" >Enter your email</label>
                    <input type="text" name="txtEmail" id="txtEmail" class="form-control mb-3" placeholder="Email" value="{{ isset($request->txtEmail) ? $request->txtEmail : '' }}">
                    @if(session('message'))
                        <p class="text-danger">
                            {{ session('message') }}
                        </p>
                    @endif
                </div>
                  <button type="submit" class="btn btn-primary mt-3">Reset Password</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
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
   
</body>

</html>