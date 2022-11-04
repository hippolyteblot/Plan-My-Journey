var items = document.querySelectorAll(".item");

for (var i = 0; i < items.length; i++) {
  items[i].addEventListener("click", function () {
    if (this.classList.contains("selected")) {
      this.classList.add("unselected");
      this.classList.remove("selected");
    } else {
      this.classList.remove("unselected");
      this.classList.add("selected");
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
    var selectedItems = document.querySelectorAll(".item.selected");
    var selectedItemsArray = [];
    for (var i = 0; i < selectedItems.length; i++) {
      selectedItemsArray.push(selectedItems[i].innerHTML);
    }
    window.location.href =
      "/index.php?page=account&setPreferences=" + selectedItemsArray.join(",");

    var unSelectedItems = document.querySelectorAll(".item.unselected");
    var unSelectedItemsArray = [];
    for (var i = 0; i < unSelectedItems.length; i++) {
      unSelectedItemsArray.push(unSelectedItems[i].innerHTML);
    }
    window.location.href =
      "/index.php?page=account&setPreferences=" +
      selectedItemsArray.join(",") +
      "&unSetPreferences=" +
      unSelectedItemsArray.join(",");
  }
  document.getElementById("modal-" + id).style.display = "none";
}
