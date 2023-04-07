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
        // io.to(socket.id).emit('hey', "Hello to all");
        io.emit('hey', "Hello to all");
    })
})

server.listen(prt, () => {
    console.log(`Server running on port: ${prt}`)
})