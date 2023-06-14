
<!DOCTYPE html>
<html lang="PT-BR" class="light">
<head>
    <meta charset="utf-8">
    <link href="{!! asset('imagens/favicon.png') !!}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="José Alves">
        <title>Página não encontrada</title>
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />

    <style> .intro-x { color:#000 !important }</style>
</head>

<body class="py-5 md:py-0">
    <div class="container">
<!-- BEGIN: Error Page -->
<div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
    <div class="text-white mt-10 lg:mt-0">
        <div class="intro-x text-8xl font-medium">404</div>
        <div class="intro-x text-xl lg:text-3xl font-medium mt-5">Página não encontrada</div>
        <div class="intro-x text-lg mt-3">A página que você acessou não existe ou está em manutenção</div>
        <a href="{{ url()->previous() }} " class="intro-x btn py-3 px-4 text-white border-white dark:border-darkmode-400 dark:text-slate-200 mt-10">Voltar</a>
    </div>
</div>
<!-- END: Error Page -->
</div>
</body>
@include('includes.footer')

</html>
