"use strict";

const regexImage = /^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/;
const regexNomArtiste = /^[a-zA-Z0-9 ]+$/;
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
  errorList = "<li>\"affichage via js avec un preventDefault si valeurs incorrectes\"</li>";
  listResult.classList.remove("red");
  let isValid = true;

  if (nomArtiste.value.trim() == EMPTY ) 
  {
    errorList += "<li><p>Veuillez entrez un nom d'artiste</p></li>";
    isValid = false;
  }
  else if (!regexNomArtiste.test(nomArtiste.value)){
    errorList += '<li><p>Le nom de l\'artiste doit contenir au moins 1 caractère,' + 
                 '  accèpte les accents, les espaces, ".","-" et les "_" </p></li>';
    isValid = false;
  }
  
  if (ville.value == VALUE_ZERO) {
    errorList += "<li><p>Veullez choisir une ville dans la liste</p></li>";
    isValid = false;
  }
  if (photo.value.trim() == EMPTY || !regexImage.test(photo.value)) {
    errorList += "<li><p>Format d'image invalide</p></li>";
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
