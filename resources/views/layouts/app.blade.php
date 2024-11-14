<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('layouts.navbar')

        <main class="container mt-5">
            @yield('content')
        </main>
    </div>


    {{-- Scripts --}}
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
    <script>
        $(document).ready(function() {


            $('.btn-delete').click(function(event){
                Swal.fire({
                    icon: 'error',
                    title: '¿Está seguro?',
                    text: 'Desea eliminar este registro',
                    showCancelButton: true,
                    cancelButtonColor: '#D0211C',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#2471A3',
                    confirmButtonText: 'Aceptar'
                }).then((result)=>{
                    if(result.value){
                        $(this).parent().submit();
                    }
                });
            });

            $(".btn-add-product").click(function () {
                let info = $(this).data('info');
                $('#load_id').val(info);
                // console.log($('#cargue_id'));
            });

            /* --- */
            $('#qr').change(function(event) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#preview').attr('src', event.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            @if(session('message'))
                Swal.fire({
                    icon: 'success',
                    title: 'Felicitaciones',
                    text: '{{ session('message') }}',
                    confirmButtonColor: '#2471A3',
                    confirmButtonText: 'Aceptar'
                })
            @endif

            @if(session('error'))
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Acceso Denegado',
                    text: '{{ session('error') }}',
                    showConfirmButton:false,
                    timer: 2500
                })
            @endif

            @if(session('message-error'))
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('message-error') }}',
                    showConfirmButton:false,
                    timer: 2500
                })
            @endif

            // Create a QR code reader instance
            const qrReader = new Html5Qrcode("reader");

            // QR reader settings
            const qrConstraints = {
                facingMode: "environment"
            };
            const qrConfig = {
                fps: 10,
                qrbox: {
                    width: 300,
                    height: 300
                }
            };
            const qrOnSuccess = (decodedText, decodedResult) => {
                stopScanner(); // Stop the scanner

                // console.log(`Message: ${decodedText}, Result: ${JSON.stringify(decodedResult)}`);
                // console.log(String(decodedText));
                // console.log(JSON.parse(String(decodedText)).id);
                $("#product_load_id").val(JSON.parse(String(decodedText)).id); // Set the value of the barcode field
                // $("#update_form").trigger("submit"); // Submit form to backend
                $("#start_reader").show();
                $('#formRegisterLoadProduct').submit();
            };

            // Methods: start / stop
            const startScanner = () => {
                $("#reader").show();
                $("#start_reader").hide();
                qrReader.start(
                    qrConstraints,
                    qrConfig,
                    qrOnSuccess,
                ).catch(console.error);
            };

            const stopScanner = () => {
                $("#reader").hide();
                $("#start_reader").show();
                qrReader.stop().catch(console.error);
            };

            // Start scanner on button click
            $(document).on("click", "#start_reader", function() {
                startScanner();
            });

            $(document).on("click", "#close_reader", function() {
                stopScanner();
            });

            // Submit
            // $("#update_form").on("submit", function(evt) {
            //     evt.preventDefault();

            //     $.ajax({
            //         type: "POST",
            //         url: "../my-scanner-script.php",
            //         data: $(this).serialize(),
            //         dataType: "json",
            //         success: function(res) {
            //         console.log(res);
            //         if (res.status === "success") {
            //             // Attempt to start the scanner
            //             startScanner();
            //         }
            //         }
            //     });
            // });





        });
    </script>

</body>

</html>
