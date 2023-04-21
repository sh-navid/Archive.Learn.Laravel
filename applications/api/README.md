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