<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Informasi Dasar</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    @php
        $user = Auth::user();
    @endphp

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Profile</h1>
            </div>
            @include('navheader')
        </div>
        
        <!-- Basic Information -->
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
                <a href="{{ route('editinfo') }}" class="edit-info">Edit</a>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit">Logout</button>
      </form>
    </div>
</body>
</html>