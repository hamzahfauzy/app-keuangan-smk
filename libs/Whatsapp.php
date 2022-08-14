<?php

class Whatsapp
{
    
    static function send($to, $message)
    {
        $conn = conn();
        $db   = new Database($conn);

        return $db->insert('messages',[
            'message_content' => $message,
            'message_to' => $to,
            'message_type' => 'whatsapp',
            'status' => 'queued',
        ]);
    }
    
    static function sent($to, $message)
    {
        if(empty(config('wa_api_key')) || !empty(config('wa_sender')))
        {
            return false;
        }
        $data = [
            'api_key' => config('wa_api_key'),
            'sender'  => config('wa_sender'),
            'number'  => $to,
            'message' => $message
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://wa.webisniz.com/app/api/send-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data))
        );
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
    }
}
