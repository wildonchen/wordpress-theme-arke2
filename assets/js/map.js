/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-10-29 21:10:04 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 16:08:13
 */
var setPoint;
function bdmap(here) {
    var clientHeight = document.body.clientHeight;
    document.getElementById('my-map').style.height = clientHeight + "px";
    var map = new BMapGL.Map("my-map");
    var point = new BMapGL.Point(108.5525, 34.3227);
    map.centerAndZoom(point, 5);
    if (here) {
        var myGeo = new BMapGL.Geocoder();
        // 将地址解析结果显示在地图上，并调整地图视野
        myGeo.getPoint(here, function (point) {
            if (point) {
                map.centerAndZoom(point, 16);
            }
        })

        point = new BMapGL.Point(108.5525, 34.3227);
        map.centerAndZoom(point, 5);
    }
    map.enableScrollWheelZoom(true);
    map.setMinZoom(5);
    map.setMaxZoom(18);
    var styleJson = [{
        "featureType": "water",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "color": "#cad2d3ff"
        }
    }, {
        "featureType": "green",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "color": "#dee5e5ff"
        }
    }, {
        "featureType": "building",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "building",
        "elementType": "geometry.topfill",
        "stylers": {
            "color": "#d1dbdbff"
        }
    }, {
        "featureType": "building",
        "elementType": "geometry.sidefill",
        "stylers": {
            "color": "#d1dbdbff"
        }
    }, {
        "featureType": "building",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#aab6b6ff"
        }
    }, {
        "featureType": "subwaystation",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "color": "#888fa0ff"
        }
    }, {
        "featureType": "education",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "color": "#e1e7e7ff"
        }
    }, {
        "featureType": "medical",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "color": "#d1dbdbff"
        }
    }, {
        "featureType": "scenicspots",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "color": "#d1dbdbff"
        }
    }, {
        "featureType": "highway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "weight": 4
        }
    }, {
        "featureType": "highway",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "highway",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#cacfcfff"
        }
    }, {
        "featureType": "highway",
        "elementType": "labels",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "highway",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "highway",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "highway",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "arterial",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "weight": 2
        }
    }, {
        "featureType": "arterial",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#fbfffeff"
        }
    }, {
        "featureType": "arterial",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#cacfcfff"
        }
    }, {
        "featureType": "arterial",
        "elementType": "labels",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "arterial",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "arterial",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "local",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "weight": 3
        }
    }, {
        "featureType": "local",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#fbfffeff"
        }
    }, {
        "featureType": "local",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#cacfcfff"
        }
    }, {
        "featureType": "local",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "local",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "local",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "railway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "weight": 3
        }
    }, {
        "featureType": "railway",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#9494941a"
        }
    }, {
        "featureType": "railway",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#ffffff1a"
        }
    }, {
        "featureType": "subway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "weight": 3
        }
    }, {
        "featureType": "subway",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#c3bed433",

        }
    }, {
        "featureType": "subway",
        "elementType": "labels",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "subway",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#979c9aff"
        }
    }, {
        "featureType": "subwaystation",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "continent",
        "elementType": "labels",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "continent",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "continent",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#333333ff"
        }
    }, {
        "featureType": "continent",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "city",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "city",
        "elementType": "labels",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "city",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#454d50ff"
        }
    }, {
        "featureType": "city",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "town",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "town",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "town",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#454d50ff"
        }
    }, {
        "featureType": "town",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "road",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "road",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#fbfffeff"
        }
    }, {
        "featureType": "poilabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "districtlabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "poilabel",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "districtlabel",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#888fa0ff"
        }
    }, {
        "featureType": "transportation",
        "elementType": "geometry",
        "stylers": {
            "color": "#d1dbdbff"
        }
    }, {
        "featureType": "companylabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "restaurantlabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "lifeservicelabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "carservicelabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "financelabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "otherlabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "village",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "district",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "land",
        "elementType": "geometry",
        "stylers": {
            "color": "#f4f4f2ff"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#cacfcfff"
        }
    }, {
        "featureType": "provincialway",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#cacfcfff"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#cacfcfff"
        }
    }, {
        "featureType": "road",
        "elementType": "geometry.stroke",
        "stylers": {
            "color": "#cacfcfff"
        }
    }, {
        "featureType": "subwaylabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "subwaylabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "tertiarywaysign",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "tertiarywaysign",
        "elementType": "labels",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "provincialwaysign",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "provincialwaysign",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "nationalwaysign",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "nationalwaysign",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "highwaysign",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "highwaysign",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#fbfffeff"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "provincialway",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "highway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "highway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "highway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "highway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "highway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "highway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "highway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "highway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "highway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "nationalway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "nationalway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "nationalway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "nationalway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "provincialway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "8,8",
            "level": "8"
        }
    }, {
        "featureType": "provincialway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "8,8",
            "level": "8"
        }
    }, {
        "featureType": "provincialway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "8,8",
            "level": "8"
        }
    }, {
        "featureType": "cityhighway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "cityhighway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "cityhighway",
        "stylers": {
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "6"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "7"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "labels",
        "stylers": {
            "visibility": "off",
            "curZoomRegionId": "0",
            "curZoomRegion": "6,8",
            "level": "8"
        }
    }, {
        "featureType": "cityhighway",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#fbfffeff"
        }
    }, {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#8f5a33ff"
        }
    }, {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "country",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#8f5a33ff"
        }
    }, {
        "featureType": "country",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "country",
        "elementType": "labels.text",
        "stylers": {
            "fontsize": 28
        }
    }, {
        "featureType": "manmade",
        "elementType": "geometry",
        "stylers": {
            "color": "#dfe7e7ff"
        }
    }, {
        "featureType": "provincialway",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#fbfffeff"
        }
    }, {
        "featureType": "tertiaryway",
        "elementType": "geometry.fill",
        "stylers": {
            "color": "#fbfffeff"
        }
    }, {
        "featureType": "manmade",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "manmade",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "scenicspots",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "scenicspots",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "airportlabel",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "airportlabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "scenicspotslabel",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "scenicspotslabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "educationlabel",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "educationlabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "medicallabel",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "medicallabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "companylabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "restaurantlabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "hotellabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "hotellabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "shoppinglabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "shoppinglabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "lifeservicelabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "carservicelabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "transportationlabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "on",
        }
    }, {
        "featureType": "transportationlabel",
        "elementType": "labels",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "financelabel",
        "elementType": "labels.icon",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "entertainment",
        "elementType": "geometry",
        "stylers": {
            "color": "#d1dbdbff"
        }
    }, {
        "featureType": "estate",
        "elementType": "geometry",
        "stylers": {
            "color": "#d1dbdbff"
        }
    }, {
        "featureType": "shopping",
        "elementType": "geometry",
        "stylers": {
            "color": "#d1dbdbff"
        }
    }, {
        "featureType": "education",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "education",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "medical",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "medical",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "transportation",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#999999ff"
        }
    }, {
        "featureType": "transportation",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#ffffffff"
        }
    }, {
        "featureType": "country",
        "elementType": "labels.text.fill",
        "stylers": {
            "color": "#9ca0a3ff"
        }
    },
    {
        "featureType": "country",
        "elementType": "labels.text.stroke",
        "stylers": {
            "color": "#707070ff"
        }
    }, {
        "featureType": "subwaystation",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "footbridge",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "crosswalk",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on"
        }
    }, {
        "featureType": "underpass",
        "elementType": "geometry",
        "stylers": {
            "visibility": "off"
        }
    }, {
        "featureType": "scenicspots",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "color": "#eef0efff"
        }
    }, {
        "featureType": "scenicspotsway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "weight": 3
        }
    }, {
        "featureType": "universityway",
        "elementType": "geometry",
        "stylers": {
            "visibility": "on",
            "weight": 3
        }
    }
    ];
    map.setMapStyleV2({
        styleJson: styleJson
    });
    function setPointFunc(city, img = true, con = null) {
        //创建地址解析器实例
        var myGeo = new BMapGL.Geocoder();
        // 将地址解析结果显示在地图上，并调整地图视野
        myGeo.getPoint(city, function (point) {
            if (point) {
                var marker = new BMapGL.Marker(point);
                if (img != false) {
                    marker = new BMapGL.Marker(point, { icon: new BMapGL.Icon(img, new BMapGL.Size(24, 24)) });
                }
                map.addOverlay(marker);
                marker.addEventListener('click', function (e) {
                    if (document.getElementById("pointBox")) {
                        pointBoxClose();
                    }
                    var box = document.createElement("div");
                    box.id = "pointBox";
                    var conAry = con.split('||');
                    var conCon = con;
                    if (conAry[0]) {
                        //url 标题，内容，时间
                        var imgStr = img.replace(/_24/g, "_92");
                        imgStr = imgStr.replace(/\/circle,r_100/g, "");
                        conCon = '<div class="map-con-box"><div class="map-img"><img src="' + imgStr + '"  onclick="imgLightbox.open(this)"/></div><div class="map-con"><h2 class="map-con-title"><a class="a-hover-underline" href="' + conAry[0] + '" rel="noreferrer" target="_blank">' + conAry[1] + '</a></h2><div class="map-con-text"><span class="map-con-location"><i class="icon-location"></i><a class="a-hover-underline" href="javascript:bdmap(\'' + city + '\');">' + city + '</a></span>&nbsp;&nbsp;' + conAry[2] + '</div></div></div>';
                    }
                    box.innerHTML = '<div id="pointCon" class="point-con site-content fix-width fadeIn animated">' + conCon + '<div class="point-close" onclick="pointBoxClose();">&Cross;</div></div>';
                    document.getElementById('site-content').appendChild(box);
                    //map.centerAndZoom(point, 16);
                    var conBox = document.getElementById('pointCon');
                    var ev = e || event;
                    // 点击位置在窗口的坐标
                    if (ev.clientY < (clientHeight / 2)) {
                        conBox.classList.remove("point-con-top");
                        conBox.classList.add("point-con-bottom");
                    }
                    else {

                        conBox.classList.add("point-con-top");
                        conBox.classList.remove("point-con-bottom");
                    }


                });

            }
        })
    }
    setPoint = setPointFunc;
    mapCon();
}
function pointBoxClose() {
    document.getElementById('site-content').removeChild(document.getElementById("pointBox"));
};