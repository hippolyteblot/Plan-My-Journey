let allRest = document.querySelectorAll(".rest");
allRest = Array.from(allRest).map((item) => item.innerHTML);

let allAct = document.querySelectorAll(".act");
allAct = Array.from(allAct).map((item) => item.innerHTML);

function reloadPreferences() {
  let selectedItems = document.querySelectorAll(".selected");

  selectedItems = Array.from(selectedItems).map((item) => item.innerHTML);
  console.log(selectedItems);

  for (let i = 0; i < selectedItems.length; i++) {
    selectedItems[i] = selectedItems[i].replace(/ /g, "-");
  }

  allRest.forEach((item) => {
    if (selectedItems.includes(item)) {
      document.getElementsByClassName(item)[0].style.display = "block";
    } else {
      var x = document.getElementsByClassName(item);
      for (var i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
    }
  });

  allAct.forEach((item) => {
    if (selectedItems.includes(item)) {
      document.getElementsByClassName(item)[0].style.display = "block";
    } else {
      var x = document.getElementsByClassName(item);
      for (var i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
    }
  });
}

reloadPreferences();
