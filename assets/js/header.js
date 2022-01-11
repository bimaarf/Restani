const dropdownLink = document.getElementById("dropdown-link")
const dropdownMenu = document.getElementById("dropdown-menu")
const toggle = document.getElementById('toggle')
const lines = document.querySelectorAll('.toggle div')
const navbar = document.querySelector('nav')

dropdownLink.addEventListener("mouseenter", () => {
    dropdownMenu.classList.add("show")
})
dropdownLink.addEventListener("mouseleave", () => {
    setTimeout(() => {
        dropdownMenu.classList.remove("show")
    }, 300)
})


toggle.addEventListener('click', () => {
    toggle.classList.toggle('toggle-active')
    navbar.classList.toggle('active')
})