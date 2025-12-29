<?php

namespace core;
use DateTime;
/**
 * Wrapper class for basic utility functions
 *
 * @author Przemysław Kudłacik
 */
class Utils {

    public static function addRoute($action, $controller, $roles = null) {
        App::getRouter()->addRoute($action, $controller, $roles);
    }

    public static function addRouteEx($action, $path, $controller, $method, $roles = null) {
        App::getRouter()->addRouteEx($action, $path, $controller, $method, $roles);
    }

    public static function addErrorMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::ERROR), $index);
    }

    public static function addInfoMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::INFO), $index);
    }

    public static function addWarningMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::WARNING), $index);
    }

    private static function _url_maker($action, $params = null) {
        $url = $action;
        if ($params != null && is_array($params)) {
            foreach ($params as $key => $value) {
                if (App::getConf()->clean_urls) {
                    $url .= '/';
                } else {
                    $url .= '&' . $key . '=';
                }
                $url .= $value;
            }
        }
        return $url;
    }

    private static function _url_maker_noclean($action, $params = null) {
        $url = $action;
        if (App::getConf()->clean_urls) {
            $url .= '?';
        }
        if ($params != null && is_array($params)) {
            $first = true;
            foreach ($params as $key => $value) {
                if ($first && App::getConf()->clean_urls){
                    $url .= $key . '=' . $value;
                    $first = false;
                } else {
                    $url .= '&' . $key . '=' . $value;
                }
            }
        }
        return $url;
    }
    public static function URL($action, $params = null) {       
        return App::getConf()->action_url . self::_url_maker($action, $params);
    }

    public static function relURL($action, $params = null) {       
        return App::getConf()->action_root . self::_url_maker($action, $params);
    }

    public static function URL_noclean($action, $params = null) {       
        return App::getConf()->action_url . self::_url_maker_noclean($action, $params);
    }

    public static function relURL_noclean($action, $params = null) {       
        return App::getConf()->action_root . self::_url_maker_noclean($action, $params);
    }

    public static function DB_toDateTime($datetime_str) {
       $format = 'Y-m-d H:i:s';
       $dateTime = DateTime::createFromFormat($format, $datetime_str);
       return $dateTime;
    }

    public static function DB_DateTimeToString($datetime) {
       $format = 'Y-m-d H:i:s';
       return $datetime->format($format);
    }

    public static function isEmptyString($str) {
        return (!isset($str) || trim($str) === '');
    }

    public static function intValidateFromRequest(&$validator, $param, $req_message, $invalid_message=null, $min = null, $max = null) {
        $rules = [
            'int' => true,
            'required_message' => $req_message,
            'validator_message' => $invalid_message,
            'numeric' => true,
            'required' => true,
            'default' => null
        ];

        if ($min !== null) {
            $rules['min'] = $min;
        }
        if ($max !== null) {
            $rules['max'] = $max;
        }
        return $validator->validateFromRequest($param, $rules);
    }

}