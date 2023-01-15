<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MathPHP\Probability\Combinatorics;

class TestController extends Controller
{

    public function sort(){


        //declaration of data set
        $sourceDataSet = [23,22,12,7,5,4,3,1];

        // Retrieve all combinations as Utility
        $permtuationList = \Math\Combinatorics\Permutation::get($sourceDataSet, 8);

        $aa = $permtuationList;
        $response = [];

        //iterate on array combinations
        for ($mm = 0; $mm<sizeof($aa); $mm++){
            $test = $aa[$mm];
            $test1 = $aa[$mm];
            $length = sizeof($aa[$mm]);
            $inner_loop_counter = 0;

            //outer loop declaration
            $add4 = 0;
            $cmp8 = 0;
            $mmv4 = 0;
            $mmv8 = 0;

            //inner loop declaration
            $cmp8_inner = 0;
            $cmp4_inner = 0;
            $add4_inner = 0;
            $mmv4_inner = 0;
            $mmv8_inner = 0;

            //mmv4 1 time
            $i =0;
            $mmv4 = $mmv4 +1;

            //add4 1 time
            $n = $length - 1;
            $add4 = $add4 + 1;

            //mmv4 1 time
            $mmv4 = $mmv4 +1;

            //add 4 1 time
            $cmp4 = $length;

            for(; $i < $n ;$i++) {
                //add 4 n-1 times
                $add4 = $add4 + 1;

                //mmv8 n-1 times
                $small = $test[$i];
                $mmv8 = $mmv8 + 1;

                //mmv4 n-1 times
                $k = $i;
                $mmv4 = $mmv4 +1;

                //mmv4 n-1 times
                $j = $i + 1;
                $mmv4 = $mmv4 +1;

                //add 4 n-1 times
                $add4 = $add4 + 1;

                //cmp 4 n times
                $cmp4_inner = $cmp4_inner+1;

                //inner loop
                for(; $j < $length; $j++) {

                    $add4_inner = $add4_inner +1;
                    $cmp4_inner = $cmp4_inner+1;
                    $cmp8_inner = $cmp8_inner+1;
                    if($small > $test[$j]) {
                        $small = $test[$j];
                        $mmv8_inner = $mmv8_inner + 1;
                        $k = $j;
                        $mmv4_inner = $mmv4_inner + 1;
                        $inner_loop_counter = $inner_loop_counter + 1;
                    }
                }

                //mmv n-1 times
                $test[$k] = $test[$i];
                $mmv8 = $mmv8 +1;

                //mmv8 n-1 times
                $test[$i] = $small;
                $mmv8 = $mmv8 +1;
            }

            //vertical sums
            $vertical_add4 = $add4 + $add4_inner;
            $vertical_cmp4 = $cmp4 + $cmp4_inner;
            $vertical_cmp8 = $cmp8 + $cmp8_inner;
            $vertical_mmv4 = $mmv4 + $mmv4_inner;
            $vertical_mmv8 = $mmv8 + $mmv8_inner;

            //8 byte to 4 bytes
            $cmp_in_4_byte = $vertical_cmp4 + 2*($vertical_cmp8);
            $mmv_in_4_byte = $vertical_mmv4 + 2*($vertical_mmv8);

            //response generation
            $result = [
                'Test Array' => $test1,
                'Sorted Array' => $test,
                'Inner Loop (Loop Invariant)'=>$inner_loop_counter,
                'add4' => $add4,
                'cmp4' => $cmp4,
                'mmv4' => $mmv4,
                'mmv8' => $mmv8,
                'cmp8' => $cmp8,
                'cmp4_inner' => $cmp4_inner+1,
                'cmp8_inner' => $cmp8_inner,
                'add4_inner' => $add4_inner,
                'mmv4_inner' => $mmv4_inner,
                'vertical_add4' => $vertical_add4,
                'vertical_cmp4' => $vertical_cmp4,
                'vertical_cmp8' => $vertical_cmp8,
                'vertical_mmv4' => $vertical_mmv4,
                'vertical_mmv8' => $vertical_mmv8,
                'G-total' => $vertical_add4 + $cmp_in_4_byte + $mmv_in_4_byte + 1
            ];
            array_push($response, $result);
        }

        //save in file
        Storage::put('attempt1.txt', json_encode($response));

        //return response
        return response()->json($response);
    }

}
