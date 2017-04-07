define([
        'jquery'
    ],
    function ($, autocomplete) {

        return {
            autocompleteData: function (ajaxurl) {
                $(document).on('click', '#search_submit', function (event) {
                    event.preventDefault();
                    var searchResults = $('#search_results');
                    var search_terms = $('#search_terms').val();
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        showLoader: true,
                        dataType: 'json',
                        data: {search_terms: search_terms},
                        success: function (response) {
                            //searchResults.toggle();
                            //console.log(response);
                            var html;
                            $.each(response, function (key, value) {
                                console.log(key + ": " + value);
                                //var str = key + ": " + value;
                                html += key + ": " + value;
                            });
                            searchResults.append(html);
                        },
                        error: function () {
                            // searchResults.removeClass('hidden');
                            console.log('error');
                        }
                    });
                });
            }
        }

    });
