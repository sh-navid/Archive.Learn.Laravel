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
- Change user schema like this
    - ~~~php
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('password');
            $table->string('color', 7);
            $table->rememberToken();
            $table->timestamps();
        });
      ~~~
    - Add mysql password in `.env`
    - Run `php artisan migrate`
    - Run `php artisan migrate:fresh`
- Change user model like this
    - ~~~php
        protected $fillable = [
            'name',
            'color',
            'password',
        ];
      ~~~
- Make `register.blade.php` for register new user
    - ~~~php
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <input type="color" name="color"/>
            <input type="submit" value="Register">
        </form>
      ~~~
- Make a route in `web.php`
    - ~~~php
        Route::view("/register", "register");
        Route::post("/register", function (Request $request) {
            $request["password"] = Hash::make($request['password']);
            User::create($request->all());
            return redirect("login")->with('msg', 'You are a user now');
        });
      ~~~
- Make `login.blade.php` for login
    - ~~~php
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <input type="submit" value="Login">
        </form>
        <a href="/register">Go to register page</a>
      ~~~
- Make a route in `web.php`
    - ~~~php
        Route::view("/login", "login");
        Route::post("/login", function (Request $request) {
            if (Auth::attempt($request->only('name', 'password')))
                return redirect('gameboard');
            return redirect("login");
        });
      ~~~
- Also make a route for logout in `web.php`
    - ~~~php
        Route::get("/logout", function () {
            Session::flush();
            Auth::logout();
            return Redirect('gameboard');
        });
      ~~~
- Make `gameboard.blade.php` for register new user
    - ~~~php
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
      ~~~
- Make a route for gameboard in `web.php`
    - ~~~php
        Route::get("/gameboard", function () {
            if (Auth::check())
                return view('gameboard');
            return redirect("login");
        });
      ~~~
    