<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Chat Message</title>
</head>
<body>
    <header>
        <img class= "blogo" src="{{ asset('images/Logo.png') }}" alt="">
        <nav class="navbar">
          <div class='nav-left'>
            <a class = "active" href="home">Home</a></li>
            <a href="explore">Explore</a></li>
            <a href="booth">Booth</a></li>
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


      <h2 style="color:#FFC60B; padding-bottom: 2rem; padding-top: 2rem;">Chat Messages</h2>


      <div class="chat-container">
        <div class="chat-content-1">
          @if(Auth::user()->role == "tenant")
            <p>{{ $chats->eo->name }}</p><br>
          @elseif(Auth::user()->role == "eventorganizer")
            <p>{{ $chats->tenant->name }}</p><br>
          @endif
        </div>
        <div class="chat-content-2">
            @if(Auth::user()->role == "tenant")
              @foreach($messages as $message)
                <div class="message-container {{ $message->sender == 'eventorganzier' ? 'message-left' : 'message-right' }}">
                  <p>{{ $message->message }}</p>
                </div>
              @endforeach
            @elseif(Auth::user()->role == "eventorganizer")
              @foreach($messages as $message)
              <div class="message-container {{ $message->sender == 'tenant' ? 'message-left' : 'message-right' }}">
                <p>{{ $message->message }}</p>
              </div>
              @endforeach
            @endif
        
        </div>
        <form action="{{ route("message.post", $chats->id) }}" method="POST">
          @csrf
          <div class="chat-send">
            <input type="text" name="sendtext" id="sendtext" placeholder="Type your message">
            <input type="button" name="" id="" value="Send">
          </div>
        </form>
      </div>
    
    
</body>
</html>