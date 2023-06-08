<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\History;
use App\Models\Personal_access_tokens;
use Illuminate\Support\Str;

class ExcelApiController extends Controller
{
    public function index()
    {   
        return Category::all();
    }    
    
    public function status()
    {
        return History::orderByDesc('id')->first();
    }

    public function show($id)
    {                
        return Category::where('lm',$id)->first();
    }

    public function update(Request $request, $id)
    {                 
        $request->validate([            
            'name' => 'nullable|string',
            'free_shipping' => 'nullable|in:yes,no',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
        ]);
        
        $category = Category::where('lm',$id)->first();                
        $category->update($request->all());      
        $category->save();          
    }

    public function destroy($id)
    {        
        Category::where('lm',$id)->first()->delete();
        return 'Dados Deletados com sucesso!';
    }
}
