<!DOCTYPE html>

<html lang="pt-br" class="light">
   <head>
      <meta charset="utf-8">
      <link href="{!! asset('imagens/favicon.png') !!}" rel="shortcut icon">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="José Alves">
      <title>FIEMT - Dashboard Legislativo </title>
      <!-- BEGIN: CSS Assets-->
      <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />
      <style>
        #proposituras_status, #proposituras_interesse {width:320px !important; height:300px !important;}
        .quadrado1 {  border:2px solid rgba(0,0,0,.2); padding:10px; }
        .quadrado1 input { padding:10px; margin-top:5px; background: #005cad; }
        .quadrado1 label { font-size:15px; margin-top:10px; }
        .quadrado1 input, label { position: relative; top:-10px; }
        .quadrado1 h4 { font-weight: 600 }
        .qd { height: 120px !important }
      </style>
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
            <img title="Logo Fiemt" style="min-width:200px; position: relative; left:-10px;" src="{!! asset('imagens/logo_nova.png') !!}">
            </span>
            </a>
            @include("includes.brand")
            <div class="intro-x dropdown mr-4 sm:mr-6">
               <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                  <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i>
               </div>
               <div class="notification-content pt-2 dropdown-menu">
                  <div class="notification-content__box dropdown-content">
                     <div class="notification-content__title">Notificações</div>
                     <div class="cursor-pointer relative flex items-center ">
                        <div class="ml-2 overflow-hidden">
                           <div class="flex items-center">
                              <a href="javascript:;" class="font-medium truncate mr-5">Nova proposta aprovada</a>
                              <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">13/12/2022 08:20</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="flex overflow-hidden">
        @include("includes.menu")
         <div class="content">
            <div class="grid grid-cols-12 gap-6">
               <div class="col-span-12 2xl:col-span-12">
                <ul style="margin-top:40px;" class="
                nav
                nav-pills
                w-3/4
                2xl:w-4/6
                bg-slate-200
                dark:bg-black/10
                rounded-md
                mx-auto
                p-1
                mt-5
            " role="tablist">
            <li id="active-users-tab" class="nav-item flex-1" role="presentation">
                <button class="nav-link w-full py-1.5 px-2 active" data-tw-toggle="pill" data-tw-target="#active-users" type="button" role="tab" aria-controls="active-users" aria-selected="true">
                    Assembleia Legislativa
                </button>
            </li>
            <li id="inactive-users-tab" class="nav-item flex-1" role="presentation">
                <button class="nav-link w-full py-1.5 px-2" data-tw-toggle="pill" data-tw-target="#inactive-users" type="button" role="tab" aria-selected="false">
                    Diário Oficial
                </button>
            </li>
        </ul>
                  <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="grid grid-cols-12 gap-6 mt-5 mb-4">

                        <div class="col-span-3 quadrado1">
                            <h4 class="font-light truncate mr-5 mb-4">Proposituras por ano</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Projeto de Emenda Constitucional
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                  Projeto de lei
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                <label class="form-check-label" for="flexCheckChecked2">
                                  Projeto de lei complementar
                                </label>
                              </div>
                        </div>

                        <div class="col-span-2 quadrado1">
                            <h4 class="font-light truncate mr-5 mb-4">Interesse</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Interesse Geral
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                  Interesse Setorial
                                </label>
                              </div>
                        </div>

                        <div class="col-span-2 quadrado1">
                            <h4 class="font-light truncate mr-5 mb-4">Partido do Autor</h4>
                            <select class="form-control">
                                <option>Todos</option>
                                <option>Cidadania</option>
                                <option>DC</option>
                                <option>DEM</option>
                            </select>
                        </div>

                        <div class="col-span-2 quadrado1">
                            <h4 class="font-light truncate mr-5 mb-4">Autor</h4>
                            <select class="form-control">
                                <option>Todos</option>
                                <option>José Alves</option>
                                <option>Ryan Oliveira</option>
                                <option>Natan</option>
                            </select>
                        </div>

                        <div class="col-span-3 quadrado1">
                            <h4 class="font-light truncate mr-5 mb-4">Assunto</h4>
                            <select class="form-control">
                                <option>Todos</option>
                                <option>Ácido Bórico</option>
                                <option>Agenda 2030</option>
                                <option>Agrotóxicos</option>
                            </select>
                        </div>

                        <div class="col-span-3 quadrado1">
                            <h4 class="font-light truncate mr-5 mb-4">Fases do Projeto</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Comissão de mérito
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                  1º Votação
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                <label class="form-check-label" for="flexCheckChecked2">
                                 CCJ
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                <label class="form-check-label" for="flexCheckChecked2">
                                 2ª Votação
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                <label class="form-check-label" for="flexCheckChecked2">
                                 Sem Votação
                                </label>
                              </div>
                        </div>

                        <div class="col-span-2 quadrado1">
                            <h4 class="font-light truncate mr-5 mb-4">Ano</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  2022
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                  2021
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                <label class="form-check-label" for="flexCheckChecked2">
                                 2020
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                <label class="form-check-label" for="flexCheckChecked2">
                                 2019
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                <label class="form-check-label" for="flexCheckChecked2">
                                 2018
                                </label>
                              </div>
                        </div>

                        <div class="col-span-2 quadrado1 qd">
                            <h4 class="font-light truncate mr-5 mb-4">Status</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Em Tramitação
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                  Encerrada
                                </label>
                              </div>
                        </div>

                        <div class="col-span-3 quadrado1 qd">
                            <h4 class="font-light truncate mr-5 mb-4">Sindicato</h4>
                            <select class="form-control">
                                <option>Todos</option>
                            </select>
                        </div>
                    </div>

                    <hr/>

                    <ul class="nav nav-pills mb-3 d-flex justify-content-center mt-4" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a
                            class="nav-link active"
                            id="ex1-tab-1"
                            data-bs-toggle="pill"
                            href="#ex1-pills-1"
                            role="tab"
                            aria-controls="ex1-pills-1"
                            aria-selected="true"
                            >Gráfico</a
                          >
                        </li>
                        <li class="nav-item" role="presentation">
                          <a
                            class="nav-link"
                            id="ex1-tab-2"
                            data-bs-toggle="pill"
                            href="#ex1-pills-2"
                            role="tab"
                            aria-controls="ex1-pills-2"
                            aria-selected="false"
                            >Analítico</a
                          >
                        </li>

                      </ul>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-6 intro-y">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposituras por ano</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    {!! $bar !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 intro-y">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposituras por Prioridade</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    {!! $prioridade !!}
                                </div>
                            </div>
                        </div>


                        <div class="col-span-3 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposituras por status</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    {!! $status !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-span-5 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposituras por tipo</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    {!! $tipo !!}
                                </div>
                            </div>
                        </div>


                        <div class="col-span-4 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposituras por interesse</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <center>{!! $interesse !!}</center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">

                        <div class="col-span-6 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Fases do Projeto</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <center>{!! $fases !!}</center>
                                </div>
                            </div>
                        </div>


                        <div class="col-span-6 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposituras por posicionamentos</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <center>{!! $proposituras !!}</center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  </div>
               </div>

            </div>
         </div>
         <!-- END: Content -->
      </div>
      <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcUcow5QHjitBVOfkTdy44l7jnaoFzW1k&libraries=places"></script>
      @include('includes.footer')
      <!-- END: JS Assets-->
   </body>
</html>
