<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" href="images/logo.png" type="image/png">
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <div class="form-box box">
      <?php
      include "connection.php";

      // Capture the role from the URL or default to "student"
      $role = isset($_GET['role']) ? $_GET['role'] : 'student';

      if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $role = $_POST['role'];

        // Check email and role in the database
        $sql = "SELECT * FROM users WHERE email='$email' AND role='$role'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
          $row = mysqli_fetch_assoc($res);
          $password = $row['password'];
          $decrypt = password_verify($pass, $password);

          if ($decrypt) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            if ($role === 'student') {
              header("location: home.php");
            } else if ($role === 'teacher') {
              header("location: home.php");
            } else {
              header("location: admin/home.php");
            }
          } else {
            echo "<div class='message'><p>Wrong Password</p></div><br>";
            echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
          }
        } else {
          echo "<div class='message'><p>Wrong Email or Role</p></div><br>";
          echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
        }
      } else {
      ?>

        <header>Login</header>
        <hr>
        <form action="login.php" method="POST">
          <div class="form-box">
            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Email Address" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Password" name="password" required>
              <i class="fa fa-eye toggle icon"></i>
            </div>

            <!-- Role Selector Dropdown -->
            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <select class="input-field" name="role" required>
                <option value="student" <?php if ($role === 'student') echo 'selected'; ?>>Student</option>
                <option value="teacher" <?php if ($role === 'teacher') echo 'selected'; ?>>Teacher</option>
                <option value="admin" <?php if ($role === 'admin') echo 'selected'; ?>>Admin</option>
              </select>
            </div>

          </div>

          <input type="submit" name="login" id="submit" value="Login" class="btn" style="display: block;">

          <div class="links">
            Don't have an account? <a href="signup.php">Signup Now</a>
          </div>
        </form>
    </div>
  <?php
      }
  ?>
  </div>

  <script>
    const toggle = document.querySelector(".toggle"),
      input = document.querySelector(".password");
    toggle.addEventListener("click", () => {
      if (input.type === "password") {
        input.type = "text";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
      } else {
        input.type = "password";
      }
    })
  </script>
</body>

</html>