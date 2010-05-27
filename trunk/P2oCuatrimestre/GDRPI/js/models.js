var down = false;
function new_model() {
    if (!down) {
        Ajax("newmod", "#new");
        $("#new").slideDown("normal");
        down = true;
    }
}

var convs = 0;
function view_conv() {
    if (val_select("conv")) {
        convs++;
        var select = document.getElementById("conv");
        var id = select.value;
        var index = select.selectedIndex
        var title = select.options[index].text;
        $("#dialogs").append('<div id="conv'+convs+'" class="convs"></div>');
        Ajax("viewconv", "#conv"+convs, "conv="+id);
        $("#conv"+convs).dialog({title: "Convocatoria: "+title, 
                                 width: 300, height: 400,
                                 position: [30+convs*10, 200+convs*20]});
    }
}

var sec = -1; var els = -1; 
function add_form(type) {
    var str = "";

    if (type == "sec") {
        sec++;
        els = -1;
        str += '<div id="sec'+sec+'" class="form"><a href="'
            +'javascript:del_form(\'sec'+sec+'\')"><img src="'
            +'img/x-red.png" alt=""></a><p class="sec">'+(sec+1)
            +'. <input type="text" name="sec['+sec+'][txt]" /></p></div>';
        $("#modst").append(str);
    }
    else if (sec == -1) alert("El primer elemento debe ser una sección");
    else {
        if (type == "are") {
            els++;
            str += '<div id="sec'+sec+'el'+els+'" class="form"><a href="'
                +'javascript:del_form(\'sec'+sec+'el'+els+'\')"><img src="'
                +'img/x-red.png" alt=""></a><br /><input type="hidden"'
                +' name="sec['+sec+'][els]['+els+']['+type+']" /><textarea '
                +'disabled="disabled"></textarea></div>';
        }
        else if (type == "fie") {
            els++;
            str += '<div id="sec'+sec+'el'+els+'" class="form"><a href="'
                +'javascript:del_form(\'sec'+sec+'el'+els+'\')"><img src="'
                +'img/x-red.png" alt=""></a><br /><input type="text"'
                +'class="fie" name="sec['+sec+'][els]['+els+']['
                +type+']" /><div style="clear:both"></div></div>';
        }
        else if (type == "lst" || type == "rad" || type == "chk") {
            if (val_select(type)) {
                els++;
                var num = $("#"+type).attr("value");
                str += '<div id="sec'+sec+'el'+els+'" class="form">'
                    +'<a href="javascript:del_form(\'sec'+sec+'el'+els+'\')">'
                    +'<img src="img/x-red.png" alt=""></a>';
                switch (type) {
                case "lst": 
                    str += '<p class="txt">- Lista desplegable:</p>'; break;
                case "rad": str += '<p class="txt">- Radiales:</p>'; break;
                case "chk": str += '<p class="txt">- Cajas:</p>'; break;
                }
                for (i=0; i<num; i++) {
                    str += 'Opción '+(i+1)+': <input type="text" name="sec['+sec
                        +'][els]['+els+']['+type+']['+i+']" /><br />';
                }   
                str += '</div>';
            }
        }
        $("#modst #sec"+sec).append(str);
    }
}

function del_form(id) {
    if (id.indexOf("el") == -1 && id.substr(3) == sec) sec--;
    $("#"+id).remove();
}

function mod_model() {
    check = $("#evmods table input:checkbox:checked");
    if (check.length == 0) alert("Debe seleccionar un modelo primero");
    else if (check.length > 1) 
        alert("Sólo se puede modificar un modelo a la vez");
    else {
        if (!down && confirm_mod(check, "modifica")) {
            Ajax("modmod", "#new", "id="+check.attr("name"));
            
            /* Restore the js variables */
            sec = $("#new #modst input#sec").attr("value");
            els = $("#new #modst input#els").attr("value");

            $("#new").slideDown("normal");
            down = true;
        }        
    }
}

function save_model() {
    if (val_savemod())
        document.getElementById("modform").submit();
}

function del_model() {
    check = $("#evmods table input:checkbox:checked");
    if (check.length == 0) alert("Debe seleccionar un modelo primero");
    else if (confirm_mod(check, "elimina")) {
        var ids = "";
        check.each(function () {
                ids += $(this).attr("name")+",";
            });
        Ajax("delmod", "", "ids="+ids);
        history.go(0);
    }
}

function confirm_mod(check, str) {
    var res = true;
    if (check.attr("value") > 0) 
        res = confirm("Si "+str+" un modelo de evaluación que ya se ha "
                      +"empleado en algún "
                      +"proyecto afectará a la consistencia de la información "
                      +"en el sistema. ¿Desea continuar de todos modos?");
    return res;
}