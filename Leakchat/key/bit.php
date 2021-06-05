<?php if(!defined('s7V9pz')) {die();}?>
<?php
function cnf($v = "cnf") {
    $cnf["cnf"] = array(
        "mode" => 1,
        "name" => "Grupo - Baevox Framework",
        "tag" => "Something Beyond Limits",
        "poet" => "Baevox",
        "url" => "http://test.estudycentre.com/",
        "region" => "Asia/Kolkata",
        "knob" => "knob",
        "door" => "door",
        "gem" => "gem",
        "bit" => "s7V9pz",
        "chief" => "admin",
        "codeword" => "pass",
        "samesite" => "Strict",
        "ext" => "xml",
        "global" => "1",
        "appversion" => 1,
    );
$cnf["Grupo"] = array(
                'host' => 'localhost',
                'db' => 'u398081410_leakchat_leakc',
                'user' => 'u398081410_leakchat_leakc',
                'pass' => 'L0o/8&smia^',
                'prefix' => 'gr_'
                );
if ($v == "all") {
return $cnf;
} 
else if (isset($cnf[$v])) {
return $cnf[$v];
}
}
?>

