<?php


// args list: arg1: style
// acceptable values: "art", "arcane_caitlyn", "arcane_jinx", "disney", "jojo", "jojo_yasuho", "sketch_multi"
$style = "arcane_jinx";

$command = "python -u evaluate.py --model_name ${style}";
exec($command, $output);
//var_dump($output);


//echo $str_output;
//echo "hello";


?>