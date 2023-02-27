<?php

namespace App\Http\Controllers;


use App\Models\fichesalaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fichesalaire');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fichesalaire');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'periode_debut.required'    => 'La date de début de la période est requis',
            'periode_fin.required'      => 'La date de fin de la période est requis',
            'matricule.required'        => 'Le matricule est requis',
            'matricule.exists'          => 'Le matricule n\'existe pas.',
            'date_paiement.required'    => 'La date de paiement est requis',
            'salaire_brut.required'     => 'Le salaire brute est requis',
            'tot_retenues.required'     => 'Le total des retenus  est requis.',
        ];

        $rules = [
            'date_paiement' => 'bail|required',
            'periode_debut' => 'bail|required',
            'periode_fin'   => 'bail|required',
            'salaire_brut'  => 'bail|required',
            'tot_retenues'  => 'bail|required',
            'matricule'     => 'bail|required|exists:moniteurs',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        fichesalaire::create([
            'date_paiement' =>  $request->date_paiement,
            'periode_debut' =>  $request->periode_debut,
            'periode_fin'   =>  $request->periode_fin,
            'salaire_brut'  =>  $request->salaire_brut,
            'sal_net'       =>  $request->salaire_brut - $request->tot_retenues,
            'matricule'     =>  $request->matricule,
        ]);
        // $fichesalaire = new fichesalaire;
        // $fichesalaire->date_paiement = $request->date_paiement;
        // $fichesalaire->sal_net = $request->sal_net;
        // $fichesalaire->moniteur_id = $request->moniteur_id;

        // $fichesalaire->save();

        return redirect()->back()->with('message', 'Opération effectuée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fichesalaire  $fichesalaire
     * @return \Illuminate\Http\Response
     */
    public function show(fichesalaire $fichesalaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fichesalaire  $fichesalaire
     * @return \Illuminate\Http\Response
     */
    public function edit(fichesalaire $fichesalaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fichesalaire  $fichesalaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fichesalaire $fichesalaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fichesalaire  $fichesalaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(fichesalaire $fichesalaire)
    {
        $fichesalaire->delete();

        return redirect()->route('fichesalaire');
    }
}
