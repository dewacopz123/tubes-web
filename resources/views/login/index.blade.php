<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Etos Kerja</title>

  <!-- favicon -->
  <link rel="icon" type="image/jpg" href="/asset/img/logo2.jpg?v=20260521">

  <!-- CSS -->
  <link rel="stylesheet" href="/css/style.css?v=20260521">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <header class="main-header">
    <div class="logo">
      <img src="/asset/img/logo2.jpg?v=20260521" alt="DASHBOARD SEK" class="header-logo">
      DASHBOARD SEK
    </div>
    <nav class="main-nav"></nav>
  </header>

  @php $active = session('active', 'register'); @endphp
  <div class="container {{ $active }}-state" id="form-container">
    <h1 class="welcome-text" id="main-welcome-text">Welcome!</h1>
    <p class="tagline">Use these awesome forms to login or create new account in your project for free.</p>

    <div class="card" id="main-card">

      <form class="auth-form" id="register-form" action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="social-login-section top-social" id="social-login-register">
          <p>Sign Up</p>
        </div>

        <div class="input-group-label">
          <label>Name</label>
          <div class="input-field-wrapper">
            <input type="text" name="nama" placeholder="Your full name" value="{{ old('nama') }}" required>
            @error('nama')
              <div class="form-error">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="input-group-label">
          <label>Email</label>
          <div class="input-field-wrapper">
            <input type="email" name="email" placeholder="Your email address" value="{{ old('email') }}" required>
            @error('email')
              <div class="form-error">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="input-group-label">
          <label>Password</label>
          <div class="input-field-wrapper">
            <input type="password" name="password" placeholder="Your password" required>
            @error('password')
              <div class="form-error">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <button type="submit" class="btn-submit">SIGN UP</button>

        <p class="switch-text">Already have an account? <a href="#" id="switch-to-login-bottom">Login</a></p>
      </form>

      <form class="auth-form" id="login-form" action="{{ route('login.process') }}" method="POST">
        @csrf

        <p><b>Sign In</b></p>
        <div class="input-group-label">
          <label>Email</label>
          <div class="input-field-wrapper">
            <input type="email" name="email" placeholder="Your email address" value="{{ old('email') }}" required>
            @error('email')
              <div class="form-error">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="input-group-label">
          <label>Password</label>
          <div class="input-field-wrapper">
            <input type="password" name="password" placeholder="Your password" required>
            @error('password')
              <div class="form-error">{{ $message }}</div>
            @enderror
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
        </div>
      </form>
    </div>

    <div class="card-footer">
      <p>Diawali Dengan Bismillah, lalu Astagfirullah dan Akhirnya Alhamdulillah</p>
    </div>
  </div>

  <script src="/js/script.js?v=20260521"></script>

</body>

</html>