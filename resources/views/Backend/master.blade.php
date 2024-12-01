<!DOCTYPE html>
<html lang="ar">

@include('Backend.partial.head')

<body>
    <div class="wrapper">
        @include('Backend.partial.sidebar')

        <div class="main-panel">
            @include('Backend.partial.header')

            @yield('content')
        </div>
    </div>
    @include('Backend.partial.scripts')
</body>

</html>
