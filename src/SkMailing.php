<?php

namespace SkMailing;

class SkMailing
{

    //*********************** Send Mail ************************
    public function sendmail($data, $message_id, $response_format = 'json')
    {
        if ($data != null && $message_id != null){

                $curl_handler = curl_init();
                curl_setopt($curl_handler, CURLOPT_URL, 'http://localhost/mailing-list/asm/' . $message_id);
                //curl_setopt($curl_handler, CURLOPT_URL, $this->getSetting('MAIL_SERVICE_URL_SEND_MESSAGE', true) . $message_id);
                curl_setopt($curl_handler, CURLOPT_VERBOSE, true);
                curl_setopt($curl_handler, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl_handler, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl_handler, CURLOPT_POST, true);
                //$data['api_key'] = Configure::read('Global.gooconsole_mailing_api_key');
                $fields_string = http_build_query($data);
                curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $fields_string);
                $http_responder = curl_exec($curl_handler);
                //debug($http_responder);
                //$this->log_info($http_responder);
                curl_close($curl_handler);
                if($response_format == 'json'){
                    return $http_responder;
                }else{
                    return json_decode($http_responder, true);
                }      
        }
    }

    //********************* Subscription ************************
    public function subscribe_to_ml($data, $ml_id, $response_format = 'json')
    {
        if ($data != null && $ml_id != null){
                //$data = array_merge($data, $this->addDefaultDataToDataToSend());
                $curl_handler = curl_init();
                curl_setopt($curl_handler, CURLOPT_URL, 'http://localhost/mailing-list/asm/' . $ml_id);
                //curl_setopt($curl_handler, CURLOPT_URL, $this->getSetting('MAIL_SERVICE_URL_SUBSCRIBE', true) . $ml_id);
                curl_setopt($curl_handler, CURLOPT_VERBOSE, true);
                curl_setopt($curl_handler, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl_handler, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl_handler, CURLOPT_POST, true);
                //$data['api_key'] = Configure::read('Global.gooconsole_mailing_api_key');
                $fields_string = http_build_query($data);
                curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $fields_string);
                $http_responder = curl_exec($curl_handler);
                curl_close($curl_handler);
                if($response_format == 'json'){
                    return $http_responder;
                }else{
                    return json_decode($http_responder, true);
                }
        }
    }
}