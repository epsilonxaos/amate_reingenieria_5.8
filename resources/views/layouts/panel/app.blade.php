<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panel Administrativo para controlar los recursos">
    <meta name="author" content="Locker Agencia">
    <title>Panel</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('panel/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> --}}
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('panel/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('panel/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">

    <link rel="stylesheet" href="{{asset('panel/dropify/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/dropify/css/dropify-multiple.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/alertify/alertify.min.css')}}">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('panel/css/custom.css?v=1.2.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('panel/css/main.css?v=1.2.0')}}" type="text/css">
    <style>
        .breadcrumb {
            padding: 6px 15px
        }
        .breadcrumb a {
            color: inherit !important;
            font-size: 12px;
        }
    </style>
    {{-- <link rel="stylesheet" href="{{asset('css/panel.css')}}"> --}}
    <style>
        .alertify-notifier.ajs-right .ajs-message.ajs-visible {
            padding: 9px 15px;
            color: #fff !important;
            background-color: #2dce89 !important;
        }

        .options-flotting {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 100%;
            z-index: 1;
        }

        .options-flotting .item {
            height: 30px;
            width: 30px;
            margin-left: 5px;
            background-color: white;
            box-shadow: 0px 0px 10px -4px rgba(0, 0, 0, 0.278);
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: .8;
            transition: all .3s ease
        }

        .options-flotting .item:hover {
            opacity: 1;
        }

        .options-flotting .item.delete {
            background-color: crimson;
        }
    </style>
    @stack('link')

</head>

<body>
    @include('includes.panel.sidebar')
    <!-- Main content -->
    <div class="main-content" id="panel">
        @include('includes.panel.navbar')
        @yield('content')
    </div>
    <script>
        const PATH = '{{asset('/')}}';
    </script>
    <script src="{{mix('panel/js/main.js')}}"></script>
    <script src="{{asset('panel/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('panel/dropify/js/dropify-multiple.min.js')}}"></script>
    <script src="{{asset('panel/alertify/alertify.min.js')}}"></script>
    <script src="{{asset('panel/sweetalert/sweetalert.min.js')}}"></script>
    @stack('js')
    <script>
        function deleteSubmitForm(id){
            swal({
                title: "¿Finalizar eliminación?",
                icon: "warning",
                buttons: ["Cancelar", "Eliminar"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    alertify.alert('Espere un momento porfavor...').set({'frameless': true, 'closable': false, 'movable': false});
                    document.querySelector('.delete-form-'+id).submit();
                }
            });
        }
    </script>
</body>

</html>