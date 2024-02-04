let input_form = document.querySelectorAll(".input-form")
let submit_btn = document.querySelector("#submit-btn")

submit_btn.addEventListener("click", () => {
    input_form.forEach(input => {
        if (input.value == "")
    });
})