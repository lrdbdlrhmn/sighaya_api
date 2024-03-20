<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use App\Models\Region;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class HomeController extends ApplicationController
{
    public function report_types($language)
    {
    # code...
        $language_report_types =[
                'ar' => [
                'reason1' => 'انقطاع او نقص فى المياه',
                'reason2' => 'تسرب فى انابيب المياه',
                'reason3' => 'عدم استلام الفاتورة',
                'reason4' => 'خطأ فى قيمة الفاتورة (المطالبة بالتأكد)',
                'reason5' => 'ابلاغ عن عملية احتيال',
                'reason6' => 'أخرى'
                ],
                'fr'=> [
                'reason1' => "Manque d'eau",
                'reason2' => "Fuite d'eau",
                'reason3' => 'Facture non distribuée',
                'reason4' => 'Erreur de relevé (réclamation sur la fact)',
                'reason5' => 'Fraude signalée',
                'reason6' => 'Autre'
                ],
                'en' => [
                'reason1' => 'Lack of water',
                'reason2' => 'Water leak',
                'reason3' => 'Invoice not distributed',
                'reason4' => 'Invoice value is not correct (claim on the fact)',
                'reason5' => 'Fraud reported',
                'reason6' => 'Other'
                ]
            ];
        return $language_report_types[$language];
    }
    //
    public function index(
        Request $request
        )
    {
        $language = App::getLocale();
        
        $current_user = Auth::user();
        if ($current_user->user_type == 'manager') {
            //$regions_par_manager = DB::table('manager_regions')->where('manager_id',$current_user->id)->pluck('region_id'); 
            
            $technicals = User::where('user_type','technical')->where('region_id',$current_user->region_id)->get();
            //->where('manager_id', $current_user->id)
        }else{
            $technicals = [];
        }
        
        //if ($request->query('reload')  == 'true') {
            $result['notifications'] = $this->all_reports(true,$request,$current_user);
            $result['report_types'] = $this->report_types($language);
            $result['technicals'] = $technicals;
            # code...
            $result['user'] = $current_user;
            $result['states'] = State::all();
            $result['cities'] = City::all();
            $result['regions'] = Region::all();
        //}
        return json_encode(
            [
                'result' => $result
            ]
        );
    }
    
    
}
