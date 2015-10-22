import React, {PropTypes, Component} from 'react/addons';
import shouldPureComponentUpdate from 'react-pure-render/function';
import cx from 'classnames';

export default class Vendor extends React.Component {  
    static propTypes = {
        active: PropTypes.bool,
        name: PropTypes.string,
        vendor_type: PropTypes.string,
        onClick: PropTypes.func,
        key: PropTypes.string,
        neighbourhood: PropTypes.string
    }
    static defaultProps = {
    }
    shouldComponentUpdate = shouldPureComponentUpdate;
    constructor(props) {
        super(props);
    }
    render() {
        return (
            <li
                onClick={this.props.onClick}
                className={cx('vendor-item',
                    this.props.vendor_type,
                    this.props.$hover ? 'vendor-item--is-hovered' : '',
                    this.props.active ? 'vendor-item--is-active' : 'vendor-item--is-inactive'
                )}
                key={this.props.key} >
                <a className="row collapse block-level">
                    <div className="columns two icon-wrap mobile-one text-center">
                        <i className="icon"></i>
                    </div>	
                    <div className="columns format-text ten rule-right rule-left">
                        <h5 className="text-small" ><strong dangerouslySetInnerHTML={{__html: this.props.name}}></strong></h5>
                        <h6 className="text-small" dangerouslySetInnerHTML={{__html: this.props.neighbourhood}}></h6>
                    </div>
                </a> 
            </li>
        );
    }
}

