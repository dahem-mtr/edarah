<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title> {{ __('admin/main.dashboard') }}
         @hasSection('title')
            - @yield('title')
        @endif
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
</head>

<body class=" {{Cookie::get('dark-mode') ? 'dark-mode' :'' }}">
    @if(!empty($disable_layout))
    @yield('content')
    @else
    @include('admin.components.sidebar')
    <div class="app-wrapper">
        @include('admin.components.navbar')
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if (!Request::is('admin'))
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('admin/main.edarah') }}</a>
                        </li>
                    @endif
                    @yield('breadcrumb')
                </ol>
            </nav>
            <h4 class="page-title">@yield('title')</h4>
            @yield('content')
        </div>
    </div>

   @endif
    @stack('scripts')
</body>

</html>
