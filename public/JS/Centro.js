class SortlyApp {

    constructor() {

        this.centers = [

            {
                id: 1,
                name: "Recicla 503",
                lat: 13.702,
                lon: -89.208,
                img: "https://lh3.googleusercontent.com/p/AF1QipMng6S5K0S38a4tXS8A3isEO8VrPg3UPZxD4-bH=s680-w680-h510-rw"
            },

            {
                id: 2,
                name: "Ayala Center",
                lat: 13.715,
                lon: -89.225,
                img: "https://lh3.googleusercontent.com/gps-cs-s/APNQkAG3bj4hK6tYpbNnkiWZz5kfSFU_Ys24K0cZiLC_px5wjpqCwnZ5Z0DJVkhITTDl4KJbjIYKKakvaIJyrT-qvBmrHs2Mk4Z_gQ7-q5yUAD82YDwNhxr5ek_9wKvizw9SimrEhUWJJZz_mXAx=s680-w680-h510-rw"
            },

            {
                id: 3,
                name: "RECITODO",
                lat: 13.695,
                lon: -89.182,
                img: "https://scontent.fsal3-1.fna.fbcdn.net/v/t39.30808-6/335008077_1034067381330068_7762215020434452190_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=yIukCXOkj5sQ7kNvwE6f9Sp&_nc_oc=AdoZxfSGJ8hh2e3Ov4u90-DFKoNJIKbr25_9UIq24TfLkrGrDYcANwvLqDU7vCkA9qk&_nc_zt=23&_nc_ht=scontent.fsal3-1.fna&_nc_gid=loWf_E36H9T5q8qjZZ9dNA&_nc_ss=7b289&oh=00_Af4FGxYvYPHKWWeNvbrruIXYxkf0aEC2fa0WNCBwe1i1xw&oe=6A0B54CA"
            },

            {
                id: 4,
                name: "CLUSA EL SALVADOR",
                lat: 13.704361942348445,
                lon: -89.24591281642097,
                img: "https://lh3.googleusercontent.com/gps-cs-s/APNQkAESNHuUtZ5DffrDD-dF79I1RND0qH7io1-sUS60_BIf3q9l6_1BsH3ufI4hlm40P3y77KH3vMGOseYYRH_VtsYysppkfXNBSiFUuvC4Q5z8ITVVNn1yM-cehC7vMhd2l0ErKpW5Pw=w426-h240-k-no"
            },

            {
                id: 5,
                name: "Recicladora La Centroamericana S.A.",
                lat: 13.701696520569248,
                lon: -89.18419111787341,
                img: "https://lh3.googleusercontent.com/p/AF1QipPKVG__P6RLXjKvb65XNP_FCYaMRQE6XBiCap9v=s680-w680-h510-rw"
            },

            {
                id: 6,
                name: "CONAVE",
                lat: 13.701369800037481,
                lon: -89.1667128557993,
                img: "https://lh3.googleusercontent.com/p/AF1QipNgKc2pvbqsFpHttpHaphFOoRFqf0Iaij7HO1or=s680-w680-h510-rw"
            },

            {
                id: 7,
                name: "Centro de Reciclaje San Salvador",
                lat: 13.6989,
                lon: -89.2125,
                img: "https://cdn-pro.elsalvador.com/wp-content/uploads/2024/03/2-7.jpg" 
            },

            {
                id: 8,
                name: "Eco-Acopio Santa Tecla",
                lat: 13.6767,
                lon: -89.2797,
                img: "https://instagram.fsal2-2.fna.fbcdn.net/v/t51.75761-15/501798182_18507338959039983_6091931181941409900_n.webp?_nc_cat=104&ig_cache_key=MzY0MTQzNDE2NTU0MzgwNTEwMg%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkZFRUQueHBpZHMuMTQ0MC5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=GSbUc9Z1n88Q7kNvwGpZ4Cf&_nc_oc=AdoLsE_DBr6JU-5Q6VvSXQdtPPxVtagMjnVjEPT99zKNpCVg1SZf-dym1gDcKHFke4I&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=instagram.fsal2-2.fna&_nc_gid=VeENdMuy_E3ZNrfW9CLCjg&_nc_ss=7a22e&oh=00_Af7UEN2yKaI3rONVkqyybhnM0QhsujYvYv4JDuVZiEOiuQ&oe=6A13B4B0"
            },

            {
                id: 9,
                name: "EcoSalva - Ecología Salvadoreña",
                lat: 13.7980,
                lon: -89.1808,
                img: "https://ecosalva.com/images/Untitled-2.png"
            },

            {
                id: 10,
                name: "Grupo Palacios Recycling",
                lat: 13.7411,
                lon: -89.4304,
                img: "https://scontent.fsal2-2.fna.fbcdn.net/v/t39.30808-6/297734416_107610422050218_3294168199536853704_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=yMs4N4NarbsQ7kNvwGewARM&_nc_oc=Adoc2Xlq3XDhsJLudyI2yZQ4zTwWdKNVgzq5Lp0hMrs96jlHli6sswc-kJmS3DZKWB0&_nc_zt=23&_nc_ht=scontent.fsal2-2.fna&_nc_gid=Q955O01r6l87PQXApKI1xw&_nc_ss=7b2a8&oh=00_Af7hsFhfNsWK645Ng7a_fWlNoJ2EEAVfjDZ4zkLmykepkA&oe=6A13A232"
            } 

        ];

        this.map = null;
        this.routingControl = null;
        this.userCoords = null;
        this.userMarker = null;
        this.markers = [];
        this.filteredCenters = [];
        this.currentIndex = 0;

        this.init();
    }

    init() {

        this.map = L.map('map', {
            zoomControl: false
        }).setView([13.69, -89.21], 13);

        L.tileLayer(
            'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png'
        ).addTo(this.map);

        this.map.on('click', (e) => {

            this.setUserLocation(
                e.latlng.lat,
                e.latlng.lng
            );

        });

        this.bindUI();

        this.renderCards(this.centers);
    }

    bindUI() {

        document
            .getElementById('busqueda')
            .addEventListener('keyup', (e) => {

                this.search(e.target.value);

            });

        document
            .querySelector('.btn-location')
            .addEventListener('click', () => {

                this.getMyLocation();

            });

        document
            .querySelector('.btn-close')
            .addEventListener('click', () => {

                this.togglePanel(false);

            });

        document
            .querySelector('.btn-clear-route')
            .addEventListener('click', () => {

                this.clearRoute();

            });

        document
            .getElementById('panel-tab')
            .addEventListener('click', () => {

                this.togglePanel(true);

            });

        document
            .getElementById('nextBtn')
            .addEventListener('click', () => {

                this.nextCard();

            });

        document
            .getElementById('prevBtn')
            .addEventListener('click', () => {

                this.prevCard();

            });

    }

    renderCards(data) {

        this.filteredCenters = data;

        this.currentIndex = 0;

        this.updateSlider();

        this.markers.forEach(marker => {

            this.map.removeLayer(marker);

        });

        this.markers = [];

        const centerIcon = L.divIcon({

            className: 'custom-marker',

            html: `
                <div class="marker-pin">
                    ♻
                </div>
            `,

            iconSize: [34, 34],
            iconAnchor: [17, 17]

        });

        data.forEach(center => {

            const marker =
                L.marker(
                    [center.lat, center.lon],
                    {
                        icon: centerIcon
                    }
                ).addTo(this.map);

            marker.bindPopup(`
                <strong>${center.name}</strong>
            `);

            this.markers.push(marker);

        });

    }

    updateSlider() {

        const container =
            document.getElementById('cards');

        container.innerHTML = "";

        const center =
            this.filteredCenters[this.currentIndex];

        if (!center) return;

        const card =
            document.createElement('div');

        card.className = 'card';

        card.innerHTML = `
            <img src="${center.img}" alt="${center.name}">

            <div class="card-content">

                <div class="card-title">
                    ${center.name}
                </div>

                <div class="card-subtitle">
                    Recycling Center • San Salvador
                </div>

                <button class="btn-directions">
                    Start Route
                </button>

            </div>
        `;

        card.addEventListener('click', () => {

            this.map.flyTo(
                [center.lat, center.lon],
                15,
                {
                    duration: 1.5
                }
            );

        });

        const button =
            card.querySelector('.btn-directions');

        button.addEventListener('click', (e) => {

            e.stopPropagation();

            this.calculateRoute(
                center.lat,
                center.lon
            );

        });

        container.appendChild(card);

    }

    nextCard() {

        this.currentIndex++;

        if (
            this.currentIndex >=
            this.filteredCenters.length
        ) {
            this.currentIndex = 0;
        }

        this.updateSlider();

    }

    prevCard() {

        this.currentIndex--;

        if (this.currentIndex < 0) {

            this.currentIndex =
                this.filteredCenters.length - 1;
        }

        this.updateSlider();

    }

    setUserLocation(lat, lon) {

        this.userCoords = {
            lat,
            lng: lon
        };

        if (this.userMarker) {

            this.map.removeLayer(this.userMarker);

        }

        const userIcon = L.divIcon({

            className: 'user-marker',

            html: `
                <div class="user-pin">
                    ⬤
                </div>
            `,

            iconSize: [30, 30],
            iconAnchor: [15, 15]

        });

        this.userMarker =
            L.marker(
                [lat, lon],
                {
                    icon: userIcon
                }
            )
            .addTo(this.map)
            .bindPopup('Your Location')
            .openPopup();

    }

    calculateRoute(destLat, destLon) {

        if (!this.userCoords) {

            alert(
                'Please select your location on the map first!'
            );

            return;
        }

        if (this.routingControl) {

            this.map.removeControl(this.routingControl);

        }

        document.getElementById(
            'instructions-container'
        ).innerHTML = "";

        this.routingControl =
            L.Routing.control({

                waypoints: [
                    L.latLng(
                        this.userCoords.lat,
                        this.userCoords.lng
                    ),

                    L.latLng(
                        destLat,
                        destLon
                    )
                ],

                lineOptions: {
                    styles: [
                        {
                            color: '#8BC34A',
                            weight: 6
                        }
                    ]
                },

                createMarker: () => null,

                addWaypoints: false,

                draggableWaypoints: false,

                routeWhileDragging: false,

                fitSelectedRoutes: true,

                show: false,

                router: L.Routing.osrmv1({
                    language: 'en'
                })

            });

        this.routingControl.addTo(this.map);

        this.routingControl.on('routesfound', () => {

            const itinerary =
                this.routingControl._container;

            document
                .getElementById(
                    'instructions-container'
                )
                .appendChild(itinerary);

            this.togglePanel(true);

        });

    }

    togglePanel(show) {

        const panel =
            document.getElementById(
                'routing-panel'
            );

        const tab =
            document.getElementById(
                'panel-tab'
            );

        if (show) {

            panel.classList.add('visible');

            tab.style.display = 'none';

        } else {

            panel.classList.remove('visible');

            if (this.routingControl) {

                tab.style.display = 'flex';

            }

        }

    }

    clearRoute() {

        if (this.routingControl) {

            this.map.removeControl(
                this.routingControl
            );

            this.routingControl = null;

        }

        document.getElementById(
            'instructions-container'
        ).innerHTML = "";

        document
            .getElementById('routing-panel')
            .classList.remove('visible');

        document
            .getElementById('panel-tab')
            .style.display = 'none';

    }

    search(value) {

        const filtered =
            this.centers.filter(center =>

                center.name
                    .toLowerCase()
                    .includes(
                        value.toLowerCase()
                    )

            );

        this.renderCards(filtered);

    }

    getMyLocation() {

        navigator.geolocation.getCurrentPosition(

            (pos) => {

                const lat =
                    pos.coords.latitude;

                const lon =
                    pos.coords.longitude;

                this.setUserLocation(
                    lat,
                    lon
                );

                this.map.flyTo(
                    [lat, lon],
                    15
                );

            },

            () => {

                alert('GPS not available');

            }

        );

    }

}

const app = new SortlyApp();