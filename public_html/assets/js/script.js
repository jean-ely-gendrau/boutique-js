var selectedCategory = null;

var categoryMap = {
    1: 'the',
    2: 'cafe',
};

$('#cafe, #the').on('mousedown', function() {
    var selectedText = $(this).text();
    $('#dropdown-button').text(selectedText);
    selectedCategory = selectedText;
    console.log('Selected category:', selectedCategory); // Log selected category
});

$(function() {
    var data = [];

    $.ajax({
        url: 'getproduct.php',  // Change this to the URL that maps to your getProductsAll() method
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            data = response;
            console.log('Data:', data); // Log data
            setupAutocomplete();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('AJAX error:', textStatus, errorThrown); // Log AJAX error
        }
    });

    $("#search-dropdown").autocomplete({
        source: function(request, response) {
            console.log('source function called'); // Log when source function is called
            var parsedData = data;
            var exactMatches = [];
            var partialMatches = [];
            $.each(parsedData, function(index, item) {
                console.log('In $.each loop'); // Log when in $.each loop
                var categoryName = categoryMap[item.id_category];
                console.log('Item name:', item.name); // Log item name
                console.log('Category name:', categoryName); // Log category name
                if (item.name && item.name.startsWith(request.term) && categoryName === selectedCategory) {
                    exactMatches.push(item);
                } else if (categoryName === selectedCategory) {
                    partialMatches.push(item);
                }
            });
            console.log('Exact matches:', exactMatches); // Log exact matches
            console.log('Partial matches:', partialMatches); // Log partial matches
            response(exactMatches.concat([{ label: "", value: "" }]));
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