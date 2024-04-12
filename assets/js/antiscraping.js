var isShowed = false;

function showData() {
    var dataContainer = document.getElementById("data-container");
    var data = dataContainer.innerText;
    var button = document.getElementById("btn-show-data");
    const buttonStyle = button.style;
    if(!isShowed){
        var decodedData = atob(data);
        dataContainer.style.display = 'block'; 
        dataContainer.innerText = decodedData;
        button.style.background = "black";
        button.style.color = "white";
        isShowed = true;
    }
    
    else
    {
        var encodedData = btoa(data) ;
        dataContainer.style.display = 'none';
        dataContainer.innerText = encodedData;
        button.style = buttonStyle;
        isShowed = false;
    }

}