let map = document.querySelector("#map");

class GoogleMap {
  constructor() {
    this.map = null;
    this.bounds = null;
    this.textMarker = null;
  }

  async load(element) {
    return new Promise((resolve, reject) => {
      $script("https://maps.googleapis.com/maps/api/js?", () => {
        // Ajouter la clé API
        this.textMarker = class TexteMarker extends google.maps.OverlayView {
          constructor(position, map, text) {
            super();
            this.div = null;
            this.html = null;
            this.position = position;
            this.text = text;
            this.setMap(map);
          }
          onAdd() {
            this.div = document.createElement("div");
            this.div.classList.add("marker");
            this.div.style.position = "absolute";
            this.div.innerHTML = this.text;
            this.getPanes().overlayImage.appendChild(this.div);
            let test = false;
            this.div.addEventListener("click", () => {
              if (!test) {
                this.div.innerHTML = this.html;
                test = true;
              } else {
                this.div.innerHTML = this.text;
                test = false;
              }
            });
          }
          draw() {
            let position = this.getProjection().fromLatLngToDivPixel(
              this.position
            );
            this.div.style.left = position.x + "px";
            this.div.style.top = position.y + "px";
          }
          onRemove() {
            this.div.parentNode.removeChild(this.div);
          }

          activate() {
            if (this.div !== null) {
              this.div.classList.add("is-active");
            }
          }

          deactivate() {
            if (this.div !== null) {
              this.div.classList.remove("is-active");
            }
          }

          setContent(html) {
            this.html = html;
          }
        };
        this.map = new google.maps.Map(element);
        this.bounds = new google.maps.LatLngBounds();
        resolve();
      });
    });
  }
  addMarker(lat, lng, text) {
    let point = new google.maps.LatLng(lat, lng);
    let marker = new this.textMarker(point, this.map, text);
    this.bounds.extend(point);
    return marker;
  }

  centerMap() {
    this.map.panToBounds(this.bounds);
    this.map.fitBounds(this.bounds);
  }
}

const change = document.getElementsByClassName("change-step");

if (map !== null) {
  for (let i = 0; i < change.length; i++) {
    change[i].addEventListener("click", function () {
      addMark();
    });
  }
  addMark();
}

function addMark() {
  let mapG = new GoogleMap();
  let activateMarker = null;
  mapG.load(map).then(() => {
    let items = document.querySelectorAll(".active");
    items.forEach((item) => {
      let marker = mapG.addMarker(
        item.dataset.lat,
        item.dataset.lng,
        item.dataset.text
      );
      marker.setContent(item.innerHTML);
      item.addEventListener("mouseover", function () {
        marker.activate();
        if (activateMarker) {
          activateMarker.deactivate();
        }
        activateMarker = marker;
      });
      item.addEventListener("mouseout", function () {
        marker.deactivate();
        activateMarker = null;
      });
    });
    mapG.centerMap();
  });
}
