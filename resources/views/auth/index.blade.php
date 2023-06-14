
<!DOCTYPE html>
<html lang="PT-BR" class="light">
<head>
    <meta charset="utf-8">
    <link href="{!! asset('imagens/icone.png') !!}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="José Alves">
        <title>Login - Tili</title>
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />
</head>

    <body class="login">
            <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Logo Legislativa" class="w-60" src="{!! asset('imagens/logo1_white.png') !!}">
{{--                    <img alt="Logo Legislativa" class="w-60" src="{!! asset('imagens/logo_nova.png') !!}">--}}
                </a>
                <div class="my-auto">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10" style="font-size:20px !important;">Tecnologia de Inteligência Legislativa na Indústria</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Acompanhe as principais novidades de todo o trâmite legislativo</div>
                    <div style="position: relative; top:350px;" class="-intro-x text-lg text-white text-opacity-70 dark:text-slate-400"><center>
                        <p class="side-menu__title" style="position: absolute; bottom:40px; left:30px;">Plataforma desenvolvida por
                            <a target="_BLANK" href="https://gaotech.com.br"><img style="max-width:120px" src="{!! asset('imagens/logo-gao-branca.png') !!}"></a></p></center></div>


                </div>
            </div>
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Painel</h2>

                        <div class="intro-x mt-8">
                <form action="{!! route('auth.post') !!}" method="POST">
                    @csrf
                            <input type="email" name="email" class="intro-x login__input form-control py-3 px-4 block" placeholder="Seu E-mail">
                            @error('email')
                                <p style="color: red;
                                margin-top: 10px;
                                margin-left: 5px;" classs="text-danger">{!! $message !!}</p>
                            @enderror
                            <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="*****">
                        </div>
                        @error('password')
                        <p style="color: red;
                        margin-top: 10px;
                        margin-left: 5px;">{!! $message !!}</p>
                        @enderror
                        <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">Lembrar senha</label>
                            </div>
                            <a href="">Esqueceu sua senha?</a>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Entrar</button>
                        </div>
                </form>
                @include('alert')
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
    </body>

</html>
