<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="style-admin.css">
    <title>Boothpedia Admin</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Rekening</h1>
            </div>
            @include('navheader')
        </div>
        
        <!-- Account Content -->
        <div class="content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">JEON WONWOO</div>
                        <div class="account-num">1234567890</div>
                        <div class="bank-name">BANK SYARIAH INDONESIA
                            
                        </div>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-circle-info"></i>
                        <i class="fa-regular fa-pen-to-square"></i>
                        <i class="fa-regular fa-trash-can"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>