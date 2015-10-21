import React, {PropTypes, Component} from 'react/addons';
import controllable from 'react-controllables';
import shouldPureComponentUpdate from 'react-pure-render/function';
import {K_SIZE} from './vendor.styles.js';
import Vendor from './vendor.jsx';
import VendorItem from './vendor-item.jsx';
import GoogleMap from 'google-map-react';

function createMapOptions(maps) {
  // next props are exposed at maps
  // "Animation", "ControlPosition", "MapTypeControlStyle", "MapTypeId",
  // "NavigationControlStyle", "ScaleControlStyle", "StrokePosition", "SymbolPath", "ZoomControlStyle",
  // "DirectionsStatus", "DirectionsTravelMode", "DirectionsUnitSystem", "DistanceMatrixStatus",
  // "DistanceMatrixElementStatus", "ElevationStatus", "GeocoderLocationType", "GeocoderStatus", "KmlLayerStatus",
  // "MaxZoomStatus", "StreetViewStatus", "TransitMode", "TransitRoutePreference", "TravelMode", "UnitSystem"
  return {
    zoomControlOptions: {
      position: maps.ControlPosition.RIGHT_CENTER,
      style: maps.ZoomControlStyle.SMALL
    },
    scrollwheel: false,
    styles: [{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]}],
    mapTypeControlOptions: {
      position: maps.ControlPosition.TOP_RIGHT
    },
    mapTypeControl: true
  };
}
class VendorList extends React.Component {  
    handleChange(type) {
        this.props.onUserInput();
    }
    render() {
        return (
            <section className="rule-left brew-finder__list vendor-listing bg-cream ">
                <div className="screen">
                    <p className="lead"><i className="icon-tap"></i>Find our beer at these all-star establishments.<br/>
                        <a className="text-small" href="">Bars</a>&nbsp;
                        <a className="text-small" href="">Restuarants</a>&nbsp;
                        <a className="text-small" href="">Brew Pubs</a>&nbsp;
                        <input 
                            type="checkbox" 
                            checked={this.props.filterLcbo} 
                            ref="onlyLcboInput" 
                            onChange={this.handleChange.bind(this)}
                       />
                    </p>
                    <div className="scrollshadow">
                        <ul >{this.props.children}</ul>
                    </div>
                </div>
            </section>
            );
    }
}
@controllable(['center', 'zoom', 'hoverKey', 'clickKey'])
class Map extends React.Component {  
    static propTypes = {
        center: PropTypes.array, // @controllable
        zoom: PropTypes.number, // @controllable
        hoverKey: PropTypes.string, // @controllable
        clickKey: PropTypes.string, // @controllable
        onCenterChange: PropTypes.func, // @controllable generated fn
        onZoomChange: PropTypes.func, // @controllable generated fn
        onHoverKeyChange: PropTypes.func, // @controllable generated fn
        openBallonIndex: PropTypes.number,
        onChildClick: PropTypes.func
    }
    static defaultProps = {
        zoom: 13, 
        center: [43.67325256259363, -79.39391286230466]
    }
    // shouldComponentUpdate = shouldPureComponentUpdate;
    constructor(props) {
        super(props);
        this.state = { 
            data: [],
            filterLcbo: false
        };
    }
    originalData
    handleUserInput() {
        const vendorTypeFilter = 'bar';
        this.setState({
            data: this.originalData.filter(function(vendor) {
                return vendor.vendor_type === vendorTypeFilter;
            })
        });
    }

    loadDataFromServer() {
        $.ajax({
            url: this.props.url,
            dataType: this.props.dataType,
            success: (data) => {
                this.originalData = data.result;
                this.setState({data: data.result});
            },
            error: (xhr, status, err) => {
                console.error(this.props.url, status, err.toString());
            }
        });
    }
    _onChildMouseEnter = (key , childProps ) => {
        this.props.onHoverKeyChange(key);
    }
    _onChildMouseLeave = (/* key, childProps */) => {
        this.props.onHoverKeyChange(null);
    }
    _onBoundsChange = (center, zoom, bounds, marginBounds) => {
        if (this.props.onBoundsChange) {
            this.props.onBoundsChange({center, zoom, bounds, marginBounds});
        } else {
            this.props.onCenterChange(center);
            this.props.onZoomChange(zoom);
        }
        console.log(center);
        console.log('on bounds change');
    }

    _onChildClick = (key, childProps) => {
        let markerId = Number(key);
        let clickedMarker = this.state.data.find(function(m) {
            return m.id === markerId;
        });
        this.props.onCenterChange([clickedMarker.latitude, clickedMarker.longitude]);
        this.props.onHoverKeyChange(key.toString());
        this.setState({hoverKey:key.toString()});
        this.setState({zoom:3});
    }
    componentDidMount() {
        this.loadDataFromServer();
    }
    render() {
        const vendorListNodes = this.state.data.map((vendor, i) => {
            var boundClick = this._onChildClick.bind(this, vendor.id);
            return (
                <VendorItem
                    name={vendor.name} 
                    vendor_type={vendor.vendor_type} 
                    lat={vendor.latitude} 
                    lng={vendor.longitude} 
                    key={vendor.id} 
                    neighbourhood={vendor.neighbourhood} 
                    onClick={boundClick}
                    >
                </VendorItem>
            );
        });
        const vendorNodes = this.state.data.map(vendor => {
            return (
                <Vendor 
                    text={vendor.name} 
                    address={vendor.address} 
                    vendor_type={vendor.vendor_type} 
                    lat={vendor.latitude} 
                    key={vendor.id} 
                    lng={vendor.longitude} 
                    $hover={this.props.hoverKey === vendor.id}  >
                </Vendor>
            );
        });
        return (
            <div className="row collapse brew-finder__container">
                <div className="columns eight push-four mobile-flush brew-finder__map">
                    <GoogleMap 
                        center={this.props.center}
                        onBoundsChange={this._onBoundsChange}
                        onChildClick={this._onChildClick}
                        onChildMouseEnter={this._onChildMouseEnter}
                        onChildMouseLeave={this._onChildMouseLeave}
                        options={createMapOptions}
                        filter={this.state.filter}
                        zoom={this.props.zoom} >
                        {vendorNodes}
                    </GoogleMap>
                </div>
                <div className="columns four sidebar pull-eight mobile-flush">
                    <VendorList 
                        onUserInput={this.handleUserInput.bind(this)}
                        filterLcbo={this.state.filterLcbo} >
                        {vendorListNodes}
                </VendorList>
            </div>
            </div>
        );
    }
}

React.render(<Map dataType='json' url="/wp-json/cartogram-api/vendors" />, document.getElementById('map'));

