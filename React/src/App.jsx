import React, { useState } from 'react';


function CounterApp() {
  const [count, setCount] = useState(0);
  return (
    <div className="app-box">
      <h3>Számláló</h3>
      <p>Érték: {count}</p>
      <button onClick={() => setCount(count + 1)}> + </button>
      <button onClick={() => setCount(count - 1)}> - </button>
    </div>
  );
}


function TodoApp() {
  const [todos, setTodos] = useState([]);
  const [input, setInput] = useState("");

  const add = () => {
    if (input) {
      setTodos([...todos, input]);
      setInput("");
    }
  };

  return (
    <div className="app-box">
      <h3>Teendők</h3>
      <input value={input} onChange={(e) => setInput(e.target.value)} />
      <button onClick={add}>Hozzáad</button>
      <ul>
        {todos.map((t, i) => <li key={i}>{t}</li>)}
      </ul>
    </div>
  );
}


export default function App() {
  const [page, setPage] = useState('home');

  return (
    <div className="spa-wrapper">
      <nav>
        <button onClick={() => setPage('home')}>Főoldal</button>
        <button onClick={() => setPage('counter')}>Számláló</button>
        <button onClick={() => setPage('todo')}>Teendők</button>
      </nav>
      <main>
        {page === 'home' && <h2>Üdv az SPA-ban!</h2>}
        {page === 'counter' && <CounterApp />}
        {page === 'todo' && <TodoApp />}
      </main>
    </div>
  );
}
