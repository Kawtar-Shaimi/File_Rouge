import Swal from "sweetalert2";

$(document).ready(function () {
    $("#add-book").prop("disabled", true);

    $("#name").on("input", function () {
        var name = $(this).val();
        if (name.length < 3) {
            $("#nameErr").text("Name must be at least 3 characters");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else if (name.length > 150) {
            $("#nameErr").text("Name must be less than 150 characters");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
            $("#nameErr").text("Name must only contain letters and spaces");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else if (name.trim() === "") {
            $("#nameErr").text("Name cannot be empty");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else {
            $("#nameErr").text("");
            $("#name")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#add-book").prop("disabled", false);
        }
    });

    $("#price").on("input", function () {
        var price = $(this).val();
        if (price <= 0) {
            $("#priceErr").text("Price must be greater than 0");
            $("#price")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else {
            $("#priceErr").text("");
            $("#price")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#add-book").prop("disabled", false);
        }
    });

    $("#stock").on("input", function () {
        var stock = $(this).val();
        if (stock <= 0) {
            $("#stockErr").text("Stock must be greater than 0");
            $("#stock")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else {
            $("#stockErr").text("");
            $("#stock")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#add-book").prop("disabled", false);
        }
    });

    $("#description").on("input", function () {
        var description = $(this).val();
        if (description.length < 3) {
            $("#descriptionErr").text(
                "Description must be at least 3 characters"
            );
            $("#description")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else if (description.trim() === "") {
            $("#descriptionErr").text("Description cannot be empty");
            $("#description")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else {
            $("#descriptionErr").text("");
            $("#description")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#add-book").prop("disabled", false);
        }
    });

    $("#image").on("change", function () {
        var image = $(this).val();
        if (image === "") {
            $("#imageErr").text("Image is required");
            $("#image")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#add-book").prop("disabled", true);
        } else {
            $("#imageErr").text("");
            $("#image")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#add-book").prop("disabled", false);
        }
    });

    $("#add-book").click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You are about to create a new book.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#6366f1",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#createBookForm").submit();
            }
        });
    });
});
