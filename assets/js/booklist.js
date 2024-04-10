filtering("all")

function toggleSide_Panel() {
    var side_panel = document.getElementById("side-panel-booklist");
    var booklist = document.getElementById("booklist");

    if (side_panel.style.width === "0px") 
    {
        side_panel.style.width = "450px";
        booklist.style.marginLeft = "450px";
    }

    else 
    {
        side_panel.style.width = "0px";
        booklist.style.marginLeft = "auto";
    }
}
