/**
 * Created by pedro.data on 16/12/2015.
 */
$(function() {

    $( ".target select" ).change(function() {
        var value = $(this).val();
        var id = $(this).parents().eq(2).find('form').attr('id');
        //console.log( value + " " + id );
        aButtonPressed(id);
    });

});

function aButtonPressed(id){
    $.post('/player',
    {data: id},
        function(response){
            /*if(response.code == 100 && response.success){//dummy check

             }*/

        }, "json");
}