@include('includes.header')
           <div class="content">
            @include('alert')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-11">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Filtre o Grupo de usuário</h2>
                </div>
                {!! Form::model(Request::input(), ['method' => 'get', 'autocomplete' => 'off', 'route' => ['group', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate']) !!}
                <div id="vertical-form" class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-12">
                                <div>
                                    <label for="update-profile-form-6" class="form-label">Palavra chave</label>
                                    <input id="update-profile-form-6" type="text" class="form-control" name="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 card-footer">
                            <button class="btn btn-primary mt-5"><i data-lucide="search" class="block mx-auto"></i> Buscar</button>
                        </div>

                    </div>
                </form>

            </div>
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                    <h2 class="font-medium text-base mr-auto">Grupos Cadastrados</h2>
                    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                        <a href="{!! route('grupo.show') !!}" class="btn btn-primary"> + NOVO </a>
                    </div>
                </div>
                <div class="p-5" id="small-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            @if (empty($gruposUser))
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">Nome</th>
                                        <th class="whitespace-nowrap">Usuário Responsável</th>
                                        <th class="whitespace-nowrap">Data de criação</th>
                                        <th class="whitespace-nowrap">Editar</th>
                                        <th class="whitespace-nowrap">Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $groupUser as $row)
                                        <tr>
                                            <td>{!! $row->name !!}</td>
                                            <td>{!! $row->user->name !!}</td>
                                            <td>{!! date('d/m/Y', strtotime($row->created_at)) !!}</td>
                                            <td style="position: relative; left:-50px;"><a class="text-center" href="{!! route('grupo.update', $row->id) !!}"><i data-lucide="edit-2" class="block mx-auto"></i></a></td>
                                            <td style="position: relative; left:-50px;"> <a href="{!! route('grupo.destroy', $row->id) !!}"><i data-lucide="x" class="block mx-auto"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning" style="color:#fff !important"> Nenhum grupo cadastrados </div>
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
@include('includes.footer')
<!-- END: JS Assets-->
</body>
</html>

