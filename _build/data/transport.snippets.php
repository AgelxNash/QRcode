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
 * @package QRCode
 * @subpackage build
 */
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => PKG_NAME,
    'description' => 'QRcode generator',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.qrcode.php'),
));
$snippets[0]->setProperties(array(
    array(
        'name' => 'input',
        'value' => '',
        'type' => 'textarea',
        'desc' => 'qrcode.input',
        'lexicon' => 'qrcode:properties',
        'options' => '',
    ),
    array(
        'name' => 'method',
        'value' => 'png',
        'type' => 'list',
        'desc' => 'qrcode.method',
        'lexicon' => 'qrcode:properties',
        'options' => array(
            array('text' => 'png','value' => 'png'),
            array('text' => 'svg','value' => 'svg'),
			array('text' => 'text','value' => 'text'),
			array('text' => 'eps','value' => 'eps')
        ),
    ),
    array(
        'name' => 'mode',
        'value' => 'L',
        'type' => 'list',
        'desc' => 'qrcode.mode',
        'lexicon' => 'qrcode:properties',
        'options' => array(
            array('text' => 'L - 7%','value' => 'L'),
            array('text' => 'M - 15%','value' => 'M'),
			array('text' => 'Q - 25%','value' => 'Q'),
			array('text' => 'H - 30%','value' => 'H'),
        ),
    ),
	array(
        'name' => 'padding',
        'value' => '2',
        'type' => 'numberfield',
        'desc' => 'qrcode.padding',
        'lexicon' => 'qrcode:properties',
        'options' => '',
    ),
	array(
        'name' => 'dot',
        'value' => '4',
        'type' => 'list',
        'desc' => 'qrcode.dot',
        'lexicon' => 'qrcode:properties',
        'options' => array(
            array('text' => '1px','value' => '1'),
            array('text' => '2px','value' => '2'),
			array('text' => '3px','value' => '3'),
			array('text' => '4px','value' => '4'),
			array('text' => '5px','value' => '5'),
			array('text' => '6px','value' => '6'),
			array('text' => '7px','value' => '7'),
			array('text' => '8px','value' => '8'),
			array('text' => '9px','value' => '9'),
			array('text' => '10px','value' => '10'),
        ),
    ),
	array(
        'name' => 'replace',
        'value' => '0',
        'type' => 'list',
        'desc' => 'qrcode.replace',
        'lexicon' => 'qrcode:properties',
        'options' => array(
            array('text' => 'true','value' => '1'),
            array('text' => 'false','value' => '0'),
        ),
    ),array(
        'name' => 'folder',
        'value' => 'QRcode',
        'type' => 'textfield',
        'desc' => 'qrcode.folder',
        'lexicon' => 'qrcode:properties'
    ),
	array(
        'name' => 'filename',
        'value' => '',
        'type' => 'textfield',
        'desc' => 'qrcode.filename',
        'lexicon' => 'qrcode:properties'
    ))
);
return $snippets;