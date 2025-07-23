<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Q&A Board</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="app-container">
   
    <header class="main-header">
      <div class="header-container">
        <div class="logo-section">
          <i class="fas fa-graduation-cap logo-icon"></i>
          <h1 class="site-title">Student Q&A Board</h1>
        </div>
        <div class="header-actions">
          <?php if (isset($_SESSION['user_id'])): ?>
            <div class="user-info">
              <i class="fas fa-user-circle"></i>
              <span class="username"><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </header>

   
    <nav class="main-nav">
      <div class="nav-container">
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="../corephpfiles/community.php" class="nav-link">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
          </li>

          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li class="nav-item">
              <a href="../admin/manageusers.php" class="nav-link">
                <i class="fas fa-users-cog"></i>
                <span>Manage Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="../admin/managemodules.php" class="nav-link">
                <i class="fas fa-book"></i>
                <span>Manage Modules</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="../admin/manageposts.php" class="nav-link">
                <i class="fas fa-file-alt"></i>
                <span>Manage Posts</span>
              </a>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <a href="../corephpfiles/contact.php" class="nav-link">
              <i class="fas fa-envelope"></i>
              <span>Contact Admin</span>
            </a>
          </li>
        </ul>
        
        <div class="nav-actions">
          <?php include '../templates/logout.html.php'; ?>
        </div>
      </div>
    </nav>

   
    <main class="main-content">
      <div class="content-container">
        <?php if (isset($output)) echo $output; ?>
        <?php if (isset($content)) echo $content; ?>
      </div>
    </main>

    
    <footer class="main-footer">
      <div class="footer-container">
        <div class="footer-content">
          <div class="footer-section">
            <h3>Student Q&A Board</h3>
            <p>Connect, learn, and grow together with your academic community.</p>
          </div>
          <div class="footer-section">
            <h4>Quick Links</h4>
            <ul class="footer-links">
              <li><a href="../corephpfiles/community.php">Home</a></li>
              <li><a href="../corephpfiles/contact.php">Contact</a></li>
              <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="../admin/manageusers.php">Admin Panel</a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="footer-section">
            <h4>Connect</h4>
            <div class="social-links">
              <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
              <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
              <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <p>&copy; <?= date('Y') ?> Student Q&A Board. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>

  
  <button class="mobile-nav-toggle" aria-label="Toggle navigation">
    <i class="fas fa-bars"></i>
  </button>

  <script>
   
    document.addEventListener('DOMContentLoaded', function() {
      const mobileToggle = document.querySelector('.mobile-nav-toggle');
      const navMenu = document.querySelector('.nav-menu');
      
      if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function() {
          navMenu.classList.toggle('nav-menu--open');
          mobileToggle.classList.toggle('mobile-nav-toggle--open');
        });
      }
    });
  </script>
</body>
</html>
