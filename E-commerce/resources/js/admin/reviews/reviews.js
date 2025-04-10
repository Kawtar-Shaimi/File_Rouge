import Swal from "sweetalert2";

$(document).ready(function () {
    function fetchReviews(query, page = 1, sort = "id", order = "asc") {
        $.ajax({
            url: "/admin/filter/reviews?page=" + page,
            method: "GET",
            data: {
                query,
                sort,
                order,
            },
            success: function (response) {
                $("#reviews-table").html(response.data.html);
            },
        });
    }

    $("#search").on("keyup", function () {
        let query = $(this).val();
        let sort = $("#sort").val();
        let order = $("#order").val();
        fetchReviews(query, 1, sort, order);
    });

    $("#sort, #order").on("change", function () {
        let order = $("#order").val();
        let query = $("#search").val();
        let sort = $("#sort").val();
        fetchReviews(query, 1, sort, order);
    });

    $(document).on("click", "#pagination a", function (event) {
        event.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        let query = $("#search").val();
        let sort = $("#sort").val();
        let order = $("#order").val();
        fetchReviews(query, page, sort, order);
    });
});

function showDeleteConfirmation(e, uuid) {
    e.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "This action will permanently delete this review!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $(`#delete-form-${uuid}`).submit();
        }
    });
}

window.showDeleteConfirmation = showDeleteConfirmation;
