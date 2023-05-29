function myFunction() //toggle function
{
    filteredArray.forEach(element => {
        element.classList.toggle("light-mode")
    });

    if (window.localStorage.getItem('mode') != "light")
    {
        window.localStorage.setItem("mode","light");        
        window.localStorage.setItem("icon","moon");
        accueilSelect.classList.remove("yasso")
    }
    else
    {
        window.localStorage.setItem("mode","dark");    
        window.localStorage.setItem("icon","sun");
        accueilSelect.classList.add("yasso")
    }

    if (iconSelect.classList.contains("bi-sun"))
    {
        iconSelect.classList.remove("bi-sun")
        iconSelect.classList.add("bi-moon-stars")        
    }
    else if (iconSelect.classList.contains("bi-moon-stars"))
    {
        iconSelect.classList.remove("bi-moon-stars")
        iconSelect.classList.add("bi-sun")    
    }
}

var filteredArray = elementsTochange.filter(function (element)
{
    return element !== null;
})
console.log(filteredArray)

filteredArray.forEach(element => {
    if (window.localStorage.getItem('mode') != "light")
    {
        element.classList.add("light-mode");
    }
    else
    {
        element.classList.remove("light-mode");
    }
    
    });
    
    if (window.localStorage.getItem('icon') == "sun")
    {
        iconSelect.classList.remove("bi-sun")
        iconSelect.classList.add("bi-moon-stars")
        accueilSelect.classList.add("yasso")
    }
    else
    {
        iconSelect.classList.remove("bi-moon-stars")
        iconSelect.classList.add("bi-sun")
        accueilSelect.classList.remove("yasso")
    }



