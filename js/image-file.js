let input_file = document.querySelector("#file-input")
let file_name = document.querySelector("#file-name")
input_file.addEventListener("change", (event) => {
    let upload_file = event.target.files[0].name
    file_name.textContent = upload_file
})