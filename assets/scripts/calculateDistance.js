function calculateDistance(x1, y1, x2, y2) {
    // Use aversine formula to calculate distance between two points
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(y2-y1);  // deg2rad below
    var dLon = deg2rad(x2-x1);
    var a =
        Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(deg2rad(y1)) * Math.cos(deg2rad(y2)) *
        Math.sin(dLon/2) * Math.sin(dLon/2)
        ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c; // Distance in km
    d = d * 1.3;
    // Round to 2 decimal places
    d = Math.round(d * 100) / 100;
    return d;
}

function deg2rad(deg) {
    return deg * (Math.PI/180);
}

function calculateEachDistance(array) {
    var distance = 0;
    for (var i = 0; i < array.length - 1; i++) {
        distance += calculateDistance(array[i].x, array[i].y, array[i + 1].x, array[i + 1].y);
    }
    return distance;
}



function insertDistance() {
    var distancesInfo = document.getElementsByClassName("distance");
    var durationInfo = document.getElementsByClassName("duration");
    var activeSteps = document.getElementsByClassName("active");
    // Get the id of the last distance
    var lastDistanceId = distancesInfo[distancesInfo.length - 1].getAttribute("id");
    // Keep the number after -
    lastDistanceId = lastDistanceId.split("-")[1];
    for(var i = 0; i < lastDistanceId; i++) {
        var x1 = activeSteps[i].getAttribute("data-lat");
        var y1 = activeSteps[i].getAttribute("data-lng");
        var x2 = activeSteps[i+1].getAttribute("data-lat");
        var y2 = activeSteps[i+1].getAttribute("data-lng");
        var distance = calculateDistance(x1, y1, x2, y2);
        distancesInfo[i].innerHTML = distance + " km";
        durationInfo[i].innerHTML = Math.round(distance * 12 ) + " min (à pied), " + Math.round(distance * 3) + " min (en voiture)";
    }
}

function updateFinalDistance() {
    var totalDistance = document.getElementById("total-distance");
    var distancesInfo = document.getElementsByClassName("distance");
    var distance = 0;
    for(var i = 0; i < distancesInfo.length; i++) {
        distance += parseFloat(distancesInfo[i].innerHTML);
    }
    distance = Math.round(distance * 100) / 100;
    totalDistance.innerHTML = distance + " km";
}

var changeStepBtns = document.getElementsByClassName("change-step");
for(var i = 0; i < changeStepBtns.length; i++) {
    changeStepBtns[i].addEventListener("click", function() {
        insertDistance();
        updateFinalDistance();
    });
}

insertDistance();
updateFinalDistance();
