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