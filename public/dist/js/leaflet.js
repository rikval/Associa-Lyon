var assocIcon = L.Icon.extend({
    options: {
        iconSize: [28, 35], // size of the icon
        iconAnchor: [14, 35], // point of the icon which will correspond to marker's location
        popupAnchor: [1, -40] // point from which the popup should open relative to the iconAnchor
    }
});

var amapIcon = new assocIcon({
    iconUrl: 'dist/img/picto/AMAP.png'
}),
cafeIcon = new assocIcon({
    iconUrl: 'dist/img/picto/cafe.png'
}),
boitePartageIcon = new assocIcon({
    iconUrl: 'dist/img/picto/boitePartage.png'
});
composteurIcon = new assocIcon({
    iconUrl: 'dist/img/picto/composteur.png'
});
cygaleIcon = new assocIcon({
    iconUrl: 'dist/img/picto/cygale.png'
});
echangesLocauxIcon = new assocIcon({
    iconUrl: 'dist/img/picto/echangesLocaux.png'
})
jardinsPartagesIcon = new assocIcon({
    iconUrl: 'dist/img/picto/jardinsPartages.png'
})
reparationVeloIcon = new assocIcon({
    iconUrl: 'dist/img/picto/reparationVelo.png'
})



window.onload = function () {

    var mymap = L.map('mapid').setView([45.75, 4.85], 12);



    var tileStreets = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>,Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiZGVpdmVjYXQiLCJhIjoiY2pzazcwdXZxMHh6YzQzbGlmb2RuaTJtdSJ9.b6xnSK_6kVfPgM4B_RF1BA'
    })
    tileStreets.addTo(mymap);

    L.marker([45.717042, 4.8883251], {
        icon: amapIcon
    }).addTo(mymap).bindPopup("AMAP");
    L.marker([45.747535, 4.82381], {
        icon: cafeIcon
    }).addTo(mymap).bindPopup("Café");
    L.marker([45.84499, 4.829713], {
        icon: boitePartageIcon
    }).addTo(mymap).bindPopup("boite de Partage");
    L.marker([45.84414, 4.8269606], {
        icon: composteurIcon
    }).addTo(mymap).bindPopup("composteur");
    L.marker([45.7701514, 4.8412214], {
        icon: cygaleIcon
    }).addTo(mymap).bindPopup("cygale");
    L.marker([45.7181412, 4.815588700000035], {
        icon: echangesLocauxIcon
    }).addTo(mymap).bindPopup("échanges locaux");
    L.marker([45.7692607, 4.860921800000028], {
        icon: jardinsPartagesIcon
    }).addTo(mymap).bindPopup("Jardins partagés");
    L.marker([45.8048103, 4.713381], {
        icon: reparationVeloIcon
    }).addTo(mymap).bindPopup("réparation vélo");

}