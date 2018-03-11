import PropTypes from "prop-types";
import React, { Component } from "react";
import shouldPureComponentUpdate from "react-pure-render/function";
import cx from "classnames";

export default class Vendor extends React.Component {
  static propTypes = {
    active: PropTypes.bool,
    name: PropTypes.string,
    vendor_type: PropTypes.string,
    onClick: PropTypes.func,
    key: PropTypes.string,
    neighbourhood: PropTypes.string
  };
  static defaultProps = {};
  shouldComponentUpdate = shouldPureComponentUpdate;
  constructor(props) {
    super(props);
  }
  updateScrollPos(pos) {
    this.props.onScrollVendorList(pos);
  }
  componentWillUpdate(pp, ps) {
    if (pp.active) {
      let pos2 = React.findDOMNode(this).offsetTop;
      this.updateScrollPos(pos2);
    }
  }
  render() {
    const mapLink =
      "https://www.google.com/maps/dir/Current+Location/" + this.props.address;
    return (
      <li
        onClick={this.props.onClick}
        className={cx(
          "vendor-item",
          this.props.vendor_type,
          this.props.$hover ? "vendor-item--is-hovered" : "",
          this.props.active
            ? "vendor-item--is-active"
            : "vendor-item--is-inactive"
        )}
        key={this.props.key}
      >
        <a className="row collapse block-level">
          <div className="columns two icon-wrap mobile-one text-center">
            <i className="icon" />
          </div>
          <div className="columns format-text ten rule-left">
            <h5 className="text-small">
              <strong dangerouslySetInnerHTML={{ __html: this.props.name }} />
            </h5>
            <h6
              className="text-small"
              dangerouslySetInnerHTML={{ __html: this.props.neighbourhood }}
            />
          </div>
        </a>

        <a href={mapLink} target="_blank" className="link--get-directions">
          Get directions 123
        </a>
      </li>
    );
  }
}
