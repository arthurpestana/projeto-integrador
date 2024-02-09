let dropdown_active = document.querySelectorAll(".dropdown--active")
let dropdown_display = document.querySelectorAll(".dropdown__display")
dropdown_active.forEach((active, index) => {
    active.addEventListener("click", () => {
        dropdown_display[index].style.display = dropdown_display[index].style.display == "flex" ? "none" : "flex"
        for (let i of dropdown_display) {
            if (i!=dropdown_display[index]) {
                i.style.display = "none"
            }
        }
        let dropdown_option = dropdown_display[index].querySelectorAll(".dropdown__option")
        dropdown_option.forEach((option, opt_i) => {
            option.addEventListener("click", () => {
                let option_active = dropdown_active[index].querySelector(".option__active")
                option_active.value = option.textContent
                dropdown_display[index].style.display = "none"
            })
        })
    })
})