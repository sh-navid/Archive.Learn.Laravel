# Laravel
## SocketIO
- Install NodeJS
- Run [Socket Server](socket-server.js) using below commands
    - `npm install`
    - `node socket-server.js`
        - ~~~php
            'use strict';

            const exp = require('express')
            const app = exp()
            const server = require('http').createServer(app)
            const prt = process.env.PORT || 3000
            const io = require("socket.io")(server, {
                cors: {
                    origin: `*`,
                    methods: ["GET", "POST"]
                }
            });

            io.on('connection', async socket => {
                console.log('A client connected');

                socket.on('hi', async json => {
                    // io.to(socket.id).emit('hey', "Hello to caller");
                    io.emit('hey', "Hello to all");
                })
            })

            server.listen(prt, () => {
                console.log(`Server running on port: ${prt}`)
            })
          ~~~
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