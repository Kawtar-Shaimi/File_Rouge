export function showAlert(type, message) {
    $('.alert').remove();

    let alertHtml = `
        <div class="alert fixed bottom-0 right-5 w-1/4 mx-auto my-10
                    ${type === 'error' ? 'bg-red-500' : 'bg-green-500'}
                    text-white font-bold rounded-lg p-3 border border-black
                    hover:border-white transition-colors duration-200">
            ${message}
        </div>
    `;

    $('body').append(alertHtml);

    setTimeout(() => {
        $('.alert').addClass('hide');
    }, 3000);
}
