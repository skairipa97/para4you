@extends('layout')

@section('title', 'Login')
<style>
  body{
    
        background-image:url('img\\bg.png'); /* Replace 'your-image-url.jpg' with the actual URL or path of your image */
        /* background-size: cover;  */
        background-position: bottom right; /* Centers the image */
        background-repeat: no-repeat;
  }
</style>
@section('content')
<div class="form-body mt-5">
  <div class="row">
    <div class="form-holder mt-2">
      <div class="form-content">
        <div class="form-items">
          <h3>Hello Again!</h3>
          <p>Fill in the data below.</p>
          <form class="requires-validation mt-3" method="POST" action="{{ route('authenticate') }}" novalidate>
          @csrf
            <div class="col-md-12">
              <input class="form-control" type="text" name="username" placeholder="User Name" required>
              <div class="valid-feedback">Username field is valid!</div>
              <div class="invalid-feedback">Username field cannot be blank!</div>
            </div>

           

            <div class="col-md-12 mt-3">
              <input class="form-control" type="password" name="password" placeholder="Password" required>
              <div class="valid-feedback">Password field is valid!</div>
              <div class="invalid-feedback">Password field cannot be blank!</div>
            </div>

            @if ($errors->has('login_error'))
            <div class="alert alert-danger">
                {{ $errors->first('login_error') }}
            </div>
           @endif
            <div class="form-button mt-4">
              <button id="submit" type="submit" class="btn" style='background-color:pink' >Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
