<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="{{ asset('script.js') }}"></script>  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title> Edit Bank Account</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Edit Bank Account</h1>
            </div>
            @include('navheader')
        </div>
        
        <!-- Account Content -->
        <div class="content" style="display:block;">
            <div class="bank-container">
                <form class="add-bank" id="bankForm" method="POST" action="{{ route('editbank.update', $bankAcc->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="bankacc-container">
                        <ul>
                            <li class="bank-field">
                                <label for="account-name" class="account-name-title">Name</label>
                                <input type="text" name="account_name" id="account-name" value="{{ old('account_name', $bankAcc->account_name) }}">
                            </li>
                            <li class="bank-field">
                                <label for="account-num" class="account-num-title">Bank Account Number</label>
                                <input type="text" name="account_num" id="account-num" value="{{ old('account_num', $bankAcc->account_num) }}">
                            </li>
                            <li class="bank-field">
                                <label for="bank-name" class="bank-name-title">Bank Name</label>
                                <input type="text" name="bank_name" id="bank-name" value="{{ old('bank_name', $bankAcc->bank_name) }}">
                            </li>
                        </ul>
                        <div class="btn-savecancel">
                            <a href="{{ route('bankaccount') }}" class="cancel-info">Cancel</a>
                            <input type="submit" value="Save" class="submit-btn" style="margin-left:10px">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>