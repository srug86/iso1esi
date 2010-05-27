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
function Ajax(act, layer, values) {
    $.ajax({
           type: "POST",
           async: false,
           url: "index.php?act="+act,
           data: values,
           dataType: "xhtml",
           success: function (xhtml) {
                if (layer != "")
                    $(layer).html(xhtml);
           },
           error: function (obj, msg) {
                alert("*** Error: "+ msg);
           }
           });
}

/* Forms fields values */
function values(f) {
    var values = "";
    for (i=0; i<f.length-1; i++) {
        if ((f.elements[i].type == "checkbox" && f.elements[i].checked) ||
            (f.elements[i].type == "radio" && f.elements[i].checked) ||
            (f.elements[i].type != "checkbox" && f.elements[i].type != "radio"))
            values += f.elements[i].name+"="+f.elements[i].value+"&";
    }
    return values.substring(0, values.length-1);
}

/* FadeOut system messages */
$(document).ready(function () {
        setTimeout(function () {$("#body #right #msg").fadeOut()}, 4000);
    });

/* Validates */
function val_select(id) {
    if (document.getElementById(id).value == "default") {
        alert("Debe seleccionar alguna opción");
        return false;
    }
    else return true;
}

function val_savemod() {
    var result = true;
    if ($("#modform #conv").attr("value") == "default") {
        alert("Debe seleccionar una convocatoria");
        result = false;
    }
    else if (!$("#modform #modst input").length) {
        alert("Debe añadir algún campo al modelo");
        result = false;
    }
    else {
        $("#modform #modst input[type=text]").each(function () {
                if ($(this).attr("value") == "") {
                    alert("Debe rellenar todos los campos añadidos");
                    result = false;
                    return false;
                }
            });
    }
    return result;
}

function val_projects() {
    res = false;
    check = $("#projects table input:checkbox:checked");    
    if (check.length == 0) alert("Debe seleccionar un proyecto primero");
    else if (check.length > 1) 
        alert("Debe seleccionar sólo un proyecto a la vez");
    else res = true;
    return res;
}

/* Functions without implementation */
function woimp() {
    alert("Esta funcionalidad no está implementada");
}
