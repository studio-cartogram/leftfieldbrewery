import PropTypes from "prop-types";
import React from "react";
import Scroller from "./scroller.js";
import cx from "classnames";

export default class VendorList extends React.Component {
  filterVendors(type) {
    this.props.onFilter(type);
  }
  render() {
    return (
      <section className="rule-left brew-finder__list vendor-listing bg-cream ">
        <div className="screen">
          <ul className="vendor-filter">
            <li>
              <a
                onClick={this.filterVendors.bind(this, "bar")}
                className={cx(
                  "",
                  this.props.filter === "bar" ? "is-active" : ""
                )}
              >
                Bars
              </a>
            </li>
            <li>
              <a
                onClick={this.filterVendors.bind(this, "brew-pub")}
                className={cx(
                  "",
                  this.props.filter === "brew-pub" ? "is-active" : ""
                )}
              >
                Brew Pubs
              </a>
            </li>
            <li>
              <a
                onClick={this.filterVendors.bind(this, "restaurant")}
                className={cx(
                  "",
                  this.props.filter === "restaurant" ? "is-active" : ""
                )}
              >
                Restaurants
              </a>
            </li>
            <li>
              <a
                target="_blank"
                href="http://www.lcbo.com/lcbo/search?searchTerm=%27left+field+brewery%27"
              >
                LCBO
              </a>
            </li>
          </ul>
          <Scroller
            scrollPos={this.props.scrollPos}
            items={this.props.children}
          />
        </div>
      </section>
    );
  }
}
