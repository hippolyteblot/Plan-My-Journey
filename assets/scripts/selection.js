let allRest = document.querySelectorAll(".rest");
allRest = Array.from(allRest).map((item) => item.innerHTML);

let allAct = document.querySelectorAll(".act");
allAct = Array.from(allAct).map((item) => item.innerHTML);

function reloadPreferences() {
  let selectedItems = document.querySelectorAll(".selected");
  let unSelectedItems = document.querySelectorAll(".unselected");

  selectedItems = Array.from(selectedItems).map((item) => item.innerHTML);

  unSelectedItems = Array.from(unSelectedItems).map((item) => item.innerHTML);

  for (let i = 0; i < selectedItems.length; i++) {
    selectedItems[i] = selectedItems[i].replace(/ /g, "-");
  }

  for (let i = 0; i < unSelectedItems.length; i++) {
    unSelectedItems[i] = unSelectedItems[i].replace(/ /g, "-");
  }

  allRest.forEach((item) => {
    if (selectedItems.includes(item) && !unSelectedItems.includes(item)) {
      document.getElementsByClassName(item)[0].style.display = "block";
      document
        .getElementsByClassName(item)[0]
        .classList.add("selectedPreference");
    } else {
      var x = document.getElementsByClassName(item);
      for (var i = 0; i < x.length; i++) {
        x[i].style.display = "none";
        x[i].classList.remove("selectedPreference");
      }
    }
  });

  allAct.forEach((item) => {
    item = item.replace(/ /g, "-");
    if (selectedItems.includes(item) && !unSelectedItems.includes(item)) {
      document.getElementsByClassName(item)[0].style.display = "block";
      document
        .getElementsByClassName(item)[0]
        .classList.add("selectedPreference");
    } else {
      var x = document.getElementsByClassName(item);
      for (var i = 0; i < x.length; i++) {
        x[i].style.display = "none";
        x[i].classList.remove("selectedPreference");
      }
    }
  });
}

reloadPreferences();

function sendAllPreferences() {
  let selectedPreferences = document.querySelectorAll(".selectedPreference");

  selectedPreferences = Array.from(selectedPreferences).map(
    (item) => item.innerHTML
  );

  for (let i = 0; i < selectedPreferences.length; i++) {
    selectedPreferences[i] = selectedPreferences[i].replace("-", " ");
  }

  let selectedPreferencesString = selectedPreferences.join(",");

  // put the string in the url without reloading the page
  window.history.pushState(
    {},
    "",
    `?page=preferencesSelection&preferences=${selectedPreferencesString}`
  );
}
