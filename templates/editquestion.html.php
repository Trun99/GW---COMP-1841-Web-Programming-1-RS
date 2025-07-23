<div class="page-header">
  <div class="page-header-content">
    <i class="fas fa-edit page-icon"></i>
    <h1>Edit Question</h1>
    <p>Update your question details</p>
  </div>
</div>

<div class="edit-container">
  <div class="ask-form" style="display: block; margin: 0 auto;">
    <div class="form-header">
      <h2>Edit Question</h2>
    </div>
    
    <form action="../postsmanagement/editquestion.php?id=<?= $question['id'] ?>" method="post" enctype="multipart/form-data" class="question-form">
      <div class="form-group">
        <label for="title">
          <i class="fas fa-heading"></i>
          Question Title
        </label>
        <input type="text" 
               name="title" 
               id="title" 
               value="<?= htmlspecialchars($question['title']) ?>" 
               required
               placeholder="Enter a clear, descriptive title">
      </div>

      <div class="form-group">
        <label for="content">
          <i class="fas fa-comment-alt"></i>
          Question Content
        </label>
        <textarea name="content" 
                  id="content" 
                  rows="6" 
                  required
                  placeholder="Describe your question in detail..."><?= htmlspecialchars($question['content']) ?></textarea>
      </div>

      <div class="form-group">
        <label for="image">
          <i class="fas fa-image"></i>
          Replace Image (Optional)
        </label>
        <div class="file-upload">
          <input type="file" 
                 name="image" 
                 id="image" 
                 accept="image/*"
                 onchange="previewImage(this)">
          <div class="file-upload-info">
            <i class="fas fa-cloud-upload-alt"></i>
            <span>Click to upload or drag and drop</span>
            <small>PNG, JPG, GIF up to 5MB</small>
          </div>
        </div>
        
        <?php if (!empty($question['image_path'])): ?>
          <div class="current-image">
            <label style="font-weight: 600; color: var(--secondary-700); margin-bottom: var(--spacing-2); display: block;">
              <i class="fas fa-image"></i>
              Current Image:
            </label>
            <div class="image-display" style="border: 1px solid var(--secondary-200); border-radius: var(--radius-lg); padding: var(--spacing-3); background: var(--secondary-50);">
              <img src="/CW_PHPupdate/<?= htmlspecialchars($question['image_path']) ?>" 
                   alt="Current question image"
                   style="max-width: 100%; height: auto; border-radius: var(--radius-md); margin-bottom: var(--spacing-2);">
              <span class="image-info" style="font-size: var(--font-size-sm); color: var(--secondary-600);">
                <i class="fas fa-info-circle"></i>
                This image will be replaced if you upload a new one
              </span>
            </div>
          </div>
        <?php endif; ?>
        
        <div id="imagePreview" class="image-preview" style="display: none;">
          <img id="previewImg" src="" alt="Preview">
          <button type="button" class="remove-image" onclick="removeImage()">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>

      <div class="form-group">
        <label for="module_id">
          <i class="fas fa-book"></i>
          Select Module
        </label>
        <select name="module_id" id="module_id" required>
          <?php foreach ($modules as $module): ?>
            <option value="<?= $module['id'] ?>" 
                    <?= $module['id'] == $question['module_id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($module['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-actions">
        <button type="submit" class="submit-btn">
          <i class="fas fa-save"></i>
          Update Question
        </button>
        <a href="../corephpfiles/community.php" class="cancel-btn">
          <i class="fas fa-times"></i>
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>

<script>
function previewImage(input) {
  const preview = document.getElementById('imagePreview');
  const previewImg = document.getElementById('previewImg');
  
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    
    reader.onload = function(e) {
      previewImg.src = e.target.result;
      preview.style.display = 'block';
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

function removeImage() {
  const input = document.getElementById('image');
  const preview = document.getElementById('imagePreview');
  
  input.value = '';
  preview.style.display = 'none';
}
</script>