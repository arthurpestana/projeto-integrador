let catalog_slider = document.querySelector(".catalog__recommend--flex")
let arrow_slider = document.querySelectorAll(".arrows")
let first_book = catalog_slider.querySelectorAll(".catalog__recommend--book")[0]
let fst_book_width = first_book.clientWidth + 4
let scroll_width = catalog_slider.scrollWidth - catalog_slider.clientWidth

function hiddenArrow() {
    arrow_slider[0].style.display = catalog_slider.scrollLeft == 0 ? "none" : "block"
    arrow_slider[1].style.display = catalog_slider.scrollLeft == scroll_width ? "none" : "block"
}

arrow_slider.forEach(arrow => {
    arrow.addEventListener("click", () => {
        catalog_slider.scrollLeft += arrow.id == "left" ? -fst_book_width : fst_book_width
        hiddenArrow()
    })
    hiddenArrow()
});
