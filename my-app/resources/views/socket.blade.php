<!DOCTYPE html>
<html lang="en">
<body>
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
</body>
</html>