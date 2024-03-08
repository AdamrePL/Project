// window.onload = alert("meta mis juevos en tu boca");

//i have no idea what im doing :D
// let A = document.querySelector("#ibox");
// let B = document.querySelector("#si");
// A.addEventListener("click", () => {
//     B.style.visibility = visible;
//     () => {
//     A.style.visibility = visible;
//     }
// hgnhhhhhhhhhhhhh i no want nesting () => and even listener hnghhhhhhhhh
//     
// })


//check when user scrolled past/to legend -> append(?) navigate.php, or hide idfk

//holy hell this is horrible
// document.addEventListener("scroll", () => {
//     var A = window.scrollY;
//     if(A>=250){ //change to variables with sth like document.body.scrollheight/top/bottom whatevrlhtalrht
//         document.querySelector("#test").style.visibility ="visible";
//     } else if(A<=250) {
//         document.querySelector("#test").style.visibility ="hidden";
//     }
// })


// })


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