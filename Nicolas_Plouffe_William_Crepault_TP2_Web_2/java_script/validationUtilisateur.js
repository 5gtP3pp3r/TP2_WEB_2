"use strict";

document.addEventListener("DOMContentLoaded", function() {

const regexNom = /^^[a-zA-Z0-9]{6,45}$/;
const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
const regexEmail = /^[\w.-]+@[a-zA-Z_-]+?\.[a-zA-Z]{2,6}$/;
const MIN_VALUE = 0;
const MIN_AGE = 18;
const MAX_AGE = 100;
const EMPTY = "";

let nomUtilisateur = document.getElementById("nomUtilisateur");
let age = document.getElementById("age"); 
let email = document.getElementById("email");
let password = document.getElementById("password");
let ville = document.getElementById("ville");
let role = document.getElementById("role");
 
let listResult = document.getElementById("listResult");

let validList = EMPTY;
let errorList = EMPTY;

document.getElementById("submitUS0").addEventListener("click", validationAjout);
document.getElementById("resetUS0").addEventListener("click", resetForm);

function validationAjout(event){
    //event.preventDefault();
    validList = EMPTY;
    errorList = "<li>\"affichage via js avec un preventDefault si valeurs incorrectes\"</li>";
    listResult.classList.remove("red");
    let isValid = true;

    if (nomUtilisateur.value.trim() == EMPTY || !regexNom.test(nomUtilisateur.value)){
        errorList += "<li><p>Entrez un nom d'utilisateur valide</p></li>";
        isValid = false;
    }
    if (age.value == EMPTY || age.value < MIN_AGE || age.value > MAX_AGE){
        errorList += "<li><p>Entrez un age valide entre 18 et 100</p></li>";
        isValid = false;
    }
    if (email.value.trim() == EMPTY || !regexEmail.test(email.value)){
        errorList += "<li><p>Entrez une adresse mail valide</p></li>";
        isValid = false;
    }   
    if (password.value.trim() == EMPTY || !regexPassword.test(password.value)){
        errorList += "<li><p>Entrez un mot de passe valide</p></li>";
        isValid = false;
    }
    if (ville.value == MIN_VALUE){
        errorList += "<li><p>Choisir une ville dans la liste</p></li>";
        isValid = false;
    }
    if (role && (role.value == MIN_VALUE)){
        errorList += "<li><p>Choisir un role valide</p></li>";
        isValid = false;
    }    
    if (!isValid){
        event.preventDefault();
        listResult.innerHTML = errorList;
        listResult.classList.add("red");
    }        
}

function resetForm(){
    listResult.innerHTML = EMPTY;
    nomUtilisateur.value = EMPTY;
    age.value = EMPTY;
    email.value = EMPTY;
    password.value = EMPTY;
    ville.value = VALUE_ZERO;
    role.value = VALUE_ZERO;
    
}
});