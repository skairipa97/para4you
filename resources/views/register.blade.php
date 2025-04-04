@extends('layout')

@section('title', 'Register')
<style>
  body{
    
        background-image:url('img\\bg.png'); /* Replace 'your-image-url.jpg' with the actual URL or path of your image */
        /* background-size: cover;  */
        background-position: bottom right; /* Centers the image */
        background-repeat: no-repeat;
  }
</style>
<script src="{{asset('js/form.js')}}"></script>
@section('content')
<div class="form-body mt-5">
  <div class="row">
    <div class="form-holder">
      <div class="form-content">
        <div class="form-items">
          <h3>Register Today</h3>
          <p>Fill in the data below.</p>
          <form action="{{ route('register') }}" method="POST" class="requires-validation" novalidate>
    @csrf
            <div class="col-md-12">
              <input class="form-control" type="text" name="username" placeholder="User Name" required>
              <div class="valid-feedback">Username field is valid!</div>
              <div class="invalid-feedback">Username field cannot be blank!</div>
            </div>

            <div class="col-md-12 mt-3">
              <input class="form-control" type="text" name="name" placeholder="Nom Complet" required>
              <div class="valid-feedback">Username field is valid!</div>
              <div class="invalid-feedback">Username field cannot be blank!</div>
            </div>

            
            <div class="col-md-12">
              <input class="form-control mt-3" type="email" name="email" placeholder="Addresse e-mail" required>
              <div class="valid-feedback">Email field is valid!</div>
              <div class="invalid-feedback">Email field cannot be blank!</div>
            </div>

            <div class="col-md-12 mt-3">
              <input class="form-control" type="text" name="tel" placeholder="Tel" required>
              <div class="valid-feedback">Username field is valid!</div>
              <div class="invalid-feedback">Username field cannot be blank!</div>
            </div>
            <!-- <div class="col-md-12">
              <select class="form-select mt-3" required>
                <option selected disabled value="">Position</option>
                <option value="jweb">Junior Web Developer</option>
                <option value="sweb">Senior Web Developer</option>
                <option value="pmanager">Project Manager</option>
              </select>
              <div class="valid-feedback">You selected a position!</div>
              <div class="invalid-feedback">Please select a position!</div>
            </div> -->

            <div class="col-md-12">
              <input class="form-control mt-3" type="password" name="password" placeholder="Mot de passe" required>
              <div class="valid-feedback">Password field is valid!</div>
              <div class="invalid-feedback">Password field cannot be blank!</div>
            </div>

            <div class="col-md-12">
              <input class="form-control mt-3" type="password" name="password_confirmation" placeholder="Confirmer mot de passe " required>
              <div class="valid-feedback">Password field is valid!</div>
              <div class="invalid-feedback">Password field cannot be blank!</div>
            </div>

            <div class="col-md-12 mt-3">
    <label class="mb-3 mr-1" for="gender">Gender: </label>

    <input type="radio" class="btn-check" name="gender" id="male" value="male" autocomplete="off" required>
    <label class="btn btn-sm btn-outline-secondary" for="male">Male</label>

    <input type="radio" class="btn-check" name="gender" id="female" value="female" autocomplete="off" required>
    <label class="btn btn-sm btn-outline-secondary" for="female">Female</label>

    <input type="radio" class="btn-check" name="gender" id="secret" value="secret" autocomplete="off" required>
    <label class="btn btn-sm btn-outline-secondary" for="secret">Secret</label>

    <div class="valid-feedback mv-up">You selected a gender!</div>
    <div class="invalid-feedback mv-up">Please select a gender!</div>
</div>


            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="privacyPolicy" id="invalidCheck" required>
              <label class="form-check-label"> I agree to the <a href="/privacy-policy" target="_blank">Privacy Policy</a>.</label>
              <div class="invalid-feedback">Please confirm that the entered data are all correct!</div>
            </div>
    
    
            <div class="form-button mt-3">
              <button id="submit" type="submit" class="btn" style='background-color:pink' >Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
