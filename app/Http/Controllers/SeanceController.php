<?php

namespace App\Http\Controllers;

use App\Models\rdv;
use App\Models\Seance;
use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    public function create($treatement){
        return view('seance.create',
            ['treatement'=>$treatement,
            'sevices'=>Service::all()
            ]);
    }

    public function store(Request $request){
        $request->validate([
            'description' => ['required', 'string'],
            'id_service' => ['required'],
        ]);

        $treatement = Treatment::find($request->id_treatment);

        if($request->montant > $treatement->MontantNonRegle )
            return back()->with('error','Montant est supérieur au montant non reglé ');

        $seance = new Seance();
        $seance->description = $request->description;
        $seance->montant = $request->montant;
        $seance->id_service = $request->id_service;
        $seance->id_treatment = $request->id_treatment;

        $treatement->MontantNonRegle -= $seance->montant;

        $treatement->save();
        $seance->save();

        return back()->with('success','Seance Addeed successfully');
    }

    public function show($id){

        $seance = Seance::find($id);
        $service = $seance->service;
        return view('seance.show',
        ['seance'=>$seance,
        'treatement'=>$seance->treatement,
            'service'=>$service
        ]);

    }

    public function edit($id,$treatement){

        $seance = Seance::find($id);

        return view('seance.edit',[
            'seance'=>$seance,
            'treatement'=>$treatement,
            'service'=>$seance->service,
            'sevices'=>Service::all()]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'description' => ['required', 'string'],
            'id_service' => ['required'],
        ]);

        $treatement = Treatment::find($request->id_treatment);

        $seance = Seance::find($id);

        $treatement->MontantNonRegle += $seance->montant;

        if($request->montant > $treatement->MontantNonRegle )
            return back()->with('error','Montant est supérieur au montant non reglé ');

        $seance->description = $request->description;
        $seance->montant = $request->montant;
        $seance->id_service = $request->id_service;
        $seance->id_treatment = $request->id_treatment;

        $treatement->MontantNonRegle -= $seance->montant;

        $rdv = rdv::all()->where('telephone','=',$treatement->user->phonenumber)
        ->where('week','=',date('W'))
        ->where('day','=',getdate()['wday']-1);

        foreach ($rdv as $value){
            $value->etat = 'terminé';
            $value->save();
        }

        $treatement->save();
        $seance->save();

        return back()->with('success','Seance Updated successfully');
    }
}
