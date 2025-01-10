<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/extras.css') }}">
    <script type="text/javascript" src="{{ asset('myscript.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Invoices Data</title>
</head>
<body>
    <header>
        <img class= "blogo" src="{{ asset('images/Logo.png') }}" alt="">
        
        @php
        $user = Auth::user();
        $username = $user->name;
        @endphp
            
        <p class="header-text">Welcome, {{ $username }}</p>

        <form method="POST" action="{{ route('logout') }}" style="padding-top:1rem;">
            @csrf
            <button type="submit" class="logout-button">
              <i class="fa-solid fa-right-from-bracket"></i>Logout
            </button>
        </form>
    </header>

    <div class="main-container">
        <p style="font-size:30px; color:#0082CB">{{ $events->name }}</p>
        
        @foreach($banks as $bank)
            <p>Account Number : {{ $bank->account_num }}</p>              
            <p>Account Name   : {{ $bank->account_name }}</p>                   
            <p>Bank Name      : {{ $bank->bank_name }}</p>                
        @endforeach
                           
        <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>Tenant</th>
                <th>Price</th>
                <th>Finished</th>
              </tr>
            </thead>
            <tbody>
                @if (isset($invoices) && $invoices->count() > 0)
                    @foreach ($invoices as $index => $invoice)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $invoice->tenant->name }}</td> 
                            <td>Rp {{ number_format($invoice->price , 0, ',', '.')}},00</td> 
                            <td>@if ($invoice->finished == 'Y')
                                <span style="color: green;">Finished</span>
                            @else
                                <span style="color: red;">Not Finished</span>
                            @endif</td> 
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No invoices found for this event.</td>
                    </tr>
                @endif
            </tbody>
            
            <tfoot>
              <tr>
                <td colspan="9">
                    <form action="{{ route('finance', ['event_name' => $events->name]) }}" method="get" style="display: flex; align-items: center; gap: 1rem;">
                        <select name="filter" id="filter" class="form-select">
                            <option value="all">All</option>
                            <option value="finished">Finished</option>
                            <option value="notfinished">Not Finished</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </td>
              </tr>
            </tfoot>
        </table>
        <div class="pagination-container d-flex justify-content-center mt-3">
            {{ $invoices->links('pagination::bootstrap-4') }} 
        </div>
    </div>
    

    @if(session('success'))  
        <div class="alert alert-success" role="alert" id="success-alert">
             {{ session('success') }}
        </div>
    @endif

    <script>
        setTimeout(function(){
            var x = document.getElementById("success-alert");
            if (x) {
                x.style.display = "none"; 
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
    <script>
        function filterRefunds() {
            const filterValue = document.getElementById('filter').value;
            const rows = document.querySelectorAll('tbody tr');
    
            rows.forEach(row => {
                const status = row.cells[8].textContent.trim(); // Assuming status is in the 8th column (index 7)
    
                if (filterValue === 'all' || status === filterValue) {
                    row.style.display = ''; 
                } else {
                    row.style.display = 'none'; 
                }
            });
        }
    
        // Initial filter (optional)
        filterRefunds('{{ $filter }}'); 
    </script>
</body>
</html>