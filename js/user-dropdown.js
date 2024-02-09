let user_dropdown = document.querySelector(".user-btn")
user_dropdown.addEventListener("click", (btn) => {
    let dropdown = document.querySelector(".nav__dropdown")
    if (dropdown.style.display == "flex"){
        dropdown.style.display = "none"
    }
    else {
        dropdown.style.display = "flex"
    }
})