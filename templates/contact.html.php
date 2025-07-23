<?php

?>

<div class="page-header">
  <div class="page-header-content">
    <i class="fas fa-envelope page-icon"></i>
    <h1>Contact Admin</h1>
    <p>Get in touch with the administration team</p>
  </div>
</div>

<div class="contact-container">
  <div class="contact-card">
    <?php if ($status): ?>
      <div class="success-message" style="color: green;">
        <i class="fas fa-check-circle"></i>
        <strong><?= htmlspecialchars($status) ?></strong>
      </div>
    <?php elseif ($error): ?>
      <div class="error-message">
        <i class="fas fa-exclamation-circle"></i>
        <strong><?= htmlspecialchars($error) ?></strong>
      </div>
    <?php endif; ?>

    <form action="../corephpfiles/contact.php" method="post" class="contact-form">
      <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="form-group">
          <label for="name">
            <i class="fas fa-user"></i>
            Your Name
          </label>
          <input type="text"
                 id="name"
                 name="name"
                 value="<?= htmlspecialchars($name) ?>"
                 required
                 placeholder="Enter your full name">
        </div>

        <div class="form-group">
          <label for="email">
            <i class="fas fa-envelope"></i>
            Your Email
          </label>
          <input type="email"
                 id="email"
                 name="email"
                 value="<?= htmlspecialchars($email) ?>"
                 required
                 placeholder="Enter your email address">
        </div>
      <?php else: ?>
        <div class="user-info-display">
          <div class="info-item">
            <i class="fas fa-user"></i>
            <span><strong>Name:</strong> <?= htmlspecialchars($name) ?></span>
          </div>
          <div class="info-item">
            <i class="fas fa-envelope"></i>
            <span><strong>Email:</strong> <?= htmlspecialchars($email) ?></span>
          </div>
        </div>
        <input type="hidden" name="name" value="<?= htmlspecialchars($name) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
      <?php endif; ?>

      <div class="form-group">
        <label for="to_email">
          <i class="fas fa-user-shield"></i>
          Send to Admin
        </label>
        <input type="email"
               id="to_email"
               name="to_email"
               required
               placeholder="Enter admin's email address">
      </div>

      <div class="form-group">
        <label for="message">
          <i class="fas fa-comment"></i>
          Your Message
        </label>
        <textarea id="message"
                  name="message"
                  rows="6"
                  required
                  placeholder="Write your message here..."></textarea>
      </div>

      <button type="submit" class="submit-btn">
        <i class="fas fa-paper-plane"></i>
        Send Message
      </button>
    </form>
  </div>
</div>
