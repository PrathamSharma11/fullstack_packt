<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{


public function store(){
    try {
        $api_url = 'https://fakerapi.it/api/v1/books?_quantity=100 ';
        $response = Http::get($api_url);
        $data = json_decode($response->body(), true);

        foreach ($data['data'] as $post) {

            Product::updateOrCreate(
                ['id' => $post['id']],
                [
                    'id' => $post['id'],
                    'title' => $post['title'],
                    'author' => $post['author'],
                    'genre' => $post['genre'],
                    'description' => $post['description'],
                    'isbn' => $post['isbn'],
                    'image' => $post['image'],
                    'published' => $post['published'],
                    'publisher' => $post['publisher']
                ]
            );
        }

        return response()->json(['message' => 'Data stored successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function display(){
    $data=Product::all();
    return response()->json(['data' => $data], 200);

}

public function save(Request $a) {
    $file = $a->file('image');
    $filename = 'image' . time() . '.' . $a->image->extension();


    if ($file->move("upload/", $filename)) {
        $data = new Product();
        $data->title = $a->title;
        $data->author = $a->author;
        $data->genre = $a->genre;
        $data->description = $a->description;
        $data->isbn = $a->isbn;
        $data->image = $filename;
        $data->published = $a->published;
        $data->publisher = $a->publisher;

        $data->save();

        if ($data) {

            return response()->json(['message' => 'Product created successfully'], 200);
        }
    }


    return response()->json(['error' => 'File upload failed'], 500);
}


public function view($id)
{
    $data = Product::find($id);

    if ($data) {
        return response()->json(['data' => $data], 200);
    } else {
        return response()->json(['error' => 'Product not found'], 404);
    }
}




public function update(Request $request, $id)
{
    $data = Product::find($id);

    if (!$data) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    try {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'image' . time() . '.' . $file->getClientOriginalExtension();
            $file->move("upload/", $filename);
            $data->image = $filename;
        }

        // Update only the provided fields
        $fillableFields = ['title', 'author', 'genre', 'description', 'isbn', 'published', 'publisher'];
        foreach ($fillableFields as $field) {
            if ($request->has($field)) {
                $data->$field = $request->input($field);
            }
        }

        $data->save();

        return response()->json(['message' => 'Product updated successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}




public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $deleted = $product->delete();

        if ($deleted) {
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete product'], 500);
        }
    }




    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $products = Product::search($query)->get();
        } else {

            $products = Product::all();
        }

        return response()->json(['products' => $products]);
    }


}
