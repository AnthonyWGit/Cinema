function myFunction() //toggle function
{
    elementsTochange.forEach(element => {
        element.classList.toggle("light-mode")
    });
    if (window.localStorage.getItem('mode') != "light")
    {
        window.localStorage.setItem("mode","light");        
        window.localStorage.setItem("icon","moon");
        iconSelect.classList.remove("bi-moon");
        iconSelect.classList.add("bi-sun");  
    }
    else
    {
        window.localStorage.setItem("mode","dark");    
        window.localStorage.setItem("icon","sun"); 
        iconSelect.classList.remove("bi-sun");
        iconSelect.classList.add("bi-moon");
    }

}
//mode must persist after refresh
const mode = window.localStorage.getItem('mode');
const wrapperSelect = document.querySelector(".wrapper")
const headerSelect = document.querySelector(".header")
const footerSelect = document.querySelector(".footer")
const bannerSelect = document.querySelector(".banner")
const iconSelect = document.getElementById("sun-moon")
const allSelect = document.querySelector("*")

var elementsTochange = [wrapperSelect, headerSelect, footerSelect, bannerSelect, iconSelect]
elementsTochange.forEach(element => {
if (window.localStorage.getItem('mode') != "light")
{
    element.classList.add("light-mode");
    element.classList.remove("dark-mode");

}
else
{
    element.classList.add("dark-mode");
    element.classList.remove("light-mode");
}

// if (element = "iconSelect" && window.localStorage.getItem('mode') != "light")
// {
//     element.classList.remove("bi bi-moon-stars");    
//     element.classList.add("bi bi-sun");
// }    
});


