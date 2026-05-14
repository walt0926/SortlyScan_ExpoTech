<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SortlyScan | Eco-Map</title>

    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&family=Nunito:wght@400;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <link rel="stylesheet" href="CSS/Centro.css">

</head>

<body>

    <div class="bg-glow glow-1"></div>
    <div class="bg-glow glow-2"></div>

    <div id="panel-tab" class="panel-tab">
        <span>NAV</span>
    </div>

    <div id="routing-panel" class="side-panel">

        <div class="panel-header">

            <div>
                <p class="panel-subtitle">SortlyScan Navigation</p>

                <h3 class="panel-title">
                    Directions
                </h3>
            </div>

            <button type="button" class="btn-close">
                ×
            </button>

        </div>

        <div id="instructions-container"></div>

        <button type="button" class="btn-clear-route">
            Clear Route
        </button>

    </div>

    <header class="main-header">

        <div class="logo-wrapper">

            <img src="img/logo3.png" alt="SortlyScan" class="brand-logo">

        </div>

        <div class="search-group">

            <input
                type="text"
                id="busqueda"
                placeholder="Search recycling centers..."
            >

            <button class="btn-location">
                My Location
            </button>

        </div>

    </header>

    <div id="map"></div>

    <div class="slider-wrapper">

        <button class="slider-arrow left" id="prevBtn">
            ❮
        </button>

        <div class="slider-container" id="cards"></div>

        <button class="slider-arrow right" id="nextBtn">
            ❯
        </button>

    </div>

    <button class="back-button" onclick="history.back()">

    <svg xmlns="http://www.w3.org/2000/svg"
         width="22"
         height="22"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2.5"
         stroke-linecap="round"
         stroke-linejoin="round">

        <path d="M15 18l-6-6 6-6"/>

    </svg>

    </button>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <script src="JS/Centro.js"></script>

</body>

</html>