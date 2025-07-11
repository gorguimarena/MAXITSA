<?php

function dd($data) : void {
    echo '<pre>';
    echo $data;
    echo '</pre>';
    die();
}