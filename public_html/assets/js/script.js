var selectedCategory = null;

var categoryMap = {
    1: 'the',
    2: 'cafe',
};

$('#cafe, #the').on('mousedown', function() {
    var selectedText = $(this).text();
    $('#dropdown-button').text(selectedText);
    selectedCategory = 1;
    //console.log('Selected category:', selectedCategory); // Log selected category
});

$(function() {
    var data = [];

    $.ajax({
        url: '/search', 
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            data = response;
            //console.log('Data:', data); // Log data
        },
        error: function(jqXHR, textStatus, errorThrown) {
            //console.log('AJAX error:', textStatus, errorThrown); // Log AJAX error
        }
    });

    $("#search-dropdown").autocomplete({
        source: function(request, response) {
            //console.log('source function called'); // Log when source function is called
            var parsedData = data;
            var exactMatches = [];
            var partialMatches = [];
            $.each(parsedData, function(index, item) {
                //console.log('In $.each loop'); // Log when in $.each loop
                var categoryName = categoryMap[item.category_id];
                /*
                console.log('Item name:', item.name); // Log item name
                console.log('Category name:', categoryName); // Log category name
                console.log('Item name starts with request term:', item.name.startsWith(request.term),request.term,item.name); // Log if item name starts with request term
                */
                if (item.name && item.name.startsWith(request.term)) {
                    exactMatches.push({label:item.name,value:item.quantity});
                } else if (categoryName === selectedCategory) {
                    partialMatches.push({label:item.name,value:item.quantity});
                }
            });
            /*
            console.log('Exact matches:', exactMatches); // Log exact matches
            console.log('Partial matches:', partialMatches); // Log partial matches
            console.log('Response:', exactMatches.concat([{ label: "---", value: "" }])); // Log response
            */
            response(exactMatches.concat([{ label: "---", value: "" }]));
        },
        focus: function(event, ui) {
            event.preventDefault();
        },
        select: function(event, ui) {
            if (ui.item.value !== "") {
                window.location.href = 'detail/' + ui.item.id;
            }
            return false;
        },
        minLength: 1
    });
});