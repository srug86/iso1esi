/* Change powered's images */
$(document).ready(function () {
        $("#footer img").mouseenter(function () {
                var img = $(this).attr("src");
                var name = img.substr(0, img.indexOf(".")-1);
                var ext = img.substr(img.indexOf(".")+1);
                $(this).attr("src", name+"c."+ext);
            }).mouseleave(function() {
                    var img = $(this).attr("src");
                    var name = img.substr(0, img.indexOf(".")-1);
                    var ext = img.substr(img.indexOf(".")+1);
                    $(this).attr("src", name+"g."+ext);                    
                })
            });

/* Ajax querys */
function Ajax(func, layer, values) {
    $.ajax({
           type: "POST",
           async: false,
           url: "index.php?act="+func,
           data: values,
           dataType: "xhtml",
           success: function (xhtml) {
                $(layer).html(xhtml);
           },
           error: function (obj, msg) {
                alert("*** Error: "+ msg);
           }
           });
}

/* Validates */
function val_select(id) {
    if (document.getElementById(id).value == "default") {
        alert("Debe seleccionar alguna opción");
        return false;
    }
    else return true;
}

/* Forms fields values */
function values(f) {
    var values = "";
    for (i=0; i<f.length-1; i++) {
        if ((f.elements[i].type == "checkbox" && f.elements[i].checked) ||
            (f.elements[i].type == "radio" && f.elements[i].checked) ||
            (f.elements[i].type != "checkbox" && f.elements[i].type != "radio"))
            valores += f.elements[i].name+"="+f.elements[i].value+"&";
    }
    return values.substring(0, values.length-1);
}