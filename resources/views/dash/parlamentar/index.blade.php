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
                        <h2 class="font-medium text-base mr-auto">Digite o nome do parlamentar</h2>
                    </div>
                    {!! Form::model(Request::input(), ['method' => 'get', 'autocomplete' => 'off', 'route' => ['parlamentar', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate']) !!}
                    <div id="vertical-form" class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12">
                                    <div>
                                        <label for="update-profile-form-6" class="form-label">Palavra chave</label>
                                        <input id="update-profile-form-6" type="text" class="form-control" name="name">
                                    </div>
                                    <div>
                                        <label for="update-profile-form-6" class="form-label">Status</label>
                                        <select class="tom-select w-full" name="status">
                                                <option>Ativo</option>
                                                <option>inativo</option>
                                                <option>Licenciados</option>
                                        </select>
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


            {{-- <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                    <h2 class="font-medium text-base mr-auto"><i data-lucide="users" class="block mx-auto"></i></h2>
                    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                        <button class="btn btn-primary"> + NOVO </button>
                    </div>
                </div>
                <div class="p-5" id="small-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            @if (!$user->isEmpty())
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">Nome</th>
                                        <th class="whitespace-nowrap">Grupo vinculado</th>
                                        <th class="whitespace-nowrap">Editar</th>
                                        <th class="whitespace-nowrap">Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $user as $row)
                                        <tr>
                                            <td>{!! $row->name !!}</td>
                                            <td>{!! GrupoUser($row->id) !!}</td>
                                            <td style=""><a class="text-center" href="{!! route('grupo.update', $row->id) !!}"><i data-lucide="edit-2"></i></a></td>
                                            <td style=""> <a href=""><i data-lucide="x"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning" style="color:#fff !important"> Nenhum usuario cadastrado </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="col-span-12 mt-8">

            <center>
        {!! $parlamentar->links() !!}
            </center>
            <div class="grid grid-cols-12 gap-6 mt-5">
                @foreach($parlamentar as $row)
                {{-- @dd($row->filiacoes) --}}
                    <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{!! route('parlamentar.show', $row->nano_id) !!}">
                            <div class="box p-5">
                                <div class="flex">
                                    <div class="text-3xl font-medium leading-8 mt-6" style="font-size:17px;">Dep. {{$row->name}}
                                        <div class="text-base text-slate-500 mt-1">Partido:
                                            @foreach($row->filiacoes as $key => $value)
                                                @php
                                                    $partido =  json_decode($value->partido, true);
                                                    echo $partido['sigla']
                                                @endphp
                                            @endforeach
                                            <BR> Situação: {!! ($row->status == "inativo") ? "<label class='text-danger'> Inativo </label>" : "<label class='text-primary'> Ativo </label>" !!}</div>
                                    </div>


                                    <div class="ml-auto">
                                        <img style="border-radius:30px; max-width:150px !important;" src="{!! (!empty($row->fotografia) ? $row->fotografia : 'https://argumentumpericias.com.br/biblioteca/2019/09/sem-imagem-avatar.png') !!}">
                                    </div>
                                </div>
                                {{-- <div class="text-3xl font-medium leading-8 mt-6">vizualizar</div>
                                <div class="text-base text-slate-500 mt-1">Proposituras por ano</div> --}}
                            </div>
                        </a>
                        </div>
                    </div>
                @endforeach
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

