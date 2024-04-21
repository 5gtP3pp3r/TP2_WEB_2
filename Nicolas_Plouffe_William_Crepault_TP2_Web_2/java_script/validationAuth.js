"use strict";

document.addEventListener("DOMContentLoaded", function() {

const regexNom = /^[A-Za-z]{2,}$/;
const regexPassword = /^[a-zA-Z\d]{6,}$/;
const regexEmail = /^[\w.-]+@[a-zA-Z_-]+?\.[a-zA-Z]{2,6}$/;
const MIN_VALUE = 0;
const MIN_AGE = 18;
const MAX_AGE = 120;
const EMPTY = "";

let nomUtilisateur = document.getElementById("nomUtilisateur");
let age = document.getElementById("age"); /********/
let email = document.getElementById("email");
let password = document.getElementById("password");
let role = document.getElementById("role");
let ville = document.getElementById("role"); /*********/

let listResult = document.getElementById("listResult");

let validList = EMPTY;
let errorList = EMPTY;

document.getElementById("submitUS0").addEventListener("click", validationAuth);
document.getElementById("resetUS0").addEventListener("click", resetForm);

function validationAuth(/*event*/){
    //event.preventDefault();
    validList = EMPTY;
    errorList = EMPTY;
    listResult.classList.remove("red");
    let isValid = true;

    if (nomUtilisateur && (nomUtilisateur.value.trim() == EMPTY || !regexNom.test(nomUtilisateur.value))){
        errorList += "<li><p>Entrez un nom d'utilisateur valide</p></li>";
        isValid = false;
    }
    else if (nomUtilisateur) {
        validList += "<li><p>Nom d'utilisateur valide</p></li>";
    }

    if (age && (age.value.Trim() == EMPTY || age.value.Trim() < MIN_AGE || age.value.Trim() > MAX_AGE)){
        errorList += "<li><p>Entrez un age valide entre 18 et 120</p></li>";
        isValid = false;
    }
    else if (age){
        validList += "<li><p>Age valide</p></li>";
    }

    if (email && (email.value.trim() == EMPTY || !regexEmail.test(email.value))){
        errorList += "<li><p>Entrez une adresse mail valide</p></li>";
        isValid = false;
    }
    else if (email) {
        validList += "<li><p>Adresse mail valide</p></li>";
    }   
    if (password && (password.value.trim() == EMPTY || !regexPassword.test(password.value))){
        errorList += "<li><p>Entrez un mot de passe valide</p></li>";
        isValid = false;
    }
    else if (password) {
        validList += "<li><p>Mot de passe valide</p></li>";
    }

    if (ville && (ville.value == MIN_VALUE)){
        errorList += "<li><p>Choisir une ville dans la liste</p></li>";
        isValid = false;
    }
    else if (ville){
        validList += "<li><p>Choix ville valide</p></li>";
    }

    if (role && (role.value == MIN_VALUE)){
        errorList += "<li><p>Entrez un role valide</p></li>";
        isValid = false;
    }
    else if (role) 
    {
        validList += "<li><p>Rôle valide</p></li>";
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
});