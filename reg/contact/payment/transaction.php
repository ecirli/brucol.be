<?php

require 'config.php';
require 'system/app.php';

function url_get_contents($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

if (isset($_GET["id"])) {
    $transaction = Braintree\Transaction::find($_GET["id"]);
    $transactionSuccessStatuses = [
        Braintree\Transaction::AUTHORIZED,
        Braintree\Transaction::AUTHORIZING,
        Braintree\Transaction::SETTLED,
        Braintree\Transaction::SETTLING,
        Braintree\Transaction::SETTLEMENT_CONFIRMED,
        Braintree\Transaction::SETTLEMENT_PENDING,
        Braintree\Transaction::SUBMITTED_FOR_SETTLEMENT
    ];

    if (in_array($transaction->status, $transactionSuccessStatuses)) {
        $code = $_GET['code'];
        if (strlen($code) == 7) { 
            $data = getcontents(FORM_DIR.'_database/'.$code.'.txt');
            $total = _total($code.'.txt');
            $data = unserialize($data);

            if (unserialize($data['braintree'])['id'] != $transaction->id) {
                unlink(FORM_DIR.'_database/'.$code.'.txt');
                $trans = [];
                $trans['id'] = $transaction->id;
                $trans['amount'] = $transaction->amount;
                $trans['status'] = $transaction->status;
                $trans['created'] = $transaction->createdAt;
                $trans['updated'] = $transaction->updatedAt;
                $trans['payer'] = $transaction->customer;
                $trans['billing'] = $transaction->billing;

                $myfile = fopen(FORM_DIR."_database/".$code.".txt", "w");
                $result = $data;
                $result['status'] = 'paid';
                $result['braintree'] = serialize($trans);
                $result['braintree_list'][] = serialize($trans);
                $result['paid_amount'] = @$data['paid_amount'] + $transaction->amount;
                fwrite($myfile, serialize($result));
                fclose($myfile);
            }
        } else if (strlen($code) > 7) {
            // Specific handling for codes longer than 7 characters, if necessary.
        }

        $message ='Payment Confirmation.<br> <br> 
            Dear Author, we are glad to inform you that you have successfully completed the payment for '.gc('conf_name_shortest').'.<br>
            You will soon receive an email including the official receipt and the letter of final acceptance.<br> <br> 
            Thank You for the collaboration. <br>
            '.gc('conf_name_shortest').'<br>
            Organizing Committee.';

        alert($message);
    } else {
        $status = $transaction->status.' <br><br>Reason: '.$transaction->processorResponseText.' ('.$transaction->processorResponseCode.')';
        alert('Error: '.$status);
    }
}

?>
<br><br>
<div style="float: left; width: 100%; text-align: center;">
    <a href="https://www.braintreepayments.com/about-braintree" target="_blank"><img src="braintree-badge-wide-light.png" style="width: 260px; opacity: 0.5"></a>
</div>
<style>
    body {overflow: hidden;}
</style>
<script>
    document.title="Payment Success";
</script>
