<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\Commande;
use App\Models\CommandePizzade;
// gère la création et la consultation des commandes pour les utilisateurs, la gestion des commandes pour les pizzaiolos, et la consultation des commandes pour les administrateurs.
class CommandeController extends Controller
{

    public function addToCart(Request $request, Pizza $pizza)
    {
        $request->input('quantity');
        $cart = session()->get('cart');

        // Si le panier n'existe pas, on le crée
        if(!$cart) {
            $cart = [            $pizza->id => [                "nom" => $pizza->nom,                "qte" => 1,                "prix" => $pizza->prix,            ]
            ];

            session()->put('cart', $cart);
            return redirect()->route('pizzas.index')->with('success', 'Pizza ajoutée au panier avec succès!');
        }

        // Si le produit est déjà dans le panier, on incrémente la quantité
        if(isset($cart[$pizza->id])) {
            $cart[$pizza->id]['qte']++;
            session()->put('cart', $cart);
            return redirect()->route('pizzas.index')->with('success', 'Pizza ajoutée au panier avec succès!');
        }

        // Si le produit n'est pas encore dans le panier, on l'ajoute
        $cart[$pizza->id] = [        "nom" => $pizza->nom,        "qte" => 1,        "prix" => $pizza->prix,    ];
        session()->put('cart', $cart);
        return redirect()->route('pizzas.index')->with('success', 'Pizza ajoutée au panier avec succès!');
    }



    // va renvoyer la liste des commandes passées par l'utilisateur connecté.
    public function viewCart()
    {
        $panier = session()->get('cart');
        $total = 0;

        if (session()->has('cart')){
        foreach ($panier as $p){
            $total += $p ['total'];

        }
        }
        return view('panier', ['panier' => $panier , 'prixTotal' => $total]);
    }

    public function modifierCommande(Request $request, $id )
    {

        $qte = $request->input('qte');

        // Mettre à jour la quantité de la commande correspondante dans la session
        $panier = session('cart');
        $panier[$id]['qte'] = $qte;
        $pizza =pizza::findOrFail($id);
        $panier[$pizza->id]['total']=$pizza->prix * $request->qte ;
        session()->put('cart', $panier);

        return redirect()->back();
    }

    public function supprimerCommande(Request $request)
    {
        $id = $request->input('id');

        // Supprimer la commande correspondante de la session
        $panier = session('cart');
        unset($panier[$id]);
        session()->put('cart', $panier);

        return redirect()->back();
    }

    public function passerCommande()
    {
        // Enregistrer la commande dans la base de données avec le statut fourni
        $commande = new commande ();
        $commande->statut ='envoye';
        $commande->user_id= auth()->user()->id;
        $commande->save();

        // Vider le panier dans la session
        session(['panier' => []]);

        return view('commandeValider')->with('success', 'Commande passée');
    }

/* public function showDetail($id)
    {
        $commande = Commande::findOrFail($id);

        $pizzas = DB::table('pizzas')
            ->join('commande_pizza', 'pizzas.id', '=', 'commande_pizza.pizza_id')
            ->select('pizzas.nom', 'pizzas.description', 'pizzas.prix', 'commande_pizza.qte')
            ->where('commande_pizza.commande_id', $id)
            ->get();

        $total = 0;
        foreach ($pizzas as $pizza) {
            $total += $pizza->prix * $pizza->qte;
        }

        return view('detail', [
            'commande' => $commande,
            'pizzas' => $pizzas,
            'total' => $total,
        ]);
    }*/
    public function showDetail($id)
    {
        $commande = Commande::with('user')->find($id);

        return view('detail',compact('commande'));
    }
    public function show()
    {

        $commandes = Commande::where('statut', 'envoye')->get();
        return view('commandes', ['commandes' => $commandes]);
    }

    public function update( $id)
    {
        $commande = Commande::findOrFail($id);


        $commande->save();

        return redirect()->route('commandes.show', $commande->id)->with('success', 'Commande mise à jour avec succès');
    }
}
