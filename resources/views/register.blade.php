@extends('layout')

@section('title', 'Inscription - Para4You')

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
    max-width: 650px;
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
  
  .gender-group {
    margin-bottom: 30px;
  }
  
  .gender-group .form-label {
    display: block;
    margin-bottom: 15px;
    font-weight: 500;
    color: #555;
  }
  
  .gender-group .btn-outline-secondary {
    border-color: #e1e1e1;
    color: #555;
    margin-right: 10px;
    border-radius: 30px;
    padding: 10px 20px;
    transition: all 0.3s ease;
  }
  
  .gender-group .btn-check:checked + .btn-outline-secondary {
    background-color: var(--primary);
    border-color: var(--primary);
    color: white;
  }
  
  .form-check {
    margin-bottom: 20px;
  }
  
  .form-check-label {
    color: #555;
  }
  
  .form-check-label a {
    color: var(--primary);
    text-decoration: none;
  }
  
  .form-check-label a:hover {
    text-decoration: underline;
  }
  
  .form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
  }
  
  .alert-danger {
    border-radius: 10px;
    margin-bottom: 25px;
  }
  
  html, body {
    overflow-x: hidden;
  }
  
  @media (max-width: 991.98px) {
    .auth-wrapper {
      margin: 0 auto;
      padding: 0 20px;
      max-width: 100%;
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
      <div class="col-lg-9">
        <div class="auth-wrapper" data-aos="fade-up">
          <div class="auth-header">
            <h2>Créer un compte</h2>
            <p>Rejoignez-nous et profitez de tous nos produits</p>
          </div>
          
          @if ($errors->any())
          <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          
          <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="row">
              <div class="col-md-6">
                <div class="input-wrapper">
                  <input class="form-control" type="text" name="username" placeholder="Nom d'utilisateur" required>
                  <i class="bi bi-person input-icon"></i>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="input-wrapper">
                  <input class="form-control" type="text" name="name" placeholder="Nom complet" required>
                  <i class="bi bi-person-badge input-icon"></i>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="input-wrapper">
                  <input class="form-control" type="email" name="email" placeholder="Adresse e-mail" required>
                  <i class="bi bi-envelope input-icon"></i>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="input-wrapper">
                  <input class="form-control" type="text" name="tel" placeholder="Téléphone" required>
                  <i class="bi bi-telephone input-icon"></i>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="input-wrapper">
                  <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                  <i class="bi bi-lock input-icon"></i>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="input-wrapper">
                  <input class="form-control" type="password" name="password_confirmation" placeholder="Confirmer mot de passe" required>
                  <i class="bi bi-key input-icon"></i>
                </div>
              </div>
            </div>
            
            <div class="gender-group">
              <label class="form-label">Genre :</label>
              
              <div>
                <input type="radio" class="btn-check" name="gender" id="male" value="male" autocomplete="off" required>
                <label class="btn btn-outline-secondary" for="male">Homme</label>
                
                <input type="radio" class="btn-check" name="gender" id="female" value="female" autocomplete="off" required>
                <label class="btn btn-outline-secondary" for="female">Femme</label>
                
                <input type="radio" class="btn-check" name="gender" id="secret" value="secret" autocomplete="off" required>
                <label class="btn btn-outline-secondary" for="secret">Secret</label>
              </div>
            </div>
            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="privacyPolicy" id="privacyPolicy" required>
              <label class="form-check-label" for="privacyPolicy">
                J'accepte les <a href="/privacy-policy" target="_blank">conditions d'utilisation</a> et la politique de confidentialité
              </label>
            </div>
            
            <button type="submit" class="auth-btn">Créer mon compte</button>
          </form>
          
          <div class="auth-footer">
            Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 d-none d-lg-block">
        <!-- Space reserved for the background image -->
      </div>
    </div>
  </div>
</section>
@endsection
