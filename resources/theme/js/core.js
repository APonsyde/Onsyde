"use strict";

$(document).ready(function() {
    $(".burger").click(function(){
        $(".links").toggleClass('open')
    });
    /* -- Bootstrap Popover -- */
    $('[data-toggle="popover"]').popover();
    /* -- Bootstrap Tooltip -- */
    $('[data-toggle="tooltip"]').tooltip();
});