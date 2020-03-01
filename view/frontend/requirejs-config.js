var config = {};

requirejs( ["jquery"], function($) {
    $( ".vehicle-selector" ).on( "click", function() {
        $( "#amfinder_2" ).toggle();
    } );
} );
