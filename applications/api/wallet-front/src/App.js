import { useState } from "react"

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
          {data.answers.map((item, index) => (
            <span key={index}>{item}</span>
          ))}
        </div>
      )}
    </div>
  );
};

const App = () => {
  return <Records/>;
};

export default App;
