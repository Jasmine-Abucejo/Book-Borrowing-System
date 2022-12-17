let currentDate = new Date()
let dateString = currentDate.toLocaleString()
let dateElement = document.getElementById("date")
dateElement.innerText = dateString;

let addButton = document.getElementById("addBtn")
addButton.addEventListener("click", function(){
    let modal = document.getElementById("myPopUp");
    modal.style.display = "block";
})

let close = document.getElementById("closeBtn")
close.addEventListener("click", function(){
    let modalClose = document.getElementById("myPopUp");
    modalClose.style.display = "none"
})
