jQuery.cookie.defaults.path = "/";

(function($) {
    var demo_assets_url = "images/";
    var styleSelector = {
        filename: "default.css",
        primary_color: "#79cba8",
        isChanging: false,
        cookieColor: "noo-selector-color",
        cookieColorSecondary: "noo-selector-color-secondary",
        cookieSkin: "noo-selector-skin",
        cookieLayout: "noo-selector-layout",
        cookiePattern: "noo-selector-pattern",
        cookieOpened: "noo-selector-opened",
        initialize: function() {
            iThis = this;
            iThis.build();
            iThis.events();
            if ($.cookie(iThis.cookieColor) != null) {
                iThis.setColor($.cookie(iThis.cookieColor));
            }
            if ($.cookie(iThis.cookieSkin) != null) {
                iThis.setSkin($.cookie(iThis.cookieSkin));
            }
            if ($.cookie(iThis.cookieLayout) != null) {
                iThis.setLayout($.cookie(iThis.cookieLayout));
            }
            if ($.cookie(iThis.CookiePattern) != null) {
                iThis.setPattern($.cookie(iThis.CookiePattern));
            }
            if ($.cookie(iThis.cookieOpened) == null) {
                $.cookie(iThis.cookieOpened, true);
            }
        },
        build: function() {
            var iThis = this;
            style_selector_div = $("<div />").attr("id", "styleSelector").addClass("style-selector visible-md visible-lg").append($("<h4 />").addClass("selector-title").html("Style Selector").append($("<a />").attr("href", "#").append($("<div />").addClass("icon-wrap").append($("<i />").addClass("fa fa-spin fa-cog"), $("<i />").addClass("fa fa-spin fa-spin-reverse fa-cog"), $("<i />").addClass("fa fa-spin fa-cog")))), $("<div />").addClass("style-selector-wrap").append($("<h5 />").html("Colors"), $("<ul />").addClass("options colors").attr("data-type", "colors"), $("<h5 />").html("Site Layout"), $("<div />").addClass("options-links layout").append($("<a />").attr("href", "#").attr("data-layout", "fullwidth").addClass("active").html("Wide"), $("<a />").attr("href", "#").attr("data-layout", "boxed").html("Boxed")), $("<div />").hide().addClass("patterns").append($("<h5 />").html("Background Patterns"), $("<ul />").addClass("options").attr("data-type", "patterns")), $("<hr />"), $("<div />").addClass("options-links").append($("<a />").addClass("reset").attr("href", "#").html("Reset"))));
            $("body").append(style_selector_div);
            iThis.container = $("#styleSelector");
            iThis.container.find("div.options-links.mode a").click(function(e) {
                e.preventDefault();
                var style_selector_div = $(this).parents(".mode");
                style_selector_div.find("a.active").removeClass("active");
                $(this).addClass("active");
                if ("advanced" == $(this).attr("data-mode")) {
                    $("#styleSelector").addClass("advanced").removeClass("basic");
                } else {
                    $("#styleSelector").addClass("basic").removeClass("advanced");
                }
            });
            var presetColors = [ {
                Hex1: iThis.primary_color,
                colorName1: "Default",
                Hex2: "#79cba8",
                colorName2: "Default",
                fileName: "default.css"
            }, {
                Hex1: "#49C9B1",
                colorName1: "Cyan",
                Hex2: "#49C9B1",
                colorName2: "Cyan",
                fileName: "cyan.css"
            }, {
                Hex1: "#ff514a",
                colorName1: "Red",
                Hex2: "#ff514a",
                colorName2: "Red",
                fileName: "red.css"
            }, {
                Hex1: "#eb5982",
                colorName1: "Pink",
                Hex2: "#eb5982",
                colorName2: "Pink",
                fileName: "pink.css"
            }, {
                Hex1: "#4f9fd1",
                colorName1: "Blue",
                Hex2: "#4f9fd1",
                colorName2: "Blue",
                fileName: "blue.css"
            }, {
                Hex1: "#eab129",
                colorName1: "Yellow",
                Hex2: "#eab129",
                colorName2: "Yellow",
                fileName: "yellow.css"
            }, {
                Hex1: "#578223",
                colorName1: "Green",
                Hex2: "#578223",
                colorName2: "Green",
                fileName: "green.css"
            } ];
            presetColorsEl = iThis.container.find("ul[data-type=colors]");
            $.each(presetColors, function(index) {
                var colorEl = $("<li />").append($("<a />").css("background-color", presetColors[index].Hex2).attr({
                    "data-color-hex1": presetColors[index].Hex1,
                    "data-color-name1": presetColors[index].colorName1,
                    "data-color-hex2": presetColors[index].Hex2,
                    "data-color-name2": presetColors[index].colorName2,
                    "data-filename": presetColors[index].fileName,
                    href: "#",
                    title: presetColors[index].colorName1
                }).append($("<div />").addClass("triangle-topleft").css("border-top-color", presetColors[index].Hex1)));
                presetColorsEl.append(colorEl);
            });
            presetColorsEl.find("a").click(function(e) {
                e.preventDefault();
                iThis.setColor($(this).attr("data-filename"));
            });
            iThis.container.find("div.options-links.layout a").click(function(e) {
                e.preventDefault();
                iThis.setLayout($(this).attr("data-layout"));
            });
            iThis.container.find("div.options-links.skin a").click(function(e) {
                e.preventDefault();
                iThis.setSkin($(this).attr("data-direction"));
            });
            var patterns = [ "bright_squares", "random_grey_variations", "wild_oliva", "denim", "subtle_grunge", "az_subtle", "straws", "textured_stripes" ];
            var patternsOption = iThis.container.find("ul[data-type=patterns]");
            $.each(patterns, function(index, value) {
                var patternEl = $("<li />").append($("<a />").addClass("pattern").css("background-image", "url(" + demo_assets_url + "patterns/" + value + ".png)").attr({
                    "data-pattern": value,
                    href: "#",
                    title: value.charAt(0).toUpperCase() + value.slice(1)
                }));
                patternsOption.append(patternEl);
            });
            patternsOption.find("a").click(function(e) {
                e.preventDefault();
                iThis.setPattern($(this).attr("data-pattern"));
            });
            iThis.container.find("a.reset").click(function(e) {
                e.preventDefault();
                iThis.reset();
            });
        },
        events: function() {
            var iThis = this;
            iThis.container.find(".selector-title a").click(function(e) {
                e.preventDefault();
                if (iThis.container.hasClass("active")) {
                    iThis.container.animate({
                        left: "-" + iThis.container.width() + "px"
                    }, 300).removeClass("active");
                } else {
                    iThis.container.animate({
                        left: "0"
                    }, 300).addClass("active");
                }
            });
        },
        setColor: function(filename) {
            var iThis = this;
            if (iThis.isChanging) {
                return false;
            }
            $mainCSS = $("#style-main-color");
            cssHref = $mainCSS.attr("href");
            cssHref = cssHref.replace(iThis.filename, filename);
            iThis.filename = filename;
            $mainCSS.attr("href", cssHref);
            $.cookie(iThis.cookieColor, filename);
            $(document).trigger("noo-color-changed");
        },
        setSkin: function(value) {
            var iThis = this;
            if (value != "rtf") value = "ltf";
            var skinOptionEl = iThis.container.find("div.options-links.skin");
            skinOptionEl.find("a.active").removeClass("active");
            skinOptionEl.find("a[data-direction=" + value + "]").addClass("active");
            var cvalue = "";
            if (value == "rtf") {
                $("body").addClass("theme-rtl");
                cvalue = value;
            } else {
                cvalue = "";
                $("body").removeClass("theme-rtl");
            }
            $.cookie(iThis.cookieSkin, cvalue);
        },
        updateLogo: function() {
            var skin = iThis.container.find("div.options-links.skin a.active").attr("data-skin");
            image_url = skin === "dark" ? demo_assets_url + "logo-dark.png" : demo_assets_url + "logo.png";
            image_floating_url = demo_assets_url + "logo-dark.png";
            if (image_url !== "") {
                $(".navbar-brand .noo-logo-img").remove();
                $(".navbar-brand .noo-logo-retina-img").remove();
                $(".navbar-brand").append('<img class="noo-logo-img noo-logo-normal" src="../jquery/' + image_url + '">');
                $(".navbar-brand").append('<img class="noo-logo-retina-img noo-logo-normal" src="../jquery/' + image_url + '">');
                $(".navbar-brand").append('<img class="noo-logo-img noo-logo-floating" src="../jquery/' + image_floating_url + '">');
                $(".navbar-brand").append('<img class="noo-logo-retina-img noo-logo-floating" src="../jquery/' + image_floating_url + '">');
            }
            $(document).trigger("noo-logo-changed");
        },
        setLayout: function(value) {
            var iThis = this;
            var layoutOptionEl = iThis.container.find("div.options-links.layout");
            var patternsEl = iThis.container.find("div.patterns");
            layoutOptionEl.find("a.active").removeClass("active");
            layoutOptionEl.find("a[data-layout=" + value + "]").addClass("active");
            if ("fullwidth" == value) {
                patternsEl.hide();
                $("body").removeClass("boxed-layout");
                $("body").css("background-image", "none");
                $.removeCookie("pattern");
            } else {
                patternsEl.show();
                $("body").addClass("boxed-layout");
                if ($.cookie(iThis.CookiePattern) === null) {
                    iThis.container.find("ul[data-type=patterns] li:first a").click();
                }
            }
            $.cookie(iThis.cookieLayout, value);
            $(document).trigger("noo-layout-changed");
        },
        setPattern: function(value) {
            var iThis = this;
            if ($("body").hasClass("boxed-layout")) {
                $("body").css("background-image", "url(" + demo_assets_url + "patterns/" + value + ".png)").css("background-repeat", "repeat");
                $.cookie(iThis.CookiePattern, value);
            }
            $(document).trigger("noo-pattern-changed");
        },
        updateCSS: function() {
            iThis = this;
            var skin = iThis.container.find("div.options-links.skin a.active");
            var skin = iThis.container.find("div.options-links.skin a.active").attr("data-direction");
        },
        reset: function() {
            var iThis = this;
            $.removeCookie(iThis.cookieColor);
            $.removeCookie(iThis.cookieSkin);
            $.removeCookie(iThis.cookieLayout);
            $.removeCookie(iThis.CookiePattern);
            location.reload();
        }
    };
    $(document).ready(function() {
        styleSelector.initialize();
    });
})(jQuery);