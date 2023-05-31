
const mode = window.localStorage.getItem('mode');
const wrapperSelect = document.querySelector(".wrapper")
const headerSelect = document.querySelector(".header")
const footerSelect = document.querySelector(".footer")
const bannerSelect = document.querySelector(".banner")
const iconSelect = document.getElementById("sun-moon")
const allSelect = document.querySelector("*")

var elementsTochange = [wrapperSelect, headerSelect, footerSelect, bannerSelect, iconSelect]

//Base elements common to all pages