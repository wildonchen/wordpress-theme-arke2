/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-10-16 11:48:29 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-16 16:08:38
 */
var albumLightbox = (function openAblbumBox() {
    return {
        open: function (e) {
            loading.begin();
            //处理oss缩略图
            if (e.src.indexOf("?x-oss-process") == -1) {
                var src = e.src;
            } else {
                var src = e.src.substring(0, e.src.indexOf("?"));
            }
            var con=document.getElementsByClassName(e.getAttribute("data-id"))[1];
            var box = document.createElement("div");
            var imgBox = document.documentElement.clientHeight-100;
            box.id = "albumLightbox";
            box.innerHTML =
                '<div id="albumLightbox"><form style="width:100% ;height:100%"><table border=0 cellpadding=0 cellspacing=0 style="width:100% ;height:100%"><tr><td style="width:100%;" align="center" valign="middle"><img onclick="albumLightbox.close();" id="albumLightImg" style="max-height:' +
                imgBox +
                'px;" src="' +
                src +
                '" onerror="this.src=base+\'/assets/img/no-img.jpg\'"/><div id="albumLightboxCon" class="fix-width">'+con.innerHTML+'</div></td></tr></table></form></div><div id="imgLightbox-button" onclick="albumLightbox.close();">&Cross;</div>';
            document.body.appendChild(box);
            loading.end("albumLightImg");
        },
        close: function () {
            document.body.removeChild(document.getElementById("albumLightbox"));
        },
    };
})();