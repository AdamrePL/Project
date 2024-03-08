<?php




function log_out(): bool {
    if (empty($_SESSION)) {
        return false;
    }

    session_unset();
    session_destroy();
    return true;
}

function update_last_login(mysqli $conn, string $username) {
    $sql = "UPDATE users SET `last-login` = NOW() WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getAllSiblings(element) {
    let childrens = [];
    getAllChild(childrens, element.parentNode);
}

function getAllChild(array, div) {
    for (let index = 0; index < div.childElementCount; index++) {
        const element = div.children[index];
        if (element.childElementCount > 0) {
            getAllChild(array, element)
        }
        array.push(element);
    }
}

function createParagraphForm() {
    let p = document.querySelector(".footer");

    let form = document.createElement("form");
    form.setAttribute("id", "add-paragraph");
    form.setAttribute("method", "POST");
    form.onsubmit = (event) => {
        event.preventDefault();
        addParagraph();
    }
    
    let textarea = document.createElement("textarea");
    textarea.setAttribute("class", "paragraphs");
    textarea.addEventListener('input', AdjustParagraphHeight);


    let submitbutton = document.createElement("input");
    submitbutton.setAttribute("type", "submit");
    submitbutton.setAttribute("value", "Dodaj")


    let clearbutton = document.createElement("input");
    clearbutton.setAttribute("type", "reset");
    clearbutton.setAttribute("value", "Wyczyść")

    let cancelbutton = document.createElement("input");
    cancelbutton.setAttribute("type", "button");
    cancelbutton.setAttribute("value", "Anuluj");
    cancelbutton.onclick = () => {
        form.remove();
    }

    p.parentNode.insertBefore(form, p);
    form.appendChild(textarea);
    form.appendChild(cancelbutton);
    form.appendChild(clearbutton);
    form.appendChild(submitbutton);


    function addParagraph() {
        var form = document.querySelector("#add-paragraph");
        let content = form.firstChild.innerHTML;
    
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "addparagraph.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onload = () => {
            form.remove();
        }
        xhr.send(content)
    }

    $conn -> close();