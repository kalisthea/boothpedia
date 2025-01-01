<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title>Informasi Dasar</title>
</head>
<body>
        <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Informasi Dasar</h1>
            </div>
            @include('navheader')
        </div>
        
        <!-- Edit Basic Information -->
        <div class="content">
            <div class="verif-container">
                <form class="add-verif" id="verifForm" method="POST" enctype="multipart/form-data" action="{{ route('editverif.update', $profile->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="id-container">
                        <ul>
                            <div class="button-verif-container" style="display:flex;align-items:center;">
                                <button class="upload-id-button" onclick="document.getElementById('fileId').click();">
                                    <i class="fas fa-upload"></i>Upload ID Picture
                                </button>
                                <input type="file" name="id_photo" id="fileId" style="display: none;" onchange="displayFileName('fileId', 'photoId');"/>
                                <span id="photoId" style="margin-left: 10px;"></span>
                            </div>
                            <li class="verif-field">
                                <label for="id-num" class="id-num-title">ID Number</label>
                                <input type="text" name="id_num" id="id-num" value="{{ old('id_num', $profile->id_num) }}" >
                            </li>
                            <li class="verif-field">
                                <label for="id-name" class="id-name-title">Name</label>
                                <input type="text" name="id_name" id="id-name" value="{{ old('id_name', $profile->id_name) }}" >
                            </li>
                            <li class="verif-field">
                                <label for="id-address" class="id-address-title">Address</label>
                                <input type="text" name="id_address" id="id-address" value="{{ old('id_address', $profile->id_address) }}" >
                            </li>
                        </ul>
                        <div class="btn-savecancel">
                            <a href="{{ route('verifprofile') }}" class="cancel-info">Batal</a>
                            <input type="submit" value="Submit" class="submit-btn" style="margin-left:10px">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>