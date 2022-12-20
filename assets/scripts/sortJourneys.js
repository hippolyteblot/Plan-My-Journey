var journeys = document.querySelectorAll('.journey-preview');

var journeysArray = Array.prototype.slice.call(journeys);

function sortJourneysByDate() {
    journeysArray.sort(function(a, b) {
        return new Date(b.dataset.date) - new Date(a.dataset.date);
    });
}

function sortJourneysByRating() {
    journeysArray.sort(function(a, b) {
        return b.dataset.rating - a.dataset.rating;
    });
}

function sortJourneysByDistance() {
    journeysArray.sort(function(a, b) {
        return b.dataset.distance - a.dataset.distance;
    });
}

function deleteJourneysFromDOM() {
    journeysArray.forEach(function(journey) {
        journey.remove();
    });
}

function addJourneysToDOM() {
    journeysArray.forEach(function(journey) {
        document.querySelector('.journey-container').appendChild(journey);
    });
}