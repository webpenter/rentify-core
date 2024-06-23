import React from 'react';
import Sidebar from './components/Sidebar';
import ItemList from './components/ItemList';
import ItemContent from './components/ItemContent';

function App() {
  return (
      <div className="flex h-screen">
        <Sidebar />
        <ItemList />
        <ItemContent />
      </div>
  );
}

export default App;
