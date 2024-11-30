<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link rel="stylesheet" href="signin.css" />
  <style>
    .alert-popup {
      display: none;
      background-color: #f44336;
      color: white;
      padding: 15px 30px;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
      border-radius: 20px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="signin-container">
    <div class="signin-form">
      <h2>Sign In</h2>
      <form id="signin-form" method="post" action="">
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required />
        </div>
        <button type="submit">Sign In</button>
      </form>
      <p class="signup-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
  </div>

  <div id="alertPopup" class="alert-popup"></div>

  <script>
    function showAlert(message) {
      var alertPopup = document.getElementById('alertPopup');
      alertPopup.textContent = message;
      alertPopup.style.display = 'block';
      setTimeout(function() {
        alertPopup.style.display = 'none';
      }, 3000);
    }
  </script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'my_database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: index.html");
        exit();
    } else {
        echo "<script>showAlert('Wrong email or password');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
