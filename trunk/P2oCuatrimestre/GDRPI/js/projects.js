function expand(id) {
    a = $("#"+id);
    tr = a.parent().parent();
    tr.after('<tr><td style="border: 0; padding: 0;"></td>'
             +'<td style="padding: 0;" colspan="4">'
             +'<div id="tdexps'+id+'" class="exps"></div></td></tr>');
    Ajax("proexp", "#tdexps"+id, "pro="+id);
    $("#tdexps"+id).slideDown("normal");
    a.attr("href", "javascript:collapse('"+id+"')");
    $("#"+id+" img").attr("src", "img/collapse.png");
}

function collapse(id) {
    div = $("#tdexps"+id);
    div.slideUp("normal", function () {
            div.parent().parent().remove();
        });
    $("#"+id).attr("href", "javascript:expand('"+id+"')");
    $("#"+id+" img").attr("src", "img/expand.png");
}

function assign_experts() {
    if (val_projects()) {
        check = $("#projects table input:checkbox:checked");    
        var id = check.attr("name");
        expand(id);




//             Ajax("endrep", "", "id="+id);
//             history.go(0);
//         }
    }
}
