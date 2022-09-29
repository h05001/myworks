<?php

namespace App\Imports;


use App\CardDetail;
use App\MonsterCardDetail;
use App\MonsterCardClass;
use App\MagicCardDetail;
use App\TrapCardDetail;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\OnEachRow;

class CardDetailImport implements OnEachRow,WithStartRow,ToModel
{
    public function onRow(Row $row)
    {

        $import = CardDetail::create([
          'card_name' => $row[0],
          'ruby' => $row[1],
          'card_text' => $row[2],
        ]);

        // 13_1
        $monsterCardclassArr = explode("_",$row[3]);
        //$monsterCardclassArr[0] 13
        //$monsterCardclassArr[1] 1

        foreach ($monsterCardclassArr as $monsterCardclass) {
          MonsterCardclass::create([
            'card_master_id' => $import-> card_master_id,
            'class_id' => $monsterCardclass
          ]);
        }

        MonsterCardDetail::create([
          'card_master_id' => $import-> card_master_id,
          'property' => $row[4],
          'tribe_id' => $row[5],
          'level_rank_link' => $row[6],
          'scale' => $row[7],
          'pendulum_effect' => $row[8],
          'link_marker' => $row[9],
          'attack' => $row[10],
          'defense' => $row[11],
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
