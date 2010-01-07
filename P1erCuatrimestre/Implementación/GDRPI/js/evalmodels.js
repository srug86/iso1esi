var down = false;
function new_model() {
    if (!down) {
        Ajax("newmod", "#new");
        $("#new").slideDown("normal");
        down = true;
    }
}

function view_conv() {
    //Ajax("viewconv"
}