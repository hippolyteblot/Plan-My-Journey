var items = document.querySelectorAll(".item");

for (var i = 0; i < items.length; i++) {
  items[i].addEventListener("click", function () {
    if (this.classList.contains("selected")) {
      var value = this.getAttribute("value");
      document.querySelectorAll(".item").forEach(function (item) {
        if (item.getAttribute("value") == value) {
          item.classList.add("unselected");
          item.classList.remove("selected");
        }
      });
    } else {
      var value = this.getAttribute("value");
      document.querySelectorAll(".item").forEach(function (item) {
        if (item.getAttribute("value") == value) {
          item.classList.remove("unselected");
          item.classList.add("selected");
        }
      });
    }
  });
}

// Get the modal
var modal2 = document.getElementById("myModal2");

// Get the button that opens the modal
var btn2 = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal
// btn2.onclick = function () {
//   modal2.style.display = "block";
// };

function openModal(id) {
  document.querySelectorAll(".category-modal").forEach(function (modal) {
    modal.style.display = "none";
  });
  document.getElementById("modal-" + id).style.display = "block";
}

function closeModal(id) {
  if (id == "pref") {
    var selectedItems = document.querySelectorAll(".item.selected.primary");
    var selectedItemsArray = [];

    var unSelectedItems = document.querySelectorAll(".item.unselected.primary");
    var unSelectedItemsArray = [];

    for (var i = 0; i < unSelectedItems.length; i++) {
      unSelectedItemsArray.push(unSelectedItems[i].getAttribute("value"));
    }
    for (var i = 0; i < selectedItems.length; i++) {
      // If note in unselected array
      if (
        unSelectedItemsArray.indexOf(selectedItems[i].getAttribute("value")) ==
        -1
      ) {
        selectedItemsArray.push(selectedItems[i].getAttribute("value"));
      }
    }

    var selectedSecondaryItems = document.querySelectorAll(
      ".item.selected.secondary"
    );
    var selectedSecondaryItemsArray = [];

    var unSelectedSecondaryItems = document.querySelectorAll(
      ".item.unselected.secondary"
    );
    var unSelectedSecondaryItemsArray = [];

    for (var i = 0; i < unSelectedSecondaryItems.length; i++) {
      unSelectedSecondaryItemsArray.push(
        unSelectedSecondaryItems[i].getAttribute("value")
      );
    }
    for (var i = 0; i < selectedSecondaryItems.length; i++) {
      // If note in unselected array
      if (
        unSelectedSecondaryItemsArray.indexOf(
          selectedSecondaryItems[i].getAttribute("value")
        ) == -1
      ) {
        selectedSecondaryItemsArray.push(
          selectedSecondaryItems[i].getAttribute("value")
        );
      }
    }

    var url = new URL(window.location.href);
    var page = url.searchParams.get("page");

    if (page == "account") {
      window.location.href =
        "?page=" +
        page +
        "&setPreferences=" +
        selectedItemsArray.join(",") +
        "&unSetPreferences=" +
        unSelectedItemsArray.join(",") +
        "&setSecondaryPreferences=" +
        selectedSecondaryItemsArray.join(",") +
        "&unSetSecondaryPreferences=" +
        unSelectedSecondaryItemsArray.join(",");
    } else if (page == "preferencesSelection") {
      reloadPreferences();
    }
  }
  document.getElementById("modal-" + id).style.display = "none";
}
