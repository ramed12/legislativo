@include('includes.header')
<style>
.pagination .page-item.active .page-link {
    background-color:#4796e9 !important;
    color:#fff !important;
}

.accordion .accordion-item .accordion-header .accordion-button:not(.collapsed)  {
    background:#4796e9;
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
                <div class="flex items-center mt-8 intro-y">
                   <h2 class="mr-auto text-lg font-medium">Perfil <b style="border-bottom:2px solid #105fe6">{!! $parlamentar->name !!}</b></h2>
                </div>
                <!---->
                <div>
                   <div class="px-5 pt-5 mt-5 intro-y box">
                      <div class="flex flex-col pb-5 -mx-5 border-b lg:flex-row border-slate-200/60 dark:border-darkmode-400">
                         <div class="flex items-center justify-center flex-1 px-5 lg:justify-start">
                            <div class="relative flex-none w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 image-fit">
                               <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{!! (!empty($parlamentar->fotografia) ? $parlamentar->fotografia : 'https://argumentumpericias.com.br/biblioteca/2019/09/sem-imagem-avatar.png') !!}">

                            </div>
                            <div class="ml-5">
                               <div class="w-24 text-lg font-medium truncate sm:w-40 sm:whitespace-normal">{!! $parlamentar->name !!}</div>
                               <div class="text-slate-500">
                                @foreach($parlamentar->filiacoes as $key => $value)
                                    @php
                                        $partido =  json_decode($value->partido, true);
                                        echo $partido['sigla']. "<br>";
                                    @endphp
                                @endforeach
                                {!! ($parlamentar->status == "inativo") ? "<label style='position:relative; top:5px;' class='text-danger'> INATIVO </label>" : "<label class='text-dark'> Ativo </label>" !!} <BR><BR>

                                    Proposições Seguidas: {!! !empty($propoSeguidas) ? $propoSeguidas: 0 !!}

                               </div>
                            </div>
                         </div>
                         <div class="flex-1 px-5 pt-5 mt-6 border-t border-l border-r lg:mt-0 border-slate-200/60 dark:border-darkmode-400 lg:border-t-0 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-3"> Midias sociais </div>
                            @php
                             $instagram = [];
                             $twitter = [];
                             $facebook = [];
                            @endphp
                            @foreach($parlamentar->midias as $key => $value)
                            @php
                                $midias = json_decode($value->midias, true);
                                $instagram[] = $midias['instagram'];
                                $youtube = $midias['youtube'];
                                $facebook[] = $midias['facebook'];
                                $twitter[]  = $midias['twitter'];
                            @endphp
                        @endforeach

                            <div class="flex flex-col items-center justify-center mt-4 lg:items-start">
                               <div class="flex items-center truncate sm:whitespace-normal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-1.5 block mx-auto"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                {!! (!empty($facebook[0]) ? $facebook[0] : "Não declarou")  !!}
                               </div>
                               <div class="flex items-center mt-3 truncate sm:whitespace-normal">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-1.5 w-4 h-4 mr-2">
                                     <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                     <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                     <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                  </svg>
                                  {!! (!empty($instagram[0]) ? $instagram[0] : "Não declarou")  !!}
                               </div>
                               <div class="flex items-center mt-3 truncate sm:whitespace-normal">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-1.5 w-4 h-4 mr-2">
                                     <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                                  </svg>
                                  {!! (!empty($twitter[0]) ? $twitter[0] : "Não declarou")  !!}
                               </div>
                            </div>
                         </div>
                         <div class="flex-1 px-5 pt-5 mt-6 border-t lg:mt-0 lg:border-0 border-slate-200/60 dark:border-darkmode-400 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-5"> Contato disponível </div>
                                <div class=" mt-3 truncate sm:whitespace-normal">
                                @foreach($parlamentar->contato as $key)
                                 {!! ($key->tipo == "fixo") ? "Telefone" : "E-mail"  !!}: <span class="ml-3 font-medium text-success">{{ $key->valor }}</span> <BR>
                               @endforeach
                            </div>
                         </div>
                      </div>
                      <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
                        <li id="dashboard-tab" class="nav-item" role="presentation">
                        <a href="javascript:;" class="nav-link py-4 active" data-tw-target="#dashboard" aria-controls="dashboard" aria-selected="true" role="tab">
                        Início
                        </a>
                        </li>
                        <li id="adicionais-tab" class="nav-item" role="presentation">
                            <a href="javascript:;" class="nav-link py-4" data-tw-target="#adicionais    " aria-selected="false" role="tab">
                            Informações Adicionais
                            </a>
                        </li>
                        <li id="account-and-profile-tab" class="nav-item" role="presentation">
                        <a href="javascript:;" class="nav-link py-4" data-tw-target="#account-and-profile" aria-selected="false" role="tab">
                        Mandatos
                        </a>
                        </li>
                        <li id="proposicoes-tab" class="nav-item" role="presentation">
                        <a href="javascript:;" class="nav-link py-4" data-tw-target="#proposicoes" aria-selected="false" role="tab">
                        Proposições
                        </a>
                        </li>

                        <li id="licenca-tab" class="nav-item" role="licenca">
                            <a href="javascript:;" class="nav-link py-4" data-tw-target="#licenca" aria-selected="false" role="tab">
                            Licenças
                            </a>
                        </li>

                        <li id="anotacoes-tab" class="nav-item" role="presentation">
                            <a href="javascript:;" class="nav-link py-4" data-tw-target="#anotacoes" aria-selected="false" role="tab">
                            Anotações do TILI
                            </a>
                        </li>
                        </ul>
                   </div>
    <div class="intro-y tab-content mt-5">
    <div id="dashboard" class="tab-pane active" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="grid grid-cols-12 gap-6">
    <div class="intro-y box col-span-12 lg:col-span-12">
    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
    <h2 class="font-medium text-base mr-auto">Bibiografia do Deputado(a)</h2>
    </div>
    <div class="p-5">
    <div class="flex flex-col sm:flex-row">
    <div class="mr-auto">
    {!! $parlamentar->biografia !!}
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>



    <div id="adicionais" class="tab-pane" role="tabpanel" aria-labelledby="adicionais-tab">
        <div class="grid grid-cols-12 gap-6">
        <div class="intro-y box col-span-12 lg:col-span-12">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Informações adicionais do deputado</h2>
        </div>
        <div class="p-5">
        <div class="flex flex-col sm:flex-row">
        <div class="mr-auto">
            <form method="POST" action="{!! route('parlamentar.perfil', $parlamentar->nano_id) !!}">
                @csrf
            <textarea name="perfil">
                {!! !is_null($parlamentar->perfil) ? $parlamentar->perfil : ''  !!}
             </textarea>
             <div class="col-span-12 card-footer">
                <button class="btn btn-primary mt-5"> Inserir</button>
            </div>
            </form>

        </div>
        </div>
        </div>
        </div>
        </div>
        </div>



    <div id="proposicoes" class="tab-pane" role="tabpanel" aria-labelledby="proposicoes-tab">
        <div class="grid grid-cols-12 gap-6">
        <div class="intro-y box col-span-12 lg:col-span-12">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Proposições do Deputado</h2>
        </div>

        {!! Form::model(Request::input(), ['method' => 'get', 'autocomplete' => 'off', 'route' => ['parlamentar', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate']) !!}
        <div id="vertical-form" class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-12">
                        <div>
                            <label for="update-profile-form-6" class="form-label">Palavras Chaves</label>
                            <input id="update-profile-form-6" type="text" class="form-control">
                        </div>
                    </div>
                    {{-- <div class="col-span-12 xl:col-span-6">
                        <label for="update-profile-form-6" class="form-label">Grupo de usuário</label>
                                {!!Form::select('grupo', $group, null, ['class' => 'tom-select w-full',  'required'])!!}
                        </select>
                    </div> --}}
                </div>
                <div class="col-span-12 card-footer">
                    <button class="btn btn-primary mt-5"><i data-lucide="search" class="block mx-auto"></i> Buscar</button>
                </div>

            </div>
        </form>
        </div>
        </div>

        @php

            $dadosProposicoes = [];
            $tramitacoesProposicoes = [];

        @endphp
        @foreach ($parlamentar->proposicoes as $prop )

        @php
            $dadosProposicoes[] = $prop;
            $tramitacoesProposicoes[] = $prop->tramitacoes;
        @endphp

        <center>
                </center>
        <div class="mt-3 intro-y col-span-12 md:col-span-6 lg:col-span-4">
            <div class="box">
                <div class="text-center lg:text-left p-5">
                    <div>{!! $prop->ementa !!}</div>
                    <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5">
                        <i data-lucide="mail" class="w-3 h-3 mr-2"></i>{!! $prop->tipo !!}

                        @php
                            $protocoloP = (json_decode($prop->protocoloP))
                        @endphp

                        nº {!! $protocoloP->numero !!}/{!! $protocoloP->ano !!} Dep. {!! $prop->user->name !!} - Proposicão Número: {!! $protocoloP->proposicaoNum !!}
                    </div>
                </div>
                <div class="text-center lg:text-right p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    {{-- <button class="btn btn-primary py-1 px-2 mr-2"><i class="fa-solid fa-person-running"></i> Seguir</button> --}}


                    @if(!empty($prop->proposicoesSeguidas))

                    @php
                        $user = $prop->proposicoesSeguidas->userSeguido;
                    @endphp

                    <a class="btn btn-primary py-1 px-2 mr-2">
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-primary tooltip cursor-pointer" title="Proposição seguida por {!! $user->name !!} no dia  {!! date('d/m/Y H:i:s', strtotime($prop->proposicoesSeguidas->created_at)) !!}">
                                <span style="position: relative; left:-2px;">Informação adicional</span>
                            </div>
                        </div>
                    </a>

                    <a class="btn btn-danger py-1 px-2 mr-2" href="{!! route('unfollow.proposicao', $prop->id_api ) !!}?type=1&parlamentar={!! $parlamentar->nano_id !!}"><i class="fa-solid fa-person-running"></i>Deixar de seguir</a>
                    @else
                    <a class="btn btn-primary py-1 px-2 mr-2" href="{!! route('seguir.proposicao', $prop->id_api ) !!}?type=1&parlamentar={!! $parlamentar->nano_id !!}"><i class="fa-solid fa-person-running"></i> Seguir</a>
                    @endif




                    <a href="{!! route('tramitacao', $prop->id_api) !!}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-eye"></i> Veja a tramitação</a>
                    <a target="_BLANK" download="" href="https://www.al.mt.gov.br/storage/webdisco/cp/{!! $prop->arquivo !!}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-file-pdf"></i> Baixar {!! $prop->tipo !!}</a>
                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-proposicoes-{{$prop->id}}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-users-rays"></i> Justificativa</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="mt-5">
            {!! $parlamentar->proposicoes->links() !!}
        </div>

        </div>

    <!-- -->


    <div id="account-and-profile" class="tab-pane" role="tabpanel" aria-labelledby="account-and-profile-tab">
        <div class="grid grid-cols-12 gap-6">
        <div class="intro-y box col-span-12 lg:col-span-12">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Mandatos do Deputado (a)</h2>
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="box">
            <div id="faq-accordion-1" class="accordion p-5">
            @php
             $vars = 1
             @endphp
            @foreach($parlamentar->mandatos as $row)
                <div class="accordion-item">
                    <div id="faq-accordion-content-{{$vars}}" class="accordion-header">
                        <button style="font-size:17px !important    " class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-{{$vars}}" aria-expanded="true" aria-controls="faq-accordion-collapse-{{$vars}}">
                        {!! date('d-m-Y' ,strtotime($row['inicio'])) !!} - {!!date('d-m-Y' ,strtotime($row['fim'])) !!}   -  Votos {!! $row->votos !!}
                        </button>
                    </div>
                    <div id="faq-accordion-collapse-{{$vars}}" class="accordion-collapse collapse {!!  ($vars ==1) ? 'show' : null !!}" aria-labelledby="faq-accordion-content-{{$vars}}" data-tw-parent="#faq-accordion-1">
                        <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                        </div>
                    </div>
                </div>
                @php $vars++ @endphp
            @endforeach
            </div>
            </div>
        </div>
        </div>
        </div>
    </div>



    <div id="licenca" class="tab-pane" role="tabpanel" aria-labelledby="licenca-tab">
        <div class="grid grid-cols-12 gap-6">
        <div class="intro-y box col-span-12 lg:col-span-12">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Licenças do deputado</h2>
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">


            @if(!$parlamentar->licencas->isEmpty())
            <div class="overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Motivo</th>
                            <th class="whitespace-nowrap">Publicado em</th>
                            <th class="whitespace-nowrap">Situação</th>
                            <th class="whitespace-nowrap">+ Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dados = [];
                        @endphp
                        @foreach($parlamentar->licencas as $row)

                            @php
                                $dados[] = [$row];
                            @endphp
                            <tr>
                                <td>{!! $row->id !!}</td>
                                <td>{!! $row->motivo !!}</td>
                                <td>{!! date('d/m/Y', strtotime($row->diario_oficial))!!}</td>
                                <td>Inativo</td>
                                <td><a href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-preview-{{$row->id}}" class="btn btn-primary">(+)</a>                                </td>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5 mb-5" style="">
                    {!! $parlamentar->licencas->links() !!}
                </div>
            </div>
            @else
                <div class='alert alert-warning' role='alert'>Nenhuma licença encontrada</div>
            @endif

        </div>
        </div>
        </div>
    </div>

    <!-- -->


    <div id="anotacoes" class="tab-pane" role="tabpanel" aria-labelledby="anotacoes-tab">
    <div class="grid grid-cols-12 gap-6">
    <div class="intro-y box col-span-12 lg:col-span-12">
    <div class="mr-auto">

        <div class="post__content tab-content">
            <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">

            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">

            <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i>Anotações sobre o deputado
            </div>
            <div class="mt-5">
                <form method="POST" action="{!! route('anotacoes.post', $parlamentar->nano_id) !!}">
                    @csrf
                <textarea name="texto" placeholder="Digite aqui.....">

                 </textarea>
                 <div class="col-span-12 card-footer">
                    <button class="btn btn-primary mt-5"> Inserir</button>
                </div>
                </form>
            </div>
            </div>

            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="box">
                    @foreach($parlamentar->anotacoesS as $row)
                    @if(!is_null($row->id_proposicao))
                        @continue
                    @endif
                        <div id="faq-accordion-1" class="accordion p-5">
                            <div class="accordion-item">
                                <div id="faq-accordion-content-1" class="accordion-header">
                                    <button style="font-size:17px !important" class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                                    Anotação Nº {!! $row->id !!}  <label style="float:right">Usuário: {!! $row->usuario->name !!} - {!! date('d/m/Y', strtotime($row->created_at)) !!}</label>
                                    </button>
                                </div>
                                <div id="faq-accordion-collapse-1" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-1" data-tw-parent="#faq-accordion-1">
                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                        {!! $row->texto !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
                <BR>
                @if($parlamentar->anotacoesS->isEmpty())
                            <div class='alert alert-warning' role='alert'> Nenhuma anotação encontrada para o deputado</div>
                @endif
                </div>
            </div>
    </div>
    </div>
    </div>
    </div>

</div>
        <!-- END: Content -->
</div>



<!-- DADOS DA LICENÇA MODAL -->

@if(!empty($dados))
@foreach($dados as $b)

    @foreach($b as $key)

    @php
    $conteudo = json_decode($key['concessao'], true);
    @endphp

    <div id="basic-modal-preview-{{$key->id}}" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-body p-10 text-center">
                <div class="overflow-x-auto">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Concessão</h2>
                        </div>
                    <table class="tabless">
                        <tbody>
                                <tr>
                                    @if(!empty($conteudo['sessao_plenaria']))
                                        <td data-label="Numero">{!! $conteudo['numero'] !!}</td>
                                        <td data-label="Ata"><a download href="{!! $conteudo['sessao_plenaria']['ata'] !!}" target="_BLANK">
                                            Visualizar <svg style='float:right' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text block mx-auto"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>
                                                <line x1="10" y1="9" x2="8" y2="9"></line>
                                            </svg>
                                        </a></td>
                                        <td data-label="Tipo">{!! $conteudo['sessao_plenaria']['tipo'] !!}</td>
                                        <td data-label="Data de Inicio">{!! date('d/m/Y H:i:s', strtotime($conteudo['sessao_plenaria']['inicio'])) !!}</td>
                                        <td data-label="Data Final">{!! date('d/m/Y H:i:s', strtotime($conteudo['sessao_plenaria']['fim'])) !!}</td>
                                        <td data-label="Número">{!! $conteudo['sessao_plenaria']['numero'] !!}</td>
                                    @endif
                                </tr>
                        </tbody>
                    </table>
                </div>
        </div>
        </div>
        </div>
        </div>
    @endforeach
@endforeach
@endif




<!-- MODAL JUSTIFICATIVA DAS PROPOSICOES -->
@if(!empty($dadosProposicoes))
@foreach($dadosProposicoes as $b)

    <div id="basic-modal-proposicoes-{{$b->id}}" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-body p-10 text-center">
                <div class="overflow-x-auto">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Justificativa da {!! $b->tipo !!}</h2>
                        </div>
                        {!! str_replace('\\', '', $b->justificativa) !!}
                </div>
        </div>
        </div>
        </div>
        </div>
@endforeach
@endif

@include('includes.footer')
<!-- END: JS Assets-->
</body>
</html>

