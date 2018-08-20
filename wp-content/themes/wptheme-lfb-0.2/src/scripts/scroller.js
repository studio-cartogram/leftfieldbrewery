import PropTypes from "prop-types";
import React from "react";
import ReactDOM from "react-dom";

export default class Scroller extends React.Component {
  scrollThis() {
    let pos = ReactDOM.findDOMNode(this).scrollTop;
    let newPos = this.props.scrollPos;
    if (pos !== newPos) {
      // React.findDOMNode(this).scrollTop = this.props.scrollPos;
      $(ReactDOM.findDOMNode(this)).animate(
        { scrollTop: this.props.scrollPos },
        100
      );
    }
  }
  componentDidUpdate(pp, ps) {
    this.scrollThis();
  }

  render() {
    return (
      <div className="scrollshadow">
        <ul>{this.props.items}</ul>
      </div>
    );
  }
}
