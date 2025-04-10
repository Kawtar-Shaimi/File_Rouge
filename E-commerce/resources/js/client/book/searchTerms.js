$(document).ready(function () {
    $("#search").on("input", function () {
        var query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: "/client/filter/searchTerms",
                method: "GET",
                data: { query },
                success: function (res) {
                    $("#search-results").empty();
                    if (res.data.searchTerms.length === 0) {
                        $("#search-results").append(
                            '<li class="py-2 px-4 text-gray-500">No results found</li>'
                        );
                    } else {
                        $.each(
                            res.data.searchTerms,
                            function (index, searchTerm) {
                                $("#search-results").append(
                                    `<li><a class="block py-2 px-4 border-b border-gray-200 hover:bg-gray-100" href="/books?query=${searchTerm}">${searchTerm}</a></li>`
                                );
                            }
                        );
                    }
                    $("#results").removeClass("hidden");
                },
            });
        } else {
            $("#search-results").empty();
            $("#results").addClass("hidden");
        }
    });
});
