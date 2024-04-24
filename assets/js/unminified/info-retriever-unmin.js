function recaptcha_callback() {
    let xhr = new XMLHttpRequest();
    var form_data = new FormData(document.getElementById("captcha-f"));
    xhr.open("POST", "../controllers/get-contact-info.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText == "failure"){
                document.getElementById("contact-info").innerHTML = "<p>Wystąpił błąd podczas pobierania danych kontaktowych. Odśwież stronę</p>";
                return;
            }
            document.getElementById("contact-info").innerHTML = xhr.responseText;
        }
    }
    xhr.send(form_data);
}