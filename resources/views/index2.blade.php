<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Pagina | Inmboliaria</title>
	<!-- <link rel="stylesheet" href="{{ asset('pagina/css/all.css') }}">
	<link rel="stylesheet" href="{{ asset('pagina/css/mdb.min.css') }}">
	<link rel="stylesheet" href="{{ asset('pagina/css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('pagina/css/style.css') }}"> -->
	<link href="{{ asset('css/lib.css') }}" rel="stylesheet">

</head>
<body>
    <div id="pagina">  
		@yield('pagina')
	</div>
	
	<!-- <script src="{{ asset('pagina/js/main.js') }}"></script>
	<script src="{{ asset('pagina/js/mdb.min.js') }}"></script> -->
    <script src="{{ asset('js/pagina.js') }}"></script>
    <script src="{{ asset('js/lib.js') }}"></script>
</body>
</html>