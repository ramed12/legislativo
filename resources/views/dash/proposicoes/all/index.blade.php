@include('includes.header')
<style>
.pagination .page-item.active .page-link {
    background-color:#105fe6 !important;
    color:#fff !important;
}
</style>

           <div class="content">


            @include('alert')
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-11">


            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Todas as proposições</h2>
                    </div>
                    {!! Form::model(Request::input(), ['method' => 'get', 'autocomplete' => 'off', 'route' => ['proposicoes.all', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate']) !!}
                    <div id="vertical-form" class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12">
                                    <div>
                                        <label for="update-profile-form-6" class="form-label">Palavra chave</label>
                                        <select name="ementa[]" data-placeholder="Selecione o usuário" class="tom-select w-full" multiple>
                                            @if(!empty($palavrasChaves))
                                                @foreach ($palavrasChaves as $b)
                                                    <option value="{!! $b !!}" selected>{!! $b !!}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 card-footer">
                                <button class="btn btn-primary mt-5"><i data-lucide="search" class="block mx-auto"></i> Buscar</button>
                            </div>

                        </div>
                    </form>

                </div>

                @if(!$props->isEmpty())
                @foreach ($props as $prop )
            <div class="mt-3 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                @if(!empty($prop->parecer))
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
                    <label style="color: {!! $prop->parecer->parecerCadastrado->color !!}; font-weight:bolder;">{!! $prop->parecer->parecerCadastrado->name !!}</label>
                </div>
            @endif
                <div class="box">
                    <div class="text-center lg:text-left p-5">

                        <div>{!! $prop->ementa !!}</div>
                        <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5">
                            <i data-lucide="mail" class="w-3 h-3 mr-2"></i>{!! $prop->tipo !!}

                            @php
                                $protocoloP = (json_decode($prop->protocoloP))
                            @endphp

                            nº {!! $protocoloP->numero !!}/{!! $protocoloP->ano !!} Dep. {!! $prop->user->name !!} - Proposicão Número: {!! $protocoloP->proposicaoNum !!}

                        <BR>

                            <div class="pull-left" style="position: absolute; bottom: 10px;">
                            @php

                            foreach($prop->propPalavras as $b){
                                $string = "$prop->ementa";
                                $search = "$b->palavra";
                                $found = FindString($string, $search);

                                if($found) {
                                    foreach($found as $pos) {
                                    echo "<button class='transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 dark:bg-darkmode-400 dark:text-slate-300 [&amp;:hover:not(:disabled)]:bg-slate-100 [&amp;:hover:not(:disabled)]:border-slate-100 [&amp;:hover:not(:disabled)]:dark:border-darkmode-300/80 [&amp;:hover:not(:disabled)]:dark:bg-darkmode-300/80 mb-2 mr-1 w-24'>$search</button>";
                                    }
                                }
                            }

                          @endphp




                            </div>

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

                        <a class="btn btn-danger py-1 px-2 mr-2" href="{!! route('unfollow.proposicao', $prop->id_api ) !!}?type=3&parlamentar={!! $prop->user->nano_id !!}"><i class="fa-solid fa-person-running"></i>Deixar de seguir</a>
                        @else
                        <a class="btn btn-primary py-1 px-2 mr-2" href="{!! route('seguir.proposicao', $prop->id_api ) !!}?type=3&parlamentar={!! $prop->user->nano_id !!}"><i class="fa-solid fa-person-running"></i> Seguir</a>
                        @endif




                        <a href="{!! route('tramitacao', $prop->id_api) !!}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-eye"></i> Veja a tramitação</a>
                        <a target="_BLANK" download="" href="https://www.al.mt.gov.br/storage/webdisco/cp/{!! $prop->arquivo !!}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-file-pdf"></i> Baixar {!! $prop->tipo !!}</a>
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-proposicoes-{{$prop->id}}" class="btn btn-outline-secondary py-1 px-2"><i class="fa-solid fa-users-rays"></i> Justificativa</a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="alert alert-warning mt-5" role="alert"> Nenhuma proposição encontrada </div>
            @endif
            <div class="mt-5">
                {!! $props->links() !!}
            </div>

            {{-- Truncate na tabela para limpar as buscar do sistema --}}
            {!! DB::table('palavras_chaves_busca')->truncate() !!}


        </div>

        <div class="col-span-12 mt-8">

        </div>
    </div>

</div>
        <!-- END: Content -->
</div>
@include('includes.footer')
<!-- END: JS Assets-->
</body>
</html>

