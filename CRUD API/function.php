<?php
function msg($msg,$code){
    echo json_encode($msg);
    http_response_code($code);
}