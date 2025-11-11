import React from "react";

interface HelloWorldProps {
  name: string;
}

const HelloWorld: React.FC<HelloWorldProps> = ({ name }) => {
  return <p>Welcome, {name}! Your React component is working inside WordPress.</p>;
};

export default HelloWorld;
