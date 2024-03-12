const uid_element = document.querySelector(".user-id");
uid_element.addEventListener("click", ()=>{
    fun();
    console.log("clicked")
});
const fun = function() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../controllers/account-controller.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            console.log("test")
            uid_element.querySelector("uid").innerHTML = this.responseText;
        }
    }

    xhr.send("show-id=showid"); 
}
