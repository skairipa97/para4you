@extends('layout')

@section('title', 'Connexion - Para4You')

@section('page_styles')
<style>
  .auth-section {
    padding: 60px 0;
    background-image: url('img/bg.png');
    background-position: right bottom;
    background-repeat: no-repeat;
    background-size: auto 90%;
    min-height: 90vh;
    display: flex;
    align-items: center;
    overflow: hidden;
  }
  
  .auth-wrapper {
    max-width: 500px;
    margin: 0;
    padding: 0 20px 0 60px;
  }
  
  .auth-header {
    margin-bottom: 40px;
    border-left: 5px solid var(--primary);
    padding-left: 20px;
  }
  
  .auth-header h2 {
    color: var(--dark);
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 32px;
  }
  
  .auth-header p {
    color: #777;
    margin-bottom: 0;
    font-size: 16px;
  }
  
  .form-control {
    border-radius: 10px;
    padding: 15px 15px 15px 45px;
    border: 1px solid #e1e1e1;
    margin-bottom: 20px;
    font-size: 16px;
    transition: all 0.3s ease;
    background-color: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(5px);
  }
  
  .form-control:focus {
    box-shadow: 0 0 0 3px rgba(201, 142, 182, 0.2);
    border-color: var(--primary);
    background-color: #fff;
  }
  
  .auth-btn {
    background-color: var(--primary);
    color: white;
    border: none;
    border-radius: 30px;
    padding: 14px 30px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
    text-align: center;
    width: 100%;
    margin-top: 10px;
  }
  
  .auth-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(201, 142, 182, 0.3);
  }
  
  .auth-footer {
    margin-top: 30px;
    text-align: center;
    font-size: 16px;
    color: #777;
  }
  
  .auth-footer a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
  }
  
  .auth-footer a:hover {
    text-decoration: underline;
  }
  
  .input-wrapper {
    position: relative;
    margin-bottom: 20px;
  }
  
  .input-icon {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #aaa;
    transition: all 0.3s ease;
    font-size: 18px;
  }
  
  .form-control:focus + .input-icon {
    color: var(--primary);
  }
  
  .form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
  }
  
  .form-check-label {
    color: #555;
  }
  
  .alert-danger {
    border-radius: 10px;
    margin-bottom: 25px;
  }
  
  html, body {
    overflow-x: hidden;
  }
  
  @media (max-width: 767.98px) {
    .auth-wrapper {
      margin: 0 auto;
      padding: 0 20px;
    }
    
    .auth-section {
      background-size: 50% auto;
      background-position: right bottom;
      padding: 40px 0;
    }
  }
</style>
@endsection

@section('content')
<section class="auth-section">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="auth-wrapper" data-aos="fade-up">
          <div class="auth-header">
            <h2>Bienvenue !</h2>
            <p>Connectez-vous pour accéder à votre compte</p>
          </div>
          
          @if ($errors->has('login_error'))
          <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ $errors->first('login_error') }}
          </div>
          @endif
          
          <form method="POST" action="{{ route('authenticate') }}">
            @csrf
            
            <div class="input-wrapper">
              <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
              <i class="bi bi-person input-icon"></i>
            </div>
            
            <div class="input-wrapper">
              <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
              <i class="bi bi-lock input-icon"></i>
            </div>
            
            <div class="mb-4 form-check">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Se souvenir de moi</label>
            </div>
            
            <button type="submit" class="auth-btn">Connexion</button>
          </form>
          
          <div class="auth-footer">
            Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-none d-md-block">
        <!-- Space reserved for the background image -->
      </div>
    </div>
  </div>
</section>
@endsection
