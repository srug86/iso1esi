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