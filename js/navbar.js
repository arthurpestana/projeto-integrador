let menu_ham = document.querySelector(".nav__hamburguer")
menu_ham.addEventListener("click", () => {
    let line = document.querySelectorAll(".line")
    let nav_list = document.querySelector(".nav__list")
    let nav_links = document.querySelectorAll(".nav__text")
    let nav_imgs = document.querySelectorAll(".nav__imgs")
    for (let i=0; i<3; i++) {
        line[i].classList.toggle(`line${i+1}-checked`)
    }
    nav_list.classList.toggle("nav__list--active")
    nav_imgs.forEach((imgs) => {
        imgs.classList.toggle("nav__imgs--disable")
    })
    nav_links.forEach((link) => {
        if (link.style.animation != "") {
            link.style.animation=""
        }
        else {
            link.style.animation="navLinkFade 0.5s ease forwards 0.3s"
        }
        link.classList.toggle("nav__text--active")
    })
})