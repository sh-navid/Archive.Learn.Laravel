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
    