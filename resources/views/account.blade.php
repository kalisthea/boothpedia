<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Bank Account</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Bank Account</h1>
            </div>
            @include('navheader')
        </div>
        
        <!-- Account Content -->
        <div class="content" style="display:block;">
            <div class="bank-container">
                <ul>
                    <li class="bank-field">
                        <div class="account-name-title">Name</div>
                        <div class="account-name">{{ $bankAccount->account_name }}</div>
                    </li>
                    <li class="bank-field">
                        <div class="account-num-title">Bank Account Number</div>
                        <div class="account-num">{{ $bankAccount->account_num }}</div>
                    </li>
                    <li class="bank-field">
                        <div class="bank-name-title">Address</div>
                        <div class="bank-name">{{ $bankAccount->bank_name }}</div>
                    </li>
                    <a href="{{ route('editbank', ['id' => $bankAccount->id]) }}" class="edit-verif">Edit</a>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>