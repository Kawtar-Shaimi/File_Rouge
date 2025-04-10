import Swal from "sweetalert2";

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
            $("#create-user").prop("disabled", true);
        } else if (name.length > 100) {
            $("#nameErr").text("Name must be less than 100 characters");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
            $("#nameErr").text("Name must only contain letters and spaces");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (name.trim() === "") {
            $("#nameErr").text("Name cannot be empty");
            $("#name")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else {
            $("#nameErr").text("");
            $("#name")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#create-user").prop("disabled", false);
        }
    });

    $("#email").on("input", function () {
        var email = $(this).val();
        if (email.length < 3) {
            $("#emailErr").text("Email must be at least 3 characters");
            $("#email")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (email.length > 150) {
            $("#emailErr").text("Email must be less than 150 characters");
            $("#email")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            $("#emailErr").text("Invalid email format");
            $("#email")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (email.trim() === "") {
            $("#emailErr").text("Email cannot be empty");
            $("#email")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else {
            $("#emailErr").text("");
            $("#email")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#create-user").prop("disabled", false);
        }
    });

    $("#phone").on("input", function () {
        var phone = $(this).val();
        if (phone.length < 3) {
            $("#phoneErr").text("Phone must be at least 3 characters");
            $("#phone")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (phone.length > 20) {
            $("#phoneErr").text("Phone must be less than 20 characters");
            $("#phone")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (phone.trim() === "") {
            $("#phoneErr").text("Phone cannot be empty");
            $("#phone")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else {
            $("#phoneErr").text("");
            $("#phone")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#create-user").prop("disabled", false);
        }
    });

    $("#password").on("input", function () {
        var password = $(this).val();
        if (password.length < 8) {
            $("#passwordErr").text("Password must be at least 8 characters");
            $("#password")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (password.length > 20) {
            $("#passwordErr").text("Password must be less than 20 characters");
            $("#password")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (
            !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/.test(
                password
            )
        ) {
            $("#passwordErr").text(
                "Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character"
            );
            $("#password")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (password.trim() === "") {
            $("#passwordErr").text("Password cannot be empty");
            $("#password")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else {
            $("#passwordErr").text("");
            $("#password")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#create-user").prop("disabled", false);
        }
    });

    $("#password_confirmation").on("input", function () {
        var password = $("#password").val();
        var confirmPassword = $(this).val();
        if (confirmPassword.length < 8) {
            $("#password_confirmationErr").text(
                "Password confirmation must be at least 8 characters"
            );
            $("#password_confirmation")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (confirmPassword.length > 20) {
            $("#password_confirmationErr").text(
                "Password confirmation must be less than 20 characters"
            );
            $("#password_confirmation")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (
            !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/.test(
                confirmPassword
            )
        ) {
            $("#password_confirmationErr").text(
                "Password confirmation must contain at least one lowercase letter, one uppercase letter, one number, and one special character"
            );
            $("#password_confirmation")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (confirmPassword.trim() === "") {
            $("#password_confirmationErr").text(
                "Password confirmation cannot be empty"
            );
            $("#password_confirmation")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else if (password !== confirmPassword) {
            $("#password_confirmationErr").text("Passwords do not match");
            $("#password_confirmation")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        } else {
            $("#password_confirmationErr").text("");
            $("#password_confirmation")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#create-user").prop("disabled", false);
        }
    });

    $("#role").on("change", function () {
        var role = $(this).val();
        if (role === "admin" || role === "publisher") {
            $("#roleErr").text("");
            $("#role")
                .removeClass("border-red-500  focus:ring focus:ring-red-300")
                .addClass("border-green-500  focus:ring focus:ring-green-300");
            $("#create-user").prop("disabled", false);
        } else {
            $("#roleErr").text("Role must be admin or publisher");
            $("#role")
                .removeClass(
                    "border-green-500  focus:ring focus:ring-green-300"
                )
                .addClass("border-red-500  focus:ring focus:ring-red-300");
            $("#create-user").prop("disabled", true);
        }
    });

    $("#create-user").click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You are about to create a new user.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#6366f1",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, create it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#create-form").submit();
            }
        });
    });

    $("#togglePassword").on("click", function () {
        $("#password").attr(
            "type",
            $("#password").attr("type") === "password" ? "text" : "password"
        );
        $(this).toggleClass("fa-eye fa-eye-slash");
    });

    $("#toggleConfirmPassword").on("click", function () {
        $("#password_confirmation").attr(
            "type",
            $("#password_confirmation").attr("type") === "password"
                ? "text"
                : "password"
        );
        $(this).toggleClass("fa-eye fa-eye-slash");
    });
});
