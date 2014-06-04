<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alisson
 * Date: 19/03/14
 * Time: 08:46
 * To change this template use File | Settings | File Templates.
 */

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

$routeThis = multiexplode(array('/','?'), Route::getCurrentRoute()->getPath());
return array(
    'siteName'              => 'SUSA',
    'MsgAll'                => 'Informação não encontrada!',
    'PathImg'               => '/media/images',

    'routeThis'             => $routeThis,
    'route'                 => '/'.$routeThis[0],
);
