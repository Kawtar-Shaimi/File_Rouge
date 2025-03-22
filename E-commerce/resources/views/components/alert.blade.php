@props(['type', 'message'])

@if ($type === 'error')
    <div class="alert fixed bottom-0 right-5 w-1/5 mx-auto my-10 bg-red-500 text-white font-bold rounded-lg p-3 border border-black hover:border-white transition-colors duration-200">
        {{ $message }}
    </div>
@else
    <div class="alert fixed bottom-0 right-5 w-1/5 mx-auto my-10 bg-green-500 text-white font-bold rounded-lg p-3 border border-black hover:border-white transition-colors duration-200">
        {{ $message }}
    </div>
@endif

<style>
    .alert{
        opacity: 1;
    }
    .alert.hide{
        animation: hide 1s forwards;
    }
    @keyframes hide{
        0%{
            opacity: 1;
        }
        99%{
            opacity: 0;
        }
        100%{
            display: none;
        }
    }
</style>

<script>
    setTimeout(() => {
        document.querySelector('.alert').classList.add('hide');
    }, 3000);
</script>
