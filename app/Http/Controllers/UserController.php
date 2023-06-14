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

class UserController extends Controller
{
    protected $user;
    public function __construct(UserRepository $user)
    {
        $this->user            = $user;
    }

    // public function index(Request $request){
    //     return view('usuario.index', [
    //         "panel"       => $this->panelRepository->all(),
    //     ]);
    // }
    // public function painel($id){
    //     if(empty($id)){
    //         abort(404);
    //     }
    //     return view('usuario.temas', [
    //         "temas"      => $this->indicadorRepository->whereS('tema_filho', $id),
    //         "panel"      => $this->panelRepository->all(),
    //         "id"         => $id
    //     ]);
    // }

    // public function indicativos($id_painel, $id_indicativo){

    //     if(empty($id_painel) || empty($id_indicativo)){
    //         abort(404);
    //     }

    //     return view('usuario.indicativos', [
    //         "panel"         => $this->panelRepository->all(),
    //         "id"            => $id_painel,
    //         "indicativo"    => $this->indicadorTema->find($id_indicativo)
    //     ] );
    // }

    // public function about(){
    //     return view('usuario.about');
    // }


    public function auth(UserAuthRequest $request){

        if(Auth::attempt($request->except('_token'))){
            $request->session()->flash('alert', ["code" => "success", "text" => "Login realizado com sucesso..."]);
            return redirect()->route('dashboard');
        }

        $request->session()->flash('alert', ["code" => "danger", "text" => "Login ou senha incorretos, tente novamente"]);
        return redirect()->route('auth');
    }

    public function show(){
        return view('dash.user.index', [
            "brand" => [
                ["route" => "", "name" => "Legislativo", "class" => null],
                ["route" => route('dashboard'), "name" => "Dashboard", "class" => "active"],
            ],
            "user" => $this->user->all()
        ]);
    }

    // public function recovery(UserRecoveryRequest $request){
    //     $auth = $this->user->where('email', $request->input('email'));
    //     if(empty($auth)){
    //          $request->session()->flash('alert', ["code" => "warning", "text" => "E-mail não encontrado, por favor, tente novamente"]);
    //          return redirect()->route('auth.recovery');
    //     }

    //     try{
    //         $token =  Str::random(125);
    //         // Insere o token para recuperação de senha
    //         $auth->token = $token;
    //         $auth->save();
    //         // Encerra a inserção do token para recuperação de senha

    //         Mail::send(new RecoveryPassword($auth));
    //         $request->session()->flash('alert', ["code" => "success", "text" => "Enviamos um link no e-mail cadastrado."]);
    //     }catch(Exception $e){
    //         $request->session()->flash('alert', ["code" => "danger", "text" => $e->getMessage()]);
    //     }
    //     return redirect()->route('auth.recovery');

    // }

    // public function tokenRecovery($token){
    //     if(empty($token)){
    //         session()->flash('alert', ['code' => 'danger',  'text' => 'É necessário um TOKEN para autorizar a alteração de senha']);
    //         return redirect()->route('auth');
    //     }

    //     $auth = $this->user->where('token', $token);

    //     if(empty($auth)){
    //         session()->flash('alert', ['code' => 'danger',  'text' => 'O Token informado já foi utilizado e não está mais válido.']);
    //         return redirect()->route('auth');
    //     }

    //     $password = Str::random(5);
    //     try{
    //         Mail::send(new sendRecoveryPassword($auth, $password));
    //         $auth->password = $password;
    //         $auth->token = null;
    //         $auth->save();
    //         session()->flash('alert', ['code' => 'success',  'text' => 'Senha atualizada com sucesso. Enviamos uma nova senha em seu e-mail']);

    //     }catch(Exception $e){
    //         session()->flash('aler', ['code' => 'danger', 'text' => $e->getMessage()]);
    //     }

    //     return redirect()->route('auth');

    // }

    // public function newUserSend(CreateUserRequest $request){

    //    try {
    //         $request->merge([
    //             "status" => 1,
    //             "password" => Str::random(7)
    //         ]);

    //         $user = $this->user->create($request->except('_token'));

    //         if($user){
    //             session()->flash('alert', ['code' => 'success',  'text' => 'Usuário cadastrado com sucesso.']);
    //             //Gera token para o usuário validar o cadastro e salva no banco de dados
    //             $random = Str::random(180).$user->id;
    //             $user->newRegister = $random;
    //             $user->save();

    //             //Envia e-mail ao usuário
    //             Mail::send(new SendNewUser($user));
    //         }

    //    }catch(Exception $e){
    //         session()->flash('alert', ['code' => 'danger',  'text' => $e->getMessage()]);
    //    }

    //    return redirect()->route('dash.user.list');

    // }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('alert', ["code" => "success", "text" => "Deslogado com sucesso"]);
        return redirect()->route('auth');
    }

    // Validação ajax

    public function validateCpf(Request $request){
        if (preg_match('/(\d)\1{10}/', $request->input('cpf'))) {
            return response()->json([ "status"  =>  "danger", "message" =>  "Formato do CPF está incorreto"]);
        }
        $cpf = $request->input('cpf');

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return response()->json([ "status"  =>  "danger", "message" =>  "CPF digitado não é válido"]);
            }
        }
        $auth = $this->user->where('cpf', $request->input('cpf'));
        if(!empty($auth)){
            return response()->json([ "status"  =>  "danger", "message" =>  "CPF já cadastrado, por favor, utilize outro"]);
        }
        return response()->json([ "status"  =>  "success", "message" =>  "CPF disponível para uso"]);
    }
    public function validateEmail(Request $request){
        $auth = $this->user->where('email', $request->input('email'));
        if(!empty($auth)){
            return response()->json([ "status"  =>  "danger", "message" =>  "E-mail já cadastrado, por favor, utilize outro"]);
        }
        return response()->json([ "status"  =>  "success", "message" =>  "E-mail disponível para uso"]);
    }

}
