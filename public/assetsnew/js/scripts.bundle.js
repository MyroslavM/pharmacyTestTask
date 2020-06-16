"use strict";

var KTHeader = function (t, e) {
    var a = this, n = KTUtil.get(t), i = KTUtil.get("body");
    if (void 0 !== n) {
        var o = {classic: !1, offset: {mobile: 150, desktop: 200}, minimize: {mobile: !1, desktop: !1}}, l = {
            construct: function (t) {
                return KTUtil.data(n).has("header") ? a = KTUtil.data(n).get("header") : (l.init(t), l.build(), KTUtil.data(n).set("header", a)), a
            }, init: function (t) {
                a.events = [], a.options = KTUtil.deepExtend({}, o, t)
            }, build: function () {
                var t = 0, e = !0;
                KTUtil.getViewPort().height, KTUtil.getDocumentHeight();
                !1 === a.options.minimize.mobile && !1 === a.options.minimize.desktop || window.addEventListener("scroll", function () {
                    var n, o, r, s = 0;
                    KTUtil.isInResponsiveRange("desktop") ? (s = a.options.offset.desktop, n = a.options.minimize.desktop.on, o = a.options.minimize.desktop.off) : KTUtil.isInResponsiveRange("tablet-and-mobile") && (s = a.options.offset.mobile, n = a.options.minimize.mobile.on, o = a.options.minimize.mobile.off), r = KTUtil.getScrollTop(), KTUtil.isInResponsiveRange("tablet-and-mobile") && a.options.classic && a.options.classic.mobile || KTUtil.isInResponsiveRange("desktop") && a.options.classic && a.options.classic.desktop ? r > s ? (KTUtil.addClass(i, n), KTUtil.removeClass(i, o), e && (l.eventTrigger("minimizeOn", a), e = !1)) : (KTUtil.addClass(i, o), KTUtil.removeClass(i, n), 0 == e && (l.eventTrigger("minimizeOff", a), e = !0)) : (r > s && t < r ? (KTUtil.addClass(i, n), KTUtil.removeClass(i, o), e && (l.eventTrigger("minimizeOn", a), e = !1)) : (KTUtil.addClass(i, o), KTUtil.removeClass(i, n), 0 == e && (l.eventTrigger("minimizeOff", a), e = !0)), t = r)
                })
            }, eventTrigger: function (t, e) {
                for (var n = 0; n < a.events.length; n++) {
                    var i = a.events[n];
                    if (i.name == t) {
                        if (1 != i.one) return i.handler.call(this, a, e);
                        if (0 == i.fired) return a.events[n].fired = !0, i.handler.call(this, a, e)
                    }
                }
            }, addEvent: function (t, e, n) {
                a.events.push({name: t, handler: e, one: n, fired: !1})
            }
        };
        return a.setDefaults = function (t) {
            o = t
        }, a.on = function (t, e) {
            return l.addEvent(t, e)
        }, l.construct.apply(a, [e]), !0, a
    }
};
// "undefined" != typeof module && void 0 !== module.exports && (module.exports = KTHeader);
var KTMenu = function (t, e) {
    var a = this, n = !1, i = KTUtil.get(t), o = KTUtil.get("body");
    if (i) {
        var l = {scroll: {rememberPosition: !1}, accordion: {slideSpeed: 200, autoScroll: !1, autoScrollSpeed: 1200, expandAll: !0}, dropdown: {timeout: 500}}, r = {
            construct: function (t) {
                return KTUtil.data(i).has("menu") ? a = KTUtil.data(i).get("menu") : (r.init(t), r.reset(), r.build(), KTUtil.data(i).set("menu", a)), a
            }, init: function (t) {
                a.events = [], a.eventHandlers = {}, a.options = KTUtil.deepExtend({}, l, t), a.pauseDropdownHoverTime = 0, a.uid = KTUtil.getUniqueID()
            }, update: function (t) {
                a.options = KTUtil.deepExtend({}, l, t), a.pauseDropdownHoverTime = 0, r.reset(), a.eventHandlers = {}, r.build(), KTUtil.data(i).set("menu", a)
            }, reload: function () {
                r.reset(), r.build(), r.resetSubmenuProps()
            }, build: function () {
                a.eventHandlers.event_1 = KTUtil.on(i, ".kt-menu__toggle", "click", r.handleSubmenuAccordion), ("dropdown" === r.getSubmenuMode() || r.isConditionalSubmenuDropdown()) && (a.eventHandlers.event_2 = KTUtil.on(i, '[data-ktmenu-submenu-toggle="hover"]', "mouseover", r.handleSubmenuDrodownHoverEnter), a.eventHandlers.event_3 = KTUtil.on(i, '[data-ktmenu-submenu-toggle="hover"]', "mouseout", r.handleSubmenuDrodownHoverExit), a.eventHandlers.event_4 = KTUtil.on(i, '[data-ktmenu-submenu-toggle="click"] > .kt-menu__toggle, [data-ktmenu-submenu-toggle="click"] > .kt-menu__link .kt-menu__toggle', "click", r.handleSubmenuDropdownClick), a.eventHandlers.event_5 = KTUtil.on(i, '[data-ktmenu-submenu-toggle="tab"] > .kt-menu__toggle, [data-ktmenu-submenu-toggle="tab"] > .kt-menu__link .kt-menu__toggle', "click", r.handleSubmenuDropdownTabClick)), a.eventHandlers.event_6 = KTUtil.on(i, ".kt-menu__item > .kt-menu__link:not(.kt-menu__toggle):not(.kt-menu__link--toggle-skip)", "click", r.handleLinkClick), a.options.scroll && a.options.scroll.height && r.scrollInit()
            }, reset: function () {
                KTUtil.off(i, "click", a.eventHandlers.event_1), KTUtil.off(i, "mouseover", a.eventHandlers.event_2), KTUtil.off(i, "mouseout", a.eventHandlers.event_3), KTUtil.off(i, "click", a.eventHandlers.event_4), KTUtil.off(i, "click", a.eventHandlers.event_5), KTUtil.off(i, "click", a.eventHandlers.event_6)
            }, scrollInit: function () {
                a.options.scroll && a.options.scroll.height ? (KTUtil.scrollDestroy(i), KTUtil.scrollInit(i, {mobileNativeScroll: !0, windowScroll: !1, resetHeightOnDestroy: !0, handleWindowResize: !0, height: a.options.scroll.height, rememberPosition: a.options.scroll.rememberPosition})) : KTUtil.scrollDestroy(i)
            }, scrollUpdate: function () {
                a.options.scroll && a.options.scroll.height && KTUtil.scrollUpdate(i)
            }, scrollTop: function () {
                a.options.scroll && a.options.scroll.height && KTUtil.scrollTop(i)
            }, getSubmenuMode: function (t) {
                return KTUtil.isInResponsiveRange("desktop") ? t && KTUtil.hasAttr(t, "data-ktmenu-submenu-toggle") && "hover" == KTUtil.attr(t, "data-ktmenu-submenu-toggle") ? "dropdown" : KTUtil.isset(a.options.submenu, "desktop.state.body") ? KTUtil.hasClasses(o, a.options.submenu.desktop.state.body) ? a.options.submenu.desktop.state.mode : a.options.submenu.desktop.default : KTUtil.isset(a.options.submenu, "desktop") ? a.options.submenu.desktop : void 0 : KTUtil.isInResponsiveRange("tablet") && KTUtil.isset(a.options.submenu, "tablet") ? a.options.submenu.tablet : !(!KTUtil.isInResponsiveRange("mobile") || !KTUtil.isset(a.options.submenu, "mobile")) && a.options.submenu.mobile
            }, isConditionalSubmenuDropdown: function () {
                return !(!KTUtil.isInResponsiveRange("desktop") || !KTUtil.isset(a.options.submenu, "desktop.state.body"))
            }, resetSubmenuProps: function (t) {
                var e = KTUtil.findAll(i, ".kt-menu__submenu");
                if (e) for (var a = 0, n = e.length; a < n; a++) KTUtil.css(e[0], "display", ""), KTUtil.css(e[0], "overflow", "")
            }, handleSubmenuDrodownHoverEnter: function (t) {
                if ("accordion" !== r.getSubmenuMode(this) && !1 !== a.resumeDropdownHover()) {
                    "1" == this.getAttribute("data-hover") && (this.removeAttribute("data-hover"), clearTimeout(this.getAttribute("data-timeout")), this.removeAttribute("data-timeout")), r.showSubmenuDropdown(this)
                }
            }, handleSubmenuDrodownHoverExit: function (t) {
                if (!1 !== a.resumeDropdownHover() && "accordion" !== r.getSubmenuMode(this)) {
                    var e = this, n = a.options.dropdown.timeout, i = setTimeout(function () {
                        "1" == e.getAttribute("data-hover") && r.hideSubmenuDropdown(e, !0)
                    }, n);
                    e.setAttribute("data-hover", "1"), e.setAttribute("data-timeout", i)
                }
            }, handleSubmenuDropdownClick: function (t) {
                if ("accordion" !== r.getSubmenuMode(this)) {
                    var e = this.closest(".kt-menu__item");
                    "accordion" != e.getAttribute("data-ktmenu-submenu-mode") && (!1 === KTUtil.hasClass(e, "kt-menu__item--hover") ? (KTUtil.addClass(e, "kt-menu__item--open-dropdown"), r.showSubmenuDropdown(e)) : (KTUtil.removeClass(e, "kt-menu__item--open-dropdown"), r.hideSubmenuDropdown(e, !0)), t.preventDefault())
                }
            }, handleSubmenuDropdownTabClick: function (t) {
                if ("accordion" !== r.getSubmenuMode(this)) {
                    var e = this.closest(".kt-menu__item");
                    "accordion" != e.getAttribute("data-ktmenu-submenu-mode") && (0 == KTUtil.hasClass(e, "kt-menu__item--hover") && (KTUtil.addClass(e, "kt-menu__item--open-dropdown"), r.showSubmenuDropdown(e)), t.preventDefault())
                }
            }, handleLinkClick: function (t) {
                var e = this.closest(".kt-menu__item.kt-menu__item--submenu");
                !1 !== r.eventTrigger("linkClick", this, t) && e && "dropdown" === r.getSubmenuMode(e) && r.hideSubmenuDropdowns()
            }, handleSubmenuDropdownClose: function (t, e) {
                if ("accordion" !== r.getSubmenuMode(e)) {
                    var a = i.querySelectorAll(".kt-menu__item.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs)");
                    if (a.length > 0 && !1 === KTUtil.hasClass(e, "kt-menu__toggle") && 0 === e.querySelectorAll(".kt-menu__toggle").length) for (var n = 0, o = a.length; n < o; n++) r.hideSubmenuDropdown(a[0], !0)
                }
            }, handleSubmenuAccordion: function (t, e) {
                var n, i = e || this;
                if ("dropdown" === r.getSubmenuMode(e) && (n = i.closest(".kt-menu__item")) && "accordion" != n.getAttribute("data-ktmenu-submenu-mode")) t.preventDefault(); else {
                    var o = i.closest(".kt-menu__item"), l = KTUtil.child(o, ".kt-menu__submenu, .kt-menu__inner");
                    if (!KTUtil.hasClass(i.closest(".kt-menu__item"), "kt-menu__item--open-always") && o && l) {
                        t.preventDefault();
                        var s = a.options.accordion.slideSpeed;
                        if (!1 === KTUtil.hasClass(o, "kt-menu__item--open")) {
                            if (!1 === a.options.accordion.expandAll) {
                                var d = i.closest(".kt-menu__nav, .kt-menu__subnav"), c = KTUtil.children(d, ".kt-menu__item.kt-menu__item--open.kt-menu__item--submenu:not(.kt-menu__item--here):not(.kt-menu__item--open-always)");
                                if (d && c) for (var u = 0, p = c.length; u < p; u++) {
                                    var f = c[0], g = KTUtil.child(f, ".kt-menu__submenu");
                                    g && KTUtil.slideUp(g, s, function () {
                                        r.scrollUpdate(), KTUtil.removeClass(f, "kt-menu__item--open")
                                    })
                                }
                            }
                            KTUtil.slideDown(l, s, function () {
                                r.scrollToItem(i), r.scrollUpdate(), r.eventTrigger("submenuToggle", l, t)
                            }), KTUtil.addClass(o, "kt-menu__item--open")
                        } else KTUtil.slideUp(l, s, function () {
                            r.scrollToItem(i), r.eventTrigger("submenuToggle", l, t)
                        }), KTUtil.removeClass(o, "kt-menu__item--open")
                    }
                }
            }, scrollToItem: function (t) {
                KTUtil.isInResponsiveRange("desktop") && a.options.accordion.autoScroll && "1" !== i.getAttribute("data-ktmenu-scroll") && KTUtil.scrollTo(t, a.options.accordion.autoScrollSpeed)
            }, hideSubmenuDropdown: function (t, e) {
                e && (KTUtil.removeClass(t, "kt-menu__item--hover"), KTUtil.removeClass(t, "kt-menu__item--active-tab")), t.removeAttribute("data-hover"), t.getAttribute("data-ktmenu-dropdown-toggle-class") && KTUtil.removeClass(o, t.getAttribute("data-ktmenu-dropdown-toggle-class"));
                var a = t.getAttribute("data-timeout");
                t.removeAttribute("data-timeout"), clearTimeout(a)
            }, hideSubmenuDropdowns: function () {
                var t;
                if (t = i.querySelectorAll('.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs):not([data-ktmenu-submenu-toggle="tab"])')) for (var e = 0, a = t.length; e < a; e++) r.hideSubmenuDropdown(t[e], !0)
            }, showSubmenuDropdown: function (t) {
                var e = i.querySelectorAll(".kt-menu__item--submenu.kt-menu__item--hover, .kt-menu__item--submenu.kt-menu__item--active-tab");
                if (e) for (var a = 0, n = e.length; a < n; a++) {
                    var l = e[a];
                    t !== l && !1 === l.contains(t) && !1 === t.contains(l) && r.hideSubmenuDropdown(l, !0)
                }
                KTUtil.addClass(t, "kt-menu__item--hover"), t.getAttribute("data-ktmenu-dropdown-toggle-class") && KTUtil.addClass(o, t.getAttribute("data-ktmenu-dropdown-toggle-class"))
            }, createSubmenuDropdownClickDropoff: function (t) {
                var e, a = (e = KTUtil.child(t, ".kt-menu__submenu") ? KTUtil.css(e, "z-index") : 0) - 1, n = document.createElement('<div class="kt-menu__dropoff" style="background: transparent; position: fixed; top: 0; bottom: 0; left: 0; right: 0; z-index: ' + a + '"></div>');
                o.appendChild(n), KTUtil.addEvent(n, "click", function (e) {
                    e.stopPropagation(), e.preventDefault(), KTUtil.remove(this), r.hideSubmenuDropdown(t, !0)
                })
            }, pauseDropdownHover: function (t) {
                var e = new Date;
                a.pauseDropdownHoverTime = e.getTime() + t
            }, resumeDropdownHover: function () {
                return (new Date).getTime() > a.pauseDropdownHoverTime
            }, resetActiveItem: function (t) {
                for (var e, n, o = 0, l = (e = i.querySelectorAll(".kt-menu__item--active")).length; o < l; o++) {
                    var r = e[0];
                    KTUtil.removeClass(r, "kt-menu__item--active"), KTUtil.hide(KTUtil.child(r, ".kt-menu__submenu"));
                    for (var s = 0, d = (n = KTUtil.parents(r, ".kt-menu__item--submenu") || []).length; s < d; s++) {
                        var c = n[o];
                        KTUtil.removeClass(c, "kt-menu__item--open"), KTUtil.hide(KTUtil.child(c, ".kt-menu__submenu"))
                    }
                }
                if (!1 === a.options.accordion.expandAll && (e = i.querySelectorAll(".kt-menu__item--open"))) for (o = 0, l = e.length; o < l; o++) KTUtil.removeClass(n[0], "kt-menu__item--open")
            }, setActiveItem: function (t) {
                r.resetActiveItem();
                for (var e = KTUtil.parents(t, ".kt-menu__item--submenu") || [], a = 0, n = e.length; a < n; a++) KTUtil.addClass(KTUtil.get(e[a]), "kt-menu__item--open");
                KTUtil.addClass(KTUtil.get(t), "kt-menu__item--active")
            }, getBreadcrumbs: function (t) {
                var e, a = [], n = KTUtil.child(t, ".kt-menu__link");
                a.push({text: e = KTUtil.child(n, ".kt-menu__link-text") ? e.innerHTML : "", title: n.getAttribute("title"), href: n.getAttribute("href")});
                for (var i = KTUtil.parents(t, ".kt-menu__item--submenu"), o = 0, l = i.length; o < l; o++) {
                    var r = KTUtil.child(i[o], ".kt-menu__link");
                    a.push({text: e = KTUtil.child(r, ".kt-menu__link-text") ? e.innerHTML : "", title: r.getAttribute("title"), href: r.getAttribute("href")})
                }
                return a.reverse()
            }, getPageTitle: function (t) {
                var e;
                return KTUtil.child(t, ".kt-menu__link-text") ? e.innerHTML : ""
            }, eventTrigger: function (t, e, n) {
                for (var i = 0; i < a.events.length; i++) {
                    var o = a.events[i];
                    if (o.name == t) {
                        if (1 != o.one) return o.handler.call(this, e, n);
                        if (0 == o.fired) return a.events[i].fired = !0, o.handler.call(this, e, n)
                    }
                }
            }, addEvent: function (t, e, n) {
                a.events.push({name: t, handler: e, one: n, fired: !1})
            }, removeEvent: function (t) {
                a.events[t] && delete a.events[t]
            }
        };
        return a.setDefaults = function (t) {
            l = t
        }, a.scrollUpdate = function () {
            return r.scrollUpdate()
        }, a.scrollReInit = function () {
            return r.scrollInit()
        }, a.scrollTop = function () {
            return r.scrollTop()
        }, a.setActiveItem = function (t) {
            return r.setActiveItem(t)
        }, a.reload = function () {
            return r.reload()
        }, a.update = function (t) {
            return r.update(t)
        }, a.getBreadcrumbs = function (t) {
            return r.getBreadcrumbs(t)
        }, a.getPageTitle = function (t) {
            return r.getPageTitle(t)
        }, a.getSubmenuMode = function (t) {
            return r.getSubmenuMode(t)
        }, a.hideDropdown = function (t) {
            r.hideSubmenuDropdown(t, !0)
        }, a.hideDropdowns = function () {
            r.hideSubmenuDropdowns()
        }, a.pauseDropdownHover = function (t) {
            r.pauseDropdownHover(t)
        }, a.resumeDropdownHover = function () {
            return r.resumeDropdownHover()
        }, a.on = function (t, e) {
            return r.addEvent(t, e)
        }, a.off = function (t) {
            return r.removeEvent(t)
        }, a.one = function (t, e) {
            return r.addEvent(t, e, !0)
        }, r.construct.apply(a, [e]), KTUtil.addResizeHandler(function () {
            n && a.reload()
        }), n = !0, a
    }
};
"undefined" != typeof module && void 0 !== module.exports && (module.exports = KTMenu), document.addEventListener("click", function (t) {
    var e;
    if (e = KTUtil.get("body").querySelectorAll('.kt-menu__nav .kt-menu__item.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs)[data-ktmenu-submenu-toggle="click"]')) for (var a = 0, n = e.length; a < n; a++) {
        var i = e[a].closest(".kt-menu__nav").parentNode;
        if (i) {
            var o = KTUtil.data(i).get("menu");
            if (!o) break;
            if (!o || "dropdown" !== o.getSubmenuMode()) break;
            t.target !== i && !1 === i.contains(t.target) && o.hideDropdowns()
        }
    }
});
var KTOffcanvas = function (t, e) {
    var a = this, n = KTUtil.get(t), i = KTUtil.get("body");
    if (n) {
        var o = {}, l = {
            construct: function (t) {
                return KTUtil.data(n).has("offcanvas") ? a = KTUtil.data(n).get("offcanvas") : (l.init(t), l.build(), KTUtil.data(n).set("offcanvas", a)), a
            }, init: function (t) {
                a.events = [], a.options = KTUtil.deepExtend({}, o, t), a.overlay, a.classBase = a.options.baseClass, a.classShown = a.classBase + "--on", a.classOverlay = a.classBase + "-overlay", a.state = KTUtil.hasClass(n, a.classShown) ? "shown" : "hidden"
            }, build: function () {
                if (a.options.toggleBy) if ("string" == typeof a.options.toggleBy) KTUtil.addEvent(a.options.toggleBy, "click", function (t) {
                    t.preventDefault(), l.toggle()
                }); else if (a.options.toggleBy && a.options.toggleBy[0]) if (a.options.toggleBy[0].target) for (var t in a.options.toggleBy) KTUtil.addEvent(a.options.toggleBy[t].target, "click", function (t) {
                    t.preventDefault(), l.toggle()
                }); else for (var t in a.options.toggleBy) KTUtil.addEvent(a.options.toggleBy[t], "click", function (t) {
                    t.preventDefault(), l.toggle()
                }); else a.options.toggleBy && a.options.toggleBy.target && KTUtil.addEvent(a.options.toggleBy.target, "click", function (t) {
                    t.preventDefault(), l.toggle()
                });
                var e = KTUtil.get(a.options.closeBy);
                e && KTUtil.addEvent(e, "click", function (t) {
                    t.preventDefault(), l.hide()
                })
            }, isShown: function (t) {
                return "shown" == a.state
            }, toggle: function () {
                l.eventTrigger("toggle"), "shown" == a.state ? l.hide(this) : l.show(this)
            }, show: function (t) {
                "shown" != a.state && (l.eventTrigger("beforeShow"), l.togglerClass(t, "show"), KTUtil.addClass(i, a.classShown), KTUtil.addClass(n, a.classShown), a.state = "shown", a.options.overlay && (a.overlay = KTUtil.insertAfter(document.createElement("DIV"), n), KTUtil.addClass(a.overlay, a.classOverlay), KTUtil.addEvent(a.overlay, "click", function (e) {
                    e.stopPropagation(), e.preventDefault(), l.hide(t)
                })), l.eventTrigger("afterShow"))
            }, hide: function (t) {
                "hidden" != a.state && (l.eventTrigger("beforeHide"), l.togglerClass(t, "hide"), KTUtil.removeClass(i, a.classShown), KTUtil.removeClass(n, a.classShown), a.state = "hidden", a.options.overlay && a.overlay && KTUtil.remove(a.overlay), l.eventTrigger("afterHide"))
            }, togglerClass: function (t, e) {
                var n, i = KTUtil.attr(t, "id");
                if (a.options.toggleBy && a.options.toggleBy[0] && a.options.toggleBy[0].target) for (var o in a.options.toggleBy) a.options.toggleBy[o].target === i && (n = a.options.toggleBy[o]); else a.options.toggleBy && a.options.toggleBy.target && (n = a.options.toggleBy);
                if (n) {
                    var l = KTUtil.get(n.target);
                    "show" === e && KTUtil.addClass(l, n.state), "hide" === e && KTUtil.removeClass(l, n.state)
                }
            }, eventTrigger: function (t, e) {
                for (var n = 0; n < a.events.length; n++) {
                    var i = a.events[n];
                    if (i.name == t) {
                        if (1 != i.one) return i.handler.call(this, a, e);
                        if (0 == i.fired) return a.events[n].fired = !0, i.handler.call(this, a, e)
                    }
                }
            }, addEvent: function (t, e, n) {
                a.events.push({name: t, handler: e, one: n, fired: !1})
            }
        };
        return a.setDefaults = function (t) {
            o = t
        }, a.isShown = function () {
            return l.isShown()
        }, a.hide = function () {
            return l.hide()
        }, a.show = function () {
            return l.show()
        }, a.on = function (t, e) {
            return l.addEvent(t, e)
        }, a.one = function (t, e) {
            return l.addEvent(t, e, !0)
        }, l.construct.apply(a, [e]), !0, a
    }
};
"undefined" != typeof module && void 0 !== module.exports && (module.exports = KTOffcanvas);
var KTPortlet = function (t, e) {
    var a = this, n = KTUtil.get(t), i = KTUtil.get("body");
    if (n) {
        var o = {bodyToggleSpeed: 400, tooltips: !0, tools: {toggle: {collapse: "Collapse", expand: "Expand"}, reload: "Reload", remove: "Remove", fullscreen: {on: "Fullscreen", off: "Exit Fullscreen"}}, sticky: {offset: 300, zIndex: 101}}, l = {
            construct: function (t) {
                return KTUtil.data(n).has("portlet") ? a = KTUtil.data(n).get("portlet") : (l.init(t), l.build(), KTUtil.data(n).set("portlet", a)), a
            }, init: function (t) {
                a.element = n, a.events = [], a.options = KTUtil.deepExtend({}, o, t), a.head = KTUtil.child(n, ".kt-portlet__head"), a.foot = KTUtil.child(n, ".kt-portlet__foot"), KTUtil.child(n, ".kt-portlet__body") ? a.body = KTUtil.child(n, ".kt-portlet__body") : KTUtil.child(n, ".kt-form") && (a.body = KTUtil.child(n, ".kt-form"))
            }, build: function () {
                var t = KTUtil.find(a.head, "[data-ktportlet-tool=remove]");
                t && KTUtil.addEvent(t, "click", function (t) {
                    t.preventDefault(), l.remove()
                });
                var e = KTUtil.find(a.head, "[data-ktportlet-tool=reload]");
                e && KTUtil.addEvent(e, "click", function (t) {
                    t.preventDefault(), l.reload()
                });
                var n = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                n && KTUtil.addEvent(n, "click", function (t) {
                    t.preventDefault(), l.toggle()
                });
                var i = KTUtil.find(a.head, "[data-ktportlet-tool=fullscreen]");
                i && KTUtil.addEvent(i, "click", function (t) {
                    t.preventDefault(), l.fullscreen()
                }), l.setupTooltips()
            }, initSticky: function () {
                a.options.sticky.offset;
                a.head && window.addEventListener("scroll", l.onScrollSticky)
            }, onScrollSticky: function (t) {
                var e = a.options.sticky.offset;
                if (!isNaN(e)) {
                    var o = KTUtil.getScrollTop();
                    o >= e && !1 === KTUtil.hasClass(i, "kt-portlet--sticky") ? (l.eventTrigger("stickyOn"), KTUtil.addClass(i, "kt-portlet--sticky"), KTUtil.addClass(n, "kt-portlet--sticky"), l.updateSticky()) : 1.5 * o <= e && KTUtil.hasClass(i, "kt-portlet--sticky") && (l.eventTrigger("stickyOff"), KTUtil.removeClass(i, "kt-portlet--sticky"), KTUtil.removeClass(n, "kt-portlet--sticky"), l.resetSticky())
                }
            }, updateSticky: function () {
                var t, e, n;
                a.head && (KTUtil.hasClass(i, "kt-portlet--sticky") && (t = a.options.sticky.position.top instanceof Function ? parseInt(a.options.sticky.position.top.call(this, a)) : parseInt(a.options.sticky.position.top), e = a.options.sticky.position.left instanceof Function ? parseInt(a.options.sticky.position.left.call(this, a)) : parseInt(a.options.sticky.position.left), n = a.options.sticky.position.right instanceof Function ? parseInt(a.options.sticky.position.right.call(this, a)) : parseInt(a.options.sticky.position.right), KTUtil.css(a.head, "z-index", a.options.sticky.zIndex), KTUtil.css(a.head, "top", t + "px"), KTUtil.css(a.head, "left", e + "px"), KTUtil.css(a.head, "right", n + "px")))
            }, resetSticky: function () {
                a.head && !1 === KTUtil.hasClass(i, "kt-portlet--sticky") && (KTUtil.css(a.head, "z-index", ""), KTUtil.css(a.head, "top", ""), KTUtil.css(a.head, "left", ""), KTUtil.css(a.head, "right", ""))
            }, remove: function () {
                !1 !== l.eventTrigger("beforeRemove") && (KTUtil.hasClass(i, "kt-portlet--fullscreen") && KTUtil.hasClass(n, "kt-portlet--fullscreen") && l.fullscreen("off"), l.removeTooltips(), KTUtil.remove(n), l.eventTrigger("afterRemove"))
            }, setContent: function (t) {
                t && (a.body.innerHTML = t)
            }, getBody: function () {
                return a.body
            }, getSelf: function () {
                return n
            }, setupTooltips: function () {
                if (a.options.tooltips) {
                    var t = KTUtil.hasClass(n, "kt-portlet--collapse") || KTUtil.hasClass(n, "kt-portlet--collapsed"), e = KTUtil.hasClass(i, "kt-portlet--fullscreen") && KTUtil.hasClass(n, "kt-portlet--fullscreen"), o = KTUtil.find(a.head, "[data-ktportlet-tool=remove]");
                    if (o) {
                        var l = e ? "bottom" : "top", r = new Tooltip(o, {title: a.options.tools.remove, placement: l, offset: e ? "0,10px,0,0" : "0,5px", trigger: "hover", template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + l + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'});
                        KTUtil.data(o).set("tooltip", r)
                    }
                    var s = KTUtil.find(a.head, "[data-ktportlet-tool=reload]");
                    if (s) {
                        l = e ? "bottom" : "top", r = new Tooltip(s, {title: a.options.tools.reload, placement: l, offset: e ? "0,10px,0,0" : "0,5px", trigger: "hover", template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + l + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'});
                        KTUtil.data(s).set("tooltip", r)
                    }
                    var d = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                    if (d) {
                        l = e ? "bottom" : "top", r = new Tooltip(d, {title: t ? a.options.tools.toggle.expand : a.options.tools.toggle.collapse, placement: l, offset: e ? "0,10px,0,0" : "0,5px", trigger: "hover", template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + l + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'});
                        KTUtil.data(d).set("tooltip", r)
                    }
                    var c = KTUtil.find(a.head, "[data-ktportlet-tool=fullscreen]");
                    if (c) {
                        l = e ? "bottom" : "top", r = new Tooltip(c, {title: e ? a.options.tools.fullscreen.off : a.options.tools.fullscreen.on, placement: l, offset: e ? "0,10px,0,0" : "0,5px", trigger: "hover", template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + l + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'});
                        KTUtil.data(c).set("tooltip", r)
                    }
                }
            }, removeTooltips: function () {
                if (a.options.tooltips) {
                    var t = KTUtil.find(a.head, "[data-ktportlet-tool=remove]");
                    t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").dispose();
                    var e = KTUtil.find(a.head, "[data-ktportlet-tool=reload]");
                    e && KTUtil.data(e).has("tooltip") && KTUtil.data(e).get("tooltip").dispose();
                    var n = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                    n && KTUtil.data(n).has("tooltip") && KTUtil.data(n).get("tooltip").dispose();
                    var i = KTUtil.find(a.head, "[data-ktportlet-tool=fullscreen]");
                    i && KTUtil.data(i).has("tooltip") && KTUtil.data(i).get("tooltip").dispose()
                }
            }, reload: function () {
                l.eventTrigger("reload")
            }, toggle: function () {
                KTUtil.hasClass(n, "kt-portlet--collapse") || KTUtil.hasClass(n, "kt-portlet--collapsed") ? l.expand() : l.collapse()
            }, collapse: function () {
                if (!1 !== l.eventTrigger("beforeCollapse")) {
                    KTUtil.slideUp(a.body, a.options.bodyToggleSpeed, function () {
                        l.eventTrigger("afterCollapse")
                    }), KTUtil.addClass(n, "kt-portlet--collapse");
                    var t = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                    t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").updateTitleContent(a.options.tools.toggle.expand)
                }
            }, expand: function () {
                if (!1 !== l.eventTrigger("beforeExpand")) {
                    KTUtil.slideDown(a.body, a.options.bodyToggleSpeed, function () {
                        l.eventTrigger("afterExpand")
                    }), KTUtil.removeClass(n, "kt-portlet--collapse"), KTUtil.removeClass(n, "kt-portlet--collapsed");
                    var t = KTUtil.find(a.head, "[data-ktportlet-tool=toggle]");
                    t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").updateTitleContent(a.options.tools.toggle.collapse)
                }
            }, fullscreen: function (t) {
                if ("off" === t || KTUtil.hasClass(i, "kt-portlet--fullscreen") && KTUtil.hasClass(n, "kt-portlet--fullscreen")) l.eventTrigger("beforeFullscreenOff"), KTUtil.removeClass(i, "kt-portlet--fullscreen"), KTUtil.removeClass(n, "kt-portlet--fullscreen"), l.removeTooltips(), l.setupTooltips(), a.foot && (KTUtil.css(a.body, "margin-bottom", ""), KTUtil.css(a.foot, "margin-top", "")), l.eventTrigger("afterFullscreenOff"); else {
                    if (l.eventTrigger("beforeFullscreenOn"), KTUtil.addClass(n, "kt-portlet--fullscreen"), KTUtil.addClass(i, "kt-portlet--fullscreen"), l.removeTooltips(), l.setupTooltips(), a.foot) {
                        var e = parseInt(KTUtil.css(a.foot, "height")), o = parseInt(KTUtil.css(a.foot, "height")) + parseInt(KTUtil.css(a.head, "height"));
                        KTUtil.css(a.body, "margin-bottom", e + "px"), KTUtil.css(a.foot, "margin-top", "-" + o + "px")
                    }
                    l.eventTrigger("afterFullscreenOn")
                }
            }, eventTrigger: function (t) {
                for (var e = 0; e < a.events.length; e++) {
                    var n = a.events[e];
                    if (n.name == t) {
                        if (1 != n.one) return n.handler.call(this, a);
                        if (0 == n.fired) return a.events[e].fired = !0, n.handler.call(this, a)
                    }
                }
            }, addEvent: function (t, e, n) {
                return a.events.push({name: t, handler: e, one: n, fired: !1}), a
            }
        };
        return a.setDefaults = function (t) {
            o = t
        }, a.remove = function () {
            return l.remove(html)
        }, a.initSticky = function () {
            return l.initSticky()
        }, a.updateSticky = function () {
            return l.updateSticky()
        }, a.resetSticky = function () {
            return l.resetSticky()
        }, a.destroySticky = function () {
            l.resetSticky(), window.removeEventListener("scroll", l.onScrollSticky)
        }, a.reload = function () {
            return l.reload()
        }, a.setContent = function (t) {
            return l.setContent(t)
        }, a.toggle = function () {
            return l.toggle()
        }, a.collapse = function () {
            return l.collapse()
        }, a.expand = function () {
            return l.expand()
        }, a.fullscreen = function () {
            return l.fullscreen("on")
        }, a.unFullscreen = function () {
            return l.fullscreen("off")
        }, a.getBody = function () {
            return l.getBody()
        }, a.getSelf = function () {
            return l.getSelf()
        }, a.on = function (t, e) {
            return l.addEvent(t, e)
        }, a.one = function (t, e) {
            return l.addEvent(t, e, !0)
        }, l.construct.apply(a, [e]), a
    }
};
"undefined" != typeof module && void 0 !== module.exports && (module.exports = KTPortlet);
var KTScrolltop = function (t, e) {
    var a = this, n = KTUtil.get(t), i = KTUtil.get("body");
    if (n) {
        var o = {offset: 300, speed: 600, toggleClass: "kt-scrolltop--on"}, l = {
            construct: function (t) {
                return KTUtil.data(n).has("scrolltop") ? a = KTUtil.data(n).get("scrolltop") : (l.init(t), l.build(), KTUtil.data(n).set("scrolltop", a)), a
            }, init: function (t) {
                a.events = [], a.options = KTUtil.deepExtend({}, o, t)
            }, build: function () {
                navigator.userAgent.match(/iPhone|iPad|iPod/i) ? (window.addEventListener("touchend", function () {
                    l.handle()
                }), window.addEventListener("touchcancel", function () {
                    l.handle()
                }), window.addEventListener("touchleave", function () {
                    l.handle()
                })) : window.addEventListener("scroll", function () {
                    l.handle()
                }), KTUtil.addEvent(n, "click", l.scroll)
            }, handle: function () {
                window.pageYOffset > a.options.offset ? KTUtil.addClass(i, a.options.toggleClass) : KTUtil.removeClass(i, a.options.toggleClass)
            }, scroll: function (t) {
                t.preventDefault(), KTUtil.scrollTop(0, a.options.speed)
            }, eventTrigger: function (t, e) {
                for (var n = 0; n < a.events.length; n++) {
                    var i = a.events[n];
                    if (i.name == t) {
                        if (1 != i.one) return i.handler.call(this, a, e);
                        if (0 == i.fired) return a.events[n].fired = !0, i.handler.call(this, a, e)
                    }
                }
            }, addEvent: function (t, e, n) {
                a.events.push({name: t, handler: e, one: n, fired: !1})
            }
        };
        return a.setDefaults = function (t) {
            o = t
        }, a.on = function (t, e) {
            return l.addEvent(t, e)
        }, a.one = function (t, e) {
            return l.addEvent(t, e, !0)
        }, l.construct.apply(a, [e]), !0, a
    }
};
"undefined" != typeof module && void 0 !== module.exports && (module.exports = KTScrolltop);
var KTToggle = function (t, e) {
    var a = this, n = KTUtil.get(t);
    KTUtil.get("body");
    if (n) {
        var i = {togglerState: "", targetState: ""}, o = {
            construct: function (t) {
                return KTUtil.data(n).has("toggle") ? a = KTUtil.data(n).get("toggle") : (o.init(t), o.build(), KTUtil.data(n).set("toggle", a)), a
            }, init: function (t) {
                a.element = n, a.events = [], a.options = KTUtil.deepExtend({}, i, t), a.target = KTUtil.get(a.options.target), a.targetState = a.options.targetState, a.togglerState = a.options.togglerState, a.state = KTUtil.hasClasses(a.target, a.targetState) ? "on" : "off"
            }, build: function () {
                KTUtil.addEvent(n, "mouseup", o.toggle)
            }, toggle: function (t) {
                return o.eventTrigger("beforeToggle"), "off" == a.state ? o.toggleOn() : o.toggleOff(), o.eventTrigger("afterToggle"), t.preventDefault(), a
            }, toggleOn: function () {
                return o.eventTrigger("beforeOn"), KTUtil.addClass(a.target, a.targetState), a.togglerState && KTUtil.addClass(n, a.togglerState), a.state = "on", o.eventTrigger("afterOn"), o.eventTrigger("toggle"), a
            }, toggleOff: function () {
                return o.eventTrigger("beforeOff"), KTUtil.removeClass(a.target, a.targetState), a.togglerState && KTUtil.removeClass(n, a.togglerState), a.state = "off", o.eventTrigger("afterOff"), o.eventTrigger("toggle"), a
            }, eventTrigger: function (t) {
                for (var e = 0; e < a.events.length; e++) {
                    var n = a.events[e];
                    if (n.name == t) {
                        if (1 != n.one) return n.handler.call(this, a);
                        if (0 == n.fired) return a.events[e].fired = !0, n.handler.call(this, a)
                    }
                }
            }, addEvent: function (t, e, n) {
                return a.events.push({name: t, handler: e, one: n, fired: !1}), a
            }
        };
        return a.setDefaults = function (t) {
            i = t
        }, a.getState = function () {
            return a.state
        }, a.toggle = function () {
            return o.toggle()
        }, a.toggleOn = function () {
            return o.toggleOn()
        }, a.toggleOff = function () {
            return o.toggleOff()
        }, a.on = function (t, e) {
            return o.addEvent(t, e)
        }, a.one = function (t, e) {
            return o.addEvent(t, e, !0)
        }, o.construct.apply(a, [e]), a
    }
};
"undefined" != typeof module && void 0 !== module.exports && (module.exports = KTToggle), Element.prototype.matches || (Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector), Element.prototype.closest || (Element.prototype.matches || (Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector), Element.prototype.closest = function (t) {
    var e = this;
    if (!document.documentElement.contains(this)) return null;
    do {
        if (e.matches(t)) return e;
        e = e.parentElement
    } while (null !== e);
    return null
}), function (t) {
    for (var e = 0; e < t.length; e++) !window[t[e]] || "remove" in window[t[e]].prototype || (window[t[e]].prototype.remove = function () {
        this.parentNode.removeChild(this)
    })
}(["Element", "CharacterData", "DocumentType"]), function () {
    for (var t = 0, e = ["webkit", "moz"], a = 0; a < e.length && !window.requestAnimationFrame; ++a) window.requestAnimationFrame = window[e[a] + "RequestAnimationFrame"], window.cancelAnimationFrame = window[e[a] + "CancelAnimationFrame"] || window[e[a] + "CancelRequestAnimationFrame"];
    window.requestAnimationFrame || (window.requestAnimationFrame = function (e) {
        var a = (new Date).getTime(), n = Math.max(0, 16 - (a - t)), i = window.setTimeout(function () {
            e(a + n)
        }, n);
        return t = a + n, i
    }), window.cancelAnimationFrame || (window.cancelAnimationFrame = function (t) {
        clearTimeout(t)
    })
}(), [Element.prototype, Document.prototype, DocumentFragment.prototype].forEach(function (t) {
    t.hasOwnProperty("prepend") || Object.defineProperty(t, "prepend", {
        configurable: !0, enumerable: !0, writable: !0, value: function () {
            var t = Array.prototype.slice.call(arguments), e = document.createDocumentFragment();
            t.forEach(function (t) {
                var a = t instanceof Node;
                e.appendChild(a ? t : document.createTextNode(String(t)))
            }), this.insertBefore(e, this.firstChild)
        }
    })
}), window.KTUtilElementDataStore = {}, window.KTUtilElementDataStoreID = 0, window.KTUtilDelegatedEventHandlers = {};
var KTUtil = function () {
    var t = [], e = {sm: 544, md: 768, lg: 1024, xl: 1200}, a = function () {
        var e = !1;
        window.addEventListener("resize", function () {
            clearTimeout(e), e = setTimeout(function () {
                !function () {
                    for (var e = 0; e < t.length; e++) t[e].call()
                }()
            }, 250)
        })
    };
    return {
        init: function (t) {
            t && t.breakpoints && (e = t.breakpoints), a()
        }, addResizeHandler: function (e) {
            t.push(e)
        }, removeResizeHandler: function (e) {
            for (var a = 0; a < t.length; a++) e === t[a] && delete t[a]
        }, runResizeHandlers: function () {
            _runResizeHandlers()
        }, resize: function () {
            if ("function" == typeof Event) window.dispatchEvent(new Event("resize")); else {
                var t = window.document.createEvent("UIEvents");
                t.initUIEvent("resize", !0, !1, window, 0), window.dispatchEvent(t)
            }
        }, getURLParam: function (t) {
            var e, a, n = window.location.search.substring(1).split("&");
            for (e = 0; e < n.length; e++) if ((a = n[e].split("="))[0] == t) return unescape(a[1]);
            return null
        }, isMobileDevice: function () {
            return this.getViewPort().width < this.getBreakpoint("lg")
        }, isDesktopDevice: function () {
            return !KTUtil.isMobileDevice()
        }, getViewPort: function () {
            var t = window, e = "inner";
            return "innerWidth" in window || (e = "client", t = document.documentElement || document.body), {width: t[e + "Width"], height: t[e + "Height"]}
        }, isInResponsiveRange: function (t) {
            var e = this.getViewPort().width;
            return "general" == t || ("desktop" == t && e >= this.getBreakpoint("lg") + 1 || ("tablet" == t && e >= this.getBreakpoint("md") + 1 && e < this.getBreakpoint("lg") || ("mobile" == t && e <= this.getBreakpoint("md") || ("desktop-and-tablet" == t && e >= this.getBreakpoint("md") + 1 || ("tablet-and-mobile" == t && e <= this.getBreakpoint("lg") || "minimal-desktop-and-below" == t && e <= this.getBreakpoint("xl"))))))
        }, getUniqueID: function (t) {
            return t + Math.floor(Math.random() * (new Date).getTime())
        }, getBreakpoint: function (t) {
            return e[t]
        }, isset: function (t, e) {
            var a;
            if (-1 !== (e = e || "").indexOf("[")) throw new Error("Unsupported object path notation.");
            e = e.split(".");
            do {
                if (void 0 === t) return !1;
                if (a = e.shift(), !t.hasOwnProperty(a)) return !1;
                t = t[a]
            } while (e.length);
            return !0
        }, getHighestZindex: function (t) {
            for (var e, a, n = KTUtil.get(t); n && n !== document;) {
                if (("absolute" === (e = KTUtil.css(n, "position")) || "relative" === e || "fixed" === e) && (a = parseInt(KTUtil.css(n, "z-index")), !isNaN(a) && 0 !== a)) return a;
                n = n.parentNode
            }
            return null
        }, hasFixedPositionedParent: function (t) {
            for (; t && t !== document;) {
                if ("fixed" === KTUtil.css(t, "position")) return !0;
                t = t.parentNode
            }
            return !1
        }, sleep: function (t) {
            for (var e = (new Date).getTime(), a = 0; a < 1e7 && !((new Date).getTime() - e > t); a++) ;
        }, getRandomInt: function (t, e) {
            return Math.floor(Math.random() * (e - t + 1)) + t
        }, isAngularVersion: function () {
            return void 0 !== window.Zone
        }, deepExtend: function (t) {
            t = t || {};
            for (var e = 1; e < arguments.length; e++) {
                var a = arguments[e];
                if (a) for (var n in a) a.hasOwnProperty(n) && ("object" == typeof a[n] ? t[n] = KTUtil.deepExtend(t[n], a[n]) : t[n] = a[n])
            }
            return t
        }, extend: function (t) {
            t = t || {};
            for (var e = 1; e < arguments.length; e++) if (arguments[e]) for (var a in arguments[e]) arguments[e].hasOwnProperty(a) && (t[a] = arguments[e][a]);
            return t
        }, get: function (t) {
            var e;
            return t === document ? document : t && 1 === t.nodeType ? t : (e = document.getElementById(t)) ? e : (e = document.getElementsByTagName(t)).length > 0 ? e[0] : (e = document.getElementsByClassName(t)).length > 0 ? e[0] : null
        }, getByID: function (t) {
            return t && 1 === t.nodeType ? t : document.getElementById(t)
        }, getByTag: function (t) {
            var e;
            return (e = document.getElementsByTagName(t)) ? e[0] : null
        }, getByClass: function (t) {
            var e;
            return (e = document.getElementsByClassName(t)) ? e[0] : null
        }, hasClasses: function (t, e) {
            if (t) {
                for (var a = e.split(" "), n = 0; n < a.length; n++) if (0 == KTUtil.hasClass(t, KTUtil.trim(a[n]))) return !1;
                return !0
            }
        }, hasClass: function (t, e) {
            if (t) return t.classList ? t.classList.contains(e) : new RegExp("\\b" + e + "\\b").test(t.className)
        }, addClass: function (t, e) {
            if (t && void 0 !== e) {
                var a = e.split(" ");
                if (t.classList) for (var n = 0; n < a.length; n++) a[n] && a[n].length > 0 && t.classList.add(KTUtil.trim(a[n])); else if (!KTUtil.hasClass(t, e)) for (var i = 0; i < a.length; i++) t.className += " " + KTUtil.trim(a[i])
            }
        }, removeClass: function (t, e) {
            if (t && void 0 !== e) {
                var a = e.split(" ");
                if (t.classList) for (var n = 0; n < a.length; n++) t.classList.remove(KTUtil.trim(a[n])); else if (KTUtil.hasClass(t, e)) for (var i = 0; i < a.length; i++) t.className = t.className.replace(new RegExp("\\b" + KTUtil.trim(a[i]) + "\\b", "g"), "")
            }
        }, triggerCustomEvent: function (t, e, a) {
            var n;
            window.CustomEvent ? n = new CustomEvent(e, {detail: a}) : (n = document.createEvent("CustomEvent")).initCustomEvent(e, !0, !0, a), t.dispatchEvent(n)
        }, triggerEvent: function (t, e) {
            var a;
            if (t.ownerDocument) a = t.ownerDocument; else {
                if (9 != t.nodeType) throw new Error("Invalid node passed to fireEvent: " + t.id);
                a = t
            }
            if (t.dispatchEvent) {
                var n = "";
                switch (e) {
                    case"click":
                    case"mouseenter":
                    case"mouseleave":
                    case"mousedown":
                    case"mouseup":
                        n = "MouseEvents";
                        break;
                    case"focus":
                    case"change":
                    case"blur":
                    case"select":
                        n = "HTMLEvents";
                        break;
                    default:
                        throw"fireEvent: Couldn't find an event class for event '" + e + "'."
                }
                var i = "change" != e;
                (o = a.createEvent(n)).initEvent(e, i, !0), o.synthetic = !0, t.dispatchEvent(o, !0)
            } else if (t.fireEvent) {
                var o;
                (o = a.createEventObject()).synthetic = !0, t.fireEvent("on" + e, o)
            }
        }, index: function (t) {
            for (var e = (t = KTUtil.get(t)).parentNode.children, a = 0; a < e.length; a++) if (e[a] == t) return a
        }, trim: function (t) {
            return t.trim()
        }, eventTriggered: function (t) {
            return !!t.currentTarget.dataset.triggered || (t.currentTarget.dataset.triggered = !0, !1)
        }, remove: function (t) {
            t && t.parentNode && t.parentNode.removeChild(t)
        }, find: function (t, e) {
            if (t = KTUtil.get(t)) return t.querySelector(e)
        }, findAll: function (t, e) {
            if (t = KTUtil.get(t)) return t.querySelectorAll(e)
        }, insertAfter: function (t, e) {
            return e.parentNode.insertBefore(t, e.nextSibling)
        }, parents: function (t, e) {
            Element.prototype.matches || (Element.prototype.matches = Element.prototype.matchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector || Element.prototype.oMatchesSelector || Element.prototype.webkitMatchesSelector || function (t) {
                for (var e = (this.document || this.ownerDocument).querySelectorAll(t), a = e.length; --a >= 0 && e.item(a) !== this;) ;
                return a > -1
            });
            for (var a = []; t && t !== document; t = t.parentNode) e ? t.matches(e) && a.push(t) : a.push(t);
            return a
        }, children: function (t, e, a) {
            if (t && t.childNodes) {
                for (var n = [], i = 0, o = t.childNodes.length; i < o; ++i) 1 == t.childNodes[i].nodeType && KTUtil.matches(t.childNodes[i], e, a) && n.push(t.childNodes[i]);
                return n
            }
        }, child: function (t, e, a) {
            var n = KTUtil.children(t, e, a);
            return n ? n[0] : null
        }, matches: function (t, e, a) {
            var n = Element.prototype, i = n.matches || n.webkitMatchesSelector || n.mozMatchesSelector || n.msMatchesSelector || function (t) {
                return -1 !== [].indexOf.call(document.querySelectorAll(t), this)
            };
            return !(!t || !t.tagName) && i.call(t, e)
        }, data: function (t) {
            return t = KTUtil.get(t), {
                set: function (e, a) {
                    null != t && void 0 !== t && (void 0 === t.customDataTag && (window.KTUtilElementDataStoreID++, t.customDataTag = window.KTUtilElementDataStoreID), void 0 === window.KTUtilElementDataStore[t.customDataTag] && (window.KTUtilElementDataStore[t.customDataTag] = {}), window.KTUtilElementDataStore[t.customDataTag][e] = a)
                }, get: function (e) {
                    if (void 0 !== t) return null == t || void 0 === t.customDataTag ? null : this.has(e) ? window.KTUtilElementDataStore[t.customDataTag][e] : null
                }, has: function (e) {
                    return void 0 !== t && (null != t && void 0 !== t.customDataTag && !(!window.KTUtilElementDataStore[t.customDataTag] || !window.KTUtilElementDataStore[t.customDataTag][e]))
                }, remove: function (e) {
                    t && this.has(e) && delete window.KTUtilElementDataStore[t.customDataTag][e]
                }
            }
        }, outerWidth: function (t, e) {
            var a;
            return !0 === e ? (a = parseFloat(t.offsetWidth), a += parseFloat(KTUtil.css(t, "margin-left")) + parseFloat(KTUtil.css(t, "margin-right")), parseFloat(a)) : a = parseFloat(t.offsetWidth)
        }, offset: function (t) {
            var e, a;
            if (t = KTUtil.get(t)) return t.getClientRects().length ? (e = t.getBoundingClientRect(), a = t.ownerDocument.defaultView, {top: e.top + a.pageYOffset, left: e.left + a.pageXOffset}) : {top: 0, left: 0}
        }, height: function (t) {
            return KTUtil.css(t, "height")
        }, visible: function (t) {
            return !(0 === t.offsetWidth && 0 === t.offsetHeight)
        }, attr: function (t, e, a) {
            if (null != (t = KTUtil.get(t))) return void 0 === a ? t.getAttribute(e) : void t.setAttribute(e, a)
        }, hasAttr: function (t, e) {
            if (null != (t = KTUtil.get(t))) return !!t.getAttribute(e)
        }, removeAttr: function (t, e) {
            null != (t = KTUtil.get(t)) && t.removeAttribute(e)
        }, animate: function (t, e, a, n, i, o) {
            var l = {};
            if (l.linear = function (t, e, a, n) {
                return a * t / n + e
            }, i = l.linear, "number" == typeof t && "number" == typeof e && "number" == typeof a && "function" == typeof n) {
                "function" != typeof o && (o = function () {
                });
                var r = window.requestAnimationFrame || function (t) {
                    window.setTimeout(t, 20)
                }, s = e - t;
                n(t);
                var d = window.performance && window.performance.now ? window.performance.now() : +new Date;
                r(function l(c) {
                    var u = (c || +new Date) - d;
                    u >= 0 && n(i(u, t, s, a)), u >= 0 && u >= a ? (n(e), o()) : r(l)
                })
            }
        }, actualCss: function (t, e, a) {
            var n, i = "";
            if ((t = KTUtil.get(t)) instanceof HTMLElement != !1) return t.getAttribute("kt-hidden-" + e) && !1 !== a ? parseFloat(t.getAttribute("kt-hidden-" + e)) : (i = t.style.cssText, t.style.cssText = "position: absolute; visibility: hidden; display: block;", "width" == e ? n = t.offsetWidth : "height" == e && (n = t.offsetHeight), t.style.cssText = i, t.setAttribute("kt-hidden-" + e, n), parseFloat(n))
        }, actualHeight: function (t, e) {
            return KTUtil.actualCss(t, "height", e)
        }, actualWidth: function (t, e) {
            return KTUtil.actualCss(t, "width", e)
        }, getScroll: function (t, e) {
            return e = "scroll" + e, t == window || t == document ? self["scrollTop" == e ? "pageYOffset" : "pageXOffset"] || browserSupportsBoxModel && document.documentElement[e] || document.body[e] : t[e]
        }, css: function (t, e, a) {
            if (t = KTUtil.get(t)) if (void 0 !== a) t.style[e] = a; else {
                var n = (t.ownerDocument || document).defaultView;
                if (n && n.getComputedStyle) return e = e.replace(/([A-Z])/g, "-$1").toLowerCase(), n.getComputedStyle(t, null).getPropertyValue(e);
                if (t.currentStyle) return e = e.replace(/\-(\w)/g, function (t, e) {
                    return e.toUpperCase()
                }), a = t.currentStyle[e], /^\d+(em|pt|%|ex)?$/i.test(a) ? function (e) {
                    var a = t.style.left, n = t.runtimeStyle.left;
                    return t.runtimeStyle.left = t.currentStyle.left, t.style.left = e || 0, e = t.style.pixelLeft + "px", t.style.left = a, t.runtimeStyle.left = n, e
                }(a) : a
            }
        }, slide: function (t, e, a, n, i) {
            if (!(!t || "up" == e && !1 === KTUtil.visible(t) || "down" == e && !0 === KTUtil.visible(t))) {
                a = a || 600;
                var o = KTUtil.actualHeight(t), l = !1, r = !1;
                KTUtil.css(t, "padding-top") && !0 !== KTUtil.data(t).has("slide-padding-top") && KTUtil.data(t).set("slide-padding-top", KTUtil.css(t, "padding-top")), KTUtil.css(t, "padding-bottom") && !0 !== KTUtil.data(t).has("slide-padding-bottom") && KTUtil.data(t).set("slide-padding-bottom", KTUtil.css(t, "padding-bottom")), KTUtil.data(t).has("slide-padding-top") && (l = parseInt(KTUtil.data(t).get("slide-padding-top"))), KTUtil.data(t).has("slide-padding-bottom") && (r = parseInt(KTUtil.data(t).get("slide-padding-bottom"))), "up" == e ? (t.style.cssText = "display: block; overflow: hidden;", l && KTUtil.animate(0, l, a, function (e) {
                    t.style.paddingTop = l - e + "px"
                }, "linear"), r && KTUtil.animate(0, r, a, function (e) {
                    t.style.paddingBottom = r - e + "px"
                }, "linear"), KTUtil.animate(0, o, a, function (e) {
                    t.style.height = o - e + "px"
                }, "linear", function () {
                    n(), t.style.height = "", t.style.display = "none"
                })) : "down" == e && (t.style.cssText = "display: block; overflow: hidden;", l && KTUtil.animate(0, l, a, function (e) {
                    t.style.paddingTop = e + "px"
                }, "linear", function () {
                    t.style.paddingTop = ""
                }), r && KTUtil.animate(0, r, a, function (e) {
                    t.style.paddingBottom = e + "px"
                }, "linear", function () {
                    t.style.paddingBottom = ""
                }), KTUtil.animate(0, o, a, function (e) {
                    t.style.height = e + "px"
                }, "linear", function () {
                    n(), t.style.height = "", t.style.display = "", t.style.overflow = ""
                }))
            }
        }, slideUp: function (t, e, a) {
            KTUtil.slide(t, "up", e, a)
        }, slideDown: function (t, e, a) {
            KTUtil.slide(t, "down", e, a)
        }, show: function (t, e) {
            void 0 !== t && (t.style.display = e || "block")
        }, hide: function (t) {
            void 0 !== t && (t.style.display = "none")
        }, addEvent: function (t, e, a, n) {
            null != (t = KTUtil.get(t)) && t.addEventListener(e, a)
        }, removeEvent: function (t, e, a) {
            null !== (t = KTUtil.get(t)) && t.removeEventListener(e, a)
        }, on: function (t, e, a, n) {
            if (e) {
                var i = KTUtil.getUniqueID("event");
                return window.KTUtilDelegatedEventHandlers[i] = function (a) {
                    for (var i = t.querySelectorAll(e), o = a.target; o && o !== t;) {
                        for (var l = 0, r = i.length; l < r; l++) o === i[l] && n.call(o, a);
                        o = o.parentNode
                    }
                }, KTUtil.addEvent(t, a, window.KTUtilDelegatedEventHandlers[i]), i
            }
        }, off: function (t, e, a) {
            t && window.KTUtilDelegatedEventHandlers[a] && (KTUtil.removeEvent(t, e, window.KTUtilDelegatedEventHandlers[a]), delete window.KTUtilDelegatedEventHandlers[a])
        }, one: function (t, e, a) {
            (t = KTUtil.get(t)).addEventListener(e, function t(e) {
                return e.target && e.target.removeEventListener && e.target.removeEventListener(e.type, t), a(e)
            })
        }, hash: function (t) {
            var e, a = 0;
            if (0 === t.length) return a;
            for (e = 0; e < t.length; e++) a = (a << 5) - a + t.charCodeAt(e), a |= 0;
            return a
        }, animateClass: function (t, e, a) {
            var n, i = {animation: "animationend", OAnimation: "oAnimationEnd", MozAnimation: "mozAnimationEnd", WebkitAnimation: "webkitAnimationEnd", msAnimation: "msAnimationEnd"};
            for (var o in i) void 0 !== t.style[o] && (n = i[o]);
            KTUtil.addClass(t, "animated " + e), KTUtil.one(t, n, function () {
                KTUtil.removeClass(t, "animated " + e)
            }), a && KTUtil.one(t, n, a)
        }, transitionEnd: function (t, e) {
            var a, n = {transition: "transitionend", OTransition: "oTransitionEnd", MozTransition: "mozTransitionEnd", WebkitTransition: "webkitTransitionEnd", msTransition: "msTransitionEnd"};
            for (var i in n) void 0 !== t.style[i] && (a = n[i]);
            KTUtil.one(t, a, e)
        }, animationEnd: function (t, e) {
            var a, n = {animation: "animationend", OAnimation: "oAnimationEnd", MozAnimation: "mozAnimationEnd", WebkitAnimation: "webkitAnimationEnd", msAnimation: "msAnimationEnd"};
            for (var i in n) void 0 !== t.style[i] && (a = n[i]);
            KTUtil.one(t, a, e)
        }, animateDelay: function (t, e) {
            for (var a = ["webkit-", "moz-", "ms-", "o-", ""], n = 0; n < a.length; n++) KTUtil.css(t, a[n] + "animation-delay", e)
        }, animateDuration: function (t, e) {
            for (var a = ["webkit-", "moz-", "ms-", "o-", ""], n = 0; n < a.length; n++) KTUtil.css(t, a[n] + "animation-duration", e)
        }, scrollTo: function (t, e, a) {
            a = a || 500;
            var n, i, o = (t = KTUtil.get(t)) ? KTUtil.offset(t).top : 0, l = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
            e && (l += e), n = l, i = o, KTUtil.animate(n, i, a, function (t) {
                document.documentElement.scrollTop = t, document.body.parentNode.scrollTop = t, document.body.scrollTop = t
            })
        }, scrollTop: function (t, e) {
            KTUtil.scrollTo(null, t, e)
        }, isArray: function (t) {
            return t && Array.isArray(t)
        }, ready: function (t) {
            (document.attachEvent ? "complete" === document.readyState : "loading" !== document.readyState) ? t() : document.addEventListener("DOMContentLoaded", t)
        }, isEmpty: function (t) {
            for (var e in t) if (t.hasOwnProperty(e)) return !1;
            return !0
        }, numberString: function (t) {
            for (var e = (t += "").split("."), a = e[0], n = e.length > 1 ? "." + e[1] : "", i = /(\d+)(\d{3})/; i.test(a);) a = a.replace(i, "$1,$2");
            return a + n
        }, detectIE: function () {
            var t = window.navigator.userAgent, e = t.indexOf("MSIE ");
            if (e > 0) return parseInt(t.substring(e + 5, t.indexOf(".", e)), 10);
            if (t.indexOf("Trident/") > 0) {
                var a = t.indexOf("rv:");
                return parseInt(t.substring(a + 3, t.indexOf(".", a)), 10)
            }
            var n = t.indexOf("Edge/");
            return n > 0 && parseInt(t.substring(n + 5, t.indexOf(".", n)), 10)
        }, isRTL: function () {
            return "rtl" == KTUtil.attr(KTUtil.get("html"), "direction")
        }, scrollInit: function (t, e) {
            function a() {
                var a, n;
                if (n = e.height instanceof Function ? parseInt(e.height.call()) : parseInt(e.height), (e.mobileNativeScroll || e.disableForMobile) && KTUtil.isInResponsiveRange("tablet-and-mobile")) (a = KTUtil.data(t).get("ps")) ? (e.resetHeightOnDestroy ? KTUtil.css(t, "height", "auto") : (KTUtil.css(t, "overflow", "auto"), n > 0 && KTUtil.css(t, "height", n + "px")), a.destroy(), a = KTUtil.data(t).remove("ps")) : n > 0 && (KTUtil.css(t, "overflow", "auto"), KTUtil.css(t, "height", n + "px")); else if (n > 0 && KTUtil.css(t, "height", n + "px"), e.desktopNativeScroll) KTUtil.css(t, "overflow", "auto"); else {
                    KTUtil.css(t, "overflow", "hidden"), (a = KTUtil.data(t).get("ps")) ? a.update() : (KTUtil.addClass(t, "kt-scroll"), a = new PerfectScrollbar(t, {wheelSpeed: .5, swipeEasing: !0, wheelPropagation: !1 !== e.windowScroll, minScrollbarLength: 40, maxScrollbarLength: 300, suppressScrollX: "true" != KTUtil.attr(t, "data-scroll-x")}), KTUtil.data(t).set("ps", a));
                    var i = KTUtil.attr(t, "id");
                    if (!0 === e.rememberPosition && Cookies && i) {
                        if (Cookies.get(i)) {
                            var o = parseInt(Cookies.get(i));
                            o > 0 && (t.scrollTop = o)
                        }
                        t.addEventListener("ps-scroll-y", function () {
                            Cookies.set(i, t.scrollTop)
                        })
                    }
                }
            }

            t && (a(), e.handleWindowResize && KTUtil.addResizeHandler(function () {
                a()
            }))
        }, scrollUpdate: function (t) {
            var e = KTUtil.data(t).get("ps");
            e && e.update()
        }, scrollUpdateAll: function (t) {
            for (var e = KTUtil.findAll(t, ".ps"), a = 0, n = e.length; a < n; a++) KTUtil.scrollUpdate(e[a])
        }, scrollDestroy: function (t) {
            var e = KTUtil.data(t).get("ps");
            e && (e.destroy(), e = KTUtil.data(t).remove("ps"))
        }, setHTML: function (t, e) {
            KTUtil.get(t) && (KTUtil.get(t).innerHTML = e)
        }, getHTML: function (t) {
            if (KTUtil.get(t)) return KTUtil.get(t).innerHTML
        }, getDocumentHeight: function () {
            var t = document.body, e = document.documentElement;
            return Math.max(t.scrollHeight, t.offsetHeight, e.clientHeight, e.scrollHeight, e.offsetHeight)
        }, getScrollTop: function () {
            return (document.scrollingElement || document.documentElement).scrollTop
        }
    }
}();
"undefined" != typeof module && void 0 !== module.exports && (module.exports = KTUtil), KTUtil.ready(function () {
    KTUtil.init()
}), window.onload = function () {
    KTUtil.removeClass(KTUtil.get("body"), "kt-page--loading")
};

var KTLayout = function () {
    var t, e, a, n, i, o, l, r = function () {
        return new KTPortlet("kt_page_portlet", {
            sticky: {
                offset: parseInt(KTUtil.css(KTUtil.get("kt_header"), "height")) + 200, zIndex: 90, position: {
                    top: function () {
                        var e = 0;
                        return KTUtil.isInResponsiveRange("desktop") ? (KTUtil.hasClass(t, "kt-header--fixed") && (e += parseInt(KTUtil.css(KTUtil.get("kt_header"), "height"))), KTUtil.hasClass(t, "kt-subheader--fixed") && KTUtil.get("kt_subheader") && (e += parseInt(KTUtil.css(KTUtil.get("kt_subheader"), "height")))) : KTUtil.hasClass(t, "kt-header-mobile--fixed") && (e += parseInt(KTUtil.css(KTUtil.get("kt_header_mobile"), "height"))), e
                    }, left: function (t) {
                        var e = t.getSelf();
                        return KTUtil.offset(e).left
                    }, right: function (t) {
                        var e = t.getSelf(), a = parseInt(KTUtil.css(e, "width"));
                        return parseInt(KTUtil.css(KTUtil.get("body"), "width")) - a - KTUtil.offset(e).left
                    }
                }
            }
        })
    };
    return {
        init: function () {
            t = KTUtil.get("body"), this.initHeader(), this.initAside(), this.initPageStickyPortlet(), $("#kt_aside_menu, #kt_header_menu").on("click", '.kt-menu__link[href="#"]', function (t) {
                swal.fire("", "You have clicked on a non-functional dummy link!"), t.preventDefault()
            })
        },
        initHeader: function () {
            var t, n, i;
            n = KTUtil.get("kt_header"), i = {offset: {}, minimize: {desktop: {on: "kt-header--minimize"}, mobile: {on: "kt-header--minimize"}}}, (t = KTUtil.attr(n, "data-ktheader-minimize-offset")) && (i.offset.desktop = t), (t = KTUtil.attr(n, "data-ktheader-minimize-mobile-offset")) && (i.offset.mobile = t), new KTHeader("kt_header", i), a = new KTOffcanvas("kt_header_menu_wrapper", {
                overlay: !0,
                baseClass: "kt-header-menu-wrapper",
                closeBy: "kt_header_menu_mobile_close_btn",
                toggleBy: {target: "kt_header_mobile_toggler", state: "kt-header-mobile__toolbar-toggler--active"}
            }), e = new KTMenu("kt_header_menu", {submenu: {desktop: "dropdown", tablet: "accordion", mobile: "accordion"}, accordion: {slideSpeed: 200, expandAll: !1}}), o = new KTToggle("kt_header_mobile_topbar_toggler", {target: "body", targetState: "kt-header__topbar--mobile-on", togglerState: "kt-header-mobile__toolbar-topbar-toggler--active"}), new KTScrolltop("kt_scrolltop", {offset: 300, speed: 600})
        },
        initAside: function () {
            var a, r, s, d, c;
            s = KTUtil.get("kt_aside"), KTUtil.get("kt_aside_brand"), d = KTUtil.hasClass(s, "kt-aside--offcanvas-default") ? "kt-aside--offcanvas-default" : "kt-aside", c = KTUtil.get("kt_aside_menu"), i = new KTOffcanvas("kt_aside", {baseClass: d, overlay: !0, closeBy: "kt_aside_close_btn", toggleBy: {target: "kt_aside_mobile_toggler", state: "kt-header-mobile__toolbar-toggler--active"}}), KTUtil.hasClass(t, "kt-aside--fixed") && "1" == KTUtil.attr(c, "data-ktmenu-scroll") && (KTUtil.addEvent(s, "mouseenter", function (e) {
                e.preventDefault(), !1 !== KTUtil.isInResponsiveRange("desktop") && (r && (clearTimeout(r), r = null), a = setTimeout(function () {
                    KTUtil.hasClass(t, "kt-aside--minimize") && KTUtil.isInResponsiveRange("desktop") && (KTUtil.removeClass(t, "kt-aside--minimize"), KTUtil.addClass(t, "kt-aside--minimizing"), KTUtil.transitionEnd(t, function () {
                        KTUtil.removeClass(t, "kt-aside--minimizing")
                    }), KTUtil.addClass(t, "kt-aside--minimize-hover"), n.scrollUpdate(), n.scrollTop())
                }, 50))
            }), KTUtil.addEvent(s, "mouseleave", function (e) {
                e.preventDefault(), !1 !== KTUtil.isInResponsiveRange("desktop") && (a && (clearTimeout(a), a = null), r = setTimeout(function () {
                    KTUtil.hasClass(t, "kt-aside--minimize-hover") && KTUtil.isInResponsiveRange("desktop") && (KTUtil.removeClass(t, "kt-aside--minimize-hover"), KTUtil.addClass(t, "kt-aside--minimize"), KTUtil.addClass(t, "kt-aside--minimizing"), KTUtil.transitionEnd(t, function () {
                        KTUtil.removeClass(t, "kt-aside--minimizing")
                    }), n.scrollUpdate(), n.scrollTop())
                }, 100))
            })), function () {
                var t, e = KTUtil.get("kt_aside_menu"), a = "1" === KTUtil.attr(e, "data-ktmenu-dropdown") ? "dropdown" : "accordion";
                "1" === KTUtil.attr(e, "data-ktmenu-scroll") && (t = {
                    rememberPosition: !0, height: function () {
                        var t;
                        return t = KTUtil.isInResponsiveRange("desktop") ? parseInt(KTUtil.getViewPort().height) - parseInt(KTUtil.actualHeight("kt_header_brand")) : parseInt(KTUtil.getViewPort().height), t -= parseInt(KTUtil.css(e, "marginBottom")) + parseInt(KTUtil.css(e, "marginTop"))
                    }
                }), n = new KTMenu("kt_aside_menu", {scroll: t, submenu: {desktop: a, tablet: "accordion", mobile: "accordion"}, accordion: {expandAll: !1}})
            }(), KTUtil.get("kt_aside_toggler") && ((o = new KTToggle("kt_aside_toggler", {target: "body", targetState: "kt-aside--minimize", togglerState: "kt-aside__brand-aside-toggler--active"})).on("toggle", function (a) {
                KTUtil.addClass(t, "kt-aside--minimizing"), KTUtil.get("kt_page_portlet") && l.updateSticky(), KTUtil.transitionEnd(t, function () {
                    KTUtil.removeClass(t, "kt-aside--minimizing")
                }), e.pauseDropdownHover(800), n.pauseDropdownHover(800), Cookies.set("kt_aside_toggle_state", a.getState())
            }), o.on("beforeToggle", function (t) {
                var e = KTUtil.get("body");
                !1 === KTUtil.hasClass(e, "kt-aside--minimize") && KTUtil.hasClass(e, "kt-aside--minimize-hover") && KTUtil.removeClass(e, "kt-aside--minimize-hover")
            })), this.onAsideToggle(function (t) {
                l && l.updateSticky();
                var e = $(".kt-datatable");
                e && e.each(function () {
                    $(this).KTDatatable("redraw")
                })
            })
        },
        initPageStickyPortlet: function () {
            KTUtil.get("kt_page_portlet") && ((l = r()).initSticky(), KTUtil.addResizeHandler(function () {
                l.updateSticky()
            }), r())
        },
        getAsideMenu: function () {
            return n
        },
        onAsideToggle: function (t) {
            void 0 !== o.element && o.on("toggle", t)
        },
        getAsideToggler: function () {
            return o
        },
        closeMobileAsideMenuOffcanvas: function () {
            KTUtil.isMobileDevice() && i.hide()
        },
        closeMobileHeaderMenuOffcanvas: function () {
            KTUtil.isMobileDevice() && a.hide()
        },
        getContentHeight: function () {
            return t = KTUtil.getViewPort().height, KTUtil.getByID("kt_header") && (t -= KTUtil.actualHeight("kt_header")), KTUtil.getByID("kt_subheader") && (t -= KTUtil.actualHeight("kt_subheader")), KTUtil.getByID("kt_footer") && (t -= parseInt(KTUtil.css("kt_footer", "height"))), KTUtil.getByID("kt_content") && (t = t - parseInt(KTUtil.css("kt_content", "padding-top")) - parseInt(KTUtil.css("kt_content", "padding-bottom"))), t;
            var t
        }
    }
}();
"undefined" != typeof module && (module.exports = KTLayout), $(document).ready(function () {
    KTLayout.init()
});


