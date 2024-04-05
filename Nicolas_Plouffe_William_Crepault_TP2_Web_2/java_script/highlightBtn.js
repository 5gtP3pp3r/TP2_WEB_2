"use strict";

let target = document.getElementById("target");
let btnLinks = document.getElementsByClassName("styled-button");

function hightLight(){
    for (let btn = 0; btn < btnLinks.length; btn ++){
        btnLinks[btn].classList.add("showLink");
    }    
}
function restore(){
    for (let btn = 0; btn < btnLinks.length; btn ++){
        btnLinks[btn].classList.remove("showLink");
    }    
}

target.addEventListener("mouseover", hightLight);
target.addEventListener("mouseout", restore);