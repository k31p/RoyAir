<?php 
use Illuminate\Support\Facades\DB;

    function generateKode($table, $prefix){    
        $table = DB::table($table)
        ->select("id_".$table." AS id")
        ->orderBy("id_".$table, 'desc')
        ->limit(1)
        ->get();

        if ($table->isEmpty()) {
            $id = 1;
        }
        else{
            $id = $table[0]->id + 1;
        }

        return "$prefix".$id;
    }

?>