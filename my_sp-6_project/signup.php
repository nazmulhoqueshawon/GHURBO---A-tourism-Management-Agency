<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="signup.css" />
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
    .alert-popup.success {
      background-color: #4CAF50;
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <div class="signup-form">
      <h2>Sign Up</h2>
      <form id="signup-form" method="post" action="">
        <div class="input-group">
          <label for="fullname">Full Name</label>
          <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required />
        </div>
        <div class="input-group">
          <label for="mobile">Mobile Number</label>
          <input type="tel" id="mobile" name="mobile" placeholder="Enter your mobile number" required />
        </div>
        <div class="input-group">
          <label for="gender">Gender</label>
          <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="input-group">
          <label for="birthdate">Birthdate</label>
          <input type="date" id="birthdate" name="birthdate" required />
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a password" required />
        </div>
        <button type="submit">Sign Up</button>
      </form>
      <p class="signin-link">Already have an account? <a href="http://localhost/myproject/Signin.php">Sign In</a></p>
    </div>
  </div>

  <div id="alertPopup" class="alert-popup"></div>

  <script>
    function showAlert(message, isSuccess) {
      var alertPopup = document.getElementById('alertPopup');
      alertPopup.textContent = message;
      alertPopup.classList.toggle('success', isSuccess);
      alertPopup.style.display = 'block';
      setTimeout(function() {
        alertPopup.style.display = 'none';
        if (isSuccess) {
          window.location.href = 'http://localhost/myproject/Signin.php';
        }
      }, 3000);
    }
  </script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "my_database";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (name, number, gender, birthday, email, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullname, $mobile, $gender, $birthdate, $email, $password);

    if ($stmt->execute()) {
        echo "<script>showAlert('Account Created Successfully', true);</script>";
    } else {
        echo "<script>showAlert('Sign up failed. Please try again.', false);</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
