@include('includes.header')
           <div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-11">


            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Filtre o usuário</h2>
                    </div>
                    {!! Form::model(Request::input(), ['method' => 'get', 'autocomplete' => 'off', 'route' => ['usuarios', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate']) !!}
                    <div id="vertical-form" class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12">
                                    <div>
                                        <label for="update-profile-form-6" class="form-label">Palavra chave</label>
                                        <input id="update-profile-form-6" type="text" class="form-control" name="name">
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
                                <button class="btn btn-dark mt-5"><i data-lucide="corner-left-down" class="block mx-auto"></i>exportar</button>
                            </div>

                        </div>
                    </form>

                </div>


            <div class="intro-y box mt-5">
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

