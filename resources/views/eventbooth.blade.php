@php
use App\Models\Booth;
use App\Models\Category;
session_start();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>{{ $events->name }}</title>
</head>
<body>
  <header>
    <img class= "blogo" src="{{ asset('images/Logo.png') }}" alt="">
    <nav class="navbar">
      <div class='nav-left'>
        <a class = "active" href="/home">Home</a></li>
        <a href="/explore">Explore</a></li>
        <a href="/booth">Booth</a></li>
      </div>
      <div  class="nav-right">
        <input class="search-hold" type="text" placeholder="Search">
        <a href=""><img style="width:35px; height:auto;" src="{{ asset('images/mail.png') }}" alt=""></a>
        <a href="/profile"><img style="width:35px; height:auto;" src="{{ asset('images/user.png') }}" alt=""></a>
      </div>
    </nav>
  </header>

  <hr style="border: 2px solid #2FA8E8; color:#2FA8E8;">
  <hr style="border: 2px solid #FFC60B; color: #FFC60B;">
  <div style="width:1250px; height: 260px; position: relative; left: 14rem;">
    <img class="evt-detail-img" style="width: 100%; height:100%; object-fit:cover; border-radius:18px;" src="data:image/jpeg;base64,{{ $events->image_base64 }}" alt="">
  </div>
  <div class="detail-container">
    <div class="detail-1">
      <div class="detail-content-1">
        <b><p style="color:#2FA8E8">{{ $events->name }}</p></b>
        <p style="color: #FFC60B">{{ $events->category }}</p>
        <p style="padding-top:2rem;">{{ $events->location }}</p>
        <p>{{ $events->venue }}</p>
      </div>
      <div class="detail-content-2">
        @php
          use App\Models\Rating;
          $getEO = $events->user->id;

          $averageRating = Rating::where('eo_id', $getEO)->avg('rating'); 
        @endphp
        <p>Event Organizer : {{ $events->user->name }}</p>
        <p>Rating : {{ number_format($averageRating, 1, '.', ''); }}/5</p>
        <p>{{ $events->start_date }} - {{ $events->end_date }}</p>
      </div>
    </div>
  </div>

  <div class="nav-detail">
    <div class="nav-desc">
      <b><a href="{{ url('event-detail-desc/' . $events->name) }}"><p>Description</p></a></b>
    </div>
    <div class="nav-booth-active">
        <b><p>Booth</p></b>
    </div>
  </div>

  <div class="booth-list-container">
    <form action="" method="GET"> 
      <input type="hidden" name="selected_booth_ids[]" value=""> 
      <div class="booth-category">
          <select name="categoryDropdown" id="categoryDropdown" onchange="loadBooths()" style="padding-top: 5px; padding-bottom: 5px"> 
              <option>All Booths</option>  
              @foreach ($boothCategories as $category)
                  <option value="{{ $category->id }}"  @if (old('categoryDropdown') == $category->id) 
                    selected 
                @elseif (request()->input('categoryDropdown') == $category->id) 
                    selected 
                @endif>{{ $category->category_name }}</option>
              @endforeach
          </select>  
          <button type="submit" class="ok-button">Filter</button> 
      </div>
    </form>
    <p>*Check the box to select booth </p>
    <form action="{{ route('store.data', $events->name) }}" method="POST">
      @csrf
      <div class="booth-list">
        @php
            $selectedCategoryId = request()->input('categoryDropdown');
        @endphp
        @if ($selectedCategoryId && $selectedCategoryId != "All Booths")
          @php
            $booths = Booth::where('booth_category_id', $selectedCategoryId)->get();
          @endphp
        @else 
          @php
            $categories = Category::where('event_id', $events->id)->pluck('id')->toArray();
            $booths = Booth::whereIn('booth_category_id', $categories)->get(); 

          @endphp
        @endif
        
          @if (isset($booths) && count($booths) > 0)
                @foreach ($booths as $booth)
                    @if ($loop->iteration % 4 == 1 && $loop->iteration > 1)
                        </div><div class="booth-row"> 
                    @endif
                    
                      <div class="booth-box">
                        <input type="checkbox" name="selected_booth_ids[]" value="{{ $booth->id }}" class="selection-input" @if ($booth->is_occupied === 'Y')
                        disabled
                      @endif>
                        <div class="booth-left-side">
                          <div class="booth-box-title">{{ $booth->booth_name }}</div> 
                          <div class="booth-box-sub">
                              <div class="booth-status">Rp {{ number_format($booth->booth_price , 0, ',', '.')}},00</div>
                              <div class="booth-status" style="color:{{ $booth->is_occupied === 'Y' ? 'red' : 'green' }}">{{ $booth->is_occupied === 'Y' ? 'Unavailable' : 'Available' }}</div>
                          </div>
                        </div>
                      </div>  
                    
                @endforeach
              @else
                <p style="color: red">No booths found in this category.</p> 
          @endif
      </div>
      <input type="hidden" name="event_name" value="{{ $events->name }}"> 
      <div style="padding-top: 2rem;">
        <button type="submit" id="bookNowButton" class="ok-button" style="">Book Now</button> 
      </div>
    </form>
  </div>


  <a href="data:image/jpeg;base64,{{ $events->image_base64 }}" style="padding-left:17rem;" download="booth_layout">Download Booth Layout</a>

  <script>
    const selectedBoothIdsInput = document.querySelector('[name="selected_booth_ids[]"]');
  
    function updateSelectedBoothIds() {
      const checkedBoothIds = [];
      const checkboxes = document.querySelectorAll('.selection-input:checked');
      for (const checkbox of checkboxes) {
        checkedBoothIds.push(checkbox.value);
      }
      selectedBoothIdsInput.value = checkedBoothIds.join(',');
    }
  
    document.addEventListener('change', (event) => {
      if (event.target.classList.contains('selection-input')) {
        updateSelectedBoothIds();
      }
    });

  </script>
</body>
</html>