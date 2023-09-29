 <?php

// args list: arg1: style
// acceptable values: "art", "arcane_caitlyn", "arcane_jinx", "disney", "jojo", "jojo_yasuho", "sketch_multi"
// $style = "arcane_jinx";
echo '<pre>';

$command = 'source env/bin/activate; python evaluate.py';

$output = null;
$retval = null;

// spawn a shell and run the command
exec($command, $output, $retval);

//todo remove before deploy
echo "Returned with status $retval and output:\n";
print_r($output);


echo '</pre>';
?> 

