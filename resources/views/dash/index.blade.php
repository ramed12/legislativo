@include('includes.header')
         <!-- BEGIN: Content -->
         <div class="content">
             @include('alert')
            <div class="grid grid-cols-12 gap-6">
               <div class="col-span-12 2xl:col-span-12">
                  <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->

                {{-- <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Dashboard</h2>
                        <a href="" class="ml-auto flex items-center text-primary">
                            <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">

                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="scale" class="report-box__icon text-warning"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-primary tooltip cursor-pointer" title="Total de propostas pendentes de aprovação pelos parlamentares">
                                            <span style="position: relative; left:-2px;">?</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">Visualizar</div>
                                    <div class="text-base text-slate-500 mt-1">Proposituras por ano</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="scale" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-primary tooltip cursor-pointer" title="Total de Leis que foram aprovadas até o presente momento">
                                                <span style="position: relative; left:-2px;">?</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">xxxx</div>
                                    <div class="text-base text-slate-500 mt-1">Propostas aprovadas</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="calendar" class="report-box__icon text-primary"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-primary tooltip cursor-pointer" title="Aguardar explicação ryan">
                                                <span style="position: relative; left:-2px;">?</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">xxxxx</div>
                                    <div class="text-base text-slate-500 mt-1">Ordem do dia</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="user" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-primary tooltip cursor-pointer" title="Todos os parlamentares ativos">
                                                <span style="position: relative; left:-2px;">?</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{!! route('parlamentar') !!}">
                                        <div class="text-3xl font-medium leading-8 mt-6">18</div>
                                        <div class="text-base text-slate-500 mt-1">Total de Parlamentar</div>
                                    </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div> --}}
                <!-- END: General Report -->
                        <!-- BEGIN: Important Notes -->
                        {{-- <div class="col-span-12 md:col-span-6 xl:col-span-12 mt-3 2xl:mt-8">
                            <div class="intro-x flex items-center h-10">
                               <h2 class="text-lg font-medium truncate mr-auto">Minhas notas</h2>
                               <button data-carousel="important-notes" data-target="prev" class="tiny-slider-navigator btn px-2 border-slate-300 text-slate-600 dark:text-slate-300 mr-2">
                               <i data-lucide="chevron-left" class="w-4 h-4"></i>
                               </button>
                               <button data-carousel="important-notes" data-target="next" class="tiny-slider-navigator btn px-2 border-slate-300 text-slate-600 dark:text-slate-300 mr-2">
                               <i data-lucide="chevron-right" class="w-4 h-4"></i>
                               </button>
                            </div>
                            <div class="mt-5 intro-x">
                               <div class="box zoom-in">
                                  <div class="tiny-slider" id="important-notes">
                                     <div class="p-5">
                                        <div class="text-base font-medium truncate">Processo Emenda</div>
                                        <div class="text-slate-400 mt-1">27/12/2022 17:50</div>
                                        <div class="text-slate-500 text-justify mt-1">Não esquecer a emenda do parlamentar fulano</div>
                                        <div class="font-medium flex mt-5">
                                           <button type="button" class="btn btn-secondary py-1 px-2">Excluir nota</button>

                                        </div>
                                     </div>

                                  </div>
                               </div>
                            </div>
                         </div> --}}

                         <div class="col-span-6 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposituras por ano</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    {!! $proposituras !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposições por posicionamentos</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    {!! $favoravel !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Fases do Projeto</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    {!! $fases !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 intro-y mt-5">
                            <h2 class="text-lg font-medium truncate mr-5 mb-4">Proposições por prioridade</h2>
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    {!! $status !!}
                                </div>
                            </div>
                        </div>

                  </div>
               </div>

            </div>
         </div>
         <!-- END: Content -->
      </div>
      @include('includes.footer')
      <!-- END: JS Assets-->
   </body>
</html>
