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