<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cheapo Mail</title>
    <link rel="stylesheet" href="styles.css" media="screen" />
    <script src="../scripts/jquery-3.2.1.js"></script>
    <script src="no-refresh.js" charset="utf-8"></script>
  </head>
  <body>
    <div id="wrapper" class="container">
      <header>
        <h1>My Cool AJAX Page</h1>
        <p>
          Look ma! No page refreshes!
        </p>
      </header>
      <nav>
        <ul>
          <li><a id="nav-home" href="home.php">Add User</a></li>
          <li><a id="nav-about" href="about.php">Log in</a></li>
          <li><a id="nav-contact" href="contact.php">Log out</a></li>
        </ul>
      </nav>
      <main>
        <?php include 'home.php'; ?>
      </main>
    </div>
  </body>
</html>
