document.querySelectorAll(".contact-info").forEach(element => {
    element.addEventListener("toggle", (e) => {
        let id = e.target.parentNode.id.split("_")[1];
        if (element.hasAttribute("open")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "controllers/antiscraping.php", true); 
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // application/json
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = JSON.parse(xhr.responseText); // return
                        if (data["discord"] != null && data["discord"] != "") {
                            let disc = document.createElement("p");

                            disc.innerHTML = '<i class="fa-brands fa-discord"></i> '+data["discord"];
                            
                            e.target.appendChild(disc);
                        }
                        if (data["email"] != null && data["email"] != "") {
                            let mail = document.createElement("p");
                            mail.innerHTML = '<i class="fa-regular fa-envelope"></i> '+data["email"];
                            
                            e.target.appendChild(mail);
                        }

                        if (data["phone"] != null && data["phone"] != "") {
                            let phon = document.createElement("p");
                            phon.innerHTML = '<i class="fa-solid fa-phone"></i> '+data["phone"];
                            
                            e.target.appendChild(phon);
                        }
                    }
                }
            }
            xhr.send("offer-id=" + encodeURIComponent(id));
        } else {
            const siblings = Array.from(e.target.children);
          
            siblings.forEach(sibling => {
                if (sibling !== e.target.firstChild) {
                    e.target.removeChild(sibling);
                }
            });
        }
    });
});

// You can create class for that if you want.. ig it is gonna be used in 2 places, profile.php and main page to be exact
// function displayInfo(id) {
//     getContact(id);
// }

// class OfferController {

// }