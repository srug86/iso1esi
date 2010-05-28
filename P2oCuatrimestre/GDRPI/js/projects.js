function expand(id) {
    expand(id, "");
}

function expand(id, type) {
    a = $("#"+id);
    tr = a.parent().parent();
    tr.after('<tr><td style="border: 0; padding: 0;"></td>'
             +'<td style="padding: 0;" colspan="4">'
             +'<div id="tdexps'+id+'" class="exps"></div></td></tr>');

    if (type == "search") Ajax("srchfrm", "#tdexps"+id, "pro="+id);
    else if (type == "valuated") Ajax("", "#tdexps"+id, "pro="+id);
    else Ajax("proexp", "#tdexps"+id, "pro="+id);

    $("#tdexps"+id).slideDown("slow");
    a.attr("href", "javascript:collapse('"+id+"')");
    $("#"+id+" img").attr("src", "img/collapse.png");
}

function collapse(id) {
    div = $("#tdexps"+id);
    $.each(div, function() {
            $(this).slideUp("slow", function () {
                    $(this).parent().parent().remove();
                })
                });
    $("#"+id).attr("href", "javascript:expand('"+id+"')");
    $("#"+id+" img").attr("src", "img/expand.png");
    expanded = false;
    valul = false;
}

var expanded = false;
function assign_experts(cas) {
    if (val_projects()) {
        if (!expanded || cas) {
            check = $("#projects table input:checkbox:checked");    
            var id = check.attr("name");
            $("#tdexps"+id).parent().parent().remove();
            expand(id, type="search");
            expanded = true;
        }
        else alert("Asignación de expertos en curso");
    }
}

function search(f, id) {
    Ajax("srchexp", "#srch", "pro="+id+"&"+values(f));
}

function assign(pro) {
    check = $("#projects #srch table input:checkbox:checked");    

    if (check.length == 0) alert("Debe seleccionar un experto primero");
    else {
        var ids = "";
        check.each(function () {
                ids += $(this).attr("name")+",";
            });
        ids = ids.substr(0, ids.length-1);
        Ajax("asgexp", "", "ids="+ids+"&pro="+pro);
        history.go(0);
    }
}
