<?php

$btValider = filter_input(INPUT_POST, "btnValider");

if (isset($btValider)) {
    header("location:./views/showBD.phtml");
}

include("./views/index.phtml");
