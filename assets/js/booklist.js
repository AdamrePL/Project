var isSelected = false;
function selected() {
    var button = document.getElementById("btn-filter");
    const buttonStyle = button.style;

    if(!isSelected){
        isSelected = true;
        button.style.background = "black";
        button.style.color = "white";
    }
    else{
        isSelected = false;
        button.style = button.style;
    }






    


}
