const uid_element = document.querySelector(".user-id");

uid_element.addEventListener("click", function showConfirm() {
    uid_element.removeEventListener("click", showConfirm);
    
    const warning_box = document.createElement("p");
    warning_box.innerText = "Are you sure you want to display sensitive information?";
    
    const confirm_btn = document.createElement("button");
    confirm_btn.type = "button";
    confirm_btn.innerText = "pokaż";
    confirm_btn.className = "disagree";
    confirm_btn.addEventListener("click", function cont() {
        fun();
        while (uid_element.childElementCount > 1) {
            uid_element.lastChild.remove();
        }
    });

    const cancel_btn = document.createElement("button");
    cancel_btn.type = "button";
    cancel_btn.innerText = "anuluj";
    cancel_btn.className = "agree";
    cancel_btn.addEventListener("click", () => {
        while (uid_element.childElementCount > 1) {
            uid_element.lastChild.remove();
        }
    });

    uid_element.appendChild(warning_box);
    uid_element.appendChild(confirm_btn);
    uid_element.appendChild(cancel_btn);
});

const fun = function() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../controllers/profile-controller.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            uid_element.querySelector(".uid").innerHTML = xhr.responseText;
        }
    }

    xhr.send("show-id=showid"); 
}
