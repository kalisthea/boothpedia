
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/extras.css">
    <script type="text/javascript" src="myscript.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Refunds Data</title>
</head>
<body>
    <header>
        <img class= "blogo" src="images/Logo.png" alt="">
        
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
        <div class="nav">
            <a href="/admin">Invoices</a>
            <a href="{{ url('finance-refunds/') }}">Refunds</a>
        </div>
        <p style="font-size:30px; color:#0082CB">Refund Requests</p>
        <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>Tenant</th>
                <th>Account Number</th>
                <th>Account Name</th>
                <th>Bank</th>
                <th>Price</th>
                <th>Status</th>
                <th>Last Updated By</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @if (count($refunds) > 0)
                @foreach ($refunds as $index => $refund)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $refund->tenant->name }}</td> 
                    <td>{{ $refund->bank_number }}</td> 
                    <td>{{ $refund->account_name }}</td> 
                    <td>{{ $refund->bank }}</td> 
                    <td>Rp {{ number_format($refund->invoice->price , 0, ',', '.')}},00</td> 
                    <td>@if ($refund->status == 'approved')
                        <span style="color: green;">Approved</span>
                    @else
                        <span style="color:#0082CB">Finished</span>
                    @endif</td>
                    <td>{{ $refund->admin_name }}</td> 
                    <td>
                        @if($refund->status === 'approved')
                            <form action="{{ route('refund.change') }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value={{ $refund->id }} name=refund_id>
                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to finish this refund?')">Finish</button>
                            </form>
                        @elseif ($refund->status === 'finished')
                            <form action="{{ route('refund.undo') }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value={{ $refund->id }} name=refund_id>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to undo this refund?')">Undo</button>
                            </form>
                        @endif
                    </td>
                        {{-- <a href="{{ route('refund.show', $refund->id) }}" class="btn btn-primary">View</a> 
                        <a href="{{ route('refund.approve', $refund->id) }}" class="btn btn-success">Approve</a> 
                        <a href="{{ route('refund.deny', $refund->id) }}" class="btn btn-danger">Deny</a>  --}}
                </tr>
                @endforeach
            @else
             <tr>
                <td colspan="9">No refunds found for the selected filter.</td>
              </tr>
            @endif
            </tbody>
            <tfoot>
              <tr>
                <td colspan="9">
                    <form action="{{ route('finance-refunds') }}" method="get" style="display: flex; align-items: center; gap: 1rem;">
                        <select name="filter" id="filter" class="form-select">
                            <option value="all">All</option>
                            <option value="approved">Approved</option>
                            <option value="finished">Finished</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </td>
              </tr>
            </tfoot>
        </table>
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