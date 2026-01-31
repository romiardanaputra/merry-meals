<div class="relative w-full h-[400px] rounded-[2.5rem] overflow-hidden border border-border/10 shadow-3xl animate-on-scroll">
    <div id="map" class="w-full h-full grayscale"></div>
    
    <!-- Custom Map Overlay -->
    <div class="absolute bottom-6 right-6 bg-dark/80 backdrop-blur-md text-white p-4 rounded-2xl border border-white/10 z-[1000]">
        <p class="text-xs font-black uppercase tracking-widest opacity-60 mb-1">Our Location</p>
        <p class="text-sm font-bold">Surabaya Main Office</p>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const markerPos = [-7.3015, 112.7231]; // Coordinates for Wonokromo area, Surabaya
        
        const map = L.map('map', {
            center: markerPos,
            zoom: 14,
            scrollWheelZoom: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const customIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
            iconSize: [38, 38],
            iconAnchor: [19, 38],
            popupAnchor: [0, -38]
        });

        L.marker(markerPos, { icon: customIcon }).addTo(map)
            .bindPopup('<div class="font-bold text-dark">Merry Meals Distribution Center</div><div class="text-xs text-foreground/70">Jl. Gunungsari Sawunggaling, Surabaya</div>')
            .openPopup();
            
        // Apply grayscale via CSS instead of JS filter if possible for performance
        document.getElementById('map').style.filter = "grayscale(100%) invert(10%) contrast(90%)";
    });
</script>

<style>
    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .leaflet-popup-tip {
        display: none;
    }
</style>
