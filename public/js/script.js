document.addEventListener('DOMContentLoaded', () => {
  const formContainer = document.getElementById('form-container');
  const mainCard = document.getElementById('main-card');
  const mainWelcomeText = document.getElementById('main-welcome-text');
  const switchToLoginLink = document.getElementById('switch-to-login');
  const switchToRegisterLink = document.getElementById('switch-to-register');
  const switchToLoginbottomLink = document.getElementById('switch-to-login-bottom');
  const switchToRegisterbottomLink = document.getElementById('switch-to-register-bottom');
  const btn_signin = document.getElementById('btn_signin');

  // ✅ Cegah form submit dan lakukan redirect manual
  if (btn_signin) {
    btn_signin.addEventListener("click", (e) => {
      e.preventDefault(); // hentikan submit bawaan form
      try {
        // Arahkan langsung ke halaman Data Karyawan
        window.location.href = "../../Views/DataKaryawan/data_karyawan.html";
      } catch (err) {
        console.error("Gagal berpindah ke halaman Data Karyawan:", err);
      }
    });
  }

  // Tinggi Card 
  const REGISTER_HEIGHT = '570px';
  const LOGIN_HEIGHT = '450px';

    formContainer.classList.add('register-state');
    mainCard.style.height = REGISTER_HEIGHT;
    mainWelcomeText.textContent = 'Welcome!';

    function switchToLogin() {
        formContainer.classList.remove('register-state');
        formContainer.classList.add('login-state');
        mainWelcomeText.textContent = 'Welcome Back!';
        mainCard.style.height = LOGIN_HEIGHT;
    }

  function switchToLoginbottom() {
    formContainer.classList.remove('register-state');
    formContainer.classList.add('login-state');
    mainWelcomeText.textContent = 'Welcome Back!';
    mainCard.style.height = LOGIN_HEIGHT;
  }

  function switchToRegister() {
    formContainer.classList.remove('login-state');
    formContainer.classList.add('register-state');
    mainWelcomeText.textContent = 'Welcome!';
    mainCard.style.height = REGISTER_HEIGHT;
  }

  function switchToRegisterbottom() {
    formContainer.classList.remove('login-state');
    formContainer.classList.add('register-state');
    mainWelcomeText.textContent = 'Welcome!';
    mainCard.style.height = REGISTER_HEIGHT;
  }

    if (switchToLoginLink) {
        switchToLoginLink.addEventListener('click', (e) => {
            e.preventDefault();
            switchToLogin();
        });
    }

  if (switchToLoginbottomLink) {
    switchToLoginbottomLink.addEventListener('click', (e) => {
      e.preventDefault();
      switchToLoginbottom();
    });
  }

  if (switchToRegisterLink) {
    switchToRegisterLink.addEventListener('click', (e) => {
      e.preventDefault();
      switchToRegister();
    });
  }

  if (switchToRegisterbottomLink) {
    switchToRegisterbottomLink.addEventListener('click', (e) => {
      e.preventDefault();
      switchToRegisterbottom();
    });
  }
});
