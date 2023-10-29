<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Foods;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $foods = DB::select("SELECT * FROM foods WHERE Inactive = 0");
        return View('foods.index', ['data' => $foods]);
    }
    public function GetAllFood()
    {
        //
        $foods = DB::select("SELECT * FROM foods WHERE Inactive = 0");
        return View('foods.fooditem', ['data' => $foods]);
    }
    public function SearchFood($item)
    {
        //
        $foods = DB::select("SELECT * FROM foods WHERE Inactive = 0 AND Category = '". $item."'");
        return View('foods.index', ['data' => $foods]);
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
        $foodname = $request->foodname;
        $category = $request->category;
        $description = $request->description;
        $price = $request->price;
        //
        if($request->file('image') != ''){
            $tempImage = $request->file('image');
            $reImage = time() . '.' . $tempImage->getClientOriginalExtension();
            $dest = public_path('images');
            $tempImage->move($dest, $reImage);


            $image = $reImage;

            $food = DB::table('foods')->insert([
                'food_name' => $foodname,
                'category' => $category,
                'price' => $price,
                'description' => $description,
                'image' => $image,
                'create_by' => 1,
                'Inactive' => 0
            ]);

        }
        else{

            $food = DB::table('foods')->insert([
                'food_name' => $foodname,
                'category' => $category,
                'price' => $price,
                'description' => $description,
                'image' => '',
                'create_by' => 1,
                'Inactive' => 0
            ]);
        }

        $data = DB::table('foods')->get();
        return view('foods.index', ['data' => $data]);
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
        $foods = DB::select('SELECT * FROM foods WHERE id = ' . $id);

        return View('foods.editfood', ['data' => $foods]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        if ($request->file('image') != '') {
            $tempImage = $request->file('image');

            $reImage = time() . '.' . $tempImage->getClientOriginalExtension();
            $dest = public_path('images');
            $tempImage->move($dest, $reImage);

            $update = DB::update("UPDATE foods SET food_name = '$request->foodname', category = '$request->category', price = $request->price, image = '$reImage', description = '$request->description' WHERE id = " . $request->id);
        }
        else{
            $update = DB::update("UPDATE foods SET food_name = '$request->foodname', category = '$request->category', price = $request->price,  description = '$request->description' WHERE id = " . $request->id);
        }





        $foods = DB::select("SELECT * FROM foods WHERE Inactive = 0");
        return View('foods.fooditem', ['data' => $foods]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $update = DB::update("UPDATE foods SET Inactive = 1 WHERE id = " . $id);

        $foods = DB::select('SELECT * FROM foods WHERE Inactive = 0');

        return View('foods.index', ['data' => $foods]);
    }
    public function addToCart(Request $request)
    {
        $id = $request->id;
        $product = Foods::findOrFail($id);
        // $product = DB::select('SELECT * FROM foods WHERE id = ' . $id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $id,
                "product_name" => $product->food_name,
                "image" => $product->image,
                "price" => $product->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);


        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }

    public function DecreaseFromCart(Request $request)
    {
        $id = $request->id;
        $product = Foods::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']--;
        } else {
            $cart[$id] = [
                "id" => $id,
                "product_name" => $product->food_name,
                "image" => $product->image,
                "price" => $product->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);


        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }

    public function RemoveFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
            return redirect()->back();
        }
    }

    public function Order(Request $request)
    {
            session()->remove('cart');
            
            session()->flash('success', 'Product successfully removed!');
            return redirect()->back()->with('purchase', $request->subtotal);
        
    }


}
