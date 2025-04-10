import Swal from "sweetalert2";

$(document).ready(function () {
    $("#role").on("change", function () {
        var role = $(this).val();
        if (role === "admin" || role === "publisher") {
            $("#roleErr").text("");
            $("#role")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#update-user").prop("disabled", false);
        } else {
            $("#roleErr").text("Role must be admin or publisher");
            $("#role")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#update-user").prop("disabled", true);
        }
    });

    $("#update-user").click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You are about to update this user role.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#6366f1",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#update-form").submit();
            }
        });
    });
});
