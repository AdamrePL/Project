function showData() {
    var encodedData = document.getElementById("data-container").innerText;

    var decodedData = atob(encodedData);

    var dataContainer = document.getElementById("data-container");
    dataContainer.style.display = 'block'; 
    dataContainer.innerText = decodedData;
}