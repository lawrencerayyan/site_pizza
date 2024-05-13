<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
// gère l'affichage des pizzas du menu, la création/modification/suppression de pizzas pour les administrateurs, et l'ajout de pizzas au panier pour les utilisateurs.

class PizzaController extends Controller
{
//  va renvoyer la liste des pizzas disponibles sur le menu. Pour cela, nous allons récupérer les pizzas depuis la base de données et les renvoyer à la vue
  //afficher la liste des pizzas
   public function index()
    {
        $pizzas = Pizza::paginate(10);
        return view('listePizzas', ['pizzas' => $pizzas]);
    }


// ajouter une pizza et la sauvgarder avec la function store
    public function create()
{
    return view('AjouterPizza');
}


// Notez que la méthode store() utilise l'injection de dépendance pour obtenir une instance de Request et que les méthodes edit() et update() utilisent l'injection de modèle pour obtenir une instance de Pizza.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required',
            'prix' => 'required|numeric',
        ]);

        $pizza = new Pizza();
        $pizza->nom = $validatedData['nom'];
        $pizza->description = $validatedData['description'];
        $pizza->prix = $validatedData['prix'];
        $pizza->save();

       return redirect('/pizzas');
        // return redirect()->route('pizzas.index');
    }

// modifier le nom et la desc d'une pizza, ça dirige vers le formulaire de modification
    public function edit(Pizza $pizza)
    {
        return view('modifier', ['pizza' => $pizza]);
    }

// traiter la soumission du formulaire
    public function update(Request $request, Pizza $pizza)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $pizza->nom = $validatedData['nom'];
        $pizza->description = $validatedData['description'];
        $pizza->save();

        return redirect()->route('pizzas.index');
    }


public function destroy(Pizza $pizza)
{
    $pizza->delete();
    return redirect()->route('pizzas.index');
}


    public function addToCart(Request $request, $id)
    {
        $qte = $request->input('qte');
        $pizza = pizza::findOrFail($id);
        $cart = session()->get('cart');

        if(session()->has('cart')) {
            if(isset($cart[$pizza->id])) {
                $cart[$pizza->id]['qte'] = $qte ;
                $cart[$pizza->id]['total'] = $pizza->prix * $qte ;
                session()->put('cart', $cart);
                return redirect()->route('pizzas.index')->with('success', 'Pizza ajoutée au panier avec succès!');
            } else {
                $cart[$id] = [
                    'total'=>$pizza->prix * $qte,
                    'id'=> $id,
                    'nom'=>$pizza->nom,
                    'qte'=>$qte,
                    'prix'=>$pizza->prix
                ];

                session()->put('cart', $cart);
                return redirect()->route('pizzas.index')->with('success', 'Pizza ajoutée au panier avec succès!');
            }
        } else {
            $cart[$id] = [
                'total'=>$pizza->prix * $qte,
                'id'=> $id,
                'nom'=>$pizza->nom,
                'qte'=>$qte,
                'prix'=>$pizza->prix
            ];

            session()->put('cart', $cart);
            return redirect()->route('pizzas.index')->with('success', 'Pizza ajoutée au panier avec succès!');
        }
    }



}
