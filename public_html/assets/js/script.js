var selectedCategory = null;

$('#cafe, #the').on('mousedown', function() {
    var selectedText = $(this).text();
    $('#dropdown-button').text(selectedText);
    selectedCategory = selectedText;
});

$(function() {
    var data = [
        {
            "label": "cafe 1",
            "stock": "10",
            "id": "1",
            "category": "Cafe"
        },
        {
            "name": "cafe 2",
            "stock": "20",
            "id_product": "2",
            "id_category": "Cafe"
        },
        {
            "label": "the 1",
            "stock": "10",
            "id": "3",
            "category": "The"
        },
        {
            "label": "the 2",
            "stock": "20",
            "id": "4",
            "category": "The"
        }
    ]

    $("#search-dropdown").autocomplete({
        source: function(request, response) {
            var parsedData = data;
            var exactMatches = [];
            var partialMatches = [];
            $.each(parsedData, function(index, item) {
                if (item.label.startsWith(request.term) && item.category === selectedCategory) {
                    exactMatches.push(item);
                } else if (item.category === selectedCategory) {
                    partialMatches.push(item);
                }
            });
                        response(exactMatches.concat([{ label: "", value: "" }]));
        },
        focus: function(event, ui) {
            event.preventDefault();
        },
        select: function(event, ui) {
            if (ui.item.value !== "") {
                window.location.href = 'product.php?id=' + ui.item.id;
            }
            return false;
        },
        minLength: 1
    });
});