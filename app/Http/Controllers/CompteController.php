<?php

namespace App\Http\Controllers;

use App\Models\compte;
use App\Models\wallet;
use App\Http\Requests\StorecompteRequest;
use App\Http\Requests\UpdatecompteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CompteController extends Controller
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
     * @param  \App\Http\Requests\StorecompteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecompteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\compte  $compte
     * @return \Illuminate\Http\Response
     */

     public function show(Request $request)
     {
         $user = Auth::user();

         $compte = compte::where('user_id' , $user->id)->get();
        //  dd($compte);
         if (!$user) {
             return response()->json([
                 'error' => 'Unauthorized',
                 'message' => 'Utilisateur non authentifié'
             ], 401);
         }

         try {
             return response()->json([
                 'message' => 'Details du compte de : ',
                 'user' => [
                    'name' => $user->name,
                 ],
                    'est'=>$compte
             ], 200);
         } catch (\Exception $e) {
             return response()->json([
                 'error' => 'Internal Server Error',
                 'message' => 'Une erreur est survenue lors de la récupération des détails du compte',
                 'details' => $e->getMessage()
             ], 500);
         }
     }



     public function sendMoney(Request $request)
     {
        $validateData= $request->validate([
            'montant' => 'required',
            'motif' => 'required',
            'receiver_id' => 'required',
        ]);

         $sender = Auth::user();
         $price = $request->input('montant');
         $motif = $request->input('motif');
         $idreciever = $request->receiver_id;

         $senderCompte = $sender->id;

        $Useraccount= compte::where('user_id',$senderCompte)->first();

         // Vérifier si l'utilisateur a suffisamment d'argent dans son compte
         if ($price > $Useraccount->solde ) {
             return response()->json([
                'message' => 'Solde insuffisant.'
             ], 400);
         }
        //   // Déduire le montant du solde du compte de l'expéditeur
         $Useraccount->solde  -= $price;
         $Useraccount->save();

        //  // Ajouter le montant au solde du compte du destinataire
         $recipientCompte = Compte::where('user_id', $idreciever)->first();


        //enregistrement dans le wallet
        $UserWallet= new wallet;
         $UserWallet->montant= $price;
         $UserWallet->motif= $motif;
         $UserWallet->sender_id= $senderCompte;
         $UserWallet->receiver_id=$recipientCompte->user_id;
         $UserWallet->save();

         $recipientCompte->solde += $price;
         $recipientCompte->save();
         return response()->json([
            'message' => 'Transaction effectuée avec succès.'
         ], 200);
     }



     public function transactionHistory()
    {
        $user = Auth::user();

        $transactionsSend = wallet::where('sender_id', $user->id)->get();
        $transactionsReçoi = wallet::where('receiver_id', $user->id)->get();

        return response()->json([
            'messageS' => 'Historique des transactions envoyer est ',
            'dataS' => $transactionsSend,
            'messager' => 'Historique des transactions recoi est',
            'dataR' => $transactionsReçoi
        ], 200);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function edit(compte $compte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecompteRequest  $request
     * @param  \App\Models\compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecompteRequest $request, compte $compte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(compte $compte)
    {
        //
    }
}
