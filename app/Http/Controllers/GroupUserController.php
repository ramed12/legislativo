<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserGroupRepository;
use App\Http\Requests\GroupUserStoreRequest;
use App\Models\permission_user;
use App\Repositories\PermissionRepository;
use App\Repositories\PermissionGroupRepository;

class GroupUserController extends BaseWebController
{

    protected $groupUser;
    protected $user;
    protected $permission;
    protected $permissionGroup;
    public function __construct(Request $request, PermissionGroupRepository $permissionGroup, UserGroupRepository $groupUser, UserRepository $user, PermissionRepository $permission)
    {
        $this->groupUser       = $groupUser;
        $this->user            = $user;
        $this->permission      = $permission;
        $this->permissionGroup = $permissionGroup;

        $this->middleware(function ($request, $next) {
            $this->id = Auth::guard('web')->user();
            parent::__construct($this->id, $request);
            return $next($request);
        });
    }

    public function index(Request $request): object{

        $paginate     = null;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return view('dash.group.index', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('group'), "name" => "Grupos cadastrados", "class" => "active"],
            ],
            "groupUser" => $this->groupUser->list($request, $orderByField, $orderByOrder, $paginate)
        ]);
    }

    public function show(){
        return view('dash.group.show', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('group'), "name" => "Grupos cadastrados", "class" => null],
                ["route" => route('grupo.show'), "name" => "novo Grupo", "class" => "active"],
            ],
            "users" => $this->user->all(),
            'permissions' => $this->permission->all()->sortBy('groupname'),
            'rolesCreate' => null,
        ]);
    }

    public function edit($id){
        $user = $this->groupUser->find($id)->users;

        // dd($this->groupUser->find($id));
        $ab = json_decode($user);

        $findPermisson =  permission_user::where('grupo_id', $this->groupUser->find($id)->id)->get();

        //dd($find)

        $array = [];
        foreach($findPermisson as $perm){
            array_push($array, $perm->permission_id);
        }

        return view('dash.group.edit', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('group'), "name" => "Grupos Cadastrados", "class" => null],
                ["route" => route('grupo.update', $id), "name" => $this->groupUser->find($id)->name, "class" => "active"],
            ],
            "users" => $this->user->all()->pluck('name', 'id'),
            "user"  => $ab,
            'group' => $this->groupUser->find($id),
            'permissions'   => $this->permission->all()->sortBy('groupname'),
            'role'  =>  $array
        ]);
    }

    public function store(Request $request){
        try{
            $request->merge([
                "userCreate" => Auth::user()->id,
                "users"      => json_encode($request->input('users')),
                'status'     => 2
            ]);

            $group = $this->groupUser->create($request->except('_token'));

                foreach($request->input('permissions') as $permission){
                    $request->merge([
                        "grupo_id"      => $group->id,
                        "permission_id" => $permission
                    ]);

                    $this->permissionGroup->create($request->except('_token'));
                }
            $request->session()->flash('alert', ['code' => 'success', 'text' => 'Grupo cadastro com sucesso']);
        }catch(Exception $e){
            $request->session()->flash('alert', ['code' => 'danger', 'text' => $e->getMessage()]);
        }

        return redirect()->route('group');
    }

    public function update(Request $request, $role_id){

        try {

            $request->merge([
                "userCreate" => Auth::user()->id,
                "users"      => json_encode($request->input('users')),
                "status"     => 2,
                "grupo_id"   => $role_id
            ]);

             $this->groupUser->update($request->input(), $role_id);


            permission_user::where('grupo_id', $role_id)->forceDelete();

            foreach($request->input('permissions') as $permis){
                $request->merge([
                    "permission_id" => $permis,
                ]);

                $this->permissionGroup->create($request->input());
            }

            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Grupo atualizado com sucesso!"));

        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
        }

        return redirect(route("grupo.atualiza", $role_id));

    }

    public function destroy($id){

        if(empty($id)){
            abort(404);
        }

        $findGroup = $this->groupUser->find($id);

        if(!empty($findGroup->users)){
            session()->flash('alert', ["code" => "danger","text" => "Você não pode remover um grupo que possui usuários vinculados"]);
            return redirect()->route('group');
        }

        $findGroup->destroy();

        return redirect()->route('group');
    }
}
