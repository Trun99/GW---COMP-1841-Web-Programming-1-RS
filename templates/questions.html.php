<div class="page-header">
  <div class="page-header-content">
    <i class="fas fa-question-circle page-icon"></i>
    <h1>Latest Questions</h1>
    <p>Explore the newest discussions in our community</p>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <div class="admin-actions">
        <a href="../admin/manageposts.php" class="admin-btn">
          <i class="fas fa-tasks"></i>
            Manage Posts
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="questions-container">
  <?php if (empty($questions)): ?>
    <div class="empty-state">
      <i class="fas fa-inbox empty-icon"></i>
      <h3>No Questions Yet</h3>
      <p>Be the first to start a discussion!</p>
      <a href="../postsmanagement/addquestion.php" class="btn-primary">
        <i class="fas fa-plus"></i>
        Ask a Question
      </a>
    </div>
  <?php else: ?>
    <div class="questions-grid">
      <?php foreach ($questions as $question): ?>
        <article class="question-card">
          <div class="question-header">
            <div class="question-meta">
              <div class="question-author">
                <i class="fas fa-user-circle"></i>
                <span><?= htmlspecialchars($question['username']) ?></span>
              </div>
              <div class="question-module">
                <i class="fas fa-book"></i>
                <span><?= htmlspecialchars($question['module_name']) ?></span>
              </div>
              <div class="question-date">
                <i class="fas fa-clock"></i>
                <span><?= date('M j, Y', strtotime($question['date_posted'])) ?></span>
              </div>
            </div>
          </div>

          <div class="question-content">
            <h3 class="question-title"><?= htmlspecialchars($question['title']) ?></h3>
            <p class="question-text"><?= nl2br(htmlspecialchars($question['content'])) ?></p>
            <?php if (!empty($question['image_path'])): ?>
              <div class="question-image">
                <img src="/CW_PHPupdate/<?= htmlspecialchars($question['image_path']) ?>" 
                     alt="Question Image" 
                     loading="lazy">
              </div>
            <?php endif; ?>
          </div>

          <div class="question-actions">
            
            <?php if (isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] === (int)$question['user_id']): ?>
              
              <a href="../postsmanagement/editquestion.php?id=<?= $question['id'] ?>" 
                 class="action-btn edit-btn">
                <i class="fas fa-edit"></i>
                Edit
              </a>
              <form action="../postsmanagement/deletequestion.php" method="post" class="delete-form">
                <input type="hidden" name="id" value="<?= $question['id'] ?>">
                <button type="submit" class="action-btn delete-btn" 
                        onclick="return confirm('Are you sure you want to delete this question?')">
                  <i class="fas fa-trash"></i>
                  Delete
                </button>
              </form>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
              
              <div class="admin-post-actions">
                <a href="../admin/manageposts.php?edit=<?= $question['id'] ?>" 
                   class="action-btn admin-edit-btn">
                  <i class="fas fa-cog"></i>
                  Admin Edit
                </a>
                <form action="../admin/manageposts.php" method="post" class="delete-form">
                  <input type="hidden" name="post_id" value="<?= $question['id'] ?>">
                  <button type="submit" name="delete_post" class="action-btn admin-delete-btn" 
                          onclick="return confirm('Admin: Are you sure you want to delete this question?')">
                    <i class="fas fa-trash-alt"></i>
                    Admin Delete
                  </button>
                </form>
              </div>
            <?php endif; ?>
            
            
            <button class="action-btn read-more-btn" onclick="openModal(<?= $question['id'] ?>)">
              <i class="fas fa-comments"></i>
              Read More & Comment
            </button>
          </div>

          
          <div id="modal-<?= $question['id'] ?>" class="post-modal">
            <div class="modal-content">
              <div class="modal-header">
                <h3><?= htmlspecialchars($question['title']) ?></h3>
                <span class="close-modal" onclick="closeModal(<?= $question['id'] ?>)">&times;</span>
              </div>
              
              <div class="modal-body">
                <div class="post-meta">
                  <span><i class="fas fa-user"></i> <?= htmlspecialchars($question['username']) ?></span>
                  <span><i class="fas fa-book"></i> <?= htmlspecialchars($question['module_name']) ?></span>
                  <span><i class="fas fa-clock"></i> <?= date('M j, Y', strtotime($question['date_posted'])) ?></span>
                </div>
                
                <div class="post-content">
                  <p><?= nl2br(htmlspecialchars($question['content'])) ?></p>
                  <?php if (!empty($question['image_path'])): ?>
                    <img src="/CW_PHPupdate/<?= htmlspecialchars($question['image_path']) ?>" alt="Post Image" class="post-image">
                  <?php endif; ?>
                </div>
                
                
                <div class="comments-section">
                  <h4><i class="fas fa-comments"></i> Comments</h4>
                  <div class="comments-list" id="comments-<?= $question['id'] ?>">
                    
                  </div>
                  
                  <?php if (isset($_SESSION['user_id'])): ?>
                    <form class="comment-form" onsubmit="addComment(event, <?= $question['id'] ?>)">
                      <textarea name="content" placeholder="Write your comment..." required></textarea>
                      <button type="submit" class="comment-submit">
                        <i class="fas fa-paper-plane"></i> Comment
                      </button>
                    </form>
                  <?php else: ?>
                    <p class="comment-login-prompt">
                      <a href="../authentication/login.php">Login</a> to comment
                    </p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<script>
function openModal(questionId) {
    const modal = document.getElementById('modal-' + questionId);
    modal.style.display = 'block';
    loadComments(questionId);
}

function closeModal(questionId) {
    const modal = document.getElementById('modal-' + questionId);
    modal.style.display = 'none';
}

function loadComments(questionId) {
    fetch('../postsmanagement/get_comments.php?question_id=' + questionId)
        .then(response => response.text())
        .then(data => {
            document.getElementById('comments-' + questionId).innerHTML = data;
        });
}

function addComment(event, questionId) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    formData.append('question_id', questionId);
    
    fetch('../postsmanagement/addcomment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            form.reset();
            loadComments(questionId);
        } else {
            alert('Error: ' + data.message);
        }
    });
}


window.onclick = function(event) {
    if (event.target.classList.contains('post-modal')) {
        event.target.style.display = 'none';
    }
}
</script>
<style>
.admin-actions {
  margin-top: 15px;
}

.admin-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: #e74c3c;
  color: white;
  text-decoration: none;
  border-radius: 6px;
  font-weight: 500;
  transition: background 0.2s;
}

.admin-btn:hover {
  background: #c0392b;
  color: white;
}

.admin-post-actions {
  display: flex;
  gap: 8px;
  margin-top: 10px;
  padding-top: 10px;
  border-top: 1px solid #e1e5e9;
}

.admin-edit-btn {
  background: #f39c12;
  color: white;
}

.admin-edit-btn:hover {
  background: #e67e22;
}

.admin-delete-btn {
  background: #e74c3c;
  color: white;
}

.admin-delete-btn:hover {
  background: #c0392b;
}

.question-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 15px;
}

.action-btn {
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: all 0.2s;
  text-decoration: none;
}

.edit-btn {
  background: #3498db;
  color: white;
}

.edit-btn:hover {
  background: #2980b9;
}

.delete-btn {
  background: #e74c3c;
  color: white;
}

.delete-btn:hover {
  background: #c0392b;
}

.comments-section {
  margin-top: 24px;
  background: #f8f9fa;
  border-radius: 8px;
  padding: 18px 18px 12px 18px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.comments-title {
  font-size: 16px;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.comments-list {
  max-height: 220px;
  overflow-y: auto;
  margin-bottom: 10px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.comment-item {
  background: #fff;
  border-radius: 6px;
  padding: 10px 14px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.03);
  border: 1px solid #e1e5e9;
}
.comment-header {
  display: flex;
  justify-content: space-between;
  font-size: 13px;
  color: #888;
  margin-bottom: 4px;
}
.comment-author {
  font-weight: 500;
  color: #2980b9;
}
.comment-date {
  color: #aaa;
  font-size: 12px;
}
.comment-content {
  font-size: 15px;
  color: #333;
  word-break: break-word;
}
.comment-empty {
  color: #aaa;
  font-style: italic;
  text-align: center;
  padding: 12px 0;
}
.comment-form {
  display: flex;
  gap: 8px;
  margin-top: 8px;
}
.comment-form textarea {
  flex: 1;
  border-radius: 6px;
  border: 1px solid #d1d5db;
  padding: 8px 10px;
  font-size: 14px;
  resize: none;
  min-height: 36px;
  max-height: 80px;
}
.comment-submit {
  background: #3498db;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 0 16px;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.2s;
  display: flex;
  align-items: center;
  gap: 5px;
}
.comment-submit:hover {
  background: #2980b9;
}
.comment-login-prompt {
  color: #888;
  font-size: 14px;
  margin-top: 8px;
  text-align: center;
}
.read-more-btn {
  background: #3498db;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 4px 14px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  margin-top: 8px;
  transition: background 0.2s;
}
.read-more-btn:hover {
  background: #2980b9;
}
.read-more-btn {
    background: #27ae60;
    color: white;
}

.read-more-btn:hover {
    background: #219a52;
}

.post-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 800px;
    max-height: 80vh;
    overflow-y: auto;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.close-modal {
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    color: #aaa;
}

.close-modal:hover {
    color: #000;
}

.post-image {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 10px 0;
}

.post-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #666;
}

.post-content {
    margin-bottom: 30px;
    line-height: 1.6;
}
</style>
