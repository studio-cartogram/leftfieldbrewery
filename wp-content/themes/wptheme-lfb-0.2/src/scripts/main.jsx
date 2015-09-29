import React from 'react';
import GoogleMap from 'google-map-react';
import {markerStyle} from './markerStyles.js';

class Vendor extends React.Component {  
    render() {
        return <div style={markerStyle}>{this.props.lat}</div>;
    }
}

class Map extends React.Component {  
    render() {
        return <div className="brew-finder__container">
            <GoogleMap 
                className="brew-finder__map"
                center={this.props.map.center}
                zoom={this.props.map.zoom} >
                <Vendor lat={43.76159} lng={-79.411079} />
            </GoogleMap>
        </div>;
    }
}

var _map = { zoom: 4, center: [43.76159,-79.411079]  };

React.render(<Map map={_map} />, document.getElementById('map'));

