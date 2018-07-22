import React, { Component } from 'react';
import Alert from 'react-s-alert';
// Css files
import 'react-s-alert/dist/s-alert-default.css';
import 'react-s-alert/dist/s-alert-css-effects/slide.css';
import 'react-s-alert/dist/s-alert-css-effects/scale.css';
import 'react-s-alert/dist/s-alert-css-effects/bouncyflip.css';
import 'react-s-alert/dist/s-alert-css-effects/flip.css';
import 'react-s-alert/dist/s-alert-css-effects/genie.css';
import 'react-s-alert/dist/s-alert-css-effects/jelly.css';
import 'react-s-alert/dist/s-alert-css-effects/stackslide.css';

class TodoList extends Component {
  constructor() {
    super();
    this.state = {
      userInput: '',
      items: this.getLocalStorage()
    }
  }

  getLocalStorage() {
    if (localStorage.getItem('items') !== null) {
      return JSON.parse(localStorage.getItem('items'))
    }
    return [];
  }

  onKeyDown(event) {
    if (event.key === "Enter" && !event.ctrlKey) {
      this.addTodo(event);
      return;
    }
    if (event.key === "Enter" && event.ctrlKey) {
      var newInput = this.state.userInput + '\n';
      this.setState({
        userInput: newInput
      });
    }
  }

  onChange(event) {
    this.setState({
      userInput: event.target.value
    });
  }

  addTodo(event) {
    event.preventDefault();

    if (this.state.userInput.trim() === '') {
      Alert.error('Impossible d\'ajouter un élément vide !', {
        position: 'top-left',
        effect: 'flip',
        timeout: 3000
      });
      return;
    }

    this.setState({
      userInput: '',
      items: [...this.state.items, { text: this.state.userInput.trim(), check: false }]
    });
    let array = this.state.items;
    array.push({ text: this.state.userInput.trim(), check: false })
    localStorage.setItem('items', JSON.stringify(array));

    Alert.success('Elément ajouté à la liste !', {
      position: 'top-left',
      effect: 'flip',
      timeout: 2000
    });
  }

  renderTodos() {
    return this.state.items.map((item, index) => {
      return (
        <div className={item.check ? "list-group-item disabled pt-3" : "list-group-item pt-3"} key={item.text}>
          {item.check ? <del> {item.text} </del> : item.text}
          <i className={item.check ? "fas fa-check btn float-right" : "fas fa-check btn float-right"} onClick={this.validateTodo.bind(this, index)}></i>
        </div>
      );
    });
  }

  validateTodo(index) {
    const array = this.state.items;
    array[index].check = !array[index].check;
    this.setState(array);
  }

  deleteTodo(event) {
    event.preventDefault();

    Alert.info('Elément supprimé !', {
      position: 'top-left',
      effect: 'flip',
      timeout: 2000
    });

    const array = this.state.items;
    const index = array.indexOf(event.target.value);
    array.splice(index, 1);
    this.setState({
      items: array
    });
  }

  render() {
    return (
      <div>
        <h1 className="mt-4 text-center">Ma To-do List</h1>
        <form>
          <div className="form-group mt-4">
            <input
              className="form-control"
              onKeyDown={this.onKeyDown.bind(this)}
              onChange={this.onChange.bind(this)}
              value={this.state.userInput}
              type="text"
              placeholder="Ajoutez une chose à faire...">
            </input>
          </div>
          <button
            className="btn btn-primary"
            onClick={this.addTodo.bind(this)}>
            Ajouter
            <i className="ml-2 far fa-plus-square"></i>
          </button>
        </form>
        <div className="list-group mt-3">
          {this.renderTodos()}
        </div>
        <Alert stack={{ limit: 3 }} />
      </div>
    );
  }
}

export default TodoList;
