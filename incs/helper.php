<?php 
/**
 * Create an unique Order No
 * @return [string] 
 */
function build_order_no()
{
    return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}