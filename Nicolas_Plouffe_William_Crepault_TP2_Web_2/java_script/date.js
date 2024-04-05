"use strict";

function getDate(){    
    return new Date().toISOString().split('T')[0];          
}
let today = getDate();
document.addEventListener("DOMContentLoaded", getDate);

//https://stackoverflow.com/questions/23593052/format-javascript-date-as-yyyy-mm-dd
