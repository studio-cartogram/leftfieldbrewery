import React, {PropTypes, Component} from 'react/addons';
import shouldPureComponentUpdate from 'react-pure-render/function';
import Scroller from './scroller.jsx';
import cx from 'classnames';

export default class VendorList extends React.Component {  
    filterVendors(type) {
        this.props.onFilter(type);
    }
    render() {
        return (
            <section className="rule-left brew-finder__list vendor-listing bg-cream ">
                <div className="screen">
                    <p className="lead"><i className="icon-tap"></i>Find our beer at these all-star establishments.</p>
                    <nav className="vendor-filter">
                        <a onClick={this.filterVendors.bind(this, '')} className={cx(this.props.filter === '' ? 'is-active' : '')}>All</a>
                        <a onClick={this.filterVendors.bind(this, 'bar')} className={cx(this.props.filter === 'bar' ? 'is-active' : '')}>Bars</a>
                        <a onClick={this.filterVendors.bind(this, 'lcbo')} className={cx(this.props.filter === 'lcbo' ? 'is-active' : '')}>LCBO</a>
                        <a onClick={this.filterVendors.bind(this, 'brew-pub')} className={cx(this.props.filter === 'brew-pub' ? 'is-active' : '')}>Brew Pubs</a>
                        <a onClick={this.filterVendors.bind(this, 'restaurant')} className={cx(this.props.filter === 'restaurant' ? 'is-active' : '')}>Restaurant</a>
                    </nav>
                    <Scroller scrollPos={this.props.scrollPos} items={this.props.children} >
                    </Scroller>
                </div>
            </section>
        );
    }
}
