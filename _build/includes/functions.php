<?php
/**
* QRCode
* Генератор QR кодов
*
* Copyright 2013 by Agel_Nash <Agel_Nash@xaker.ru>
*
* @category content
* @license GNU General Public License (GPL), http://www.gnu.org/copyleft/gpl.html
* @author Agel_Nash <Agel_Nash@xaker.ru>
* @date 29.05.2012
* @version 1.0
*
*/
/**
 * Functions for building
 */
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    $o = str_replace('<?php','',$o);
    $o = str_replace('?>','',$o);
    $o = trim($o);
    return $o;
}