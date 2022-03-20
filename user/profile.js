
var shared_btn = document.getElementById("shared")
var personal_btn = document.getElementById("personal")

var changes = function(element_hide, element_show, hide, show){
    var area_to_hide = document.getElementById(hide);
    var area_to_show = document.getElementById(show);
    area_to_hide.style.visibility = "hidden"
    area_to_hide.style.width = "0%"
    element_hide.style.opacity = 0.6

    area_to_show.style.visibility = "visible"
    area_to_show.style.width = "100%"
    element_show.style.opacity = 1

}

shared_btn.addEventListener("click", (event)=>{
    changes(personal_btn, shared_btn, "personal_postits_list", "shared_postits_list")
})

personal_btn.addEventListener("click", (event)=>{
    changes(shared_btn, personal_btn, "shared_postits_list", "personal_postits_list")
})


var add_btn = document.getElementById("add-btn")
var signout_btn = document.getElementById("signout-btn")

signout_btn.addEventListener('click', ()=>{
    location.href = "../accueil.php"
})