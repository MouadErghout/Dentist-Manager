<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;

class TreatementController extends Controller
{
    public function list($user){
        $treatement = User::find($user)->treatements;
        return view('treatement.list',['treatement'=>$treatement,'user'=>$user]);
    }

    public function create($user){
        return view('treatement.create',['user'=>$user]);
    }

    public function store(Request $request){
        $request->validate([
            'prix' => ['required'],
        ]);
        $treatement = new Treatment();
        $treatement->prix = $request->prix;
        $treatement->MontantNonRegle = $request->prix;
        $treatement->id_user = $request->id_user;

        $treatement->save();

        return back()->with('success','Treatement Addeed successfully');
    }

    public function show($id){

        $treatement = Treatment::find($id);
        $seances = $treatement->seances;
        return view('treatement.show',[
            'treatement'=>$treatement,
            'seances'=>$seances,
            'user'=>$treatement->user->id
        ]);

    }

    // for client treatment list
    public function show2($id){

        $treatement = Treatment::find($id);
        $seances = $treatement->seances;
        return view('treatement.clientshow',['treatement'=>$treatement,'seances'=>$seances]);

    }

    public function edit($id,$user){

        $treatement = Treatment::find($id);
        return view('treatement.edit',['treatement'=>$treatement,'user'=>$user]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'prix' => ['required']
        ]);

        $treatement = Treatment::find($id);

        if($treatement->Prix === $treatement->MontantNonRegle){
            $treatement->MontantNonRegle = $request->prix;
            $treatement->Etat = $request->etat;
            $treatement->Prix = $request->prix;
            $treatement->id_user = $request->id_user;

            $treatement->save();

            return back()->with('success','Treatement Updated successfully');
        }

//        if($request->prix < $treatement->MontantNonRegle)
//            return back()->with('error','Prix doit etre superieur au montant non regle');

        if($treatement->Prix > $request->prix){
            $diff = $treatement->Prix - $request->prix ;
            if($diff > $treatement->MontantNonRegle)
                return back()->with('error','paiement effectue par le client superieur au Prix inserer');
            else
                $treatement->MontantNonRegle -= $diff;
        }
        elseif ($treatement->Prix < $request->prix)
            $treatement->MontantNonRegle = $treatement->MontantNonRegle + ($request->prix - $treatement->Prix);

        $treatement->Etat = $request->etat;
        $treatement->Prix = $request->prix;
        $treatement->id_user = $request->id_user;

        $treatement->save();

        return back()->with('success','Treatement Updated successfully');
    }
}
