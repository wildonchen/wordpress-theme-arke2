var passiveSupported = false;
    try {
        var options = Object.defineProperty({}, "passive", {
            get: function() {
                passiveSupported = true;
            }
        });
        
    } catch(err) {}
    function fn() {
      
    }
/*! This file is auto-generated */
window.addComment = (function (v) {
  var I,
    C,
    h,
    E = v.document,
    b = {
      commentReplyClass: "comment-reply-link",
      commentReplyTitleId: "reply-title",
      cancelReplyId: "cancel-comment-reply-link",
      commentFormId: "commentform",
      temporaryFormId: "wp-temp-form-div",
      parentIdFieldId: "comment_parent",
      postIdFieldId: "comment_post_ID",
    },
    e = v.MutationObserver || v.WebKitMutationObserver || v.MozMutationObserver,
    r = "querySelector" in E && "addEventListener" in v,
    n = !!E.documentElement.dataset;
  function t() {
    d(), e && new e(o).observe(E.body, { childList: !0, subtree: !0 });
  }
  function d(e) {
    if (r && ((I = g(b.cancelReplyId)), (C = g(b.commentFormId)), I)) {
      I.addEventListener("touchstart", l,passiveSupported ? { passive: true } : false), I.addEventListener("click", l,passiveSupported ? { passive: true } : false);
      var t = function (e) {
        if ((e.metaKey || e.ctrlKey) && 13 === e.keyCode)
          return (
            C.removeEventListener("keydown", t),
            e.preventDefault(),
            C.submit.click(),
            !1
          );
      };
      C && C.addEventListener("keydown", t,passiveSupported ? { passive: true } : false);
      for (
        var n,
          d = (function (e) {
            var t = b.commentReplyClass;
            (e && e.childNodes) || (e = E);
            t = E.getElementsByClassName
              ? e.getElementsByClassName(t)
              : e.querySelectorAll("." + t);
            return t;
          })(e),
          o = 0,
          i = d.length;
        o < i;
        o++
      )
        (n = d[o]).addEventListener("touchstart", a,passiveSupported ? { passive: true } : false),
          n.addEventListener("click", a,passiveSupported ? { passive: true } : false);
    }
  }
  function l(e) {
    var t,
      n,
      d = g(b.temporaryFormId);
    d &&
      h &&
      ((g(b.parentIdFieldId).value = "0"),
      (t = d.textContent),
      d.parentNode.replaceChild(h, d),
      (this.style.display = "none"),
      (n =
        (d = (n = g(b.commentReplyTitleId)) && n.firstChild) && d.nextSibling),
      d &&
        d.nodeType === Node.TEXT_NODE &&
        t &&
        (n &&
          "A" === n.nodeName &&
          n.id !== b.cancelReplyId &&
          (n.style.display = ""),
        (d.textContent = t)),
      e.preventDefault());
  }
  function a(e) {
    var t = g(b.commentReplyTitleId),
      n = t && t.firstChild.textContent,
      d = this,
      o = m(d, "belowelement"),
      i = m(d, "commentid"),
      r = m(d, "respondelement"),
      t = m(d, "postid"),
      n = m(d, "replyto") || n;
    o &&
      i &&
      r &&
      t &&
      !1 === v.addComment.moveForm(o, i, r, t, n) &&
      e.preventDefault();
  }
  function o(e) {
    for (var t = e.length; t--; ) if (e[t].addedNodes.length) return void d();
  }
  function m(e, t) {
    return n ? e.dataset[t] : e.getAttribute("data-" + t);
  }
  function g(e) {
    return E.getElementById(e);
  }
  return (
    r && "loading" !== E.readyState
      ? t()
      : r && v.addEventListener("DOMContentLoaded", t, !1),
    {
      init: d,
      moveForm: function (e, t, n, d, o) {
        var i = g(e);
        h = g(n);
        var r,
          l,
          a,
          m,
          c = g(b.parentIdFieldId),
          s = g(b.postIdFieldId),
          y = g(b.commentReplyTitleId),
          p = y && y.firstChild,
          u = p && p.nextSibling;
        if (i && h && c) {
          void 0 === o && (o = p && p.textContent),
            (m = h),
            (e = b.temporaryFormId),
            (n = g(e)),
            (y = (y = g(b.commentReplyTitleId))
              ? y.firstChild.textContent
              : ""),
            n ||
              (((n = E.createElement("div")).id = e),
              (n.style.display = "none"),
              (n.textContent = y),
              m.parentNode.insertBefore(n, m)),
            d && s && (s.value = d),
            (c.value = t),
            (I.style.display = ""),
            i.parentNode.insertBefore(h, i.nextSibling),
            p &&
              p.nodeType === Node.TEXT_NODE &&
              (u &&
                "A" === u.nodeName &&
                u.id !== b.cancelReplyId &&
                (u.style.display = "none"),
              (p.textContent = o)),
            (I.onclick = function () {
              return !1;
            });
          try {
            for (var f = 0; f < C.elements.length; f++)
              if (
                ((r = C.elements[f]),
                (l = !1),
                "getComputedStyle" in v
                  ? (a = v.getComputedStyle(r))
                  : E.documentElement.currentStyle && (a = r.currentStyle),
                ((r.offsetWidth <= 0 && r.offsetHeight <= 0) ||
                  "hidden" === a.visibility) &&
                  (l = !0),
                "hidden" !== r.type && !r.disabled && !l)
              ) {
                r.focus();
                break;
              }
          } catch (e) {}
          return !1;
        }
      },
    }
  );
})(window);
