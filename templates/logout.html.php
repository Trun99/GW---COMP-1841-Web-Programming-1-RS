<?php if (isset($_SESSION['user_id'])): ?>
  <a href="../authentication/logout.php" class="nav-link logout-link" style="background: var(--error-50); color: var(--error-600); border: 1px solid var(--error-200);">
    <i class="fas fa-sign-out-alt"></i>
    <span>Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</span>
  </a>
<?php else: ?>
  <div class="auth-links" style="display: flex; gap: var(--spacing-2);">
    <a href="../authentication/login.php" class="nav-link" style="background: var(--primary-50); color: var(--primary-600); border: 1px solid var(--primary-200);">
      <i class="fas fa-sign-in-alt"></i>
      <span>Log In</span>
    </a>
    <a href="../authentication/register.php" class="nav-link" style="background: var(--success-50); color: var(--success-600); border: 1px solid var(--success-200);">
      <i class="fas fa-user-plus"></i>
      <span>Sign Up</span>
    </a>
  </div>
<?php endif; ?>
