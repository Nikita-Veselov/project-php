<?php

namespace app\services;
  
class RandomString
{
    private function getWord($file_arr) {
        $num_lines = count($file_arr);
        $last_arr_index = $num_lines - 1;
        $rand_index = mt_rand(0, $last_arr_index);
        $rand_word = $file_arr[$rand_index];
        return $rand_word;
    }
    public function generateString(){
        $firstFile = include __DIR__ . "/../services/dictionary/adj_words.php";
        $secondFile = include __DIR__ . "/../services/dictionary/noun_words.php";    
        return "?" . $this->getWord($firstFile) . "_" . $this->getWord($secondFile);
    }
}