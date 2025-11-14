import React from "react";
import FormRegister from "./components/FormRegister";
import HelloWorld from "./components/HelloWorld";

const App: React.FC = () => {
  return (
    <div>
      <h1>Hello from React + TypeScript + WordPress Theme asdfasdf!</h1>
      <HelloWorld name="Yunan" />
      <FormRegister />
    </div>
  );
};

export default App;
