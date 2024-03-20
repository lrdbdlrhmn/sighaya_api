<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ImageController extends BaseController
{
  /*
    public function index()
    {
    # code...
        
    }
//
*/
  public function check_balance($id)
  {
        $invoice_ref = $id;
        if (!isset($invoice_ref)) {
            # code...
            return $this->sendError('not_found','error');
        }
        $response = new ApiController();
        $user = $response->user_info($invoice_ref);

        if (!isset($user)) {
            # code...
            return $this->sendError('not_found','error');
        }
        return [
          'result' => [
            'status' => 'ok',
            'user' => $user
          ]
        ];
  }

  public function invoiceHtml($id)
  {
  # code...
      $invoice_ref = $id;
      if (!isset($invoice_ref)) {
        # code...
      }
      $response = new ApiController();
      $user = $response->user_info($invoice_ref);
      if (!isset($user)) {
        # code...

      }
      $header_with_details = $response->header_with_details($invoice_ref);

      if (!isset($header_with_details)) {
        # code...
      }
      $html = view('invoices.show',[
        'header_with_details' => $header_with_details,
        'user' => $user,
        'invoice_ref' => $invoice_ref
      ]);
      return $html;
    }
  /*
  public function invoice($invoice_ref)
  {
    //$pdf = Browsershot::url('http://127.0.0.1:8000/invoiceHtml/'.$invoice_ref)->format('A4');

  }

  public function show(Request $request)
  {
    $report = Report::find($request->id);
    
    if ($report->image->attached) {
        # code...
        throw new Exception("Error Processing Request", 1);
        
    }
    //send_data report.image.download, filename: report.image.filename.to_s, content_type: report.image.content_type
  }
  */
}
