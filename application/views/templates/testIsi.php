<!DOCTYPE html>
<html>
<head>
 <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }
 </script>
</head>
<body>
 <input type="password" id="password" name="password" placeholder="Password">
 <button onclick="togglePasswordVisibility()">Show Password</button>
</body>
</html>