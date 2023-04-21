# API
## ReactJS
- `npx create-react-app wallet-front`
    - `cd wallet-front`
    - `npm start`
- `package.json`
    - `"proxy":"http://localhost:8000"`
- ~~~js
    import { useState } from "react";

    const Records = () => {
    const [data, setData] = useState([]);
    const [isLoading, setLoading] = useState(true);

    useState(() => {
        setTimeout(() => {
        fetch("http://localhost:8000/api/record/list")
            .then((res) => res.json())
            .then((res) => {
            console.log(res);
            setData(res);
            setLoading(false);
            });
        }, 3000);
    }, []);

    return (
        <div>
        {isLoading == true ? (
            <span>Loading ...</span>
        ) : (
            <div>
            {data.map((item, index) => (
                <div>
                {item.amount} - {item.type}
                </div>
            ))}
            </div>
        )}
        </div>
    );
    };

    const App = () => {
    return <Records />;
    };

    export default App;
  ~~~
## Laravel
- `composer create-project laravel/laravel wallet-back`
- in `api.php`
- ~~~php
    Route::get("/record/list", function () {
        $data = json_encode([
            ["amount" => 12000, "type" => "IN"],
            ["amount" => 12000, "type" => "IN"],
            ["amount" => 12000, "type" => "IN"]
        ]);

        return response($data, 200)
            ->header('Content-Type', 'application/json');
    });
  ~~~
- change users migration
- ~~~php
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('api_token', 60)
                ->unique()
                ->nullable()
                ->default(null);
            $table->rememberToken();
            $table->timestamps();
        });
  ~~~
- fix database password in `.env` file
- `php artisan migrate:fresh`
- change user model
- ~~~php
    protected $fillable = [
        'username',
        'api_token',
        'password',
    ];
  ~~~
- call `localhost:8000/api/login` with postman; post method and username and password in form data
- ~~~php
    Route::get('fake', function () {
        User::create([
            "username" => "test",
            "password" => Hash::make("123"),
            "api_token" => null
        ]);
        return "User Created";
    });


    Route::post('register', function (Request $request) {
        $request["password"] = Hash::make($request->password);
        $user = User::create($request->only("username", "password"));
        return $user;
    });


    Route::post('login', function (Request $request) {
        if (Auth::attempt($request->only("username", "password"))) {
            $user = User::find(Auth::user()->id);
            $user->api_token = Str::random(60);
            $user->save();
            return Auth::user()->fresh();
        }
        return response()->json(['error' => 'Not authenticated', 'data' => $request->only("username")], 401);
    });


    Route::post('logout', function (Request $request) {
        $user = User::where("api_token", $request->api_token);
        $user->api_token = null;
        $user->save();
        return response()->json(['message' => 'You are logged out']);
    });
  ~~~
- **NOTICE**: This is not the BEST PRACTICE; read about `auth:sanctum` and `passport` instead 