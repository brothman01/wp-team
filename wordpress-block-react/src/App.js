import React, { Component } from 'react';

class App extends React.Component {

  constructor( props ) {
    super( props );
    this.state = {
      clicks: 0
    };
  }

  toggle = () => {
    this.setState( ( prevState ) => ( {
      clicks: prevState.clicks + 1
    } ) );
  }

  render() {
    return (
      <div>
        foobara
      </div>
    );
  }
}

export default App;