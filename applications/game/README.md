# Game Project
## Socket.IO
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
    - run `npm install --save socket.io`
    - run `npm install --save express`
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
    - run `node server.js`
## Laravel