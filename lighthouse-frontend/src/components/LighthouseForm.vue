<template>
  <div class="page-container">
    <!-- Navbar Section -->
    <nav class="navbar">
      <div class="navbar-left">
        <img src="@/assets/logodemo.png" alt="Logo" class="logo" />
        <span class="brand-name">Best Performance</span>
      </div>
      <button class="menu-toggle" @click="toggleMobileNav">☰</button>
      <ul :class="['nav-links', { 'mobile-nav': isMobileNavOpen }]">
        <li><a href="#articles">Articles</a></li>
        <li><a href="#packages">Packages</a></li>
        <li><a href="#tools">Free Tools</a></li>
        <li><a href="#recent">Recent</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <div class="navbar-right">
        <div class="language-selector">
          <select>
            <option value="en">English</option>
            <option value="es">Español</option>
            <option value="fr">Français</option>
          </select>
        </div>
      </div>
    </nav>

    <!-- Header Section -->
    <header class="header">
      <h1>Best Performance Checker</h1>
      <p>Performance made easy. Analyze and track effectively.</p>
    </header>

    <!-- Form Section -->
    <div class="form-container">
      <h3>Test Website Performance</h3>
      <form @submit.prevent="testPerformance">
        <input
          v-model="url"
          type="text"
          placeholder="Enter Website URL"
          class="input"
          required
        />
        <select v-model="platform" class="input">
          <option value="Desktop">Desktop</option>
          <option value="Mobile">Mobile</option>
        </select>
        <button type="submit" class="btn" :disabled="isLoading">
          <span v-if="isLoading">Running...</span>
          <span v-else>Run Test</span>
        </button>
      </form>
      <div v-if="performanceScore !== null" class="result">
        <p>Performance Score: <strong>{{ performanceScore }}</strong></p>
      </div>
    </div>

    <!-- Dashboard Section -->
    <section class="dashboard-section">
      <h2>Enjoy your Dashboard</h2>
      <h3>Everything you need in one place</h3>
      <p>
        All of the tools right at your fingertips. With one quick click, you
        can see how your site is doing. The dashboard offers instant access to
        reports, monitors, and analysis tools.
      </p>
      <img src="@/assets/post.png" alt="Dashboard" class="dashboard-image" />
    </section>
  </div>
</template>

<script>
import api from "../services/api";

export default {
  data() {
    return {
      url: "",
      platform: "Desktop",
      performanceScore: null,
      isLoading: false, // Tracks loading state
      isMobileNavOpen: false, // Controls mobile navbar visibility
    };
  },
  methods: {
    async testPerformance() {
      this.isLoading = true; // Start loader
      this.performanceScore = null; // Clear previous results
      try {
        const response = await api.post("/test-lighthouse", {
          url: this.url,
          platform: this.platform,
        });
        this.performanceScore = response.data.performance_score; // Set performance score
      } catch (error) {
        console.error("Error during API call:", error.response || error);
      } finally {
        this.isLoading = false; // Stop loader
      }
    },
    toggleMobileNav() {
      this.isMobileNavOpen = !this.isMobileNavOpen; // Toggles mobile nav visibility
    },
  },
};
</script>

<style scoped>
/* Loader Styling */
.loader {
  margin: 20px auto;
  border: 5px solid #f3f3f3; /* Light grey */
  border-top: 5px solid #4285f4; /* Blue */
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
}

/* Keyframes for Loader Animation */
@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
/* Page Container */
.page-container {
  text-align: center;
  font-family: Arial, sans-serif;
  color: #333;
  background: linear-gradient(135deg, #d4fc79, #96e6a1);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0;
  margin: 0;
}

/* Navbar Styling */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  background-color: #fff;
  border-bottom: 1px solid #ccc;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 97%;
  position: sticky;
  top: 0;
  z-index: 10;
}

.navbar-left {
  display: flex;
  align-items: center;
}

.logo {
  width: 50px;
  height: auto;
  margin-right: 10px;
}

.brand-name {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
}

.nav-links {
  display: flex;
  gap: 15px;
  list-style: none;
  margin: 0;
  padding: 0;
}

.nav-links li {
  font-size: 1rem;
}

.nav-links a {
  text-decoration: none;
  color: #333;
  transition: color 0.3s ease;
}

.nav-links a:hover {
  color: #4285f4;
}

.navbar-right {
  display: flex;
  align-items: center;
  gap: 15px;
}

.language-selector select {
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 0.9rem;
}

/* Hamburger Menu */
.menu-toggle {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #333;
  cursor: pointer;
  display: none; /* Hidden by default */
}

.mobile-nav {
  display: flex;
  flex-direction: column;
  gap: 10px;
  position: absolute;
  top: 60px;
  left: 0;
  width: 100%;
  background-color: #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 15px;
  z-index: 100;
}

.mobile-nav li {
  text-align: center;
}

/* Responsive Design for Navbar */
@media (max-width: 768px) {
  .nav-links {
    display: none; /* Hide links by default on mobile */
  }

  .menu-toggle {
    display: block; /* Show hamburger menu in mobile */
  }

  .mobile-nav {
    display: flex; /* Show sidebar when toggle is clicked */
  }

  .navbar-right {
    display: none; /* Hide right section on mobile */
  }
}

/* Header Section */
.header {
  margin-top: 20px;
  text-align: center;
}

.header h1 {
  font-size: 2rem;
  color: #333;
}

.header p {
  font-size: 1rem;
  color: #555;
  margin-top: 10px;
}

/* Form Container */
.form-container {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 90%;
  text-align: center;
  margin-top: 20px;
}

.input {
  width: 100%;
  margin-bottom: 15px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  box-sizing: border-box;
}

select.input {
  width: 100%; /* Ensure dropdown is responsive */
}

.btn {
  display: block;
  width: 100%;
  background-color: #4285f4;
  color: white;
  padding: 12px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #357ae8;
}

.result {
  margin-top: 15px;
  padding: 10px;
  background-color: #f9f9f9;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  color: #333;
}

/* Dashboard Section */
.dashboard-section {
  background: #fff;
  padding: 30px;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 20px 0;
  max-width: 800px;
  width: 90%;
}

.dashboard-section h2 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #444;
}

.dashboard-section h3 {
  font-size: 1.2rem;
  color: #666;
  margin-bottom: 10px;
}

.dashboard-section p {
  font-size: 1rem;
  color: #555;
  margin-bottom: 20px;
}

.dashboard-image {
  width: 100%;
  height: auto;
  margin-bottom: 20px;
}

.audit-btn {
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 25px;
  font-size: 1rem;
  cursor: pointer;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.audit-btn:hover {
  background-color: #45a049;
}


/* Responsive Design for Form */
@media (max-width: 768px) {
  .form-container form {
    display: flex;
    flex-direction: column; /* Stack form elements vertically */
    gap: 10px; /* Add space between form elements */
  }
}


</style>
