document.querySelector(".overlay").onclick = (e) =>{
    if (e.target == document.querySelector(".overlay")) {
        console.log("clicked background");
        e.target.remove();
    }
    if (e.target == document.querySelector(".overlay .overlay-msg")) {
        e.target.parentNode.remove();
        console.log("clicked text");
    }
}
