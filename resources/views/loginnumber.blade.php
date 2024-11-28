<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Sign-In Boothpedia</title>
</head>
<body>
  <div class="signin-container">
    <div class="signin-content-1">
      <a href="/home"><img style="position: relative; right:35%; width:10%;" src="images/arrow-left.png" alt=""></a>
      <img style="position: relative; left:20%;" src="images/Logo.png" alt="">
    </div>

    <b><p style="color:#FFC60B; padding-bottom:1rem; position: relative; left:18%;">Login to your account</p></b>

    <div class="signin-content-2">
      <div class="signin-choice">
        <div class="signin-email">
            <a href="/login"><p>Email</p></a>
        </div>
        <div class="signin-number-active">
            <p>Phone Number</p>
        </div>
      </div>

      <div class="signin-forms">
        <label for="phonenumber">Phone Number</label><br>
        <input class="signin-input"  type="text" id="phonenumber" name="phonenumber"><br>
        <label for="password">Password</label><br>
        <input class="signin-input" type="text" id="password" name="password">
      </div>

      <a href="/home"><button class="login-button" type="button">Login</button></a>
    </div>

    <div class="login-cta">
      <p>No account yet?</p>
      <a href="/signin">Register</a>
    </div>

    <a class="eologin" href="">Login as EO</a><b></b>


    
  </div>

   
</body>
</html>