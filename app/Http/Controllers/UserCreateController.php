<?php

namespace App\Http\Controllers;
use Exception;
use Carbon\Carbon;
use App\Models\UserVisit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserAuthRequest;
use App\Repositories\UserGroupRepository;

class UserCreateController extends BaseWebController
{
    protected $user;
    protected $group;
    public function __construct(UserRepository $user, UserGroupRepository $group)
    {
        $this->user            = $user;
        $this->group           = $group;

        $this->middleware(function ($request, $next) {
            $this->id = Auth::guard('web')->user();
            parent::__construct($this->id, $request);
            return $next($request);
        });
    }

    public function index(Request $request){
        $paginate     = null;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return view('dash.user.index', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Usuários Cadastrados", "class" => "active"],
            ],
            "user" => $this->user->list($request, $orderByField, $orderByOrder, $paginate),
            "group" => $this->group->all()->pluck('name', 'id')
        ]);
    }

    public function show($id){
        if(empty($id)){
            abort(404);
        }
        return view('dash.user.show', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Usuários Cadastrados", "class" => "active"],
            ],

            "user" => $this->user->find($id)
        ]);
    }



}
