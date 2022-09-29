<?php

namespace App\Imports;


use App\CardDetail;

use App\TrapCardDetail;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\OnEachRow;

class TrapCardDetailImport implements OnEachRow,WithStartRow,ToModel
{
    public function onRow(Row $row)
    {

        $import = CardDetail::create([
          'card_name' => $row[0],
          'ruby' => $row[1],
          'card_text' => $row[2],
        ]);
      
        TrapMonsterCardDetail::create([
          'card_master_id' => $import-> card_master_id,
          'trap_card_class' => $row[4],

        ]);

    }




    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }


}
