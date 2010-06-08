var down = false;
function make_report(type) {
    if (val_projects()) {
        if (!down && confirm_rep(check)) {
            tr = check.parent().parent();
            tr.after('<tr><td style="border: 0;"></td>'
                     +'<td colspan="5"><div id="tdreport"></div></td></tr>');
            var id = check.attr("name");
            Ajax("makerep", "#tdreport", "rep="+id);

            if (type == "expert")
                $("#mem").dialog({title: "Memoria", 
                                  width: 300, height: 400,
                                  position: [70, 350]});

            $("#tdreport").slideDown("normal");
            down = true;
        }
    }
}

function set_end_report() {
    $("input[name=end]").attr("value", 1);
}

function end_report() {
    if (val_projects()) {
        check = $("#projects table input:checkbox:checked");    
        if (confirm_rep(check)) {
            var id = check.attr("name");
            Ajax("endrep", "", "id="+id);
            history.go(0);
        }
    }
}

var reps = 0;
function view_report(id) {
    Ajax("viewrep", "#reports", "id="+id);
    $("#reports").after($("#reports").html());
    $("#reports").html("");
    $("#report"+id).dialog({width: 400, height: 400,
                            position: [370+reps*20, 100+reps*20]});
    reps++;
}

function confirm_rep(check) {
    var res = true;
    if (check.attr("value") == 1) 
        res = confirm("¡Advertencia! Este informe de evaluación ha sido ya "
                     +"finalizado por usted. ¿Desea continuar de todos modos?");
    return res;
}

var valul = false;
function valuate_expert() {
    check = $("table#experts input:checkbox:checked");
    if (check.length == 0) alert("Debe seleccionar un experto primero");
    else if (check.length > 1) alert("Sólo puede valorar un experto a la vez");
    else {
        if (!valul) {
            var id = check.attr("name");
            tr = check.parent().parent();
            tr.after('<tr><td style="border: 0; padding: 0;"></td>'
                     +'<td style="padding: 0;" colspan="4">'
                     +'<div id="tdexps'+id+'" class="exps"></div></td></tr>');
            valul = true;
            Ajax("valurep", "#tdexps"+id, "id="+id);
        }
        else alert("Valoración en progreso");
    }
}

function save_valuated(f, id, pro) {
    check = $("table#experts input:checkbox:checked");
    check.attr("checked", "");
    valul = false;
    Ajax("savval", "", "pro="+pro+"&id="+id+"&"+values(f));
    check.parent().parent().next().remove();
}