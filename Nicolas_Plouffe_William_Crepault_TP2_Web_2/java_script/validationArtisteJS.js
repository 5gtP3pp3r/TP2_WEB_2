"use strict";

const regexImage = /^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/;
const VALUE_ZERO = 0;
const EMPTY = "";

let nomArtiste = document.getElementById("idArtiste");
let ville = document.getElementById("ville");
let photo = document.getElementById("photoArtiste");

let listResult = document.getElementById("listResult");

let validList = EMPTY;
let errorList = EMPTY;

document.getElementById("submitUS1").addEventListener("click", validationArtiste);
document.getElementById("resetUS1").addEventListener("click", resetForm);

function validationArtiste(event){
    event.preventDefault();
    validList = EMPTY;
    errorList = EMPTY;
    listResult.classList.remove("red");
    let isValid = true;

    if (nomArtiste.value.trim() == EMPTY) {
        errorList += "<li><p>Veuillez entrez un nom d'artiste valide</p></li>";
        isValid = false;
    }
    else{
        validList += "<li><p>Nom de l'artiste: " + nomArtiste.value + "</p></li>";        
    }

    if (ville.value == VALUE_ZERO) {
        errorList += "<li><p>Veullez choisir une ville dans la liste</p></li>";
        isValid = false;
    }
    else if (ville.value > VALUE_ZERO){
        validList += "<li><p>Ville de l'artiste: " + ville.options[ville.selectedIndex].text + "</p></li>";
    }

    if (photo.value.trim() == EMPTY || !regexImage.test(photo.value)){
        errorList += "<li><p>Image manquante ou format d'image invalide</p></li>";
        isValid = false;
    }
    else{
        validList += "<li><p>Photo de l'artiste: " + photo.value + "</p></li>";
    }
    

    if (!isValid){
        listResult.innerHTML = errorList;
        listResult.classList.add("red");
    }
    else{
        listResult.innerHTML = validList;
    }        
}

function resetForm(){
    listResult.innerHTML = EMPTY;
    nomArtiste.value = EMPTY;
    ville.value = VALUE_ZERO;
    photo.value = EMPTY;
    
}