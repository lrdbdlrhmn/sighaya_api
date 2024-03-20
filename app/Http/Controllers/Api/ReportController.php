<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends ApplicationController
{
    public function index(Request $request)
    {
        //render json: { reports: all_reports, status: :ok }
        $user = Auth::user();
        return [
            'reports' => $this->all_reports(false, $request, $user),
            'status' => 'ok'
        ];
    }
    public function store(Request $request)
    {
        

        $user = Auth::user();
        $created_at = date('Y-m-d');


        try {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);


            $report = Report::create([
                'report_type' => $request->report_type,
                'latlng' => $request->latlng,
                'description' =>  $request->description,
                'city_id' =>  $request->city_id,
                'state_id' =>  $request->state_id,
                'region_id' => $request->region_id,
                'image' => $imageName,
                'user_id' => $user->id,
                'created_at' => $created_at,
                'updated_at' => $created_at
            ]);
            $notification_ids = User::where('region_id', $request->region_id)->where('user_type', 'manager')->pluck('notification_id');
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
                'headers' => [
                    'Authorization' => 'key=AAAAmfLuy4c:APA91bH_7C6q2ZBGWb7etWET2lkGDPFDUUVpQnR67PU-HiKtg_pkLGASLaRljPiYZKNyBzBOYIkv53UQy_AwYwhJWHOkWVoBKhyK1i_CU_ZwmuCJZzMlZD2UUYEg_YgNHaErAgesyi4C',
                    'Content-Type' => 'application/json'
                ],
                'registration_ids' =>  $notification_ids,
                'data' => [
                    'title' =>  'بلاغ جديد',
                    'data' => 'تم الابلاغ عن مشكلة قي منطقتك',
                ],
            ]);

            if ($res->getStatusCode() == 200) {
                return [
                    'status' => 'ok',
                    'result' => $report
                ];
            }
        } catch (\Throwable $th) {

            return [
                'status' => 'error',
                'result' => $th
            ];
        }
    }
    public function update(Request $request, $id)
    {

        try {
            $current_user = Auth::user();
            $params = $request->all();
            if ($params['report']['action'] == "work_on_it") {
                Report::where('id', $id)->where('status', 'new')->update([
                    'manager_id' => $current_user->id,
                    'technical_id' => $params['report']['technical_id'],
                    'status' => 'technical'
                ]);
                $technical_id = $params['report']['technical_id'];
                $notification_ids = User::where('id', $technical_id)->pluck('notification_id');
                
                $client = new \GuzzleHttp\Client();


                $res = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
                    'headers' => [
                        'Authorization' => 'key=AAAAmfLuy4c:APA91bH_7C6q2ZBGWb7etWET2lkGDPFDUUVpQnR67PU-HiKtg_pkLGASLaRljPiYZKNyBzBOYIkv53UQy_AwYwhJWHOkWVoBKhyK1i_CU_ZwmuCJZzMlZD2UUYEg_YgNHaErAgesyi4C',
                        'Content-Type' => 'application/json'
                    ],
                    'registration_ids' =>  $notification_ids,
                    'data' => [
                        'title' =>  'مهمة جديدة',
                        'data' => 'تم تكليفك بمعاينة مشكلة جديدة',
                    ],
                ]);
                if ($res->getStatusCode() == 200) {
                    return ['status' => 'error', 'message' => 'taken'];
                }

            } else {

                Report::where('id', $id)->where('status', 'new')->update([
                    'status' => 'solved'
                ]);
                $user_id = Report::where('id', $id)->select('user_id')->first();
                if (isset($user_id)) {
                    # code...
                    $user_id = $user_id['user_id'];
                }
                $notification_ids = User::where('id', $user_id)->pluck('notification_id');

                $client = new \GuzzleHttp\Client();
                $res = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
                    'headers' => [
                        'Authorization' => 'key=AAAAmfLuy4c:APA91bH_7C6q2ZBGWb7etWET2lkGDPFDUUVpQnR67PU-HiKtg_pkLGASLaRljPiYZKNyBzBOYIkv53UQy_AwYwhJWHOkWVoBKhyK1i_CU_ZwmuCJZzMlZD2UUYEg_YgNHaErAgesyi4C',
                        'Content-Type' => 'application/json'
                    ],
                    'registration_ids' =>  $notification_ids,
                    'data' => [
                        'title' =>  'تم حل المشكلة التي ابلغتم عنها',
                        'data' => 'نشكرك على تعاونكم، لقد تم حل المشكلة التي ابلغتم عنها ',
                    ],
                ]);


                if ($res->getStatusCode() == 200) {
                    return ['status' => 'error', 'message' => 'taken'];
                }
                return ['status' => 'error', 'message' => 'taken'];
            }

            return ['status' => 'ok'];
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return ['status' => 'error', 'message' => 'error : ' . $th];
        }
    }

    public function technical_update(Request $request, $id)
    {

        try {
            $current_user = Auth::user();
            $params = $request->all();

            Report::where('id', $id)->update([
                'status' => $params['status']
            ]);
            $user_id = Report::where('id', $id)->select('user_id')->first();
            if (isset($user_id)) {
                # code...
                $user_id = $user_id['user_id'];
            }
            $notification_ids = User::where('id', $user_id)->pluck('notification_id');

            $client = new \GuzzleHttp\Client();


            $res = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
                'headers' => [
                    'Authorization' => 'key=AAAAmfLuy4c:APA91bH_7C6q2ZBGWb7etWET2lkGDPFDUUVpQnR67PU-HiKtg_pkLGASLaRljPiYZKNyBzBOYIkv53UQy_AwYwhJWHOkWVoBKhyK1i_CU_ZwmuCJZzMlZD2UUYEg_YgNHaErAgesyi4C',
                    'Content-Type' => 'application/json'
                ],
                'registration_ids' =>  $notification_ids,

                'data' => [
                    'title' =>  'تم حل المشكلة التي ابلغتم عنها',
                    'data' => 'نشكرك على تعاونكم، لقد تم حل المشكلة التي ابلغتم عنها ',
                ],
            ]);


            return ['status' => 'ok'];
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return ['status' => 'error', 'message' => 'error : ' . $th];
        }
    }
}
