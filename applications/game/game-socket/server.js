"use strict";

const express = require("express");
const app = express();
const server = require("http").createServer(app);
const io = require("socket.io")(server, {
  cors: { origin: `*`, methods: ["GET", "POST"] },
});


let players=[]

io.on("connection", async (socket) => {
  console.log("A user is connected");

  socket.on("update", async (json) => {
    console.log(json);
    players[json.id]=json.data
    io.emit("update", json);
  });

  socket.on("load",async (json)=>{
    io.to(socket.id).emit("load", players);
  })
});

server.listen(3000, () => {
  console.log(`Server running on port 3000`);
});
