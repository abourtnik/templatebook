<!DOCTYPE html>

<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title> Facture n° @yield('title') </title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style -->
    <link href="{{ asset('css/facture.css') }}" rel="stylesheet">

</head>

<body>

<div class="container">

    @yield('content')

</div>

<footer class="text-center">
    <p class="text-muted small">Template Company au capital de 99 euros.</p>
    <p class="text-muted small">La facture a été créée sur un ordinateur elle est donc valable sans la signature et le sceau de l'entreprise.</p>
</footer>



</body>
</html>