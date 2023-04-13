# Game Project
## Socket.IO
- Redirect to `game-socket` folder
- Make a file and call it `package.json`
    - ~~~json
        {
            "name": "game-socket-server",
            "version": "0.0.1",
            "dependencies": {}
        }
      ~~~
- Make another file and call it `server.js`
    - ~~~js
        "use strict";

        const express = require("express");
        const app = express();
        const server = require("http").createServer(app);
        const io = require("socket.io")(server, {
            cors: { origin: `*`, methods: ["GET", "POST"] },
        });

        io.on("connection", async (socket) => {
            socket.on("update", async (json) => {
                io.emit("update", json);
            });
        });

        server.listen(3000, () => {
            onsole.log(`Server running on port 3000`);
        });
      ~~~
- Redirect to folder and run `npm install`
    - Run `npm install --save socket.io`
    - Run `npm install --save express`
    - Now `package.json` should be changed to
        - ~~~js
            {
            "name": "game-socket-server",
            "version": "0.0.1",
            "dependencies": {
                "express": "^4.18.2",
                "socket.io": "^4.6.1"
            }
            }
          ~~~~
    - Run `node server.js`
## Laravel
- Go to root folder of project and make a laravel project
    - `composer create-project laravel/laravel game-server`