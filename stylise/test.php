<?php



// args list: arg1: style
// acceptable values: "art", "arcane_caitlyn", "arcane_jinx", "disney", "jojo", "jojo_yasuho", "sketch_multi"
$style = "jojo";

// execute the commmand now
$command_exec = escapeshellcmd("python .\..\jojoGAN/evaluate.py --model_name ${style}");
$str_output = shell_exec($command_exec);



echo $str_output;



?>