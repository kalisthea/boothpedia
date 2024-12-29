<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="{{ asset('script.js') }}"></script>  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title>Verifikasi Profile</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Profile Verification</h1>
            </div>
            @include('navheader')
        </div>

        <!-- Verification Profile -->
        <div class="content" style="display:block;">
            <div class="verif-container">
                <ul>
                    <div class="ktp-img">
                        @php
                            $src = 'data:image/jpeg;base64,' . base64_encode($verifProfile->id_photo);
                        @endphp
                        <img src="{{ $src }}" alt="">
                    </div>
                    <li class="verif-field">
                        <div class="id-num-title">ID Number</div>
                        <div class="id-num">{{ $verifProfile->id_num }}</div>
                    </li>
                    <li class="verif-field">
                        <div class="id-name-title">Name</div>
                        <div class="id-name">{{ $verifProfile->id_name }}</div>
                    </li>
                    <li class="verif-field">
                        <div class="id-address-title">Address</div>
                        <div class="id-address">{{ $verifProfile->id_address }}</div>
                    </li>
                    <a href="{{ route('editinfo') }}" class="edit-verif">Edit</a>
                </ul>
            </div>
        </div>
    </div>
    
</body>
</html>