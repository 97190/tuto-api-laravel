<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */

     // Première methode pour la fonction index
    // public function index()
    // {
    //     // On récupère tous les utilisateurs
    //     $players = Player::all();

    //     // On retourne les informations des utilisateurs en JSON
    //     return response()->json($players);

    // }

    // Deuxième methode pour la fonction index

    public function index()
{
// On récupère tous les joueurs
$players = DB::table('players') // pour que cela marche bien penser a faire un clic droit 'import all class'
->join('clubs', 'clubs.id', '=', 'players.club_id')
->get()
->toArray();

// On retourne les informations des utilisateurs en JSON
return response()->json([
'status' => 'Success',
'data' => $players,
]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $request->validate([
                'firstName' => 'required|max:100',
                'lastName' => 'required|max:100',
                'height' => 'required|max:100',
                'position' => 'required|max:100',
        ]);
        // On crée un nouvel utilisateur
            $player = Player::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'height' => $request->height,
                'position' => $request->position,
                'club_id' => $request->club_id,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
            return response()->json([
                'status' => 'Success',
                'data' => $player,
        ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        // On retourne les informations de l'utilisateur en JSON
            return response()->json($player);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $this->validate($request, [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'height' => 'required|max:100',
            'position' => 'required|max:100',
            'club_id' => $request->club_id,
            ]);
            
            // On crée un nouvel utilisateur
            $player->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'height' => $request->height,
            'lastname' => $request->lastname,
            'position' => $request->position,
            ]);
            // On retourne les informations du nouvel utilisateur en JSON
            return response()->json([
            'status' => 'Mise à jour avec succèss']);
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        // On supprime l'utilisateur
            $player->delete();
            // On retourne la réponse JSON
            return response()->json([
            'status' => 'Supprimer avec succès avec succèss']);
    }
}
