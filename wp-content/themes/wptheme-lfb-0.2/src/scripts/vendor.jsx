import React, {PropTypes, Component} from 'react/addons';
import shouldPureComponentUpdate from 'react-pure-render/function';
import cx from 'classnames';
import {vendorStyle, vendorStyleHover, vendorOverlayStyle, vendorOverlayStyleHover} from './vendor.styles.js';

export default class Vendor extends React.Component {  
    static propTypes = {
        hover: PropTypes.bool,
        text: PropTypes.string,
        address: PropTypes.string,
        vendor_type: PropTypes.string
    }
    static defaultProps = {
    }
    shouldComponentUpdate = shouldPureComponentUpdate;
    constructor(props) {
        super(props);
    }
    render() {
        const style = this.props.$hover ? vendorStyleHover : vendorStyle;
        const overlayStyle = this.props.$hover ? vendorOverlayStyleHover : vendorOverlayStyle;
        return (
            <div style={style} 
                className={cx('brew-finder__marker',
                    this.props.vendor_type,
                    this.props.$hover ? 'marker--is-active' : 'marker--is-inactive'
                )}> 
                <div className="overlay" style={overlayStyle}>
                    <span className="overlay__name">{this.props.text}</span>
                    <span className="overlay__address">{this.props.address}</span>
                </div>
            </div>
        );
    }
}

