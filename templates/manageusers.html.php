<div class="admin-header">
  <h1>Manage Users</h1>
  <p>View and manage user accounts in the system</p>
</div>

<div class="admin-container">
  <div class="admin-grid">
    <div class="admin-card">
      <div class="admin-card-header">
        <h2 class="admin-card-title">
          <i class="fas fa-chart-bar"></i>
          User Statistics
        </h2>
      </div>
      <div class="admin-card-content">
        <div class="admin-stats">
          <div class="stat-item">
            <span class="stat-number"><?= count($users) ?></span>
            <span class="stat-label">Total Users</span>
          </div>
          <div class="stat-item">
            <span class="stat-number"><?= count(array_filter($users, fn($u) => $u['role'] === 'admin')) ?></span>
            <span class="stat-label">Admins</span>
          </div>
          <div class="stat-item">
            <span class="stat-number"><?= count(array_filter($users, fn($u) => $u['role'] === 'user')) ?></span>
            <span class="stat-label">Regular Users</span>
          </div>
        </div>
        <div class="admin-actions">
          <a href="../corephpfiles/community.php" class="admin-btn admin-btn-primary">
            <i class="fas fa-home"></i>
            Back to Home
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="admin-card" style="margin-top: var(--spacing-6);">
    <div class="admin-card-header">
      <h2 class="admin-card-title">
        <i class="fas fa-list"></i>
        User Management
      </h2>
    </div>
    <div class="admin-card-content">
      <?php if (empty($users)): ?>
        <div class="empty-state">
          <i class="fas fa-users-slash empty-icon"></i>
          <h3>No Users Found</h3>
          <p>No users have been added yet.</p>
        </div>
      <?php else: ?>
        <div class="table-container">
          <table class="data-table">
            <thead>
              <tr>
                <th><i class="fas fa-user"></i> Username</th>
                <th><i class="fas fa-envelope"></i> Email</th>
                <th><i class="fas fa-user-tag"></i> Role</th>
                <th><i class="fas fa-cog"></i> Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td>
                    <div class="user-info">
                      <i class="fas fa-user-circle"></i>
                      <span><?= htmlspecialchars($user['username']) ?></span>
                      <?php if ($user['id'] == $_SESSION['user_id']): ?>
                        <span class="current-user-badge">(You)</span>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td><?= htmlspecialchars($user['email']) ?></td>
                  <td>
                    <?php if ($user['id'] == $_SESSION['user_id']): ?>
                      <!-- Show static role badge for current user -->
                      <span class="role-badge role-<?= strtolower($user['role']) ?>">
                        <i class="fas fa-<?= $user['role'] === 'admin' ? 'crown' : 'user' ?>"></i>
                        <?= htmlspecialchars($user['role']) ?>
                      </span>
                    <?php else: ?>
                      <!-- Show editable dropdown for other users -->
                      <form action="" method="post" class="role-form" style="display: inline;">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <select name="new_role" onchange="this.form.submit()" class="role-select">
                          <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                          <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                      </form>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                      <form action="" method="post" class="delete-form">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <button type="submit" 
                                name="delete" 
                                class="action-btn delete-btn"
                                onclick="return confirm('Are you sure you want to delete user <?= htmlspecialchars($user['username']) ?>?')">
                          <i class="fas fa-trash"></i>
                          Delete
                        </button>
                      </form>
                    <?php else: ?>
                      <span class="disabled-action">Cannot delete yourself</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
