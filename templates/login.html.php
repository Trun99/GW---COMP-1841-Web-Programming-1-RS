<div class="auth-container">
  <div class="auth-card">
    <div class="auth-header">
      <i class="fas fa-sign-in-alt auth-icon"></i>
      <h2>Welcome Back</h2>
      <p>Sign in to your Student Q&A Board account</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="error-message" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form action="../authentication/login.php" method="post" class="auth-form">
      <div class="form-group">
        <label for="email">
          <i class="fas fa-envelope"></i>
          Email Address
        </label>
        <input 
          type="email" 
          name="email" 
          id="email" 
          required 
          autocomplete="email"
          placeholder="Enter your email address"
        >
      </div>

      <div class="form-group">
        <label for="password">
          <i class="fas fa-lock"></i>
          Password
        </label>
        <input 
          type="password" 
          name="password" 
          id="password" 
          required 
          autocomplete="current-password"
          placeholder="Enter your password"
        >
      </div>

      <button type="submit" class="auth-submit">
        <i class="fas fa-sign-in-alt"></i>
        Sign In
      </button>
    </form>

    <div class="auth-footer">
      <p>Don't have an account? <a href="../authentication/register.php">Sign up here</a></p>
    </div>
  </div>
</div>
