<script setup>
const redirectToGoogle = () => {
  // Redirect to the Laravel backend's Google login route
  window.location.href = 'http://127.0.0.1:8000/api/auth/google/redirect';
};
</script>

<template>
  <div class="login-container">
    <div class="logo">
      <!-- Replace with your logo -->
      <img src="https://via.placeholder.com/150" alt="App Logo" />
    </div>
    <h1 class="title">Welcome to My App</h1>
    <p class="subtitle">Sign in with Google to get started!</p>
    <button @click="redirectToGoogle" class="google-login-btn">
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png"
        alt="Google Logo"
        class="google-icon"
      />
      Login with Google
    </button>
  </div>
</template>

<style scoped>
/* Center and style the login container */
.login-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(135deg, #6a11cb, #2575fc);
  color: #fff;
  font-family: 'Arial', sans-serif;
  text-align: center;
  padding: 20px;
}

/* Logo styling */
.logo img {
  width: 100px;
  height: auto;
  margin-bottom: 20px;
}

/* Title styling */
.title {
  font-size: 2.5rem;
  font-weight: bold;
  margin-bottom: 10px;
}

/* Subtitle styling */
.subtitle {
  font-size: 1.2rem;
  margin-bottom: 30px;
}

/* Google login button */
.google-login-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #4285f4;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 25px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  gap: 10px;
}

.google-login-btn img.google-icon {
  width: 20px;
  height: 20px;
}

/* Button hover and focus effects */
.google-login-btn:hover {
  background-color: #357ae8;
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

.google-login-btn:focus {
  outline: none;
  border: 2px solid #fff;
}

/* Mobile responsive styling */
@media (max-width: 600px) {
  .title {
    font-size: 2rem;
  }
  .subtitle {
    font-size: 1rem;
  }
  .google-login-btn {
    padding: 10px 15px;
    font-size: 14px;
  }
}
</style>
