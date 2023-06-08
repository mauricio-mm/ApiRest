<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Category;
use App\Models\History;

class UserController extends Controller
{
    public function index(){
        return Inertia::render('Dashboard',);
    }

    public function upload(Request $request)
    {            
        if ($request->hasFile('file')) {                           

            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            if( $file->getClientOriginalExtension() != 'xlsx' &&  $file->getClientOriginalExtension() != 'csv') return ;
            
            $file = IOFactory::load($file->getRealPath());            
            $sheet = $file->getActiveSheet();            
            // Percorre as células e lê os valores dos campos     
            
            for($i = 4; $i <= $sheet->getHighestRow('A') ; $i++)
            {
                $columnIterator = $sheet->getRowIterator($i)->current()->getCellIterator('A', $sheet->getHighestColumn());
                $columnIterator->setIterateOnlyExistingCells(true);                            

                $data = [];
                foreach ($columnIterator as $cell) {
                    array_push($data,$cell->getValue());
                }    
                
                $Category = Category::create([
                    'user_id' => Auth::id(),
                    'lm' => $data[0],
                    'name' => $data[1],
                    'free_shipping' => $data[2],
                    'description' => $data[3],
                    'price' => $data[4],
                ])->save();   

            }

            History::create([
                'status' => 1,
                'name' => $name,
                'size' => $sheet->getHighestRow('A') - 4
            ]);            

            return back();
        }
    }
    
}
