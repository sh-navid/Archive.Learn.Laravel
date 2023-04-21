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
