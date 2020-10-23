<!DOCTYPE html>
<html>
<head>
    <title>Kelas Online</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('images/logo_small.ico') }}" type="image/x-icon">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    @livewireStyles
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="mt-5 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="/images/logo.png" width="150px"  alt="Logo SMA Negeri 3 Pekalongan">
                            <br><br>
                            <h3><b>Kelas Online</b></h3>
                        </div>
                        @livewire('login')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
