$(document).ready(function() {
    $('#role').on('change', function() {
        var role = $(this).val();
        if (role === 'admin' || role === 'publisher') {
            $('#roleErr').text('');
            $('#role').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#update-user').prop('disabled', false);
        } else {
            $('#roleErr').text('Role must be admin or publisher');
            $('#role').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        }
    });
});
