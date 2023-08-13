<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models utilizadas
use App\Models\User;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Oportunidade;
use App\Models\OportunidadeProduto; 


use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    
     public $itensPorPagina = 2;




     public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }






    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
               

        //Filtros
        $where = [];

        $request_has_user_id = false;

        if($request->has('created_at_DE') && !empty($request->input('created_at_DE'))){

            // validate se sobrar tempo --

            $where[] = ['oportunidades.created_at', '>=',   implode('-', array_reverse(explode('/', $request->input('created_at_DE')))) ];
        }

        if($request->has('created_at_ATE') && !empty($request->input('created_at_ATE'))){

            // validate se sobrar tempo --

            $where[] = ['oportunidades.created_at', '<=',   implode('-', array_reverse(explode('/', $request->input('created_at_ATE')))) ];
        }

        if($request->has('user_id') && !empty($request->input('user_id'))){

            // validate se sobrar tempo --            

            $where[] = ['oportunidades.user_id', '=',  $request->input('user_id')];
            $request_has_user_id = true;
        }

                  
        
        //Busca com Filtro e Paginacao
        // Obs: para buscar os dados das chaves estrangeiras temos 2 opcoes: 1) belongsTo na model Oportunidade  ou  2) join na query abaixo.   OPCAO ESCOLHIDA: 1)      
        $oportunidades = Oportunidade::where($where)->paginate($this->itensPorPagina)->withQueryString();



        //Se teve option escolhido e submetido via GET para vendedor(user_id), entao ele deve ser inicialmente selecionado no recarregamento da página. 
        if($request_has_user_id){            
            $request_has_user_id = User::where([['id', '=', $request->input('user_id')]])->first();           
        }

        return view('home', compact('oportunidades', 'request_has_user_id'));
    }


    public function create(){            

        //busca clientes
        $clientes = Cliente::orderBy('nome', 'ASC')->get();

        //busca produtos
        $produtos = Produto::orderBy('nome', 'ASC')->get();



        return view('oportunidade-create', compact('clientes', 'produtos'));

    }

    public function store(Request $request){        
        

        //Validate        
        $validatedData = $request->validate([
        'cliente_id' => ['required', 'numeric'],                // Em um sistema real, poderia criar uma rule adicional para checkar se é de fato um id da tabela clientes
        'produtos_id' => ['required', 'array', 'min:1'],    // Em um sistema real, poderia criar uma rule adicional para checkar se cada item do array é fato um id da tabela produtos
        ],         
        [
            'cliente_id.required' => 'Selecione um cliente',
            'cliente_id.numeric' => 'Cliente inválido',
            'produtos_id.required' => 'Selecione pelo menos um produto',
            'produtos_id.array' => 'Produto inválido',
            'produtos_id.min' => 'Produto inválido',
        ]
        ); 
        

        //Captura dados
        $dados = $request->all();
        
        //cadastra Oportunidade 
        $oportunidade = Oportunidade::create([ 'cliente_id' => $dados['cliente_id'], 'user_id' => Auth::user()->id ]);

        //cadastra OportunidadeProduto
        foreach($dados['produtos_id'] as $produto_id_){
            OportunidadeProduto::create(['oportunidade_id' => $oportunidade->id, 'produto_id' => $produto_id_]);
        }
        

        //redireciona com flash Message
        return redirect()->route('home')->with('success__', 'Registro incluído com sucesso!'); 
    }


    
    public function autocompletevendedor(Request $request){
        $data = [];
  
        if($request->filled('q')){
            $data = User::select("name", "id")->where([['name', 'LIKE', '%'. $request->get('q'). '%']])->get();
        }else{
            //busca todos users para popular select
            $data = User::select("name", "id")->orderBy('name', 'ASC')->get();

        } 
    
        return response()->json($data);
    }


    public function autocompletecliente(Request $request){
        $data = [];
  
        if($request->filled('q')){
            $data = Cliente::select("nome", "id")->where([['nome', 'LIKE', '%'. $request->get('q'). '%']])->get();
        }else{
            //busca todos users para popular select
            $data = Cliente::select("nome", "id")->orderBy('nome', 'ASC')->get();

        } 
    
        return response()->json($data); 
    }

    
    public function autocompleteprodutos(Request $request){
        $data = [];
  
        if($request->filled('q')){
            $data = Produto::select("nome", "id")->where([['nome', 'LIKE', '%'. $request->get('q'). '%']])->get();
        }else{
            //busca todos users para popular select
            $data = Produto::select("nome", "id")->orderBy('nome', 'ASC')->get();

        } 
    
        return response()->json($data);  
    }

    



}
