<div class="admin-page-header">
  <h1><i class="fas fa-file-alt"></i> Manage Posts</h1>
  <p>View, edit, or delete all questions/posts in the system.</p>
</div>

<?php if (isset($edit_question) && $edit_question): ?>
  <div class="admin-edit-form-container">
    <h2><i class="fas fa-edit"></i> Edit Post #<?= htmlspecialchars($edit_question['id']) ?></h2>
    <form action="manageposts.php" method="post" enctype="multipart/form-data" class="admin-edit-form">
      <input type="hidden" name="edit_id" value="<?= $edit_question['id'] ?>">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($edit_question['title']) ?>" required>
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" rows="4" required><?= htmlspecialchars($edit_question['content']) ?></textarea>
      </div>
      <div class="form-group">
        <label for="module_id">Module</label>
        <select name="module_id" id="module_id" required>
          <?php foreach ($modules as $module): ?>
            <option value="<?= $module['id'] ?>" <?= $module['id'] == $edit_question['module_id'] ? 'selected' : '' ?>><?= htmlspecialchars($module['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="user_id">User</label>
        <select name="user_id" id="user_id" required>
          <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>" <?= $user['id'] == $edit_question['user_id'] ? 'selected' : '' ?>><?= htmlspecialchars($user['username']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="image">Image (optional)</label>
        <input type="file" name="image" id="image" accept="image/*">
        <?php if (!empty($edit_question['image_path'])): ?>
          <div style="margin-top: 8px;">
            <img src="/CW_PHPupdate/<?= htmlspecialchars($edit_question['image_path']) ?>" alt="Current image" style="max-width: 120px; max-height: 80px; border: 1px solid #ccc;">
            <span style="font-size: 12px; color: #666;">Current image</span>
          </div>
        <?php endif; ?>
      </div>
      <div class="form-actions">
        <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Save Changes</button>
        <a href="manageposts.php" class="cancel-btn"><i class="fas fa-times"></i> Cancel</a>
      </div>
    </form>
  </div>
  <hr>
<?php endif; ?>

<div class="admin-table-container">
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>User</th>
        <th>Module</th>
        <th>Date Posted</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($questions as $question): ?>
        <tr>
          <td><?= htmlspecialchars($question['id']) ?></td>
          <td><?= htmlspecialchars($question['title']) ?></td>
          <td><?= htmlspecialchars($question['username']) ?></td>
          <td><?= htmlspecialchars($question['module_name']) ?></td>
          <td><?= htmlspecialchars($question['date_posted']) ?></td>
          <td>
            <a href="manageposts.php?edit=<?= $question['id'] ?>" class="mini-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
            <form action="manageposts.php" method="post" style="display:inline;">
              <input type="hidden" name="delete_id" value="<?= $question['id'] ?>">
              <button type="submit" class="mini-btn delete-btn" onclick="return confirm('Are you sure you want to delete this post?');"><i class="fas fa-trash"></i> Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div> 