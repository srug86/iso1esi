var down = false;
function make_report() {
    check = $("#projects table input:checkbox:checked");    
    if (check.length == 0) alert("Debe seleccionar un proyecto primero");
    else if (check.length > 1) 
        alert("Sólo se puede modificar una evaluación a la vez");
    else {
        if (!down) {
            tr = check.parent().parent();
            tr.after('<tr><td style="border: 0;"></td>'
                     +'<td colspan="5"><div id="tdreport"></div></td></tr>');
            var id = check.attr("name");
            Ajax("makerep", "#tdreport", "rep="+id);
            $("#mem").dialog({title: "Memoria", 
                              width: 300, height: 400,
                              position: [70, 350]});
            $("#tdreport").slideDown("normal");
            down = true;
        }
    }
}

function end_report() {
    $("input[name=end]").attr("value", 1);
}