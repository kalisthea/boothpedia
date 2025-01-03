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
          <form action="{{ route("user.search") }}" method="POST">
            @csrf
            <input class="search-hold" type="text" name="finduser" id="finduser" placeholder="Search User">
            @if (session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
          </form>
        </div>
        <div class="chat-content-2">
            @if(Auth::user()->role == "tenant")
              @foreach ($chats as $chat)
              <div class="chat-list">
                <b><a href="{{ url('chatmessage-active/'.$chat->id) }}" style="text-decoration: none; color:#006AA6">{{ $chat->eo->name }}</a><br></b>
              </div>
              <hr>
              @endforeach
            @elseif(Auth::user()->role == "eventorganizer")
              @foreach ($chats as $chat)
              <div class="chat-list">
                <b><a href="{{ url('chatmessage-active/'.$chat->id) }}" style="text-decoration: none; color:#006AA6">{{ $chat->tenant->name }}</a><br></b>
              </div>
              <hr>
              @endforeach
            @endif
        </div>
      </div>
  </div>
</body>
</html>