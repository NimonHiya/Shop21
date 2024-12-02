<?php
session_start();
require '../functions.php';

// Check cookies
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // Fetch username using id
  $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // Check cookie and username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
    $_SESSION['user_id'] = $id;
  }
}

if (isset($_SESSION['login'])) {
  header('Location: /');
  exit;
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Fetch user data using prepared statement
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
      // Set session
      $_SESSION["login"] = true;
      $_SESSION["user_id"] = $row["id"];
      $_SESSION["admin"] = $row['is_admin'] ? true : false;

      // Check remember me
      if (isset($_POST["remember"])) {
        // Set cookies for 1 week
        setcookie('id', $row['id'], time() + (7 * 24 * 60 * 60), "/");
        setcookie('key', hash('sha256', $row['username']), time() + (7 * 24 * 60 * 60), "/");
      }

      header("Location: /");
      exit;
    }
  }

  $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/img/halo.webp">
  <title>OldShop | Login Page</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background: linear-gradient(135deg, #343a40, #1c1f26);
      color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      background: #2b3036;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .btn-primary {
      background: linear-gradient(90deg, #007bff, #0056b3);
      border: none;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #0056b3, #003d80);
    }

    .form-control {
      background-color: #343a40;
      color: #f8f9fa;
      border: 1px solid #5a5a5a;
    }

    .form-control:focus {
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
      border-color: #007bff;
    }

    a {
      color: #f8f9fa;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h1 class="text-center mb-4">Login</h1>
    <form action="" method="post" class="needs-validation" novalidate>
      <div class="mb-3 form-floating">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="username" required>
        <label for="username">Username</label>
        <div class="invalid-feedback">
          Please enter your username.
        </div>
      </div>
      <div class="mb-3 form-floating">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <label for="password">Password</label>
        <div class="invalid-feedback">
          Please enter your password.
        </div>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="remember" id="remember" class="form-check-input">
        <label for="remember" class="form-check-label">Remember Me</label>
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
      <div class="text-center mt-3">
        <a href="register.php">Don't have an account? Register here</a>
      </div>
      <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3">Incorrect username or password</div>
      <?php endif; ?>
    </form>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script>
    // Bootstrap form validation
    (function () {
      'use strict'

      var forms = document.querySelectorAll('.needs-validation')

      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>
</body>

</html>
