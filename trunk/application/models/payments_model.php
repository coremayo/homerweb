<?php
class Payments_model extends Model {
  function Payments_model() {
    parent::Model();
  }

  /**
    * Checks the details of a payment and adds a subscription if valid.
    */
  function addPayment($payment) {
    if (_validate_payment) {
      $payment['autoApproved'] = 'Y';
      $this->db->insert('payment', $payment);
      $this->subscriptions_model->addSub($payment['paymentUser'], $payment['item_number']);
    } else {
      $payment['autoApproved'] = 'N';
      $this->db->insert('payment', $payment);
      _notify_admins($payment);
    }
  }

  /**
    * Checks a payment to see if it is valid.
    */
  function _validate_payment($payment) {
    // TODO: actually validate stuff
    return true;
  }

  /**
    * Used to notify the site admins when a payment does not pass our checks.
    */
  function _notify_admins($payment) {
    // TODO: actually email the site admins
  }
}

