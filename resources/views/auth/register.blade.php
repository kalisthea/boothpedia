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
    
    <title>Sign-Up Boothpedia</title>
</head>
<body>
  <div class="signin-container">
    <div class="signin-content-1">
      <img style="position: relative; left:30%;" src="images/Logo.png" alt="">
    </div>

    <b><p style="color:#006AA6; padding-bottom:1rem; position: relative; left:5%;">Register to Boothpedia</p></b>

    <div class="signin-content-2" style="border-color:#006AA6">
      <div class="signin-forms">
        <form action="{{ route("signupEO.post") }}" method="POST">
          @csrf
          <label for="fullname">Fullname</label><br>
          <input class="signin-input" type="text" id="fullname" name="fullname"><br>
          @if ($errors->has('fullname'))
          <span class="text-danger" style="font-size:12px;"> {{ $errors->first('fullname') }} </span><br>
          @endif
          <label for="email">Email</label><br>
          <input class="signin-input"  type="text" id="email" name="email"><br>
          @if ($errors->has('email'))
          <span class="text-danger" style="font-size:12px;"> {{ $errors->first('email') }} </span><br>
          @endif
          <label for="phonenumber">Phone Number</label><br>
          <input class="signin-input"  type="text" id="phonenum" name="phonenum"><br>
          @if ($errors->has('phonenum'))
          <span class="text-danger" style="font-size:12px;"> {{ $errors->first('phonenum') }} </span><br>
          @endif
          <label for="password">Password</label><br>
          <input class="signin-input" type="password" id="password" name="password"><br>
          @if ($errors->has('password'))
          <span class="text-danger" style="font-size:12px;"> {{ $errors->first('password') }} </span><br>
          @endif
          <input type="submit" name="" id="" value="Register" class="register-button">
        </form>
      </div>  
        {{-- onclick="registerSuccessPopup()" --}}
    </div>

    <div class="to-login">
      <p>Have account?</p>
      <a  href="/login-eo" style="color:#006AA6">Login</a>
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