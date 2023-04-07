# Laravel
## SocketIO
- Install NodeJS
- Run [Socket Server](socket-server.js) using below commands
    - `npm install`
    - `node socket-server.js`
- `socket.blade.php`
    - ~~~php
        <script src="http://localhost:3000/socket.io/socket.io.js"></script>

        <script>
            var socket = io.connect(':3000');

            socket.on('hey', function(msg) {
                d=document.getElementById("holder")
                d.innerHTML+="<br/>"+msg;
            });
        </script>

        <div id="holder"></div>
        <button onclick="socket.emit('hi')">hi</button>
      ~~~
- in `web.php`
    - `Route::view('/hihi',  "socket");`