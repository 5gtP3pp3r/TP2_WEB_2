"use strict";

function getDate() {
    var options = { timeZone: 'America/Toronto', year: 'numeric', month: '2-digit', day: '2-digit' };
    var date = new Date();
    var formattedDate = date.toLocaleDateString('en-CA', options); 
    return formattedDate.split('/').reverse().join('-'); 
}
let today = getDate();
document.addEventListener("DOMContentLoaded", getDate);

//https://stackoverflow.com/questions/23593052/format-javascript-date-as-yyyy-mm-dd
