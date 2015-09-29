import React from 'react';
import GoogleMap from 'google-map-react';

class Vendor extends React.Component {  
    render() {
        return <div className="brew-finder__marker" >{this.props.text}</div>;
    }
}

class Map extends React.Component {  
    constructor(props) {
        super(props);
        this.state = { data: [] };
    }
    loadDataFromServer() {
        $.ajax({
            url: this.props.url,
            dataType: 'jsonp',
            success: (data) => {
                this.setState({data: data.result});
                console.log(data.result[0].name);
            },
            error: (xhr, status, err) => {
                console.error(this.props.url, status, err.toString());
            }
        });
    }
    componentDidMount() {
        this.loadDataFromServer();
    }
    render() {
        const vendorNodes = this.state.data.map(vendor => {
            console.log(vendor, vendor.name, vendor.id);
            return (
                <Vendor text={vendor.quantity} lat={vendor.latitude} key={vendor.id} lng={vendor.longitude} ></Vendor>
            );
        });
        return <div className="brew-finder__container">
            <GoogleMap 
                className="brew-finder__map"
                center={this.props.map.center}
                zoom={this.props.map.zoom} >
                {vendorNodes}
            </GoogleMap>
        </div>;
    }
}

var _map = { 
    zoom: 11, 
    center: [43.76159,-79.411079]  
};
React.render(<Map url="http://lcboapi.com/stores?product_id=416818" map={_map} />, document.getElementById('map'));

