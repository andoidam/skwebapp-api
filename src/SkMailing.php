<?php

namespace SkMailing;

class SkMailing
{


    //*********************** Send Mail ************************
    public function sendmail($data, $message_id, $response_format = 'json')
    {
        $result['status'] = false;
        $result['message'] = '';

        if ($message_id != null && !empty($message_id)) {
            $result['status'] = true;
        } else {
            $result['status'] = false;
            $result['message'] = 'You must provide a Message id';
        }

        if ($result['status'] && $data != null && isset($data['email']) && $this->isMailValid($data['email'])) {
            $result['status'] = true;
        } else {
            $result['status'] = false;
            $result['message'] = 'You must provide a valid Address Mail';
        }

        if ($result['status']) {

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
            $result['result'] = json_decode($http_responder, true);
        }

        if ($response_format == 'json') {
            return json_encode ($result);
        } else {
            return $result;
        }
    }
    //********************* Subscription ************************
    public function subscribe_to_ml($data, $ml_id, $response_format = 'json')
    {
        $result['status'] = false;
        $result['message'] = '';

        if ($ml_id != null && !empty($ml_id)) {
            $result['status'] = true;
        } else {
            $result['status'] = false;
            $result['message'] = 'You must provide a Message id';
        }

        if ($result['status'] && $data != null && isset($data['email']) && $this->isMailValid($data['email'])) {
            $result['status'] = true;
        } else {
            $result['status'] = false;
            $result['message'] = 'You must provide a valid Address Mail';
        }

        if ($result['status']) {
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
            $result['result'] = json_decode($http_responder, true);
        }

        if ($response_format == 'json') {
            return json_encode ($result);
        } else {
            return $result;
        }
    }


    //************ Mail validation *******************//   
    public function isMailValid($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}
