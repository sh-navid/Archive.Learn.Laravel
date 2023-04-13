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
  console.log(`Server running on port 3000`);
});
