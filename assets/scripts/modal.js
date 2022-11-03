var items = document.querySelectorAll(".item");

for (var i = 0; i < items.length; i++) {
  items[i].addEventListener("click", function() {
    this.classList.toggle("selected");
  });
}



// Get the modal
var modal2 = document.getElementById("myModal2");

// Get the button that opens the modal
var btn2 = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal
btn2.onclick = function() {
  modal2.style.display = "block";
}


function openModal(id) {
  document.querySelectorAll(".category-modal").forEach(function(modal) {
    modal.style.display = "none";
  });
  document.getElementById("modal-" + id).style.display = "block";
}
function closeModal(id) {
  document.getElementById("modal-" + id).style.display = "none";
}