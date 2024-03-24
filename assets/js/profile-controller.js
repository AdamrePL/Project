const uid_element = document.querySelector(".user-id");

uid_element.addEventListener("click", function showConfirm() {
    uid_element.removeEventListener("click", showConfirm);
    
    const warning_box = document.createElement("p");
    warning_box.innerText = "Are you sure you want to display sensitive information?";
    
    const confirm_btn = document.createElement("button");
    confirm_btn.type = "button";
    confirm_btn.innerText = "pokaż";
    confirm_btn.className = "agree";
    confirm_btn.addEventListener("click", function cont() {
        fun();
        while (uid_element.childElementCount > 1) {
            uid_element.lastChild.remove();
        }
    });

    const cancel_btn = document.createElement("button");
    cancel_btn.type = "button";
    cancel_btn.innerText = "anuluj";
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

const fun = function() {
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
                    uid_element.querySelector(".uid").dataset.content = "Click to reveal UID";
                }, 10000)
            }
        }
    }

    xhr.send("show-uid=ok"); 
}

// I usually do not suck at javascript, but this code? I am not proud of and very dissapointed with my performance - @AdamrePL