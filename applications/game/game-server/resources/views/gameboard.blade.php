<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    </head>
    <body>
        <script>
            let socket = io.connect(":3000");

            socket.on("update", function (msg) {
                d = document.getElementById("holder");
                d.innerHTML += "<br/>" + msg;
            });
        </script>
        <a href="/logout">Logout</a>
        <div id="holder"></div>
        <button onclick="socket.emit('update')">update</button>
    </body>
</html>
