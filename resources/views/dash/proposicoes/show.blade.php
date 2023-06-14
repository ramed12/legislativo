@include('includes.header')
<style>

.nav-link.active {
    background:#043c86;
    padding:10px;
    color:#fff;
    border-radius:15px;
}

.nav-link {
    background: #e2e8f0;
    padding:10px;
    border-radius:15px;
    margin-left:10px;
}

.pagination .page-item.active .page-link {
    background-color:#043c86 !important;
    color:#fff !important;
}

.accordion .accordion-item .accordion-header .accordion-button:not(.collapsed)  {
    background:#043c86;
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
                <div class="col-span-12 lg:col-span-4 2xl:col-span-12">
                    <ul role="tablist" class="flex mx-auto rounded-md bg-slate-100 dark:bg-black/20">
                        <li id="proposicao-tab" class="nav-item" role="presentation">
                            <a href="javascript:;" class="nav-link py-4" data-tw-target="#proposicao" aria-selected="false" role="tab">
                            Proposição
                            </a>
                            </li>

                            <li id="anotacoes-tab" class="nav-item" role="presentation">
                                <a href="javascript:;" class="nav-link py-4" data-tw-target="#anotacoes" aria-selected="false" role="tab">
                                Anotações do TILI
                                </a>
                            </li>

                            <li id="parecer-tab" class="nav-item" role="presentation">
                                <a href="javascript:;" class="nav-link py-4" data-tw-target="#parecer" aria-selected="false" role="tab">
                                Parecer da Proposição
                                </a>
                            </li>
                    </ul>


                    <div class="intro-y tab-content mt-5">
                        <div id="proposicao" class="tab-pane active" role="tabpanel" aria-labelledby="proposicao-tab">
                        <div class="grid grid-cols-12 gap-6">
                            @if(!empty($proposicoes->parecer))
                                <div style="
                                    transform:rotate(20deg);
                                    position:absolute;
                                    z-index:99999999999;
                                    top:-20px;

                                    text-align:center;
                                    box-shadow:3px 6px #043c86;
                                    right:0;
                                    padding:15px;
                                    height:auto;
                                    width:auto;
                                    border-radius:50%;
                                    background:#fff">
                                    <small>Posição</small> <BR>
                                    <label style="color: {!! $proposicoes->parecer->parecerCadastrado->color !!}; font-weight:bolder;">{!! $proposicoes->parecer->parecerCadastrado->name !!}</label>
                                </div>
                            @endif
                        <div class="intro-y box col-span-12 lg:col-span-12">
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
                                {{-- <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-proposicoes-{{$proposicoes->id}}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-users-rays"></i> Justificativa</a> --}}
                            </div>
                        </div>
                        <div class="box">
                            <style>
.timeline-steps {
    display: flex;
    justify-content: center;
    flex-wrap: wrap
}

.timeline-steps .timeline-step {
    align-items: center;
    display: flex;
    flex-direction: column;
    position: relative;
    margin: 1rem
}

@media (min-width:768px) {
    .timeline-steps .timeline-step:not(:last-child):after {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 3.46rem;
        position: absolute;
        left: 7.5rem;
        top: .3125rem
    }
    .timeline-steps .timeline-step:not(:first-child):before {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 3.8125rem;
        position: absolute;
        right: 7.5rem;
        top: .3125rem
    }
}

.timeline-steps .timeline-content {
    width: 10rem;
    text-align: center
}

.timeline-steps .timeline-content .inner-circle {
    border-radius: 1.5rem;
    height: 1rem;
    width: 1rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #3b82f6
}

.timeline-steps .timeline-content .inner-circle:before {
    content: "";
    background-color: #3b82f6;
    display: inline-block;
    height: 3rem;
    width: 3rem;
    min-width: 3rem;
    border-radius: 6.25rem;
    opacity: .5
}
                            </style>
                            <div class="container">
                                <div class="row text-center justify-content-center mb-5">
                                    <div class="col-xl-6 col-lg-8">
                                        <h2 class="font-weight-bold">TimeLine da Tramitação</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                                            @foreach ($proposicoes->tramitacoes as $b)
                                                @php
                                                    $v = json_decode($b->dataReg, true)
                                                @endphp
                                                <div class="timeline-step">
                                                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                                                        <div class="inner-circle"></div>
                                                        {{-- <p class="h6 mt-3 mb-1">{!! date('d/m/Y', strtotime($v['date'])) !!}</p> --}}
                                                        <p class="h6 text-muted mb-0 mb-lg-0">{!! $b->descricao !!}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
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
                        </div>
                        </div>



                        <div id="anotacoes" class="tab-pane" role="tabpanel" aria-labelledby="anotacoes-tab">
                            <div class="grid grid-cols-12 gap-6">
                            <div class="intro-y box col-span-12 lg:col-span-12">


                            @if(!$proposicoes->anotacoes->isEmpty())

                                @foreach($proposicoes->anotacoes as $b)
                                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                        <h2 class="font-medium text-base mr-auto"><i class="fa-solid fa-notes"></i> {!! $b->titulo !!}</h2>
                                        {{-- <h2 class="font-medium text-base mr-auto">Por: {!! $b->usuario->name !!} -  {!! date('d/m/Y H:i:s',  strtotime($b->created_at)) !!}</h2> --}}
                                    </div>
                                    <div class="p-5">
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="mr-auto">
                                                    {!! $b->texto !!}

                                                    @if(!is_null($b->arquivo))
                                                    <div class="mt-5" style="background: #043c86; color:#fff; padding:10px; border-radius:5px; font-size:14px;">
                                                        <small><i class="fas fa-file"></i> <a target="_BLANK" href="/arquivos/{!! $b->arquivo !!}"> {!! $b->arquivo !!}</a></small>
                                                    </div>
                                                @endif
                                            </div>

                                            <small>{!! $b->usuario->name !!} -  {!! date('d/m/Y H:i:s',  strtotime($b->created_at)) !!}</small>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            <div class='alert alert-warning' role='alert'>Nenhuma anotação cadastrada</div>
                            @endif
                            </div>
                            </div>
                            <BR>
                            <hr style="height:2px; background:#105fe6 !important;">

                            <div class="mt-5">
                                <form method="POST" action="{!! route('tramitacao.anotacoes', $proposicoes->id_api) !!}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-span-12 xl:col-span-12 mt-5">
                                        <div>
                                            <label for="update-profile-form-12" class="form-label">Titulo da anotação</label>
                                            <input id="update-profile-form-12" type="text" class="form-control" name="titulo" placeholder="Digite aqui o titulo" required>
                                        </div>
                                    </div>
                                <div class="fallback mt-5 mb-4">
                                    <label class="mg" for="formFileLg">Escolher Arquivo</label>
                                    <style>
                                    input[type="file"] {
                                        display: none;
                                    }
                                    label.mg {
                                        padding: 10px;
                                        width: 200px;
                                        background-color: #043c86;
                                        border-radius:15px;
                                        color: #fff;
                                        text-transform: uppercase;
                                        text-align: center;
                                        display: block;
                                        margin-top: 10px;
                                        cursor: pointer;
                                        text-align:center
                                    }

                                    </style>
                                    <input style="background:#043c86; color:#fff; border:none;" multiple name="arquivos" class="form-control form-control-lg" id="formFileLg" type="file">
                                </div>
                                <textarea name="texto" placeholder="Digite aqui....." required>
                                 </textarea>

                                 <div class="col-span-12 card-footer">
                                    <button class="btn btn-primary mt-5"> Inserir</button>
                                </div>
                                </form>
                            </div>
                        </div>




                        <div id="parecer" class="tab-pane" role="tabpanel" aria-labelledby="parecer-tab">

                            @if(!empty($proposicoes->parecer))
                            <div class="mt-5 grid grid-cols-12 gap-12">

                                <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">
                                    <div class="relative zoom-in before:content-[''] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70">
                                        <div class="box p-5">
                                            <div class="flex">
                                            {{-- <i data-lucide="shopping-cart" width="24" height="24" class="stroke-1.5 h-[28px] w-[28px] text-primary h-[28px] w-[28px] text-primary"></i> --}}
                                                <div class="ml-auto">
                                                {{-- <div title="33% Higher than last month" class="tooltip cursor-pointer flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white">33%
                                                <i data-lucide="chevron-up" width="24" height="24" class="stroke-1.5 ml-0.5 h-4 w-4 ml-0.5 h-4 w-4"></i></div> --}}
                                                </div>
                                            </div>
                                        <div class="mt-6 text-3xl font-medium leading-8" style="text-transform:uppercase; color:{!! $proposicoes->parecer->parecerCadastrado->color !!}">{!! $proposicoes->parecer->parecerCadastrado->name !!}</div>
                                        <div class="mt-1 text-base text-slate-500">Posição</div>

                                        <div class="p-5 mb-4">
                                            <div class="flex flex-col sm:flex-row">
                                                <i class="fas fa-envelope"></i> <label style="margin-left:15px;">{!! json_decode($proposicoes->parecer->texto, true) !!}</label>
                                            </div>
                                        </div>
                                            <small style="font-size:13px !important" class="mt-5"><i class="fas fa-user"></i> {!! $proposicoes->parecer->usuarioParecer->name !!} -  {!! date('d/m/Y H:i:s',  strtotime($proposicoes->parecer->created_at)) !!}</small>
                                        </div>
                                    </div>
                                </div>
                                <a href="{!! route('parecer.proposicao.destroy', [$proposicoes->parecer->id, $proposicoes->id_api]) !!}" class="btn btn-danger">Remover Parecer <i class="fas fa-trash-alt"></i></a>
                                @endif
                            <BR>

                                @if(empty($proposicoes->parecer))
                                <hr style="height:2px; background:#105fe6 !important;">
                                <div class="mt-5">
                                    <form method="POST" action="{!! route('parecer.proposicao', $proposicoes->id_api) !!}" enctype="multipart/form-data">
                                        @csrf
                                    <select class="tom-select w-full mb-4" name="id_parecer">
                                        @foreach($parecer as $b)
                                        <option value="{!! $b->id !!}">{!! $b->name !!}</option>
                                        @endforeach
                                    </select>
                                    <textarea name="texto" placeholder="Motivo pelo parecer......." required>

                                    </textarea>

                                    <div class="col-span-12 card-footer">
                                        <button class="btn btn-primary mt-5"> Salvar Parecer</button>
                                    </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



@include('includes.footer')
<!-- END: JS Assets-->
</body>
</html>

