@include('includes.header')
<style>
.pagination .page-item.active .page-link {
    background-color:#105fe6 !important;
    color:#fff !important;
}

.accordion .accordion-item .accordion-header .accordion-button:not(.collapsed)  {
    background:#105fe6;
    color:#fff !important;
    padding:7px;
    border-radius:10px 10px 0px 0px;
}

.accordion .accordion-item .accordion-header .accordion-button {
    background: #e2e8f0;
    padding:7px;
    border-radius:10px 10px 0px 0px;
}


.accordion .accordion-collapse {
    background: #e2e8f0;
    padding:20px;
    border-radius:0px 0px 10px 10px;
    margin-top:0px;
}


.tabless {
    width:100%;
    }

    .tabless caption {
      font-size: 1.3em;
    }

    .tabless thead {
      border: none;
      clip: rect(0 0 0 0);
      height: 1px;
      margin: -1px;
      overflow: hidden;
      padding: 0;
      position: absolute;
      width: 1px;
    }

    .tabless tr {
      display: block;
      margin-bottom: .625em;
    }

    .tabless td {
      border-bottom: 1px solid #ddd;
      display: block;
      padding:15px;
      font-size: 13px;
      text-align: right;
      font-weight:bolder !important;
    }

    .tabless td::before {
      /*
      * aria-label has no advantage, it won't be read inside a table
      content: attr(aria-label);
      */
      content: attr(data-label);
      float: left;
      font-weight: 400;
      text-transform: uppercase;
    }

    .tabless td:last-child {
      border-bottom: 0;
    }

    .tabless {
        padding:10px;
    }



</style>

           <div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-11">


            <div class="max-w-full md:max-w-none rounded-[30px] md:rounded-none px-4 md:px-[22px] min-w-0 min-h-screen bg-slate-100 flex-1 md:pt-20 pb-10 mt-5 md:mt-1 relative dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block">

                @include('alert')


        <div class="mt-3 intro-y col-span-12 md:col-span-6 lg:col-span-4">


            <div class="grid grid-cols-12 gap-6 mt-8">
                <div class="col-span-12 lg:col-span-3 2xl:col-span-2">
                    <!-- BEGIN: Inbox Menu -->
                    <div class="p-5 mt-6 intro-y box bg-primary">
                        <button type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed w-full mt-1 bg-white text-slate-600 dark:border-darkmode-300 dark:bg-darkmode-300 dark:text-slate-300">
                            Posição Favorável
                        </button>

                        <div class="pt-4 mt-4 text-white border-t border-white/10 dark:border-darkmode-400">

                            {{-- <a class="flex items-center px-3 py-2 truncate" href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-anotacoes">
                                <div class="w-2 h-2 mr-3 rounded-full bg-pending"></div>
                                Anotações
                            </a> --}}

                            <a class="flex items-center px-3 py-2 truncate" href="{!! route('tramitacao.anotacoes', $proposicoes->id_api) !!}">
                                <div class="w-2 h-2 mr-3 rounded-full bg-pending"></div>
                                Anotações
                            </a>
                        </div>
                    </div>
                    <!-- END: Inbox Menu -->
                </div>
                <div class="col-span-12 lg:col-span-4 2xl:col-span-10">

                    <div class="box">
                    <div class="text-center lg:text-left p-5">
                        <div><b>{!! $proposicoes->ementa !!}</b></div>
                        <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5">
                            <i data-lucide="mail" class="w-3 h-3 mr-2"></i>{!! $proposicoes->tipo !!}

                            @php
                                $protocoloP = (json_decode($proposicoes->protocoloP))
                            @endphp

                            nº {!! $protocoloP->numero !!}/{!! $protocoloP->ano !!} Dep. <a class='text-primary' href="{!! route('parlamentar.show', $proposicoes->user->nano_id) !!}">{!! $proposicoes->user->name !!}</a> - Proposicão Número: {!! $protocoloP->proposicaoNum !!}
                        </div>
                    </div>
                                </div>
                <Br>
                <center><i style="color:#ddd" class="fa-4x fa-solid fa-arrow-down"></i></center>
                <br>
                <div class="box">
                    <div class="text-center lg:text-left p-5">
                        <div><b>Anotações </b></div>

                        @foreach ($proposicoes->tramitacoes as $b)

                        @php
                            $v = json_decode($b->dataReg, true)
                        @endphp

                        <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5">
                            <i>{!! date('d/m/Y', strtotime($v['date'])) !!}</i> - <b>{!! $b->descricao !!} -  Setor {!! $b->setor !!}</b>
                        </div>
                        @endforeach
                    </div>
                    </div>

                </div>
            </div>


            {{-- <div class="box">
                <div class="text-center lg:text-left p-5">
                    <div><b>{!! $proposicoes->ementa !!}</b></div>
                    <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5">
                        <i data-lucide="mail" class="w-3 h-3 mr-2"></i>{!! $proposicoes->tipo !!}

                        @php
                            $protocoloP = (json_decode($proposicoes->protocoloP))
                        @endphp

                        nº {!! $protocoloP->numero !!}/{!! $protocoloP->ano !!} Dep. <a class='text-primary' href="{!! route('parlamentar.show', $proposicoes->user->nano_id) !!}">{!! $proposicoes->user->name !!}</a> - Proposicão Número: {!! $protocoloP->proposicaoNum !!}
                    </div>
                </div>
                <div class="text-center lg:text-right p-5 border-t border-slate-200/60 dark:border-darkmode-400">

                    @if(!empty($proposicoes->proposicoesSeguidas))

                    @php

                    $user = $proposicoes->proposicoesSeguidas->userSeguido;

                @endphp

                    <a class="btn btn-primary py-1 px-2 mr-2">
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-primary tooltip cursor-pointer" title="Proposição seguida por {!! $user->name !!} no dia  {!! date('d/m/Y H:i:s', strtotime($proposicoes->proposicoesSeguidas->created_at)) !!}">
                                <span style="position: relative; left:-2px;">Informação adicional</span>
                            </div>
                        </div>
                    </a>

                    <a class="btn btn-danger py-1 px-2 mr-2" href="{!! route('unfollow.proposicao', $proposicoes->id_api ) !!}"><i class="fa-solid fa-person-running"></i>Deixar de seguir</a>
                    @else
                    <a class="btn btn-primary py-1 px-2 mr-2" href="{!! route('seguir.proposicao', $proposicoes->id_api ) !!}"><i class="fa-solid fa-person-running"></i> Seguir</a>
                    @endif


                    <a target="_BLANK" download="" href="https://www.al.mt.gov.br/storage/webdisco/cp/{!! $proposicoes->arquivo !!}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-file-pdf"></i> Baixar {!! $proposicoes->tipo !!}</a>
                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-proposicoes-{{$proposicoes->id}}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-users-rays"></i> Justificativa</a>
                </div>
            </div>
        </div>
                <!----><BR>
                <center><i style="color:#ddd" class="fa-4x fa-solid fa-arrow-down"></i></center>

                <div class="mt-3 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                    <div class="box">
                        <div class="text-center lg:text-left p-5">
                            <div><b>TRÂMITAÇÕES</b></div>

                            @foreach ($proposicoes->tramitacoes as $b)

                            @php
                                $v = json_decode($b->dataReg, true)
                            @endphp

                            <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5">
                                <i>{!! date('d/m/Y', strtotime($v['date'])) !!}</i> - <b>{!! $b->descricao !!} -  Setor {!! $b->setor !!}</b>
                            </div>
                            @endforeach
                        </div>
                        </div>
                </div>



                <div> --}}



                    {{-- <div id="basic-modal-anotacoes" class="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-body p-10 text-center">
                                <div class="overflow-x-auto">
                                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                        <h2 class="font-medium text-base mr-auto">Anotações da Proposição xxxxxx</h2></div>

                                </div>
                        </div>
                        </div>
                        </div>
                        </div> --}}




@include('includes.footer')
<!-- END: JS Assets-->
</body>
</html>

