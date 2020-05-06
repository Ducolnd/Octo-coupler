<?php

    function logg( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    function html($tag, $content, $class="", $link = "", $id = "", $value = "") {
        $html = "<{$tag}";
        if($class) {
            $html .= " class='{$class}'";
        } 
    
        if($id and $value) {
            $html .= " onclick='doPost($value, $id)'";
        }

        if($link or $tag == "a") {
            $html .= " href='{$link}' ";
        }
        $html .= ">";

        if(gettype($content) == "array") {
            foreach($content as $ht) {
                $html .= "{$ht}";
            }
            
        } else {
            $html .= "{$content}";
        }

        $html .= "</{$tag}>";

        return $html;

    }

?>