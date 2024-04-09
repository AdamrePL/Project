var offer_id = 1;

function getContact() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "antiscraping.php", true); 
    // & I don't have any clue how tf this path works but it works - @AdamrePL
    // * Actually on second thought, I think it's the path from the currently working/active page (page where the event/function/xhr was triggered/called - also in other words, from where the xhr was sent and NOT from script file location)
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // application/json
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Here you work with the data thats been recived from php file
                // ex. you insert it into DOM
                console.log( JSON.parse(xhr.responseText) ); // 
            }
        }
    }

    xhr.send("offer-id=" + encodeURIComponent(offer_id)); 
}