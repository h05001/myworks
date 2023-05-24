<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class ProbabilityController extends Controller
{
    public function calculation(Request $request)
    {
//P = 1 - ( n-aCr / nCr )
//n＝デッキ枚数
//a＝投入枚数
//r＝ドロー枚数
//dd($request);
//Numerator:分子
//denominator:分母
        $probability_arr = array();
        $numerator = 1;
        $denominator = 1;
        $deck = $request->deck;//40
        $card_A = (int)$request->card_A;//3
        $card_B = (int)$request->card_B;//3
        $draw = (int)$request->draw;//5

        for($j=$draw;$j<12;$j++){
            if ($card_A != 0 && $card_B == 0) {
                $numerator = $this->Combination($deck-$card_A,$j);
                $denominator = $this->Combination($deck,$j);
//dd($card_A);
            }
            if ($card_A != 0 && $card_B != 0) {
                $numerator_a = $this->Combination($deck-$card_A-$card_B,$j);
                $numerator_b = $this->CombinationCase($deck,$card_A,$card_B,$j);
                $numerator = $numerator_a + $numerator_b;
                $denominator = $this->Combination($deck,$j);
            }
                $probability = round((1 - ($numerator / $denominator)) * 100,1);
                $horizontal[] = $j;
                $vertical[] = $probability;
                $probability_arr[$j] =  $probability;

        }


        //$request->session()->put('key', 'value');
            // $request->session()->put('deck', $request->deck);
            // $request->session()->put('card_A', $request->card_A);
            // $request->session()->put('card_B', $request->card_B);
            // $request->session()->put('draw', $request->draw);
            //$request->session()->put('deck' => $request->deck, 'card_A' => $request->card_A, 'card_B' => $request->card_B, 'draw' => $request->draw);
            $history_arr['deck'] = $request->deck;
            $history_arr['card_A'] = $request->card_A;
            $history_arr['card_B'] = $request->card_B;
            $history_arr['draw'] = $request->draw;
            $history_arr['probability'] = reset($probability_arr);
      //dd($history_arr);
            $request->session()->push('history', $history_arr);
            $data = $request->session()->get('history');
            //dd($data);
            $count = count($data);
            if(5 < $count ){
                $data = session()->pull('history', []);
                $first = array_shift($data);
                // if(($key = array_search($idToDelete, $data)) !== false) {
                //     unset($data[$key]);
                // }
                session()->put('history', $data);


            }
            //dd($card_B);

        return view('admin.probability.calculation', [  "deck" => $deck, "card_A" => $card_A, "card_B" => $card_B,
                                                        "vertical" => $vertical, "horizontal" => $horizontal,
                                                        "probability_arr" => $probability_arr

                                                    ]);

    }
    public function Combination($n,$r)//
    {
        $numerator = 1;
        $denominator = 1;
        for($i=0;$i<$r;$i++){

            $num = abs($n - $i);//分子
            $den = abs(1 + $i);//分母
            $numerator *= $num;//37*36*35*34*33*32 = 1,673,844,480
            $denominator *= $den;//40*39*38*37*36*35 = 2,763,633,600

        }

        return $numerator/$denominator;
    }

    public function CombinationCase($deck,$card_A,$card_B,$draw)
    {
        $numerator_A = 0;
        $denominator_A = 0;
        $numerator_B = 0;
        $denominator_B = 0;
        for($i=0;$i<$card_A;$i++){
            $num_A = $this->Combination($card_A,$card_A-$i) * $this->Combination($deck-$card_A-$card_B,$draw-$card_A+$i);//3C3 * 34C2
            $numerator_A += $num_A;
        }
        for($i=0;$i<$card_B;$i++){
            $num_B = $this->Combination($card_B,$card_B-$i) * $this->Combination($deck-$card_A-$card_B,$draw-$card_B+$i);
            $numerator_B += $num_B;
        }

        return ($numerator_A + $numerator_B);
    }

}
// public function CombinationCase($deck,$card_A,$card_B,$draw)
// {
//     $numerator_A = 0;
//     $denominator_A = 0;
//     $numerator_B = 0;
//     $denominator_B = 0;
//     for($i=0;$i<$card_A;$i++){
//         $num_A = $this->Combination($card_A,$card_A-$i) * $this->Combination($deck-$card_A-$card_B,$draw-$card_A+$i);
//         $numerator_A += $num_A;
//     }
//     for($i=0;$i<$card_B;$i++){
//         $num_B = $this->Combination($card_B,$card_B-$i) * $this->Combination($deck-$card_A-$card_B,$draw-$card_B+$i);
//         $numerator_B += $num_B;
//     }
//     //$denominator = $this->Combination($deck,$draw);
//     //dd($numerator_B);
//     return ($numerator_A + $numerator_B); // $denominator;
// }
// for($i=0;$i<$j;$i++){
//
//     $num = abs($deck - $card - $i);//分子
//     $den = abs($deck - $i);//分母
//     $numerator *= $num;//37*36*35*34*33*32 = 1,673,844,480
//     $denominator *= $den;//40*39*38*37*36*35 = 2,763,633,600
//     //dd($deck);
//     //0.605668016194332
// }
//dd($probability_arr);
// $horizontal = array_keys((array)json_encode($probability_arr));
// $vertical = array_values((array)json_encode($probability_arr));
//dd($horizontal);
