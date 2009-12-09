<?php

class Purchase extends Controller {
  function Purchase() {
    parent::Controller();
  }

  function index() {
  }

  function buy($classId = '') {
    if($classId) {
      $data['content'] = 'student/purchase';
      $data['classId'] = $classId;
      $this->load->view('student/template', $data);
    }
  }

  /**
    * Handles the instant payment notification from paypal.
    */
  function receivePayment() {
    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';
    foreach ($_POST as $key => $value) {
      $value = urlencode(stripslashes($value));
      $req .= "&$key=$value";
    }

    // post back to PayPal system to validate
    $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

    $fp = fsockopen ('ssl://sandbox.paypal.com', 443, $errno, $errstr, 30);

    if (!$fp) {
      // HTTP ERROR
    } else {
      fputs ($fp, $header . $req);
      while (!feof($fp)) {
        $verified = fgets ($fp, 1024);
        if (strcmp($verified, "VERIFIED") == 0) {
          $payment['paypalVerified'] = 'Y';
          $payment['txn_id'] = $this->input->post('txn_id');
          $payment['item_number'] = $this->input->post('item_number');
          $payment['mc_gross'] = $this->input->post('mc_gross');
          $payment['mc_currency'] = $this->input->post('mc_currency');
          $payment['payer_email'] = $this->input->post('payer_email');
          $payment['payment_date'] = date('Y-m-d H:i:s');
//          $payment['payment_date'] = $this->input->post('payment_date');
          $payment['paymentUser'] = $this->input->post('custom');
          $this->payments_model->addPayment($payment);
        } else if (strcmp($verified, "INVALID") == 0) {
          $payment['paypalVerified'] = 'N';
          $payment['txn_id'] = $this->input->post('txn_id');
          $payment['item_number'] = $this->input->post('item_number');
          $payment['mc_gross'] = $this->input->post('mc_gross');
          $payment['mc_currency'] = $this->input->post('mc_currency');
          $payment['payer_email'] = $this->input->post('payer_email');
          $payment['payment_date'] = $this->input->post('payment_date');
          $payment['paymentUser'] = $this->input->post('custom');
          $this->payments_model->addPayment($payment);
        }
      }
      fclose ($fp);
    }
  }
}
?>
