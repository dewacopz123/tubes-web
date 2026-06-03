document.addEventListener('DOMContentLoaded', () => {
  const formContainer = document.getElementById('form-container');
  const mainCard = document.getElementById('main-card');
  const mainWelcomeText = document.getElementById('main-welcome-text');
  const switchToLoginLink = document.getElementById('switch-to-login');
  const switchToRegisterLink = document.getElementById('switch-to-register');
  const switchToLoginbottomLink = document.getElementById('switch-to-login-bottom');
  const switchToRegisterbottomLink = document.getElementById('switch-to-register-bottom');

  const registerForm = document.getElementById('register-form');
  const loginForm = document.getElementById('login-form');

  function updateCardHeight() {
    const activeForm = formContainer.classList.contains('register-state') ? registerForm : loginForm;
    const height = activeForm.scrollHeight + 60; // include card padding
    mainCard.style.height = `${height}px`;
  }

  function setWelcomeText() {
    const isRegister = formContainer.classList.contains('register-state');
    mainWelcomeText.textContent = isRegister ? 'Welcome!' : 'Welcome Back!';
  }

  function initializeState() {
    setWelcomeText();
    updateCardHeight();
  }

    function switchToLogin() {
        formContainer.classList.remove('register-state');
        formContainer.classList.add('login-state');
        setWelcomeText();
        updateCardHeight();
    }

  function switchToLoginbottom() {
    formContainer.classList.remove('register-state');
    formContainer.classList.add('login-state');
    setWelcomeText();
    updateCardHeight();
  }

  function switchToRegister() {
    formContainer.classList.remove('login-state');
    formContainer.classList.add('register-state');
    setWelcomeText();
    updateCardHeight();
  }

  function switchToRegisterbottom() {
    formContainer.classList.remove('login-state');
    formContainer.classList.add('register-state');
    setWelcomeText();
    updateCardHeight();
  }

  initializeState();

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
