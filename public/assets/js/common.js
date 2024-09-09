$(document).ready(() => {
    $(".nav-dropdown").click(function () {
        const parent = $(this).closest(".nav-dropdown-container");
        const thisDiv = $(this).closest(".nav-dropdown");
        const activeStatus = thisDiv.data("active");
        if (activeStatus) {
            closeDropDown(parent, thisDiv);
        } else {
            closeOtherDropdowns(thisDiv);
            openDropDown(parent, thisDiv);
        }
    });

    $(".nav-dropdown").each(function (e, item) {
        const activeStatus = $(item).data("active");
        const parent = $(item).closest(".nav-dropdown-container");
        if (activeStatus) {
            openDropDown(parent, $(item), false);
        } else {
            closeDropDown(parent, $(item), false);
        }
    });

    $("#navbar-open").click(function () {
        const drawer = $("#navdrawer");
        if (drawer.data("active")) {
            $("#navdrawer-overlay").fadeOut();
            drawer.data("active", false);
            // drawer.animate({ left: "-100%" });
            drawer.addClass("-left-full");
            drawer.removeClass("left-0");
        } else {
            $("#navdrawer-overlay").fadeIn();
            drawer.data("active", true);
            // drawer.animate({ left: "0" });
            drawer.removeClass("-left-full");
            drawer.addClass("left-0");
        }
    });

    $("#navdrawer-overlay").click(function () {
        const drawer = $("#navdrawer");
        if (drawer.data("active")) {
            $("#navdrawer-overlay").fadeOut();
            drawer.data("active", false);
            // drawer.animate({ left: "-100%" });

            drawer.addClass("-left-full");
            drawer.removeClass("left-0");
        }
    });

    function closeOtherDropdowns(except) {
        $(".nav-dropdown").each(function (e, item) {
            if ($(item).data("active") && $(item).not(except)) {
                closeDropDown(
                    $(item).closest(".nav-dropdown-container"),
                    $(item)
                );
            }
        });
    }

    $("#toggleNotificationPanel").click(() => {
        // $("#notificationPanel").toggle();
        if ($("#notificationPanel").data("visible")) {
            $("#notificationPanel").data("visible", false);
            $("#notificationPanel").css({
                transform: "translateY(-12px)",
                opacity: 0,
                visibility: "hidden",
            });
        } else {
            $("#notificationPanel").data("visible", true);
            $("#notificationPanel").css({
                transform: "translateY(0)",
                opacity: 1,
                visibility: "visible",
            });
        }
    });

    // close notification panel on click outside
    $(document).click((e) => {
        if (
            $("#notificationPanel").data("visible") &&
            !$("#notificationPanel").is(e.target) &&
            $("#notificationPanel").has(e.target).length === 0 &&
            !$("#toggleNotificationPanel").is(e.target) &&
            $("#toggleNotificationPanel").has(e.target).length === 0
        ) {
            $("#notificationPanel").data("visible", false);
            $("#notificationPanel").css({
                transform: "translateY(-12px)",
                opacity: 0,
                visibility: "hidden",
            });
        }
    });

    function openDropDown(parent, thisDiv, triggerData = true) {
        if (triggerData) thisDiv.data("active", true);
        thisDiv.children().last().children().last().css({
            transform: "rotate(180deg)",
        });
        thisDiv.removeClass("navbtn-normal-bg");
        thisDiv.addClass("navbtn-active-bg");
        parent.children().last().children().last().slideDown();
    }

    function closeDropDown(parent, thisDiv, triggerData = true) {
        if (triggerData) thisDiv.data("active", false);
        thisDiv.children().last().children().last().css({
            transform: "rotate(0deg)",
        });
        thisDiv.removeClass("navbtn-active-bg");
        thisDiv.addClass("navbtn-normal-bg");
        parent.children().last().children().last().slideUp();
    }
});
