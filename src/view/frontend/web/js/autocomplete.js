define([
        'jquery'
    ],
    function ($, autocomplete) {

        return {
            autocompleteData: function (ajaxurl) {
                $(document).on('click', '#search_submit', function (event) {
                    event.preventDefault();
                    var search_terms = $('#search_terms').val();
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        showLoader: true,
                        dataType: 'json',
                        data: {search_terms: search_terms},
                        success: function (response) {
                            var html = "";
                            if (response.num_results > 0) {
                                html = "<ul>";
                                $.each(response.data, function (key, value) {
                                    //console.log(key + ": " + value);
                                    html += "<li>" + value.tab + ": " + value.label + " (" + value.path + ")</li>";
                                });
                                html += "</ul>";
                            }
                            else {
                                html = "There were no results.";
                            }
                            $("#search_results_content").empty();
                            $("#search_results_content").append(html);
                            $("#search_results").show();
                        },
                        error: function () {
                            //console.log('error');
                            var html = 'Error';
                            $("#search_results_content").empty();
                            $("#search_results_content").append(html);
                            $("#search_results").show();
                        }
                    });
                });
            }
        }

    });
