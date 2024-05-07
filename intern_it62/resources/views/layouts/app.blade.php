<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin RiverCrane</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    @include('layouts.styles')

    @include('layouts.scripts')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            @include('layouts.nav')

            @include('layouts.sidebar')

            <div class="main-content">
                <section class="section">
                    <div class="section-header justify-content-between">
                        <h1>@yield('heading')</h1>
                        @yield('button')
                    </div>
                    @yield('main-content')

                </section>
            </div>

        </div>
    </div>

    @include('layouts.scripts_footer')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif

    @if (session()->get('error'))
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ session() -> get('error') }}'
            });
        </script>
    @endif

    @if (session()->get('success'))
        <script>
            iziToast.success({
                title: '',
                position: 'topRight',
                message: '{{ session() -> get('success') }}'
            });
        </script>
    @endif
</body>

</html>
