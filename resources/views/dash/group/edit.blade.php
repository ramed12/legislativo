@include('includes.header')
<div class="content">
    <div class="intro-y flex items-center mt-8">
<h2 class="text-lg font-medium mr-auto">Grupo {!! $group->name !!}</h2>
</div>
@include('alert')
<div class="grid grid-cols-12 gap-12">
<div class="col-span-12 lg:col-span-11 2xl:col-span-11">

<div class="intro-y box mt-5">
    <form action="{!! route('grupo.atualiza', $group->id) !!}" method="POST">
        @csrf
    <div class="p-5">
        <div class="grid grid-cols-12 gap-x-5">
            <div class="col-span-12 xl:col-span-6">
                <div>
                    <label for="update-profile-form-6" class="form-label">Nome do grupo</label>
                    <input id="update-profile-form-6" value="{!! $group->name !!}" type="text" class="form-control" name="name" placeholder="Nome do grupo">
                </div>
            </div>
            <div class="col-span-12 xl:col-span-6">
                <label for="update-profile-form-6" class="form-label">Selecione o usuário</label>
                        {!!Form::select('users[]', $users, $user, ['class' => 'tom-select w-full',  'required', 'multiple' => 'multiple'])!!}
                    </select>
            </div>
            <div class="col-span-12 xl:col-span-12" style="margin-top:20px;">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Permissões de Rotas do sistema</h2>
                </div>


                <div class="card-body">
                    @php
                    $group  = null;
                    $rowkey = 0;
                    @endphp

                    @foreach ($permissions->all() as $key => $value)

                      @if ($value->groupname != $group)
                         @php
                             $group = null;
                         @endphp

                         @if ($rowkey != 0)
                              </div>
                         </fieldset>
                          @endif
                      @endif

                      @if (is_null($group))
                          @php
                              $group = $value->groupname;
                          @endphp

                          <fieldset class="mb-3" style="padding:10px;  margin-top:20px;">
                               <legend style="font-size:20px !important" class="text-primary">{!!$group!!}</legend>
                               <hr>
                               <BR>
                                <div class="grid grid-cols-12 gap-6 mt-5">
                      @endif

                      <style>
                       .custom-control-label::after, .custom-control-label::before {top:10px !important; }
                      </style>

                        <div class="intro-y col-span-3">
                          <div class="custom-control custom-checkbox">
                             {!!Form::checkbox('permissions[]', $value->id, isset($role) ? in_array($value->id, $role) : false, [ "id" => "permissions-".$value->id, "class" => "custom-control-input form-check-input"])!!}
                              {!!Form::label("permissions-".$value->id, $value->nickname, ["class" => "custom-control-label"])!!}
                          </div>
                      </div>
                        @php
                            $rowkey ++;
                        @endphp
                  @endforeach
             </div>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary w-20 mr-auto">Salvar</button>
        </div>
    </form>
    </div>
</div>
<!-- END: Personal Information -->
</div>
</div>
</div>
<!-- END: Content -->
</div>
@include('includes.footer')
<!-- END: JS Assets-->
</body>
</html>

