import React from 'react';
import { createRoot } from 'react-dom/client';

function App() {
  return (
    <>
      <h1>Front World</h1>
    </>
  )
}

// Assuming the container exists in your HTML file
const container = document.getElementById('wrapper-front');
const root = createRoot(container);
root.render(<App />);

export default App
