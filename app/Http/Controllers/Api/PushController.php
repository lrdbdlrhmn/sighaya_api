<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PushController
{
    //
    public function send_push($body)
    {
        
        Http::withHeaders([
            'Authorization' => 'Basic YzlmMThkYmEtMWVlNS00NGExLWIzZjAtNDRkYWNkNzUxOTEx',
            'Content-Type' => 'application/json'
        ])->post('https://onesignal.com/api/v1/notifications',
            $body
        );
    # code...
    }
    public function new_report($report)
    {
    # code...
       
        $body['include_player_ids'] = ['2ee6ebd8-ee0b-4bfc-8d1d-bd12e46c3315'];
        $body['data'] = ['type' => 'new_report','id' => $report['id']];
        $body['headings'] = ['en' => 'بلاغ جديد' ];
        $body['app_id'] ='659990e5-57e9-401e-acc7-260799725f30';
        $body['contents'] = ['en' => 'تم الابلاغ عن مشكلة فى منطقتك' ];
        $push_body = json_encode($body);
        $this->send_push($push_body);
    }

    public function to_one($player_id,$title='',$body = '',$type='notify_one')
    {
        if (isset($player_id) || isset($body)) {
            # code...
            return;
        }
        $body['include_player_ids'] = [$player_id];
        $body['data'] = ['type' => $type];

        $body['headings'] = ['en' => $title];
        $body['contents'] = ['en' => $body];
        $push_body = json_encode($body);
        $this->send_push($push_body);
    # code...
        
    }
    
}
