import React, {PropTypes, Component} from 'react/addons';
import shouldPureComponentUpdate from 'react-pure-render/function';
import cx from 'classnames';

export default class Vendor extends React.Component {  
    static propTypes = {
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
            <li className={this.props.vendor_type}
                onClick={this.props.onClick}
                key={this.props.key} >
                <a className="row collapse block-level">
                    <div className="columns two icon-wrap mobile-one text-center">
                        <i className="icon"></i>
                    </div>	
                    <div className="columns format-text eight rule-right rule-left">
                        <h5 className="text-small"><strong>{this.props.name}</strong></h5>
                        <h6 className="text-small">{this.props.neighbourhood}</h6>
                    </div>
                    <div className="columns two map-wrap text-center">
                        <h4>MAP</h4>
                    </div>
                </a> 
            </li>
        );
    }
}

