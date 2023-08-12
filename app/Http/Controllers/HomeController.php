<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models utilizadas
use App\Models\User;
use App\Models\Oportunidade;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    
     public $itensPorPagina = 2;


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
               

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
        $oportunidades = Oportunidade::where($where)->paginate($this->itensPorPagina)->withQueryString();



        //Se teve option escolhido e submetido via GET para vendedor(user_id), entao ele deve ser inicialmente selecionado no recarregamento da página. 
        if($request_has_user_id){            
            $request_has_user_id = User::where([['id', '=', $request->input('user_id')]])->first();           
        }

        return view('home', compact('oportunidades', 'request_has_user_id'));
    }

    
    public function autocompletevendedor(Request $request)
    {
        $data = [];
  
        if($request->filled('q')){
            $data = User::select("name", "id")
                        ->where([['name', 'LIKE', '%'. $request->get('q'). '%']])
                        ->get();
        }else{
            //busca todos users para popular select
            $data = User::select("name", "id")
                        ->orderBy('name', 'ASC')
                        ->get();

        } 
    
        return response()->json($data);
    }


}
