@props([
    'href',
    'active' => '',
])

<li class="nav-item mb-2">

    <a

        href="{{ $href }}"

        class="nav-link text-white

        {{ $active && request()->routeIs($active)

            ? 'bg-primary rounded'

            : ''

        }}"

    >

        {{ $slot }}

    </a>

</li>