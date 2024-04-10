



$(document).ready(function() {
    $('#cafe, #the').on('mousedown', function() {
        var selectedText = $(this).text();
        $('#dropdown-button').text(selectedText);
    });
});

$(function() {
var data = [
    {
        "label": "cafe 1",
        "value": "10",
        "id": "1"
    },
    {
        "label": "the 2",
        "value": "20",
        "id": "2"
    }
]


$("#search-dropdown").autocomplete({
    source: function(request, response) {
        var parsedData = data;
        var exactMatches = [];
        var partialMatches = [];
        $.each(parsedData, function(index, item) {
            if (item.label.startsWith(request.term)) {
                exactMatches.push(item);
            } else {
                partialMatches.push(item);
            }
        });
        response(exactMatches.concat([{ label: "----", value: "" }]).concat(partialMatches));
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