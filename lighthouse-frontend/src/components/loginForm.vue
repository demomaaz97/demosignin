<template>
  <div class="login-page">
    <div class="card">
      <div class="brand">
        <img src="@/assets/logodemo.png" alt="App Logo" class="logo" />
      </div>
      <h2 class="title">Welcome Back</h2>
      <p class="subtitle">Sign in with Google to access your account.</p>
      <button @click="redirectToGoogle" class="google-btn">
        <img
          src="@/assets/iconlogin.png"
          alt="Google Icon"
          class="google-icon"
        />
        Continue with Google
      </button>
      <div class="footer">
        <p>By continuing, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    redirectToGoogle() {
      window.location.href = 'http://127.0.0.1:8000/api/auth/google/redirect';
    },
  },
};
</script>

<style scoped>
/* Full-screen container */
.login-page {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background: linear-gradient(135deg, #ff7eb3, #6a11cb);
  font-family: 'Arial', sans-serif;
  color: #fff;
  text-align: center;
}

/* Card container */
.card {
  background: #fff;
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  width: 350px;
  max-width: 90%;
  text-align: center;
}

/* Logo styling */
.brand .logo {
  width: 80px;
  height: auto;
  margin-bottom: 20px;
}

/* Title styling */
.title {
  font-size: 1.8rem;
  color: #333;
  margin-bottom: 10px;
}

/* Subtitle styling */
.subtitle {
  font-size: 1rem;
  color: #666;
  margin-bottom: 30px;
}

/* Google button */
.google-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #4285f4;
  color: #fff;
  padding: 12px 20px;
  border: none;
  border-radius: 25px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
  gap: 10px;
  width: 100%;
}

.google-btn:hover {
  background-color: #357ae8;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.google-icon {
  width: 20px;
  height: 23px;
}

/* Footer text */
.footer {
  margin-top: 20px;
  font-size: 0.9rem;
  color: #888;
}

.footer a {
  color: #4285f4;
  text-decoration: none;
}

.footer a:hover {
  text-decoration: underline;
}

/* Mobile responsiveness */
@media (max-width: 600px) {
  .card {
    padding: 30px;
  }
  .title {
    font-size: 1.5rem;
  }
  .subtitle {
    font-size: 0.9rem;
  }
  .google-btn {
    font-size: 14px;
    padding: 10px 15px;
  }
}
</style>
