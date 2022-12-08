//onload
window.onload = function () {
	const searchBtn = document.getElementById("input02");
	//si  la taille de l'ecran est inferieur a 768px
	if (window.innerWidth < 1000) {
		searchBtn.innerHTML = "Rechercher";
	}
};

