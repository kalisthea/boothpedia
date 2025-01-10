@if(Auth::user()->role == "admin")
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
    <title>Admin Dashboard</title>
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
        <p style="font-size:30px; color:#0082CB">Refund Requests</p>
        <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>Tenant</th>
                <th>Event Organizer</th>
                <th>Event</th>
                <th>Reason</th>
                <th>Additional Information</th>
                <th>Image</th>
                <th>Submitted Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @if (count($refunds) > 0)
                @foreach ($refunds as $index => $refund)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $refund->tenant->name }}</td> 
                    <td>{{ $refund->eo->name }}</td> 
                    <td>{{ $refund->event->name }}</td> 
                    <td>{{ $refund->reason }}</td> 
                    <td>{{ $refund->additional }} </td> 
                    <td>
                        @if ($refund->image)
                            <a href="data:image/jpeg;base64,{{ base64_encode($refund->image) }}" download="image_proof">
                                <i class="fa-solid fa-circle-down"></i>
                            </a>
                        @else
                            <i class="fa-solid fa-circle-down" style="color: gray; pointer-events: none;"></i> 
                        @endif
                    </td>
                    <td>{{ $refund->created_at }}</td> 
                    <td>
                        @if ($refund->status === null) 
                            <form action="{{ route('refunds.approve') }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value={{ $refund->id }} name=refund_id>
                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this refund?')">Approve</button>
                            </form>
                            <form action="{{ route('refunds.deny') }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value={{ $refund->id }} name=refund_id>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to deny this refund?')">Deny</button>
                            </form>
                        @elseif ($refund->status === 'approved')
                            <button class="btn btn-success" disabled>Approved</button>
                        @elseif ($refund->status === 'denied')
                            <button class="btn btn-danger" disabled>Denied</button>
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
                    <form action="{{ route('admin') }}" method="get" style="display: flex; align-items: center; gap: 1rem;">
                        <select name="filter" id="filter" class="form-select">
                            <option value="all">All</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="denied">Denied</option>
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
@elseif(Auth::user()->role == "finance")
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
    <title>Admin Dashboard</title>
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
        <p style="font-size:30px; color:#0082CB">Finished Events</p>
        <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>Event Name</th>
                <th>Event Organizer</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($events as $index => $event)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $event->name }}</td> 
                    <td>{{ $event->user->name }}</td> 
                    <td>@if ($event->status == 'Active')
                        <span style="color: green;">Active</span>
                    @else
                        <span style="color: red;">Inactive</span>
                    @endif</td>
                    <td>
                        <a href="{{ url('finance-invoice/'.$event->name) }}" style="text-decoration:none;">
                            <button type="submit" class="btn btn-primary">View Invoices</button>
                        </a>
                        <form action="{{ route('status.change') }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value={{ $event->id }} name="event_id">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to inactivate this event?')">Finish</button>
                        </form>
                    </td> 
                </tr>
                @endforeach
            </tbody>
            
            <tfoot>
              <tr>
                <td colspan="9">
                    <form action="{{ route('admin') }}" method="get" style="display: flex; align-items: center; gap: 1rem;">
                        <select name="filter-2" id="filter-2" class="form-select">
                            <option value="all">All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </td>
              </tr>
            </tfoot>
        </table>
        <div class="pagination-container d-flex justify-content-center mt-3">
            {{ $events->links('pagination::bootstrap-4') }} 
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
            const filterValue = document.getElementById('filter-2').value;
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
@endif