<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Etos Kerja</title>

  <!-- favicon -->
  <link rel="icon" type="image/jpg" href="{{ asset('asset/img/logo2.jpg') }}">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <header class="main-header">
    <div class="logo">
      <img src="{{ asset('asset/img/logo2.jpg') }}" alt="DASHBOARD SEK" class="header-logo">
      DASHBOARD SEK
    </div>
    <nav class="main-nav"></nav>
    <button class="free-download">Free Download</button>
  </header>

  <div class="container" id="form-container">
    <h1 class="welcome-text" id="main-welcome-text">Welcome!</h1>
    <p class="tagline">Use these awesome forms to login or create new account in your project for free.</p>

    <div class="card" id="main-card">

      <form class="auth-form" id="register-form">

        <div class="social-login-section top-social" id="social-login-register">
          <p>Register with</p>
          <div class="social-buttons">
            <button class="social-btn facebook"><i class="fab fa-facebook-f"></i></button>
            <button class="social-btn apple"><i class="fab fa-apple"></i></button>
            <button class="social-btn google"><i class="fab fa-google"></i></button>
          </div>
          <p class="divider">OR</p>
        </div>

        <div class="input-group-label">
          <label for="reg-name">Name</label>
          <div class="input-field-wrapper">
            <input type="text" id="reg-name" placeholder="Your full name" required>
          </div>
        </div>

        <div class="input-group-label">
          <label for="reg-email">Email</label>
          <div class="input-field-wrapper">
            <input type="email" id="reg-email" placeholder="Your email address" required>
          </div>
        </div>

        <div class="input-group-label">
          <label for="reg-password">Password</label>
          <div class="input-field-wrapper">
            <input type="password" id="reg-password" placeholder="Your password" required>
          </div>
        </div>

        <div class="remember-me">
          <label class="switch-toggle">
            <input type="checkbox" checked>
            <span class="slider round"></span>
          </label>
          <label for="remember-me-reg" class="remember-text">Remember me</label>
        </div>

        <button type="submit" class="btn-submit">SIGN UP</button>

        <p class="switch-text">Already have an account? <a href="#" id="switch-to-login-bottom">Login</a></p>
      </form>

      <form class="auth-form" id="login-form"
          action="{{ route('login.process') }}"
          method="POST">
        @csrf

        <p><b>Login with</b></p>
        <div class="input-group-label">
          <label for="login-email">Email</label>
          <div class="input-field-wrapper">
            <input type="email" id="login-email" placeholder="Your email address" required>
          </div>
        </div>

        <div class="input-group-label">
          <label for="login-password">Password</label>
          <div class="input-field-wrapper">
            <input type="password" id="login-password" placeholder="Your password" required>
          </div>
        </div>

        <div class="remember-me">
          <label class="switch-toggle">
            <input type="checkbox" checked>
            <span class="slider round"></span>
          </label>
          <label for="remember-me-login" class="remember-text">Remember me</label>
        </div>

        <button id="btn_signin" type="submit" class="btn-submit">SIGN IN</button>
      

        <p class="switch-text">Don't have an account? <a href="#" id="switch-to-register-bottom">Register</a></p>

        <div class="social-login-section bottom-social" id="social-login-login">
          <p class="divider">OR</p>
          <div class="social-buttons">
            <button class="social-btn facebook"><i class="fab fa-facebook-f"></i></button>
            <button class="social-btn apple"><i class="fab fa-apple"></i></button>
            <a href="{{ route('google.login') }}" class="social-btn google">
              <i class="fab fa-google"></i>
            </a>
          </div>
        </div>
      </form>
    </div>

    <div class="card-footer">
      <p>Diawali Dengan Bismillah, lalu Astagfirullah dan Akhirnya Alhamdulillah</p>
    </div>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>