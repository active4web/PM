<?php

function product_link($id)
{
    $id = intval(abs($id));

    $link = base_url().'product/'.$id;

    return $link;
}


?>