function expand(id) {
    a = $("#"+id);
    tr = a.parent().parent();
    tr.after('<tr><td style="border: 0; padding: 0;"></td>'
             +'<td style="padding: 0;" colspan="4">'
             +'<div id="tdexps'+id+'" class="exps"></div></td></tr>');
    Ajax("proexp", "#tdexps"+id, "pro="+id);
    $("#tdexps"+id).slideDown("normal");
    a.attr("href", "javascript:collapse('"+id+"')");
    $("#"+id+" img").attr("src", "theme/images/collapse.png");
}

function collapse(id) {
    div = $("#tdexps"+id);
    div.slideUp("normal", function () {
            div.parent().parent().remove();
        });
    $("#"+id).attr("href", "javascript:expand('"+id+"')");
    $("#"+id+" img").attr("src", "theme/images/expand.png");
}