<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="icon" href="images/logo.png" type="image/png">
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <div class="form-box box">
      <header>Sign Up</header>
      <hr>
      <form action="#" method="POST">
        <div class="form-box">
          <?php
          session_start();
          include "connection.php";

          if (isset($_POST['register'])) {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];
            $role = $_POST['role'];

            $check = "SELECT * FROM users WHERE email='{$email}'";
            $res = mysqli_query($conn, $check);
            $passwd = password_hash($pass, PASSWORD_DEFAULT);
            $key = bin2hex(random_bytes(12));

            if (mysqli_num_rows($res) > 0) {
              echo "<div class='message'>
                      <p>This email is used, Try another one please!</p>
                    </div><br>";
              echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
            } else {
              if ($pass === $cpass) {
                // Insert username, email, password, and role
                $sql = "INSERT INTO users(username, email, password, role) VALUES('$name', '$email', '$passwd', '$role')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                  echo "<div class='message'>
                          <p>You are registered successfully!</p>
                        </div><br>";
                  echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
                } else {
                  echo "<div class='message'>
                          <p>There was an error. Please try again.</p>
                        </div><br>";
                  echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                }
              } else {
                echo "<div class='message'>
                        <p>Password does not match.</p>
                      </div><br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
              }
            }
          } else {
          ?>
            <!-- Registration form fields -->
            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Username" name="username" required>
            </div>

            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Email Address" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Password" name="password" required>
              <i class="fa fa-eye icon toggle"></i>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field" type="password" placeholder="Confirm Password" name="cpass" required>
              <i class="fa fa-eye icon"></i>
            </div>

            <!-- Role Selector -->
            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <select class="input-field" name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
              </select>
            </div>

        </div>

        <center><input type="submit" name="register" id="submit" value="Signup" class="btn"></center>

        <div class="links">
          Already have an account? <a href="login.php">Signin Now</a>
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