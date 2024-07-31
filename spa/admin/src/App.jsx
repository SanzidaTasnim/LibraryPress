import React from 'react';
import { createRoot } from 'react-dom/client';

function App() {
  return (
    <>
      <h1>hello world</h1>
    </>
  )
}

// Assuming the container exists in your HTML file
const container = document.getElementById('librarypress_container');
const root = createRoot(container);
root.render(<App />);

export default App;
