/**
 * Created by Benoit on 09/05/2017.
 */

$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

    //Scroll down and up buttons
    $('#sticky-go-to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, "fast");
        return false;
    });

    $('#sticky-go-to-bottom').click(function(){
        $("html, body").animate({ scrollTop: $(document).height() }, "fast");
        return false
    });
});
