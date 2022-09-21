<!doctype html>
<html lang="en">
    @include("pages.head")
    <body>
        @include("pages.menu")
        <div class="container">
            @yield("content")
        </div>
        @section('scripts')
            @include('layouts.partials.scripts')
            @yield('scripts-footer')
        @show
        @include('sweetalert::alert')
    </body>
</html>
