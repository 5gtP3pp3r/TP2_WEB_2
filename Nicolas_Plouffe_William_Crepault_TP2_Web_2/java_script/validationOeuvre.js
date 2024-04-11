"use strict";

const ValuePattern = /^(\d)+.(\d){2}$/;
const codePattern = /[A-Z]{3}\d{4}/;
const sizeMBPattern = /[0-9]{1,4}/;

const MAX_VALUE = 999;
const MIN_VALUE = 0.00;
const VALUE_ZERO = 0;
const EMPTY = "";

let pieceName = document.getElementById("pieceName");
let artistName = document.getElementById("artistName");
let timeInSec = document.getElementById("timeInSec");
let sizeMB = document.getElementById("sizeMB");
let roleOptions = document.getElementById("roleOptions");
let inputDate = document.getElementById("datePublication");
let albumCode = document.getElementById("albumCode");
let albumValue = document.getElementById("albumValue");
//let youtubeLink = document.getElementById("youtubeLink");
//let lyrics = document.getElementById("lyrics")

let listResult = document.getElementById("listResult");

let validList = EMPTY;
let errorList = EMPTY;

inputDate.value = today;
document.getElementById("submitUS3").addEventListener("click", validateInputs);
document.getElementById("resetUS3").addEventListener("click", clearInputs);

function validateInputs(event){
    event.preventDefault();
    validList = EMPTY;
    errorList = EMPTY;
    listResult.classList.remove("red");
    let isValid = true;

    if (pieceName.value.trim() == EMPTY){
        errorList +="<li><p>Veuillez entrer une pièce valide</p></li>";
        isValid = false;
    }
    else{
        validList +="<li><p>Nom de la pièce: "+ pieceName.value +"</p></li>";
    }

    if (artistName.value.trim() == EMPTY){
        errorList +="<li><p>Veuillez entrez un nom d'artiste valide</p></li>";
        isValid = false;
    }
    else{
        validList +="<li><p>Nom de l'artiste: "+ artistName.value +"</p></li>";
    }

    if (roleOptions.value > VALUE_ZERO){
        validList +="<li><p>Rôle de l'ariste: "+ roleOptions.options[roleOptions.selectedIndex].text +"</p></li>";
    }

    if (albumValue.value <= MIN_VALUE || !ValuePattern.test(albumValue.value)){
        errorList +="<li><p>Veuillez entrer une valeur ($) valide</p></li>";
        isValid = false;
    }
    else{
        validList +="<li><p>Valeur de l'album: "+ albumValue.value +"$</p></li>";
    }

    if (timeInSec.value <= VALUE_ZERO || timeInSec.value > MAX_VALUE){
        errorList +="<li><p>Veuillez entrer un temps en seconde valide</p></li>";
        isValid = false;
    }
    else{
        validList +="<li><p>Temps: "+ timeInSec.value +" secondes</p></li>";
    }

    if (sizeMB.value == EMPTY){
        validList = validList;
    }
    else if (sizeMB.value <= VALUE_ZERO || sizeMB.value > MAX_VALUE){
        errorList +="<li><p>Veuillez entrer une taille en MB valide</p></li>";
        isValid = false;
    }
    else{
        validList +="<li><p>Taille: "+ sizeMB.value +" MB</p></li>";
    } 

    if (inputDate.value == EMPTY){
        validList +="<li><p>Date de publication: "+ today +"</p></li>";
    }
    else if (inputDate.value > today){   
        errorList +="<li><p>Veuillez entrer une date valide</p></li>";
        isValid = false;       
    }  
    else{
        validList +="<li><p>Date de publication: "+ inputDate.value +"</p></li>";
    }  
        
    if (albumCode.value.trim() == "" || !codePattern.test(albumCode.value)){
        errorList +="<li><p>Veuillez entrer un code valide</p></li>";
        isValid = false;
    }
    else{
        validList +="<li><p>Code de l'album: "+ albumCode.value +"</p></li>";
    }
       
    printResults();

    function printResults(){
        if (!isValid){
            listResult.innerHTML = errorList;
            listResult.classList.add("red");
        }
        else{
            listResult.innerHTML = validList;
        }        
    }
}

function clearInputs(){  
    setTimeout(function() {
        listResult.innerHTML = EMPTY;  
        inputDate.value = today; 
        pieceName.value = EMPTY;
        artistName.value = EMPTY;
        timeInSec.value = EMPTY;
        sizeMB.value = EMPTY;
        roleOptions.value = VALUE_ZERO;       
        albumValue.value = EMPTY;
        albumCode.value = EMPTY;
        youtubeLink.value = EMPTY;
        lyrics.value = EMPTY;
    }, 0);
} 











