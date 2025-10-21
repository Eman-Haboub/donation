@props([
'name'
])

@php

    $class = $name == 'error'? 'danger' : 'success';

@endphp

@if(session()->has($name))
    <div class="alert alert-{{$class}} fade-alert mt-2">
        {{ session($name) }}
    </div>

    <script>
        setTimeout(() => {
            const alertBox = document.querySelector('.fade-alert');
            if (alertBox) {
                alertBox.style.transition = 'opacity 0.5s ease';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500); // remove after fade out
            }
        }, 3000);
    </script>

@endif
