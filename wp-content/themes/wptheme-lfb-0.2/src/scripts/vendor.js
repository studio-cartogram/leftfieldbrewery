import PropTypes from "prop-types";
import React, { Component } from "react";
import shouldPureComponentUpdate from "react-pure-render/function";
import cx from "classnames";
import {
  vendorStyle,
  vendorStyleHover,
  vendorOverlayStyle,
  vendorOverlayStyleHover
} from "./vendor.styles.js";

export default class Vendor extends React.Component {
  static propTypes = {
    hover: PropTypes.bool,
    active: PropTypes.bool,
    text: PropTypes.string,
    address: PropTypes.string,
    vendor_type: PropTypes.string
  };
  static defaultProps = {};
  shouldComponentUpdate = shouldPureComponentUpdate;
  constructor(props) {
    super(props);
  }
  render() {
    const style =
      this.props.active || this.props.$hover ? vendorStyleHover : vendorStyle;
    const overlayStyle =
      this.props.active || this.props.$hover
        ? vendorOverlayStyleHover
        : vendorOverlayStyle;
    const mapLink = "https://maps.google.ca/?q=" + this.props.address;
    return (
      <div
        style={style}
        className={cx(
          "brew-finder__marker",
          this.props.vendor_type,
          this.props.$hover ? "marker--is-hovered" : "",
          this.props.active ? "marker--is-active" : "marker--is-inactive"
        )}
      >
        <div className="overlay" style={overlayStyle}>
          <a href={mapLink} target="_blank">
            <span
              className="overlay__name"
              dangerouslySetInnerHTML={{ __html: this.props.text }}
            />
            <span
              className="overlay__address"
              dangerouslySetInnerHTML={{ __html: this.props.neighbourhood }}
            />
          </a>
        </div>
      </div>
    );
  }
}
