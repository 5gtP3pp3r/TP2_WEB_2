"use strict";

const codePattern = /[A-Z]{3}\d{4}/;
const sizeMBPattern = /[0-9]{1,4}/;
const nomOeuvrePattern = /^[a-zà-öø-ÿ]+(?:[ \-_.]*[a-zà-öø-ÿ]+)*/i;
const lyricsPattern = /^[a-zA-Z0-9 ]+$/;

const MAX_LENGTH = 999;
const MAX_VALUE = 10;
const MIN_VALUE = 0;
const VALUE_ZERO = 0;
const EMPTY = "";

let pieceName = document.getElementById("pieceName");
let artistName = document.getElementById("artistName");
let role = document.getElementById("roleOptions");
let timeInSec = document.getElementById("timeInSec");
let sizeMB = document.getElementById("sizeMB");
let inputDate = document.getElementById("datePublication");
let albumCode = document.getElementById("albumCode");
let albumValue = document.getElementById("albumValue");
//let youtubeLink = document.getElementById("youtubeLink");
let lyrics = document.getElementById("lyrics")

let listResult = document.getElementById("listResult");

let errorList = EMPTY;
let setYesterday = new Date(today);
setYesterday.setDate(setYesterday.getDate() - 1);
let yesterday = setYesterday.toISOString().substring(0, 10);

inputDate.value = yesterday;
document.getElementById("submitUS3").addEventListener("click", validateInputs);
document.getElementById("resetUS3").addEventListener("click", clearInputs);

function validateInputs(event) {
  errorList = "<li>\"affichage via js avec un preventDefault si valeurs incorrectes\"</li>";
  listResult.classList.remove("red");
  let isValid = true;

  if (pieceName.value.trim() == EMPTY) {
    errorList += "<li><p>Veuillez entrer une pièce valide</p></li>";
    isValid = false;
  }
  else if (!nomOeuvrePattern.test(pieceName.value)){
    errorList += '<li><p>Le titre doit contenir au moins 1 caractère, accèpte' + 
                 ' les accents, les espaces, ".","-" et les "_"</p></li>';
    isValid = false;
  }

  if (artistName.value == VALUE_ZERO) {
    errorList += "<li><p>Veuillez choisir un nom d'artiste</p></li>";
    isValid = false;
  }

  if (role.value == MIN_VALUE){
    errorList += "<li><p>Veuillez choisir un rôle</p></li>";
    isValid = false;
  }

  if (albumValue.value <= MIN_VALUE || albumValue.value > MAX_VALUE) {
    errorList += "<li><p>Veuillez entrer une valeur entre 1$ et 10$</p></li>";
    isValid = false;
  }

  if (timeInSec.value == EMPTY){
    errorList += "<li><p>Veuillez entrer un en seconde</p></li>";
    isValid = false;
  }
  else if (timeInSec.value <= VALUE_ZERO || timeInSec.value > MAX_LENGTH) {
    errorList += "<li><p>Veuillez entrer un temps entre 1 sec et 999 sec</p></li>";
    isValid = false;
  }

  if (sizeMB.value != EMPTY && sizeMB.value <=MIN_VALUE) {
    errorList += "<li><p>Veuillez entrer une taille entre 1 Mb et 999 Mb </p></li>";
    isValid = false;
  }
  else if (sizeMB.value != EMPTY && sizeMB.value > MAX_LENGTH){
    errorList += "<li><p>Veuillez entrer une taille entre 1 Mb et 999 Mb </p></li>";
    isValid = false;
  }

  if (inputDate.value == EMPTY) {
    errorList += "<li><p>Date de publication: " + today + "</p></li>";
    isValid = false;
  }

  if (albumCode.value == VALUE_ZERO) {
    errorList += "<li><p>Veuillez choisir un code valide</p></li>";
    isValid = false;
  }

  if (lyrics.value != EMPTY && !lyricsPattern.test(lyrics.value)) {
    errorList += "<li><p>Veuillez des caractères alpha numérique avec espaces seulement</p></li>";
    isValid = false;
  }

  if (!isValid) {
    event.preventDefault();
    listResult.innerHTML = errorList;
    listResult.classList.add("red");
  }
}

function clearInputs() {
  setTimeout(function () {
    listResult.innerHTML = EMPTY;
    inputDate.value = yesterday;
    pieceName.value = EMPTY;
    timeInSec.value = EMPTY;
    sizeMB.value = EMPTY;
    roleOptions.value = VALUE_ZERO;
    albumValue.value = EMPTY;
    lyrics.value = EMPTY;
  }, 0);
}
