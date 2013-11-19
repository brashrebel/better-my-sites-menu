jQuery(document).ready(function ($) {

    // Save the height of browser viewport
    var max_height = $(window).height();

    // If viewport is resized, save its new height
    $( window ).resize(function() {
      max_height = $(this).height();
    });

    // When user is hovering over My Sites menu
    $("#wp-admin-bar-new-my-sites > .ab-sub-wrapper").hover(function() {

        // Initialize variables
        var $container = $("#wp-admin-bar-new-my-sites"),
            $list = $("#wp-admin-bar-new-my-sites-list"),
            height = $list.height() * 1.1,       // make sure there is enough room at the bottom
            multiplier = height / max_height;     // needs to move faster if list is taller

            // Save the container height so we can revert on mouseout
            $container.data("origHeight", $container.height());

            // Don't do any animation if list shorter than max
            if (multiplier > 1) {
                $container.mousemove(function(e) {
                        var offset = $container.offset();
                        var relativeY = ((e.pageY - offset.top) * multiplier) - ($container.data("origHeight") * multiplier);

                        // Add hover scroll effect so all sites on My Sites list can be accessed
                        if ( relativeY > $container.data("origHeight") ) {
                            $list.css("top", -relativeY + $container.data("origHeight"));
                            $("#wp-admin-bar-new-my-sites > .ab-sub-wrapper").css("height", -relativeY + height + 10);
                        };
                    });
            }
    }, function() { // When mouse leaves hover area
    
    var $el = $(this);

    // Return My Sites menu to its original height and position
    $el
        .height($(this).data("origHeight"))
        .find("ul")
        .css({ top: 0 })
    
    });
});