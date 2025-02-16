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
    <title>Login Boothpedia</title>
</head>
<body>
  <div class="signin-container">
    <div class="signin-content-1">
      <img style="position: relative; left:30%;" src="images/Logo.png" alt="">
    </div>

    <b><p style="color:#FFC60B; padding-bottom:1rem; position: relative; left:18%;">Login to your account</p></b>

    <div class="login-content-2">
      <div class="signin-choice">
        <div class="signin-email">
            <a href="/login"><p>Email</p></a>
        </div>
        <div class="signin-number-active">
            <p>Phone Number</p>
        </div>
      </div>

      <div class="login-forms">
        <form action="{{ route("loginnum.post") }}" method="POST">
          @csrf
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
          <input type="submit" value="Login" class="login-button">
        </form>
      </div>

      
    </div>

    <div class="login-cta">
      <p>No account yet?</p>
      <a href="/signup">Register</a>
    </div>

    <a class="eologin" href="/login-eo">Login as EO</a><b></b>


    
  </div>

   
</body>
</html>