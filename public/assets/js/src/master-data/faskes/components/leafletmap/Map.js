class MapHandler {
    constructor() {
        this.map = null;
        this.marker = null;
        this.handleInputChange = this.handleInputChange.bind(this);
    }

    initMap() {
        this.map = L.map('map').setView([3.5952, 98.6722], 13); // Initial map view set to Kota Medan

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19, // Maximum zoom level
        }).addTo(this.map);

        this.map.on('click', (event) => {
            this.removeAllMarkers();
            this.handleMapClick(event.latlng);
        });

        $('#modal-faskes').on('shown.bs.modal', () => {
            this.map.invalidateSize(); // Refreshes the map to fit the modal
        });

        this.addGeocoderControl();

        $('#latitude, #longitude').on('keyup', this.debounce(() => {
            this.handleInputChange();
        }, 300));
    }

    handleMapClick(latlng) {
        const { lat, lng } = latlng;

        if (this.marker) {
            this.marker.setLatLng(latlng);
        } else {
            this.marker = L.marker([lat, lng], { draggable: true }).addTo(this.map);
        }

        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);

        this.marker.on('dragend', (event) => {
            const { lat, lng } = this.marker.getLatLng();
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
        });
    }

    removeAllMarkers() {
        if (this.marker) {
            this.map.removeLayer(this.marker); // Remove the marker from the map
            this.marker = null; // Set marker reference to null
        }
    }

    debounce(func, delay) {
        let timeoutId;
        return function () {
            const context = this;
            const args = arguments;
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(context, args), delay);
        };
    }

    isValidCoordinates(latitude, longitude) {
        return latitude >= -90 && latitude <= 90 && longitude >= -180 && longitude <= 180;
    }

    handleInputChange() {
        const latitude = parseFloat($('#latitude').val());
        const longitude = parseFloat($('#longitude').val());

        if (isNaN(latitude) || isNaN(longitude) || !this.isValidCoordinates(latitude, longitude)) {
            toastError("Invalid coordinates! Please enter valid latitude and longitude.");
        } else {
            this.setMapView(latitude, longitude);
        }
    }

    setMapView(latitude, longitude) {
        const targetLatLng = L.latLng(latitude, longitude);
        if (this.marker) {
            this.marker.setLatLng(targetLatLng);
        } else {
            this.marker = L.marker(targetLatLng, { draggable: true }).addTo(this.map);
        }
        this.map.setView(targetLatLng, 13);
    }

    setDefaultView() {
        this.map.setView([3.5952, 98.6722], 13);
        this.marker = null;
    }

    addGeocoderControl() {
        const geocoderControl = L.Control.geocoder({
            defaultMarkGeocode: false,
        }).on('markgeocode', (event) => {
            const { center } = event.geocode;
            const { lat, lng } = center;

            if (this.marker) {
                this.marker.setLatLng(center);
            } else {
                this.marker = L.marker([lat, lng], { draggable: true }).addTo(this.map);
            }

            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);

            this.marker.on('dragend', (event) => {
                const { lat, lng } = this.marker.getLatLng();
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
            });

            const viewHalf = this.map.getSize().y / 2;
            const targetPoint = this.map.project(center);
            const targetLatLng = this.map.unproject([targetPoint.x, targetPoint.y - viewHalf]);

            this.map.setView(targetLatLng, 13);
        }).addTo(this.map);
    }
}

export { MapHandler };
