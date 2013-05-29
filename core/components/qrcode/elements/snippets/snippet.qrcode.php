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
* @version 1.0.0
*
*/
if(empty($modx) || !($modx instanceof modX)) return '';

$modelPath = (string)$modx->getOption('qrcode.core_path',null,$modx->getOption('core_path').'components/qrcode/').'model/';

$config=array();
$config['input']=(string)$modx->getOption('input',$scriptProperties);  //Кодируемая строка

$config['method'] = (string)$modx->getOption('method',$scriptProperties,'png'); //Метод конвертации png, svg, text, eps
$config['mode'] = (string)$modx->getOption('mode',$scriptProperties,'L'); //Режим корректности ошибок. L - 7%, M - 15%, Q - 25%, H - 30%
$config['padding'] = max((int)$modx->getOption('padding',$scriptProperties,'2'),0); // размер белой рамки вокруг кода
$config['dot'] = min(max(intval($modx->getOption('dot',$scriptProperties,'4')),1),10); //1...10 размер каждого квадрата в коде (в px).
$config['replace'] = intval($modx->getOption('replace',$scriptProperties,'0')); //Замена файла
$config['folder'] = trim((string)$modx->getOption('folder',$scriptProperties,'QRcode'),'/'); //Папка куда сохранять картинку
$config['filename'] = (string)$modx->getOption('filename',$scriptProperties); //Имя файла куда сохранять картинку
$config['filename'] = $conifg['filename']=='' ? sha1($config['input']) : $config['filename'];

$options = (string)$modx->getOption('options',$scriptProperties);
if($options!=''){
    $options=explode("&",$options);
    foreach ($options as $value) {
        $params = explode("=", $value,2);
        if(isset($config[$params[0]])){
            $config[$params[0]] = $params[1];
        }
        
    }
}
$flag = false;
switch(true){
    case ($config['input']==''): {
        $modx->log(modX::LOG_LEVEL_DEBUG,'[QRCode] text is empty, aborting.'); 
		break;
	}
	case (!in_array($config['mode'],array('L','M','Q','H'))): {
		$modx->log(modX::LOG_LEVEL_ERROR,'[QRCode] unknown mode'); 
		break;
	}
	case (!file_exists($modelPath.'qrcode/phpqrcode.php')):{
		$modx->log(modX::LOG_LEVEL_DEBUG,'[QRCode] file with class QRCode not found');
		break;
	}
	case (!class_exists('QRcode',false)):{
		include_once($modelPath.'qrcode/phpqrcode.php');
		if(class_exists('QRcode',false)){
			$flag = true;
		}
		break;
	}
	case (!method_exists('QRcode',$config['method'])):{
		$modx->log(modX::LOG_LEVEL_ERROR,'[QRCode] unknown method QRcode generate'); 
		break;
	}
	default:{
		$flag = true;
	}
}

if($flag){
    $config['folder'] .= '/'. $config['mode'].'/'.$config['dot'].'-'.$config['padding'];
    $out = $config['folder'].'/'.$config['filename'].'.'.$config['method'];
    $fullpath = $modx->getOption('assets_path').$config['folder'].'/';
    
    $modx->getService('fileHandler','modFileHandler');
    $dir = $modx->fileHandler->make($fullpath,array(),'modDirectory');
    if(!is_object($dir) || !($dir instanceof modDirectory)) {
        $modx->log(modX::LOG_LEVEL_ERROR,'[QRCode] not a directory');
    }
    $dir->create();
    
    if($config['replace'] || (!$config['replace'] && !file_exists($modx->getOption('assets_path').$out))){
        QRcode::$config['method'](
        	$config['input'],
    		$modx->getOption('assets_path').$out,
    		$config['mode'],
    		$config['dot'],
    		$config['padding']
    	);
    }
}else{
	$out = '';
}
return $out;