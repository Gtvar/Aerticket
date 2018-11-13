// Don't look at JavaScript part pls. It's very dirty code, I don't have time at all.

$("#search_button").click(function(){

    var data = {};

    data.searchQuery = {};
    data.searchQuery.departureAirport = $('#departureAirport').val();
    data.searchQuery.arrivalAirport = $('#arrivalAirport').val();
    data.searchQuery.departureDate = $('#departureDate').val();

    $.ajax({
        contentType: 'application/json',
        data: JSON.stringify(data),
        dataType: 'json',
        success: function(result){
            $("#result").val(JSON.stringify(result));
        },
        error: function(result){
            $("#result").val(JSON.stringify(result));
        },
        processData: false,
        type: 'POST',
        url: '/api/v1/flights/search'
    });

    return false;
});


