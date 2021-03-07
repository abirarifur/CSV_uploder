<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploaderController extends Controller
{
    public function index()
    {
        $tables_in_db = DB::select('SHOW TABLES');
        $db = "Tables_in_".env('DB_DATABASE');
        $tables = [];
        foreach($tables_in_db as $table){
            $tables[] = $table->{$db};
        }
        return view('welcome', compact('tables'));
    }
    public function uploader(Request $request)
    {
        $fileD = fopen($request->csvfile, "r");
        while (!feof($fileD)) {
            $rowData[] = fgetcsv($fileD);
        }
        foreach ($rowData as $key => $value) {
            if ($value == false) {
                break;
            }
            $inserted_data = array(
                'id' => $value[0],
                'name' => $value[1],
                'price' => $value[2],
            );
            try {
                Book::create($inserted_data);
            } catch (QueryException $e) {
                if($e->errorInfo[0] == '23000'){
                    return redirect()->back()->with('errorQuery', 'DUPLICATE ENTRY: Your Data Is Alredy Exists.');
                }
                if($e->errorInfo[0] == '22007'){
                    return redirect()->back()->with('errorQuery', 'Incorrect integer value: Your Data Is Not Valid.');
                }
            }
        }
        return redirect()->back()->with('success', 'Upload Successfully.');
    }
}
