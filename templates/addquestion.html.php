<div class="page-header">
  <div class="page-header-content">
    <i class="fas fa-plus-circle page-icon"></i>
    <h1>Ask a Question</h1>
    <p>Share your thoughts and get help from the community</p>
  </div>
</div>

<div class="ask-container">
  <button class="ask-toggle" onclick="toggleQuestionForm()">
    <i class="fas fa-plus"></i>
    Post Your Question
  </button>

  <div id="questionForm" class="ask-form">
    <div class="form-header">
      <h2>Add a New Question</h2>
      <button type="button" class="close-btn" onclick="toggleQuestionForm()">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <form action="../postsmanagement/addquestion.php" method="post" enctype="multipart/form-data" class="question-form">
      <div class="form-group">
        <label for="title">
          <i class="fas fa-heading"></i>
          Question Title
        </label>
        <input type="text" 
               name="title" 
               id="title" 
               required
               placeholder="Enter a clear, descriptive title for your question">
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
                  placeholder="Describe your question in detail..."></textarea>
      </div>

      <div class="form-group">
        <label for="image">
          <i class="fas fa-image"></i>
          Upload Image (Optional)
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
          <option value="">Choose a module...</option>
          <?php foreach ($modules as $module): ?>
            <option value="<?= $module['id'] ?>"><?= htmlspecialchars($module['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-actions">
        <button type="submit" class="submit-btn">
          <i class="fas fa-paper-plane"></i>
          Post Question
        </button>
        <button type="button" class="cancel-btn" onclick="toggleQuestionForm()">
          <i class="fas fa-times"></i>
          Cancel
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function toggleQuestionForm() {
  const form = document.getElementById('questionForm');
  const toggle = document.querySelector('.ask-toggle');
  
  if (form.style.display === 'block' || form.style.display === '') {
    form.style.display = 'none';
    toggle.style.display = 'block';
  } else {
    form.style.display = 'block';
    toggle.style.display = 'none';
    form.scrollIntoView({behavior: 'smooth'});
  }
}

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
