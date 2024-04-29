function recaptcha_callback() {
    let e = new XMLHttpRequest;
    var t = new FormData(document.getElementById("captcha-f"));
    e.open("POST","../controllers/get-contact-info.php",!0);
    e.onreadystatechange = function() {
        if (4 == e.readyState && 200==e.status) {
            if ("failure"==e.responseText) {
                document.getElementById("contact-info").innerHTML = "<p>Wystąpił błąd podczas pobierania danych kontaktowych. Odśwież stronę</p>";
                return
            }
            document.getElementById("contact-info").innerHTML=e.responseText
        }
    }
    e.send(t)
}