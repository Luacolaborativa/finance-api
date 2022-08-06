<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaxaDiariaRequest;
use App\Http\Requests\UpdateTaxaDiariaRequest;
use App\Models\TaxaDiaria;
use Exception;
use Illuminate\Support\Facades\DB;

class TaxaDiariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selicDiaria()
    {
        $selic = TaxaDiaria::where('data', date('Y-m-d'))->first();
        if($selic == null){
            $this->getSelicDiaria();
        }

        return response()->json($selic->valor, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSelicDiaria()
    {
        $today = date('m/d/Y');
        
        $isWeekend = $this->isWeekend($today);
        
        if($isWeekend == 1){
            $selicHoje = TaxaDiaria::where('id_taxa', '1')->orderBy('data', 'desc')->first();
            $selicHoje = array(
                'valor' => $selicHoje->valor
            );
            return response()->json($selicHoje, 200);
        }

        return $this->selicApi();
        
    }

    public function selicApi(){
        try {
            $hoje = date("d/m/Y");

            $url = "https://www3.bcb.gov.br/novoselic/rest/taxaSelicApurada/pub/search?parametrosOrdenacao=[]&page=1&pageSize=20";
            
            $header = array("Accept: application/json, text/plain, */*","Content-Type: application/json");
            $data = '{"dataInicial":"'.$hoje.'","dataFinal":"'.$hoje.'"}';
            
            $ch = curl_init();
            $log = fopen("/home/gesiel/fxLuaColab/storage/logs/curl.txt", "w");

            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_FILE, $log);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $res = json_decode(curl_exec($ch));
        
            if(curl_error($ch)){
                fwrite($log, curl_error($ch));
            }

            curl_close($ch);
            fclose($log);

            $valorSelic = $res->registros[0]->moda;

            if($valorSelic !== null){
                DB::table('taxadiaria')->insert([
                    'id_taxa' => '1',
                    'valor' => $valorSelic,
                    'data' => date('Y-m-d')
                ]);
            }

            return $res->registros[0]->moda;

        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaxaDiariaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxaDiariaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaxaDiaria  $taxaDiaria
     * @return \Illuminate\Http\Response
     */
    public function show(TaxaDiaria $taxaDiaria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaxaDiaria  $taxaDiaria
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxaDiaria $taxaDiaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxaDiariaRequest  $request
     * @param  \App\Models\TaxaDiaria  $taxaDiaria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxaDiariaRequest $request, TaxaDiaria $taxaDiaria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaxaDiaria  $taxaDiaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxaDiaria $taxaDiaria)
    {
        //
    }

    public function isWeekend($dt){
        $dt1 = strtotime($dt);
        $dt2 = date("l", $dt1);
        $dt3 = strtolower($dt2);
        return $dt3 == "saturday" || "sunday";
    }
}
