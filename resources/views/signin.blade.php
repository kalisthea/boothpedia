<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="myscript.js"></script>
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

    <b><p style="color:#FFC60B; padding-bottom:1rem; position: relative; left:17%;">Register to Boothpedia</p></b>

    <div class="signin-content-2">
      <div class="signin-choice">
        <div class="signin-email-active">
            <p>Email</p>
        </div>
        <div class="signin-number">
           <a href="/signin-number"><p>Phone Number</p></a>
        </div>
      </div>

      <div class="signin-forms">
        <label for="fullname">Fullname</label><br>
        <input class="signin-input" type="text" id="fullname" name="fullname"><br>
        <label for="email">Email</label><br>
        <input class="signin-input"  type="text" id="email" name="email"><br>
        <label for="password">Password</label><br>
        <input class="signin-input" type="text" id="password" name="password">
      </div>

     <button onclick="registerSuccessPopup()" class="register-button" type="button">Register</button>
    </div>

    <div class="to-login">
      <p>Have account?</p>
      <a href="/login">Login</a>
    </div>
  </div> 

  <div id="overlay" class="overlay">
    <div id="registerSuccessPopup" class="register-success-popup">
      <img style="padding-bottom: 2rem;" src="images/check.png" alt="">
      <b><p style="color:#FFC60B;">Berhasil Register!</p></b>
      <a href="/home"><button onclick="registerSuccessPopupClose()" class="ok-button">OK</button></a>
   </div>
  </div>

</body>


</html>