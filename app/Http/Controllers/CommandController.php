<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commandes;
use App\Models\Product;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
       
        $commandes = Commandes::all();

        $productsWithCoordinates = [];

        foreach ($commandes as $commande) {
            $product = Product::find($commande->productid);
            if ($product) {
                $productsWithCoordinates[] = [
                    'product' => $product,
                    'coordinates' => [
                        'phoneN' => $commande->phoneN,
                        'codeP' => $commande->codeP,
                        'region' => $commande->region,
                        'city' => $commande->city,
                        'date' => $commande->created_at,
                    ],
                ];
            }
        }

    return view('magazin.commande')->with('productsWithCoordinates', $productsWithCoordinates);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $bag = $request->session()->get('cart');
        $request->validate([
            'phonenumber' => 'required|integer',
            'zipcode' => 'required|integer',
            'city' => 'required',
            'region'=> 'required',
        ]);
        foreach ($bag as $productId) {
            Commandes::create([
                'productid'=>$productId,
                'phoneN' => $request->phonenumber ,
                'codeP' =>  $request->zipcode,
                'city' => $request->city ,
                'region'=>  $request->region,
            ]);
        }
        $request->session()->forget('cart');

        return redirect()->route('bag.index')->with('success','success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->nombre -= 1;
        $product->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
