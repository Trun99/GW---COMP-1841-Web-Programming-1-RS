<div class="admin-header">
  <h1>Manage Modules</h1>
  <p>Add, view, and manage course modules in the system</p>
</div>

<div class="admin-container">
  <div class="admin-grid">
    <div class="admin-card">
      <div class="admin-card-header">
        <h2 class="admin-card-title">
          <i class="fas fa-plus-circle"></i>
          Add New Module
        </h2>
      </div>
      <div class="admin-card-content">
        <form action="" method="post" class="question-form">
          <div class="form-group">
            <label for="modulename">
              <i class="fas fa-book"></i>
              Module Name
            </label>
            <input type="text" 
                   name="modulename" 
                   id="modulename" 
                   required
                   placeholder="Enter module name">
          </div>
          
          <button type="submit" name="add" class="submit-btn">
            <i class="fas fa-plus"></i>
            Add Module
          </button>
        </form>
      </div>
    </div>

    <div class="admin-card">
      <div class="admin-card-header">
        <h2 class="admin-card-title">
          <i class="fas fa-chart-bar"></i>
          Module Statistics
        </h2>
      </div>
      <div class="admin-card-content">
        <div class="admin-stats">
          <div class="stat-item">
            <span class="stat-number"><?= count($modules) ?></span>
            <span class="stat-label">Total Modules</span>
          </div>
          <div class="stat-item">
            <span class="stat-number"><?= count($modules) > 0 ? round(count($modules) / 2) : 0 ?></span>
            <span class="stat-label">Active Modules</span>
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

  <?php if (isset($edit_module) && $edit_module): ?>
    <div class="admin-card" style="margin-bottom: var(--spacing-6);">
      <div class="admin-card-header">
        <h2 class="admin-card-title">
          <i class="fas fa-edit"></i>
          Edit Module
        </h2>
      </div>
      <div class="admin-card-content">
        <form action="" method="post" class="question-form">
          <input type="hidden" name="id" value="<?= $edit_module['id'] ?>">
          <div class="form-group">
            <label for="edit_modulename">
              <i class="fas fa-book"></i>
              Module Name
            </label>
            <input type="text" 
                   name="modulename" 
                   id="edit_modulename" 
                   value="<?= htmlspecialchars($edit_module['name']) ?>"
                   required
                   placeholder="Enter module name">
          </div>
          
          <div class="form-actions">
            <button type="submit" name="edit" class="submit-btn">
              <i class="fas fa-save"></i>
              Update Module
            </button>
            <a href="managemodules.php" class="cancel-btn">
              <i class="fas fa-times"></i>
              Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

  <div class="admin-card" style="margin-top: var(--spacing-6);">
    <div class="admin-card-header">
      <h2 class="admin-card-title">
        <i class="fas fa-list"></i>
        Existing Modules
      </h2>
    </div>
    <div class="admin-card-content">
      <?php if (empty($modules)): ?>
        <div class="empty-state">
          <i class="fas fa-book-open empty-icon"></i>
          <h3>No Modules Found</h3>
          <p>No modules have been added yet.</p>
        </div>
      <?php else: ?>
        <div class="modules-grid">
          <?php foreach ($modules as $module): ?>
            <div class="module-card">
              <div class="module-info">
                <i class="fas fa-book module-icon"></i>
                <h3><?= htmlspecialchars($module['name']) ?></h3>
              </div>
              <div class="module-actions">
                <a href="managemodules.php?edit=<?= $module['id'] ?>" 
                   class="action-btn edit-btn"
                   style="margin-right: var(--spacing-2);">
                  <i class="fas fa-edit"></i>
                  Edit
                </a>
                <form action="" method="post" class="delete-form" style="display: inline;">
                  <input type="hidden" name="id" value="<?= $module['id'] ?>">
                  <button type="submit" 
                          name="delete" 
                          class="action-btn delete-btn"
                          onclick="return confirm('Are you sure you want to delete module <?= htmlspecialchars($module['name']) ?>?')">
                    <i class="fas fa-trash"></i>
                    Delete
                  </button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
