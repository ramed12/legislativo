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
                                Palavras Chaves
                                </a>
                             </li>
                             <li id="anotacoes-tab" class="nav-item" role="presentation">
                                <a href="javascript:;" class="nav-link py-4" data-tw-target="#anotacoes" aria-selected="false" role="tab">
                                Parecer Técnico
                                </a>
                             </li>
                          </ul>
                          <div class="intro-y tab-content mt-5">
                             <div id="proposicao" class="tab-pane active" role="tabpanel" aria-labelledby="proposicao-tab">
                                <div class="grid grid-cols-12 gap-6">
                                   <div class="intro-y box col-span-12 lg:col-span-12">
                                    <div class="intro-y box mt-5">
                                    <form action="{!! route('palavras.post') !!}" method="POST">
                                        @csrf
                                    <div class="p-5">
                                        <div class="grid grid-cols-12 gap-x-5">
                                            <div class="col-span-12 xl:col-span-12">
                                                <div>
                                                    <label for="update-profile-form-6" class="form-label">Palavras Chaves</label>
                                                    <select name="chave[]" data-placeholder="Selecione o usuário" class="tom-select w-full" multiple>
                                                        @if(!empty($palavrasChaves))
                                                            @foreach ($palavrasChaves as $b)
                                                                <option value="{!! $b !!}" selected>{!! $b !!}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                        <div class="flex justify-end mt-4 ml-4 mb-4">
                                            <button type="submit" class="btn btn-primary w-20 mr-auto">Cadastrar</button>
                                        </div>
                                    </form>
                                    </div>
                                   </div>
                                </div>
                             </div>
                             <div id="anotacoes" class="tab-pane" role="tabpanel" aria-labelledby="anotacoes-tab">
                                <div class="grid grid-cols-12 gap-6">
                                   <div class="intro-y box col-span-12 lg:col-span-12">
                                    <div class="intro-y box mt-5">
                                    <form action="{!! route('parecer.post') !!}" method="POST">
                                        @csrf
                                    <div class="p-5">
                                        <div class="grid grid-cols-12 gap-x-5">
                                            <div class="col-span-12 xl:col-span-6">
                                                <div>
                                                    <label for="update-profile-form-6" class="form-label">Nome do parecer</label>
                                                    <input id="update-profile-form-6" value="{!! old('name') !!}" @error('name') style='border:2px solid red !important'

                                                    @enderror type="text" class="form-control" name="name" placeholder="Nome do parecer">

                                                    @error('name')
                                                        <span class='text-danger'> {!! $message !!} </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-6">
                                                <label for="update-profile-form-6" class="form-label">Status</label>
                                                    <select name="status" data-placeholder="Selecione o usuário" class="tom-select w-full">
                                                     @foreach ( Status() as $b => $c )
                                                     <option value="{!! $b !!}">{!! $c !!}</option>
                                                    @endforeach
                                                    </select>
                                            </div>
                                            <div class="col-span-12 xl:col-span-12 mt-5">
                                                <div>
                                                    <label for="update-profile-form-12" class="form-label">Escolha a cor</label>
                                                    <input id="update-profile-form-12" value="{!! old('name') !!}" type="color" class="form-control" name="color" placeholder="Nome do parecer">

                                                    @error('name')
                                                        <span class='text-danger'> {!! $message !!} </span>
                                                    @enderror

                                                </div>
                                            </div>

                                            </div>
                                        <div class="flex justify-end mt-4">
                                            <button type="submit" class="btn btn-primary w-20 mr-auto">Cadastrar</button>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="p-5" id="small-table">
                                        <div class="preview">
                                            <div class="overflow-x-auto">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th class="whitespace-nowrap">Nome</th>
                                                            <th class="whitespace-nowrap">Usuário Responsável</th>
                                                            <th class="whitespace-nowrap">Situação</th>
                                                            <th class="whitespace-nowrap">Cor</th>
                                                            <th class="whitespace-nowrap">Data de criação</th>
                                                            <th class="whitespace-nowrap">Editar</th>
                                                            <th class="whitespace-nowrap">Remover</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php

                                                        $dadosParecer = [];

                                                        @endphp
                                                        @foreach($parecer as $b)

                                                        @php
                                                            $dadosParecer[] = $b;
                                                        @endphp
                                                            <tr>
                                                                <td>{!! $b->name !!}</td>
                                                                <td>{!! $b->usuario->name !!}</td>
                                                                <td>{!! SetStatus($b->status) !!}</td>
                                                                <td><div style="padding:10px; background:{!! $b->color !!}"{!! $b->color !!}</td>
                                                                <td>{!! date('d/m/Y', strtotime($b->created_at)) !!}</td>
                                                                <td style="position: relative; left:-50px;"><a class="text-center" href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-parecer-{{$b->id}}"><i data-lucide="edit-2" class="block mx-auto"></i></a></td>
                                                                <td style="position: relative; left:-50px;"> <a href=""><i data-lucide="x" class="block mx-auto"></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @if($parecer->isEmpty())
                                                <div class='mt-4 alert alert-warning' role='alert'>Nenhum parecer cadastrado</div>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>

@if(!empty($dadosParecer))
    @foreach($dadosParecer as $b)
        <div id="basic-modal-parecer-{{$b->id}}" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" style="min-height:300px">
                <div class="modal-body p-10 text-center">
                    <div class="">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">Parecer Técnico {!! $b->name !!}</h2>
                            </div>
                            <form action="{!! route('parecer.edit', $b->id) !!}" method="POST">
                                        @csrf
                                    <div class="p-5">
                                        <div class="grid grid-cols-12 gap-x-5">
                                            <div class="col-span-12 xl:col-span-6">
                                                <div>
                                                    <label for="update-profile-form-6" class="form-label">Nome do parecer</label>
                                                    <input id="update-profile-form-6" value="{!! $b->name !!}" @error('name') style='border:2px solid red !important'

                                                    @enderror type="text" class="form-control" name="name" placeholder="Nome do parecer">

                                                    @error('name')
                                                        <span class='text-danger'> {!! $message !!} </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-6">
                                                <label for="update-profile-form-6" class="form-label">Status</label>
                                                    <select name="status" data-placeholder="Selecione o status" class="tom-select w-full">
                                                        @foreach ( Status() as $d => $e )
                                                        <option value="{!! $d !!}" {!! ($b->status == $d) ? 'selected' : null !!}>{!! $e !!}</option>
                                                        @endforeach
                                                    </select>
                                            </div>

                                            <div class="col-span-12 xl:col-span-12 mt-5">
                                                <div>
                                                    <label for="update-profile-form-12" class="form-label">Cor do parecer</label>
                                                    <input id="update-profile-form-12" value="{!! $b->color !!}" type="color" class="form-control" name="color">
                                                </div>
                                            </div>
                                            </div>
                                        <div class="flex justify-end mt-4">
                                            <button type="submit" class="btn btn-primary w-20 mr-auto">Salvar</button>
                                        </div>
                                    </form>
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

