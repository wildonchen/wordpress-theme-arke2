/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-04-05 11:10:04 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-17 10:02:33
 */

/*预设函数加载和资源路径*/
var load = (function loadsrc(){
    return {
      comment: function (e,id) {
        
        
            try{
                comment(e,id);
                
            }
            catch(err){
                loadScript("/assets/css/comment.min.css","css","comment-css","head");
                loadScript("/assets/js/comment.min.js","js","comment-js","body");
                document.getElementById("comment-js").addEventListener("load", function () {
                    comment(e,id);
                })
            }

      },
      content: function (e,id) {
        try{
            content(e,id);
        }
        catch(err){
                loadScript("/assets/css/content.min.css","css","content-css","head");
                loadScript("/assets/css/library.min.css","css","library-css","head");
                loadScript("/assets/js/content.min.js","js","content-js","body");
                document.getElementById("content-js").addEventListener("load", function () {
                    content(e,id);
                })
        
        }
        },
        postNavShow: function (e) {
            try{
                postNavShow(e);
            }
            catch(err){
                loadScript("/assets/css/post-nav.min.css","css","post-nav-css","head");
                loadScript("/assets/js/post-nav.min.js","js","post-nav-js","body");
                document.getElementById("post-nav-js").addEventListener("load", function (){
                        postNavShow(e);
                    })
            }

        },
        baguetteBox: function (e) {
            try{
                baguetteBox.run(e);
            }
            catch(err){
                loadScript("/assets/css/baguetteBox.min.css","css","baguetteBox-css","head");
                loadScript("/assets/js/baguetteBox.min.js","js","baguetteBox-js","body");
                document.getElementById("baguetteBox-js").addEventListener("load", function (){
                    baguetteBox.run(e);
                })
            }

        },
        prettyPrint: function (e) {
            try{
                prettyPrint(e);
            }
            catch(err){
                loadScript("/assets/js/prettify.min.js","js","prettify-js","body");
                document.getElementById("prettify-js").addEventListener("load", function (){
                    prettyPrint(e);
                    setPrettifyLine();
                })
            }

        },
        book: function (e) {
            try{
                book(e);
            }
            catch(err){
                loadScript("/assets/css/book.min.css","css","book-css","head");
                loadScript("/assets/js/book.min.js","js","book-js","body");
                document.getElementById("book-js").addEventListener("load", function (){
                    book(e);
                })
            }

        }
    };
}());