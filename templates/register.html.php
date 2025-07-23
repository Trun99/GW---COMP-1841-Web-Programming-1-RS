<div class="auth-container">
  <div class="auth-card">
    <div class="auth-header">
      <i class="fas fa-user-plus auth-icon"></i>
      <h2>Create Account</h2>
      <p>Join the Student Q&A Board community</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="error-message" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form action="../authentication/register.php" method="post" class="auth-form">
      <div class="form-group">
        <label for="username">
          <i class="fas fa-user"></i>
          Username
        </label>
        <input 
          type="text" 
          name="username" 
          id="username" 
          required
          placeholder="Choose a username"
        >
      </div>

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
          placeholder="Create a strong password"
        >
      </div>

      <div class="form-group">
        <label for="confirm_password">
          <i class="fas fa-lock"></i>
          Confirm Password
        </label>
        <input 
          type="password" 
          name="confirm_password" 
          id="confirm_password" 
          required
          placeholder="Confirm your password"
        >
      </div>

      <button type="submit" class="auth-submit">
        <i class="fas fa-user-plus"></i>
        Create Account
      </button>
    </form>

    <div class="auth-footer">
      <p>Already have an account? <a href="../authentication/login.php">Sign in here</a></p>
    </div>
  </div>
</div>
