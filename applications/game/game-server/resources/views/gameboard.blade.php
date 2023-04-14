<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="http://localhost:3000/socket.io/socket.io.js"></script>
        <script
            src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
            crossorigin="anonymous"
        ></script>
        <style>
            .block {
                position: absolute;
                width: 3em;
                height: 3em;
                line-height: 3em;
                text-align: center;
                color: white;
            }
        </style>
    </head>
    <body>
        <script>
            let socket = io.connect(":3000");

            let players=[]
            players[{{Auth::id()}}]={"x":50,"y":50,"color":"{{Auth::user()->color}}","name":"{{Auth::user()->name}}"}

            let current={{Auth::id()}};
            movement=50
            max=300

            let render=()=>{
                $("#board").html("")
                players.forEach(p => {
                    let b=$(`<div class='block' style='background-color:${p.color}'>${p.name}</div>`);
                    b.css({"left":p.x+"px","top":p.y+"px"});
                    $("#board").append(b);
                });
            }

            socket.on("update",  (json)=> {
                players[json.id]=json.data;
                render();
            });

            socket.on("load",  (json)=> {
                console.log(players)
                console.log(json)
                for(i in json){
                    if(i!==current && json[i]!==null){
                        players[i]=json[i]
                    }
                    //console.log(i,json[i]==null)
                }
                console.log(players)
                render();
            });

            socket.emit('update',{id:current,data:players[current]})
            socket.emit("load");

            $(document).keydown((e)=>{
                switch (e.key) {
                    case "ArrowUp":
                        players[current].y-=movement
                        if (players[current].y<0)players[current].y=0
                        break;
                    case "ArrowDown":
                        players[current].y+=movement
                        if (players[current].y>max)players[current].y=max
                        break;
                    case "ArrowLeft":
                        players[current].x-=movement
                        if (players[current].x<0)players[current].x=0
                        break;
                    case "ArrowRight":
                        players[current].x+=movement
                        if (players[current].x>max)players[current].x=max
                        break;
                    default:
                        break;
                }
                socket.emit('update',{id:current,data:players[current]})
                render();
            })
        </script>
        <a href="/logout">Logout</a>
        <div id="board"></div>
        <script>
            render();
        </script>
    </body>
</html>
