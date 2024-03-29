<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\informacoes_post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class EventController extends Controller
{
    public function index(){
        // $search = request('search');

        // if (view()->exists($search)) {
        //     return redirect($search);
        // } else {
        //     return view('welcome',['search'=> $search]);
        // }    

        return view('welcome');

    }

    public function lixo(Request $request){

        $capitaisName =  DB::table('todas_capitais')
                ->select('Nome_Capitais','Nome_tabela','Regiao','Total')
                ->orderBy('Nome_Capitais','asc')
                ->get();
           
        $dados = DB::table("nome_tabelas")  
                ->select('id','nome_tabelas')
                ->where('id','<=','7')
                ->orderBy('id','asc')
                ->get();      

        $total = DB::table('todas_capitais')
                ->select('Nome_Capitais','Total','Nome_tabela')
                ->get();



       return view('lixo',[
            'capitaisName'=> $capitaisName,
            'dados' => $dados,
            'total' => $total,
        ]);


    }

    public function moradores(Request $request){

        $capitaisName2 =  DB::table('todas_capitais2')
                ->select('Nome_Capitais','Nome_tabela','Regiao','Total')
                ->orderBy('Nome_Capitais','asc')
                ->get();


        $dados2 = DB::table("nome_tabelas")  
                ->select('id','nome_tabelas')
                ->where('id','>','7')
                ->where('id','<','12')
                ->orderBy('id','asc')
                ->get();  

        $total2 = DB::table('todas_capitais2')
                ->select('Nome_Capitais','Total','Nome_tabela')
                ->get();

        return view('moradores',[
            'capitaisName'=> $capitaisName2,
            'dados' => $dados2,
            'total' => $total2,
        ]);
    }

    public function saudemental(Request $request){

        $capitaisName5 =  DB::table('todas_capitais5')
                ->select('Nome_Capitais','Nome_tabela','Regiao','Total')
                ->orderBy('Nome_Capitais','asc')
                ->get();


        $dados5 = DB::table("nome_tabelas")  
                ->select('id','nome_tabelas')
                ->where('id','>','15')
                ->where('id','<','23')
                ->orderBy('id','asc')
                ->get();  

        $total5 = DB::table('todas_capitais5')
                ->select('Nome_Capitais','Total','Nome_tabela')
                ->get();

        return view('saudemental',[
            'capitaisName'=> $capitaisName5,
            'dados' => $dados5,
            'total' => $total5,
        ]);
    }

    public function saudebucal(Request $request){

        $capitaisName4 =  DB::table('todas_capitais4')
                ->select('Nome_Capitais','Nome_tabela','Regiao','Total')
                ->orderBy('Nome_Capitais','asc')
                ->get();


        $dados4 = DB::table("nome_tabelas")  
                ->select('id','nome_tabelas')
                ->where('id','>','22')
                ->where('id','<','29')
                ->orderBy('id','asc')
                ->get();  

        $total4 = DB::table('todas_capitais4')
                ->select('Nome_Capitais','Total','Nome_tabela')
                ->get();

        return view('saudebucal',[
            'capitaisName'=> $capitaisName4,
            'dados' => $dados4,
            'total' => $total4,
        ]);
    }

    public function escolas(Request $request){

        $capitaisName6 =  DB::table('todas_capitais6')
                ->select('Nome_Capitais','Nome_tabela','Regiao','Total')
                ->orderBy('Nome_Capitais','asc')
                ->get();


        $dados6 = DB::table("nome_tabelas")  
                ->select('id','nome_tabelas')
                ->where('id','>','28')
                ->where('id','<','34')
                ->orderBy('id','asc')
                ->get();  

        $total6 = DB::table('todas_capitais6')
                ->select('Nome_Capitais','Total','Nome_tabela')
                ->get();

        return view('escolas',[
            'capitaisName'=> $capitaisName6,
            'dados' => $dados6,
            'total' => $total6,
        ]);
    }

    public function rendimento(Request $request){

        $capitaisName3 =  DB::table('todas_capitais3')
                ->select('Nome_Capitais','Nome_tabela','Regiao','Total')
                ->orderBy('Nome_Capitais','asc')
                ->get();


        $dados3 = DB::table("nome_tabelas")  
                ->select('id','nome_tabelas')
                ->where('id','>','11')
                ->where('id','<','16')
                ->orderBy('id','asc')
                ->get();  

        $total3 = DB::table('todas_capitais3')
                ->select('Nome_Capitais','Total','Nome_tabela')
                ->get();

        return view('Rendimento',[
            'capitaisName'=> $capitaisName3,
            'dados' => $dados3,
            'total' => $total3,
        ]);
   }

}//fim do class event controler