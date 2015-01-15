/* debouncedresize */
(function (e) {
    var t = e.event, n, r;
    n = t.special.debouncedresize = {
        setup: function () {
            e(this).on("resize", n.handler);
        }, teardown: function () {
            e(this).off("resize", n.handler);
        }, handler: function (e, i) {
            var s = this, o = arguments, u = function () {
                e.type = "debouncedresize";
                t.dispatch.apply(s, o);
            };
            if (r) {
                clearTimeout(r);
            }
            i ? u() : r = setTimeout(u, n.threshold);
        }, threshold: 150
    };
})(jQuery);
function on_resize(c, t) {
    onresize = function () {
        clearTimeout(t);
        t = setTimeout(c, 100);
    };
    return c;
}

// fittext 
//(function(e){e.fn.fitText=function(t,n){var r=t||1,i=e.extend({minFontSize:Number.NEGATIVE_INFINITY,maxFontSize:Number.POSITIVE_INFINITY},n);return this.each(function(){var t=e(this);var n=function(){t.css("font-size",Math.max(Math.min(t.width()/(r*10),parseFloat(i.maxFontSize)),parseFloat(i.minFontSize)))};n();e(window).on("resize.fittext orientationchange.fittext",n)})}})(jQuery);

on_resize(function () {

})();

$(document).ready(function () {
    //console.log('Document ready!');
});