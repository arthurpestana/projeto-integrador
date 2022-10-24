let input_form = document.querySelectorAll(".input-form")
for (let i=0; i<input_form.length; i++) {
    input_form[i].addEventListener("click", () => {
        let input_focus = document.querySelectorAll(".input-focus")
        focusInterval = setInterval(() => {
            if (input_form[i].value != "") {
                input_focus[i].style.setProperty("--translate-focus", "-25px")
                input_focus[i].style.setProperty("--font-focus", "15px")
            }
            else {
                input_focus[i].style.setProperty("--translate-focus", "0px")
                input_focus[i].style.setProperty("--font-focus", "18px")
            }
        }, 100)
    })
}