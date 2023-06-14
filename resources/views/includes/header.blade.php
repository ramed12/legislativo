<!DOCTYPE html>

<html lang="pt-br" class="light">
   <head>
      <meta charset="utf-8">
      <link href="{!! asset('imagens/icone.png') !!}" rel="shortcut icon">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="José Alves">
      <title>Tili - Dashboard Legislativo </title>
      <!-- BEGIN: CSS Assets-->
      <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <script src="https://cdn.tiny.cloud/1/p74lc9vtc30rv1bc4xj0ku9uc98fr6u90saf4dh1xd00g1pp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
      <!-- END: CSS Assets-->
   </head>
   <!-- END: Head -->
   <body class="py-5 md:py-0">
      <!-- BEGIN: Mobile Menu -->
        @include('includes.menu-mobile')
      <div class="top-bar-boxed  h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700">
         <div class="h-full flex items-center">
            <a href="" class="logo -intro-x hidden md:flex xl:w-[180px] block">
            <span class="logo__text text-white text-lg ml-3">
            <img title="Logo Fiemt" style="max-width:100px; position: relative; left:-10px;" src="{!! asset('imagens/logo1_white.png') !!}">
            </span>
            </a>

            <style>

                .notifi { position:relative; top:-20px; right:-25px; color:#fff !important; font-size: 17px; }
                .notification { color:#fff !important; top:10px; !important }
                .nav.nav-pills .nav-item .nav-link { background:#ddd; margin-left:10px; }

            </style>

            @include("includes.brand")
            <div class="intro-x dropdown mr-4 sm:mr-6" style="color:#fff !important">
               <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                  <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i> <sup class="notifi">{!! Notificacao()->count() !!}</sup>
               </div>
               <div class="notification-content pt-2 dropdown-menu">
                  <div class="notification-content__box dropdown-content">
                     <div class="notification-content__title">Notificações</div>
                     <div class="cursor-pointer relative flex items-center ">
                        <div class="ml-2 overflow-hidden">
                            @foreach(Notificacao()->get() as $b)
                                <div class="flex items-center">
                                    <a href="{!! route('tramitacao', $b->id_proposicao) !!}" class="font-medium truncate mr-5">{!! $b->name !!}</a>
                                    <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">{!! date('d/m/Y', strtotime($b->created_at)) !!}</div>
                                </div>

                                <div class="flex items-center">
                                    <a href="{!! route('notificacao.lida', $b->id) !!}" style="padding:4px; background:#043c86; color:#fff; border-radius:10px;"> Marcar como lida </a>
                                </div>
                            @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- END: Top Bar -->
      <div class="flex overflow-hidden">
         <!-- BEGIN: Side Menu -->
        @include("includes.menu")
