<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title>Chat Message</title>
</head>
<body>
  @include('sidebar')

  <!-- Content -->
  <div class="container">
      <!-- Header -->
      <div class="header">
          <div class="header-name">
              <h1>Chat Message</h1>
          </div>
          @include('navheader')
      </div>

      <div class="chat-container">
        <div class="chat-content-1">
          @if(Auth::user()->role == "tenant")
            <p style="color: #FFC60B; font-size:25px;">{{ $chats->eo->name }}</p>
          @elseif(Auth::user()->role == "eventorganizer")
            <p style="color: #006AA6; font-size:25px;">{{ $chats->tenant->name }}</p><br>
          @endif
        </div>
        <div class="chat-content-2">
          @foreach($messages as $message)
            <div class="message-container {{ $message->sender == Auth::user()->role ? 'message-right' : 'message-left' }}">
                <p>{{ $message->message }}</p>
            </div>
          @endforeach
        </div>
        <form action="{{ route("message.post", $chats->id) }}" method="POST">
          @csrf
          <div class="chat-send" style="padding-top: 2rem;">
            <input type="text" name="sendtext" id="sendtext" placeholder="Type your message" class="send-chat">
            <input type="button" name="" id="" class="ok-button" style="padding-top: 2px; padding-left: 20px; padding-right: 20px;" value="Send">
          </div>
        </form>
      </div>
      <a href="/chatmessage" class="back-button" style="top:80%;position: fixed;">Back</a>
  </div>
</body>
</html>