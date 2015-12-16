/**
 * Created by pedro.data on 16/12/2015.
 */
$(function() {

   /* $( ".target select" ).change(function() {
    var value = $(this).val();
    console.log(value );
    })*/
    $( ".target select" ).change(function() {
        var value = $(this).val();
        var id = $(this).parents().eq(2).html();
        console.log(value + " " +id );
    });

});