var journeys = document.querySelectorAll('.journey-preview');

var journeysArray = Array.prototype.slice.call(journeys);

function sortJourneysByDate(asc) {
    if (asc) {
        journeysArray.sort(function(a, b) {
            return new Date(a.dataset.date) - new Date(b.dataset.date);
        });
    } else {
        journeysArray.sort(function(a, b) {
            return new Date(b.dataset.date) - new Date(a.dataset.date);
        });
    }
}

function sortJourneysByRating(asc) {
    if (asc) {
        journeysArray.sort(function(a, b) {
            return a.dataset.rating - b.dataset.rating;
        });
    } else {
        journeysArray.sort(function(a, b) {
            return b.dataset.rating - a.dataset.rating;
        });
    }
}

function sortJourneysByDistance(asc) {
    if (asc) {
        journeysArray.sort(function(a, b) {
            return a.dataset.distance - b.dataset.distance;
        });
    } else {
        journeysArray.sort(function(a, b) {
            return b.dataset.distance - a.dataset.distance;
        });
    }
}

function deleteJourneysFromDOM() {
    journeysArray.forEach(function(journey) {
        journey.remove();
    });
}

function addJourneysToDOM() {
    journeysArray.forEach(function(journey) {
        document.querySelector('.journey-container-grid').appendChild(journey);
    });
}

function manageDateSort(element) {
    var selected = element.classList.contains('selected');
    var sortButtons = document.querySelectorAll('.sort-button');
    sortButtons.forEach(function(button) {
        button.classList.remove('selected');
    });
    element.classList.add('selected');
    if(!selected) {
        if(element.innerHTML === 'Date ↓') {
            sortJourneysByDate(true);
        } else {
            sortJourneysByDate(false);
        }
    } else {
        if(element.innerHTML === 'Date ↓') {
            element.innerHTML = 'Date ↑';
            sortJourneysByDate(false);
        } else {
            element.innerHTML = 'Date ↓';
            sortJourneysByDate(true);
        }
    }
    deleteJourneysFromDOM();
    addJourneysToDOM();
}

function manageRatingSort(element) {
    var selected = element.classList.contains('selected');
    var sortButtons = document.querySelectorAll('.sort-button');
    sortButtons.forEach(function(button) {
        button.classList.remove('selected');
    });
    element.classList.add('selected');
    if(!selected) {
        if(element.innerHTML === 'Note ↓') {
            sortJourneysByRating(true);
        } else {
            sortJourneysByRating(false);
        }
    } else {
        if(element.innerHTML === 'Note ↓') {
            element.innerHTML = 'Note ↑';
            sortJourneysByRating(false);
        } else {
            element.innerHTML = 'Note ↓';
            sortJourneysByRating(true);
        }
    }
    deleteJourneysFromDOM();
    addJourneysToDOM();
}