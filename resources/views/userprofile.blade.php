<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>User</title>
</head>
<body>
    <header>
        <img class= "blogo" src="images/Logo.png" alt="">
        <nav class="navbar">
          <div class='nav-left'>
            <a class = "active" href="home">Home</a></li>
            <a href="explore">Explore</a></li>
            <a href="booth">Booth</a></li>
          </div>
          <div  class="nav-right" style="display: flex; gap: 1rem; align-items:center">
            <a href="/chatmessage"><img style="width:35px; height:auto;" src="images/mail.png" alt=""></a>
            <a href="/tenant-profile"><img style="width:35px; height:auto;" src="images/user.png" alt=""></a>
          </div>
        </nav>
      </header>
    
      <hr style="border: 2px solid #2FA8E8; color:#2FA8E8;">
      <hr style="border: 2px solid #FFC60B; color: #FFC60B;">

      <h2 style="color:#FFC60B; padding-bottom: 2rem; padding-top: 2rem;">Account Information</h2>

    
      @php
        $user = Auth::user();
      @endphp

      <div class="content">
        <div class="info-container">
            <ul>
                <li class="info-field">
                    <div class="eo-name-title">Name</div>
                    <div class="eo-name">{{$user->name}}</div>
                </li>
                <li class="info-field">
                    <div class="eo-email-title">Email</div>
                    <div class="eo-email">{{$user->email}}</div>
                </li>
                <li class="info-field">
                    <div class="eo-phone-title">Phone Number</div>
                    <div class="eo-phone">{{$user->phonenum}}</div>
                </li>
            </ul>
        </div>
      </div>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="ok-button" style="background-color:#FFC60B; border-color:#FFC60B">Logout</button>
      </form>
      </div>

</body>
</html>