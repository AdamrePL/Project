document.getElementById("searchbar").addEventListener("input", () => {
    let search_query = document.getElementById("searchbar").value;
    
    const xhr = new XMLHttpRequest();
    xhr.open("get", "controllers/search-controller.php?search=" + encodeURIComponent(search_query), true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.response);
            }
        }
    }
    xhr.send();
});