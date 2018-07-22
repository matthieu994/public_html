import React, { Component } from 'react';

class TodoList extends Component {

  render() {
    return (
      <div>
        <h1>My Todo List</h1>
        <form>
          <input type="text" placeholder="Ajouter un todo" />
          <button>Ajouter</button>
        </form>
      </div>
    );
  }
}

export default TodoList;
