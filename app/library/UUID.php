<?php namespace App\Library;
/**
 * Created by IntelliJ IDEA.
 * User: HJ
 * Date: 2015-03-25
 * Time: 오후 4:33
 */

class uuid {

    public static function findUUID($uuid) {
        return self::find(hex2bin($uuid));
    }

    public static function createUUID() {
        $create = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
        $create = str_replace('-','',$create);
        return $create;
    }
}