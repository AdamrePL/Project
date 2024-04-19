const uid_element = document.querySelector(".user-id");

uid_element.addEventListener("click", function showConfirm() {
    uid_element.removeEventListener("click", showConfirm);
    
    const warning_box = document.createElement("p");
    warning_box.innerText = "Czy na pewno chcesz wyświetlić swoje ID?";
    
    const confirm_btn = document.createElement("button");
    confirm_btn.type = "button";
    confirm_btn.innerText = "Tak";
    confirm_btn.className = "agree";
    confirm_btn.addEventListener("click", function cont() {
        displayUID();
        while (uid_element.childElementCount > 1) {
            uid_element.lastChild.remove();
        }
    });

    const cancel_btn = document.createElement("button");
    cancel_btn.type = "button";
    cancel_btn.innerText = "Nie";
    cancel_btn.className = "disagree";
    cancel_btn.addEventListener("click", () => {
        while (uid_element.childElementCount > 1) {
            uid_element.lastChild.remove();
        }
    });

    uid_element.appendChild(warning_box);
    uid_element.appendChild(confirm_btn);
    uid_element.appendChild(cancel_btn);
});

const displayUID = function() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/get_user_uid.test.php", true); 
    // & I don't have any clue how tf this path works but it works - @AdamrePL
    // * Actually on second thought, I think it's the path from the currently working/active page (page where the event/function/xhr was triggered/called - also in other words, from where the xhr was sent and NOT from script file location)
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                uid_element.querySelector(".uid").dataset.content = xhr.responseText;
                setTimeout(() => {
                    uid_element.querySelector(".uid").dataset.content = "Kliknij, żeby wyświetlić ID";
                }, 10000)
            }
        }
    }

    xhr.send("show-uid=ok"); 
}

function copyUID(){
    var tooltip = document.getElementById("info-copy");
    var UID = document.getElementById("overlay-uid").innerHTML;
    navigator.clipboard.writeText(UID);

    tooltip.style.visibility = "visible";
    
}
