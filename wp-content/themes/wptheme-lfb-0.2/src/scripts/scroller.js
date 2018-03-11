import PropTypes from "prop-types";
import React, { Component } from "react";
import shouldPureComponentUpdate from "react-pure-render/function";

export default class Scroller extends React.Component {
  scrollThis() {
    let pos = React.findDOMNode(this).scrollTop;
    let newPos = this.props.scrollPos;
    if (pos !== newPos) {
      // React.findDOMNode(this).scrollTop = this.props.scrollPos;
      $(React.findDOMNode(this)).animate(
        { scrollTop: this.props.scrollPos },
        100
      );
    }
  }
  componentDidUpdate(pp, ps) {
    this.scrollThis();
  }
  // shouldComponentUpdate(nextProps, nextState) {
  //     return nextProps.scrollPos === this.props.scrollPos;
  // }
  render() {
    return (
      <div className="scrollshadow">
        <ul>{this.props.items}</ul>
      </div>
    );
  }
}
