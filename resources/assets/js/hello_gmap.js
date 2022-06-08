/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new Vue({
    el: '#hello_gmap',
    data: {
        gmap: null,
        markers: [],
        result:""
    },
    mounted: async function () {
        await this.sleep(1000);   // wait until loading google map javascript
        this.map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 0, lng: 0 },
            zoom: 1
        });
        this.result = getlocation();
        console.log(this.result);
        console.log(this.result.data[0]);
        var location;
        for(var i = 0; i < this.result.data.length; i++) { 
        	this.selectaddMarker(i);
		}
    },
    methods: {
        sleep: function (msec) {
            return new Promise((resolve) => {
                setTimeout(() => { resolve() }, msec);
            })
        },
        selectaddMarker: function (number) {
        	var location = { lat: this.result.data[number].team0_lat, lng: this.result.data[number].team0_lng };
  			var marker = this.addMarker(this.result.data[number].team0_name, location);
  			this.markers.push(marker);
		  	var location = { lat: this.result.data[number].team1_lat, lng: this.result.data[number].team1_lng };
  			var marker = this.addMarker(this.result.data[number].team1_name, location);
  			this.markers.push(marker);
        },
        selectaddMarker2: function (number) {
        	this.clearMarkers();
        	for(var i = 0; i < this.result.data.length; i++) { 
        		if(i!=number){
        			this.selectaddMarker(i);
        		}
			}
        	var location = { lat: this.result.data[number].team0_lat, lng: this.result.data[number].team0_lng };
  			var marker = this.addMarker2(this.result.data[number].team0_name, location);
  			this.markers.push(marker);
		  	var location = { lat: this.result.data[number].team1_lat, lng: this.result.data[number].team1_lng };
  			var marker = this.addMarker2(this.result.data[number].team1_name, location);
  			this.markers.push(marker);
        },
        addMarkerJapan: function () {
            let location = { lat: 36.2048, lng: 138.25 };
            let marker = this.addMarker("Japan", location);
            this.markers.push(marker);
        },
        addMarkerUSA: function () {
            let location = { lat: 37.0902, lng: -95.7129 };
            let marker = this.addMarker("Japan", location);
            this.markers.push(marker);
        },
        clearMarkers: function () {
            this.markers.forEach((marker) => {
                marker.setMap(null);
            })
            this.markers = [];
        },
        addMarker(title, location, callback) {
        	var image = '/marker.gif';
        	console.log(image);
            let marker = new google.maps.Marker(
                {
                    position: location,
                    map: this.map,
                    title: title,
                    icon: image
                }
            );
            return marker;
        },
        addMarker2(title, location, callback) {
        	var image = '/marker2.gif';
        	console.log(image);
            let marker = new google.maps.Marker(
                {
                    position: location,
                    map: this.map,
                    title: title,
                    icon: image
                }
            );
            return marker;
        },
    }
});
