$(document).on("click", "#sidebar-overlay", function() {
    if ($("body").hasClass("sidebar-open")) {
        $("body").removeClass("sidebar-open");
        $("body").addClass("sidebar-collapse sidebar-closed");
    }
});