<div class="page-header">
  <div class="page-header-content">
    <i class="fas fa-tachometer-alt page-icon"></i>
    <h1>Admin Dashboard</h1>
    <p>Manage system and users</p>
  </div>
</div>

<div class="admin-dashboard">
  
  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-icon">
        <i class="fas fa-users"></i>
      </div>
      <div class="stat-content">
        <h3><?= $totalUsers ?></h3>
        <p>Total users</p>
      </div>
    </div>
    
    <div class="stat-card">
      <div class="stat-icon">
        <i class="fas fa-question-circle"></i>
      </div>
      <div class="stat-content">
        <h3><?= $totalPosts ?></h3>
        <p>Total posts</p>
      </div>
    </div>
    
    <div class="stat-card">
      <div class="stat-icon">
        <i class="fas fa-book"></i>
      </div>
      <div class="stat-content">
        <h3><?= $totalModules ?></h3>
        <p>Total modules</p>
      </div>
    </div>
  </div>

  
  <div class="admin-actions-grid">
    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-users-cog"></i>
      </div>
      <h3>Manage Users</h3>
      <p>Change role, delete users</p>
      <a href="manageusers.php" class="action-btn">
        <i class="fas fa-arrow-right"></i>
        Access
      </a>
    </div>
    
    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-tasks"></i>
      </div>
      <h3>Manage Posts</h3>
      <p>View, edit, delete all posts</p>
      <a href="manageposts.php" class="action-btn">
        <i class="fas fa-arrow-right"></i>
        Access
      </a>
    </div>
    
    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-book-open"></i>
      </div>
        <h3>Manage Modules</h3>
        <p>Add, edit, delete modules</p>
      <a href="managemodules.php" class="action-btn">
        <i class="fas fa-arrow-right"></i>
        Access
      </a>
    </div>
  </div>

  
  <div class="recent-posts-section">
    <h2><i class="fas fa-clock"></i> Recent Posts</h2>
    <?php if (empty($recentPosts)): ?>
      <div class="empty-state">
        <i class="fas fa-inbox empty-icon"></i>
        <p>No posts yet</p>
      </div>
    <?php else: ?>
      <div class="recent-posts-grid">
        <?php foreach ($recentPosts as $post): ?>
          <div class="recent-post-card">
            <div class="post-header">
              <div class="post-author">
                <i class="fas fa-user-circle"></i>
                <span><?= htmlspecialchars($post['username']) ?></span>
              </div>
              <div class="post-module">
                <i class="fas fa-book"></i>
                <span><?= htmlspecialchars($post['module_name']) ?></span>
              </div>
            </div>
            
            <h4 class="post-title"><?= htmlspecialchars($post['title']) ?></h4>
            <p class="post-excerpt"><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
            
            <div class="post-meta">
              <span class="post-date">
                <i class="fas fa-calendar"></i>
                <?= date('d/m/Y H:i', strtotime($post['date_posted'])) ?>
              </span>
              <div class="post-actions">
                <a href="manageposts.php?edit=<?= $post['id'] ?>" class="mini-btn edit-btn">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="manageposts.php" method="post" style="display: inline;">
                  <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                  <button type="submit" name="delete_post" class="mini-btn delete-btn" 
                          onclick="return confirm('Delete this post?')">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
.admin-dashboard {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-bottom: 40px;
}

.stat-card {
  background: white;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  gap: 20px;
  border: 1px solid #e1e5e9;
  transition: transform 0.2s;
}

.stat-card:hover {
  transform: translateY(-2px);
}

.stat-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: white;
}

.stat-card:nth-child(1) .stat-icon {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stat-card:nth-child(2) .stat-icon {
  background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.stat-card:nth-child(3) .stat-icon {
  background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.stat-content h3 {
  font-size: 32px;
  font-weight: 700;
  color: #2c3e50;
  margin: 0 0 5px 0;
}

.stat-content p {
  color: #666;
  margin: 0;
  font-size: 14px;
}

/* Admin Actions Grid */
.admin-actions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  margin-bottom: 40px;
}

.action-card {
  background: white;
  border-radius: 12px;
  padding: 30px;
  text-align: center;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  border: 1px solid #e1e5e9;
  transition: transform 0.2s;
}

.action-card:hover {
  transform: translateY(-2px);
}

.action-icon {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  font-size: 32px;
  color: white;
}

.action-card h3 {
  color: #2c3e50;
  margin-bottom: 10px;
  font-size: 20px;
}

.action-card p {
  color: #666;
  margin-bottom: 20px;
  line-height: 1.5;
}

.action-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  background: #3498db;
  color: white;
  text-decoration: none;
  border-radius: 6px;
  font-weight: 500;
  transition: background 0.2s;
}

.action-btn:hover {
  background: #2980b9;
  color: white;
}

/* Recent Posts Section */
.recent-posts-section {
  background: white;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  border: 1px solid #e1e5e9;
}

.recent-posts-section h2 {
  color: #2c3e50;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.recent-posts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 20px;
}

.recent-post-card {
  border: 1px solid #e1e5e9;
  border-radius: 8px;
  padding: 20px;
  transition: box-shadow 0.2s;
}

.recent-post-card:hover {
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.post-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
  font-size: 14px;
  color: #666;
}

.post-author, .post-module {
  display: flex;
  align-items: center;
  gap: 5px;
}

.post-title {
  font-size: 16px;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 10px;
  line-height: 1.4;
}

.post-excerpt {
  color: #666;
  line-height: 1.5;
  margin-bottom: 15px;
}

.post-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  color: #999;
}

.post-date {
  display: flex;
  align-items: center;
  gap: 5px;
}

.post-actions {
  display: flex;
  gap: 5px;
}

.mini-btn {
  width: 30px;
  height: 30px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  transition: all 0.2s;
}

.mini-btn.edit-btn {
  background: #3498db;
  color: white;
}

.mini-btn.edit-btn:hover {
  background: #2980b9;
}

.mini-btn.delete-btn {
  background: #e74c3c;
  color: white;
}

.mini-btn.delete-btn:hover {
  background: #c0392b;
}

.empty-state {
  text-align: center;
  padding: 40px;
  color: #666;
}

.empty-icon {
  font-size: 48px;
  margin-bottom: 20px;
  color: #ddd;
}

@media (max-width: 768px) {
  .stats-grid {
    grid-template-columns: 1fr;
  }
  
  .admin-actions-grid {
    grid-template-columns: 1fr;
  }
  
  .recent-posts-grid {
    grid-template-columns: 1fr;
  }
}
</style> 