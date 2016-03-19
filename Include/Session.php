<?php

session_start();
function Message(){
    if(isset($_SESSION["message"])){
        $Output="<div class=\"message\">";
        $Output .= htmlentities($_SESSION["message"]);
        $Output .="</div>";
        $_SESSION["message"]=null;
        return $Output;
        
        
    }
}
function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
        $Output="<div class=\"SuccessMessage\">";
        $Output .= htmlentities($_SESSION["SuccessMessage"]);
        $Output .="</div>";
        $_SESSION["SuccessMessage"]=null;
        return $Output;
        
        
    }
}
?>