$(document).ready(function () {
    $("#name").on("input", function () {
        var name = $(this).val();
        if (name.length < 3) {
            $("#nameErr").text("Name must be at least 3 characters");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-category").prop("disabled", true);
        } else if (name.length > 100) {
            $("#nameErr").text("Name must be less than 100 characters");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-category").prop("disabled", true);
        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
            $("#nameErr").text("Name must only contain letters and spaces");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-category").prop("disabled", true);
        } else if (name.trim() === "") {
            $("#nameErr").text("Name cannot be empty");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-category").prop("disabled", true);
        } else {
            $("#nameErr").text("");
            $("#name")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#create-category").prop("disabled", false);
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
            $("#create-category").prop("disabled", true);
        } else if (description.trim() === "") {
            $("#descriptionErr").text("Description cannot be empty");
            $("#description")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-category").prop("disabled", true);
        } else {
            $("#descriptionErr").text("");
            $("#description")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#create-category").prop("disabled", false);
        }
    });

    $("#create-category").click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You are about to create a new category.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#6366f1",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#create-category-form").submit();
            }
        });
    });
});
