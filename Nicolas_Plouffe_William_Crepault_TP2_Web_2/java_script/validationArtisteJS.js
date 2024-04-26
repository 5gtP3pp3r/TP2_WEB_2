"use strict";

const regexImage = /^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/;
const regexNomArtiste = /^[a-zàâçéèêëîïôûùüÿñæœ0-9 .'-]*$/i;
const VALUE_ZERO = 0;
const EMPTY = "";

let nomArtiste = document.getElementById("idArtiste");
let ville = document.getElementById("ville");
let photo = document.getElementById("photoArtiste");

let listResult = document.getElementById("listResult");

let errorList = EMPTY;

document
  .getElementById("submitUS1")
  .addEventListener("click", validationArtiste);
document.getElementById("resetUS1").addEventListener("click", resetForm);

function validationArtiste(event) {
  errorList = EMPTY;
  listResult.classList.remove("red");
  let isValid = true;

  if (nomArtiste.value.trim() == EMPTY) {
    errorList += "<li><p>Veuillez entrez un nom d'artiste valide</p></li>";
    isValid = false;
  }

  if (ville.value == VALUE_ZERO) {
    errorList += "<li><p>Veullez choisir une ville dans la liste</p></li>";
    isValid = false;
  } else if (ville.value > VALUE_ZERO) {
    validList +=
      "<li><p>Ville de l'artiste: " +
      ville.options[ville.selectedIndex].text +
      "</p></li>";
  }

  if (photo.value.trim() == EMPTY || !regexImage.test(photo.value)) {
    errorList += "<li><p>Image manquante ou format d'image invalide</p></li>";
    isValid = false;
  }
  if (!isValid) {
    event.preventDefault();

    listResult.innerHTML = errorList;
    listResult.classList.add("red");
  }
}

function resetForm() {
  listResult.innerHTML = EMPTY;
  nomArtiste.value = EMPTY;
  ville.value = VALUE_ZERO;
  photo.value = EMPTY;
}
