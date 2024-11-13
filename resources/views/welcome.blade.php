{{-- @extends('layout.menu') --}}
{{-- @section('konten') --}}
{{-- @endsection --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="{{ asset('assetss/styles.css') }}" rel="stylesheet">
    <style>
        .chat-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            cursor: pointer;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }

        /* Tambahkan gaya untuk bubble chat */
        .chat-container {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 10px;
        }

        #messages {
            list-style-type: none;
            padding: 0;
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        #messages li {
            margin: 5px 0;
            padding: 10px;
            border-radius: 15px;
            position: relative;
            max-width: 80%;
        }

        /* Gaya untuk pesan dari admin */
        #messages li.admin {
            background-color: #007bff;
            color: #fff;
            align-self: flex-start;
            margin-left: auto;
        }

        /* Gaya untuk pesan dari tamu */
        #messages li.guest {
            background-color: #f1f1f1;
            color: #000;
            align-self: flex-start;
            margin-right: auto;
        }

        #form {
            display: flex;
            align-items: center;
        }

        #chatInput {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 15px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
    <title>Web Design Mastery | Camp</title>
</head>

<body>

    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="/">Neumedira</a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <i class="ri-menu-line"></i>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="/">HOME</a></li>
            <li><a href="{{ route('penduduk.index') }}">DATA KEPENDUDUKAN</a></li>
        </ul>
        @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST" style="float: right;">
                @csrf
                <button type="submit" class="btn btn-link">
                    Logout
                </button>
            </form>
        @endif
    </nav>
    <div class="container">
        <div class="container__left">
            <h1>Kependudukan Indonesia</h1>
            <div class="container__btn">
                <button id="store" class="btn" onclick="CTA()">TAMBAH DATA</button>
            </div>
        </div>
        <div class="container__right">
            <div class="content">
            </div>
        </div>
        <div class="message">

        </div>
    </div>

    <div class="chat-float" onclick="toggleChat()">
        <i class="ri-message-line"></i>
    </div>

    <script>
        function CTA() {
            document.getElementById("store");
            if (store) {
                window.location.href = "{{ route('penduduk.create') }}";
            }
        }

        function toggleChat() {
            document.getElementById("chat-container").style.display = document.getElementById("chat-container").style
                .display === 'none' ? 'block' : 'none';
        }
    </script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
</body>

</html>

{{-- ⬇️ dibawah ini fitur chat-app ⬇️ jangan di hapus ⬇️ --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System</title>
    <style>
        .chat-container {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 10px;
        }

        #messages {
            list-style-type: none;
            padding: 0;
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 10px;
            border-bottom: 1px #007bff;
        }

        #form {
            display: flex;
            align-items: center;
        }

        #chatInput {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 15px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
    <script src="https://cdn.socket.io/4.8.0/socket.io.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="body-container">
        <div class="chat-container" id="chat-container">
            @if (Auth::check() && Auth::user()->level == 'admin')
                <h2>&#128100;Admin Chat</h2>

                <h3>Connected Guests:</h3>
                <ul id="guestList"></ul> <!-- Display the list of connected guests -->

                <h3>Chat</h3>
                <ul id="messages"></ul>
                <form id="form" action="">
                    <input id="chatInput" autocomplete="off" placeholder="Type your message..." />
                    <button type="submit">&#11166;</button>
                </form>

                <script>
                    $(function() {
                        let socket = io('http://127.0.0.1:3000');
                        let selectedGuestSocketId = null; // Track the selected guest socket ID

                        // Register as admin on the server
                        socket.emit('registerAdmin');

                        // Update guest list when guests connect or disconnect
                        socket.on('updateGuestList', function(guestSocketIds) {
                            $('#guestList').empty(); // Clear the existing list

                            guestSocketIds.forEach(function(guestSocketId) {
                                let guestItem = $('<li>')
                                    .text("Guest " + guestSocketId)
                                    .css('cursor', 'pointer')
                                    .click(function() {
                                        selectedGuestSocketId = guestSocketId;
                                        alert("Selected Guest: " + selectedGuestSocketId);
                                    });
                                $('#guestList').append(guestItem);
                            });
                        });

                        // Display messages from guests
                        socket.on('sendChatToClient', function(data) {
                            let message = data.message;
                            let sender = data.from; // This is where the "from" field comes from
                            $('#messages').append($('<li>').text(sender + ": " + message));
                        });

                        // Send message to all connected guests
                        $('#form').submit(function(e) {
                            e.preventDefault();
                            let message = $('#chatInput').val();
                            if (message) {
                                socket.emit('sendChatToAllGuests', message);
                                $('#messages').append($('<li>').text("To all guests: " + message));
                                $('#chatInput').val('');
                            }
                        });
                    });
                </script>
            @else

                <br>
                <h2>&#128100;Guest Chat</h2>
                <ul id="messages"></ul>
                <form id="form" action="">
                    <input id="chatInput" autocomplete="off" placeholder="Type your message here..." />
                    <button type="submit">&#11166;</button>
                </form>

                <script>
                    $(function() {
                        let socket = io('http://127.0.0.1:3000');

                        // Register as a guest on the server
                        socket.emit('registerGuest');

                        // Send message to the server
                        $('#form').submit(function(e) {
                            e.preventDefault();
                            let message = $('#chatInput').val();
                            if (message) {
                                socket.emit('sendChatToServer', message);
                                $('#messages').append($('<li>').text("You: " + message));
                                $('#chatInput').val(''); // Clear input after sending
                            }
                        });

                        // Display messages from the admin
                        socket.on('sendChatToClient', function(data) {
                            let message = data.message;
                            let sender = data.from; // This will be 'admin'
                            $('#messages').append($('<li>').text(sender + ": " + message));
                        });
                    });
                </script>
            @endif
        </div>
    </div>
</body>

</html>
