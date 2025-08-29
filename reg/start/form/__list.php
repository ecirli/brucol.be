<?php

    error_reporting(0);

    require 'func.php';

    $ptype = isset($_GET['ptype']) ? $_GET['ptype'] : 1111111111111111111;
    $paidq = isset($_GET['paidq']) ? $_GET['paidq'] : 1111111111111111111;
    $nonamep = isset($_GET['nonamep']) ? $_GET['nonamep'] : 1111111111111111111;
    $actit = isset($_GET['actit']) ? $_GET['actit'] : 1111111111111111111;
    $letters = isset($_GET['letters']) ? $_GET['letters'] : 1111111111111111111;
    $papertype = isset($_GET['papertype']) ? $_GET['papertype'] : 1111111111111111111;
    $fps = isset($_GET['fps']) ? $_GET['fps'] : 1111111111111111111;
    

  $new = [];
    $snames = [];
    $spc = [];
    $ptc = [];
    $nameshash = [];
    $spc2 = [];
    if ($handle = opendir(DIR.'_database')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && $file != 'allcap.txt' && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {

          $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
        
          $_code = explode('.', $file)[0];
        
        $acex = explode('-', @$_GET['actit']);
        $acna = [];
        if (@$acex[1]) {
          
          foreach($acex as $aci => $acs) {
            $acna[uniqid()] = md5($acs);
          }
          
          if (!in_array(md5($data['academic_title']), $acna)) continue;
          
        }else {
          if (isset($_GET['actit']) && $actit != 'null' && $actit != $data['academic_title']) continue;
        }
        
       
        $papex = explode('-', @$_GET['papertype']);
        $papea = [];
        if (@$papex[1]) {
          
          foreach($papex as $aci => $acs) {
            $papea[uniqid()] = md5($acs);
          }
          
          if (!in_array(md5($data['paper_type']), $papea)) continue;
          
        }else {
          if (isset($_GET['papertype']) && $papertype != 'null' && $papertype != $data['paper_type']) continue;
        }
        
          if ($data['fee'] == 200) continue;
        
          if (isset($_GET['fps']) && $fps != 'null' && $fps == 'sent' && !$data['fps']) continue;
          if (isset($_GET['fps']) && $fps != 'null' && $fps == 'unsent' && $data['fps']) continue;
        
          if (isset($_GET['letters']) && $letters != 'null' && $letters != $data['letter']) continue;
          if (isset($_GET['nonamep']) && $nonamep != 'null' && $nonamep == 'yes' && !@$data['files']['noname']) continue;
          if (isset($_GET['nonamep']) && $nonamep != 'null' && $nonamep == 'no' && @$data['files']['noname']) continue;
        
//           $pamount = $data['paid_amount'] + $data['discount_amount']
        
        
          if (isset($_GET['ptype']) && $ptype != 'null' && $ptype != $data['fee']) continue;
          if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'paid' && $data['status'] != 'paid') continue;
          if (isset($_GET['paidq']) && $paidq != 'null' && $paidq == 'unpaid' && $data['status'] == "paid") continue;


          $front = null;
          if ((@$data['status'] == "paid" || $data['status'] == "paid") && @$data['letter'] != 'Final') $front = 111;
          if ((@$data['status'] == "paid" || $data['status'] == "paid") && @$data['letter'] == 'Final') $front = '-';


          $cd = filemtime(DIR.'_database/'.$file).rand(10000,99999);
          
          // $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['paper_title'])), 0, 40, 'UTF-8'));
          // $hash1 = md5(strtoupper(str_replace(' ', '', $data['name_surname'].implode('', unserialize($data['co_authors'])))));
          // $hash2 = md5(strtoupper(str_replace(' ', '', $data['name_surname'])));
          // $snames[$front.$cd] = $hash;
          // $spc[$hash1] = @$spc2[$hash1] ? $spc[$hash1] + 1 : 1;
          // $spc2[$hash2] = @$spc2[$hash2] ? $spc2[$hash2] + 1 : 1;
          // $nameshash[$front.$cd] = $hash2;
          
        
          $ptc[$hash2][$_code] = '<a href="__edit.php?code='.$_code.'" target="_blank" style="font-size: 8px;">'.$_code.'</a> ';

          
          $new[$front.$cd] = $data;
          $newFile[$front.$cd] = $file;


      }
    }
    closedir($handle);

    krsort($new);
      
      


?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo gc('conf_name_shortest') ?> List</title>
  </head>

  <body>

    <style>
      @import url(//fonts.googleapis.com/css?family=Roboto:400,600);
      * {
        font: 13px/1.7 "Roboto", "Proxima Nova Rg", "Source Sans Pro", "Droid Sans", Arial, Helvetica, sans-serif;
        color: #0f0000;
        margin: 0px;
        padding: 0px;
      }

      table a:link {
        color: #666;
        font-weight: bold;
        text-decoration: none;
      }

      table a:visited {
        color: #999999;
        font-weight: bold;
        text-decoration: none;
      }

      table a:active,
      table a:hover {
        color: #bd5a35;
        text-decoration: underline;
      }

      table {
        width: 1200px;
        margin: 10px auto;
        box-shadow: none;
        border: 1px solid #E6E6E6;
        padding: 0;
        background-color: #FFFFFF;
        box-sizing: border-box;
        display: table;
      }

      table th {
        text-align: center;
        background: #34495e;
        color: #FFF;
        text-shadow: 0px 01px 0px #000;
        font-size: 15px;
        height: 42px;
        border-radius: 0 !important;
        border-left: 1px solid whitesmoke;
        box-sizing: border-box;
      }

      table th:first-child {
        border-left: 0;
      }

      table tr {
        text-align: center;
      }

      table td:first-child {
        box-sizing: border-box;
        border-left: 0;
      }

      table td {
        padding: 9px;
        border-top: 1px solid #ffffff;
        border-bottom: 1px solid #e0e0e0;
        border-left: 1px solid #e0e0e0;
        background: white;
      }

      table tr:nth-child(odd) td {
        background: #fcfaf5;
      }

      table tr:last-child td {
        border-bottom: 0;
      }

      table tr:hover td {
        background: #fffcf5;
        background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
        background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0);
      }

      .btns {
        /*         margin-right: 60px; */
        float: right
      }

      .filters {
        /*         margin-left: 60px; */
        float: left
      }

      @media only screen and (max-width: 690px) {
        .btns {
          float: left;
          margin-bottom: 20px;
        }
        .filters {
          float: left;
          margin-left: 30px;
          margin-bottom: 20px;
        }
      }

      .btns .c {
        float: right;
        opacity: 1;
        pointer-events: inherit;
      }

      .btns .disabled {
        opacity: 0.1;
        pointer-events: none;
      }

      .tddate {
        position: absolute;
        right: 85px;
        font-size: 12px;
      }

      td {
      position: relative;
      }
    </style>
    <form action="__selected_mail_2.php" id="checkedmail" method="post" target="_blank">

      <input type="hidden" name="_ctype" id="chkdtype" value="default">

      <div id="container" style="max-width: 90%; margin: 0px auto; margin-top: 50px;">


        <div class="btns">
          <a href="javascript:;;" onclick="$('.btns .c').toggleClass('disabled'); " style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: darkred; color: #fff;">O/I</a>
          <div class="disabled c">
            <a href="__list_prb.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">List_Pub</a>
            <a href="pagination.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">Pgn</a>
            <a href="<?php echo ROOT_URL ?>forum/index.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">FORUM</a>
           <a href="__list_bin.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">Recycle</a>        
            <a href="__list_reviewers.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">List_Rvr</a>
            <a href="__list_reviewers_pending.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">Rvr_Pnd</a>            
            <a href="__allcap.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">ALLCAP</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('presence'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">PRESENCE</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('approve'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">APPROVE</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('cert'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERT</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('cert_org'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERT-ORG</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('modcert'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERT-MOD</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('modcertpdf'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERTMOD-PDF</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('certkeynote'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERTKEYN</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('certkeynotepdf'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERTKEYN-PDF</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('certpdf'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERT-PDF</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('certpdflist'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERT-PDF LIST</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('certorgpdf'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">CERT-ORG-PDF</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('nameholder'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">NHOLDER</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('nameholderorg'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">NHOLDER-ORG</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('receipts'); $('#checkedmail').submit();" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">RCPTS</a>
            <a href="javascript:;" id="export" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">EXP</a>
            <a href="__unpaid.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">UPD</a>
            <a href="__paid.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">PD</a>
            <a href="javascript:;" onclick="$('#chkdtype').val('default'); $('#checkedmail').submit();" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #e01304; color: #fff;">CHKD</a>
            <a href="<?php echo URL ?>universal_reviewers.php" target="_blank" style="margin-left: 10px; margin-bottom: 10px; float: right;padding: 6px 10px; background: #333; color: #fff;">UNVR</a>
          </div>
        </div>

        <div class="filters">
          <a href="__list.php" style="margin-right: 10px; margin-bottom: 10px; float: left;padding: 6px 10px; background: darkgreen; color: #fff;">reset</a>

          <select name="" id="ptype">
          <option value="null" <?PHP echo ($ptype == "null" || !@$ptype) ? 'selected="selected"' : ''; ?>>Prt</option>
          <?php 
              for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
                $name = gc('form_item_'.$iii.'_name');
                $titles = gc('form_item_'.$iii.'_titles');
                    if ($name == "fee") {

                            foreach (explode('|', $titles) as $i => $s) 
                            {
                              echo '<option ';
                              echo $ptype != 'null' && $ptype == $i ? 'selected="selected"' : '';
                              echo ' value="'.$i.'">'.$s.'</option>';
                            }
                    }
                }
          ?>
        </select>

          <select name="" id="actit">
          <?php 
              for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
                $name = gc('form_item_'.$iii.'_name');
                $titles = gc('form_item_'.$iii.'_titles');
                    if ($name == "academic_title") {

                            foreach (explode('|', $titles) as $i => $s) 
                            {
                              if ($s == "Select"){
                                 $i = "null";
                                $s = 'Title';
                              }
                              echo '<option ';
                              echo $actit != 'null' && $actit == $i ? 'selected="selected"' : '';
                              echo ' value="'.$i.'">'.$s.'</option>';
                            }
                    }
                }
          ?>
          <option value="4-7">drlar</option>
          <option value="1-2-3">prephd</option>
          <option value="4-7">drlar</option>
          <option value="4-7">drlar</option>
        </select>

          <select name="" id="letters">
          <option value="null">Letters</option>
          <option <?php if ($letters == 'Initial') echo 'selected="selected"' ?> value="Initial">Initial</option>
          <option <?php if ($letters == 'Final') echo 'selected="selected"' ?> value="Final">Final</option>
          <option <?php if ($letters == '') echo 'selected="selected"' ?> value="">empty</option>
        </select>


          <select name="" id="papertype">
          <?php 
              for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
                $name = gc('form_item_'.$iii.'_name');
                $titles = gc('form_item_'.$iii.'_titles');
                    if ($name == "paper_type") {

                             foreach (explode('|', $titles) as $i => $s) 
                             {
                              if ($s == "Select") {
                                $i = "null";
                                $s = 'Paper';
                              }
                              echo '<option ';
                              echo $papertype != 'null' && $papertype == $i ? 'selected="selected"' : '';
                              echo ' value="'.$i.'">'.$s.'</option>';
                             }
                    }
                }
          ?>
          <option value="1-3">abstact + poster</option>
         </select>

          <select name="" id="nonamep">
          <option value="null" <?PHP echo ($nonamep == "null" || !@$nonamep) ? 'selected="selected"' : ''; ?>>Noname</option>
          <option <?php if ($nonamep == 'yes') echo 'selected="selected"' ?>value="yes">Yes</option>
          <option <?php if ($nonamep == 'no') echo 'selected="selected"' ?>value="no">No</option>
          
         </select>


          <select name="" id="paidq">
          <option value="null" <?PHP echo ($paidq == "null" || !@$paidq) ? 'selected="selected"' : ''; ?>>Paym</option>
          <option <?php if ($paidq == 'paid') echo 'selected="selected"' ?>value="paid">Paid</option>
          <option <?php if ($paidq == 'unpaid') echo 'selected="selected"' ?>value="unpaid">Pending</option>
          
         </select>

          <input type="text" name="checked_mail_subject" placeholder="subject" style="width: 50px;">
          <textarea name="checked_mail_content" placeholder="content" style="    height: 25px; width: 50px;
          margin-bottom: -9px;"></textarea>

          <select name="checked_mail_template">
          <option value="select">Mails</option>
          <option value="upload_reminder">Upl Rmd</option>
          <option value="approve_selected">Approve Selected</option>
          <option value="send_preformat_doc">Final Version Request</option>            
          <option value="progress_status1">First Payment Reminder 1</option>
          <option value="progress_status2">Payment Deadline Extension</option>
          <option value="progress_status3">Progress 3</option>
          <option value="final_acc_note">Fin Acc Nt</option>
          <option value="abs_fnl_note">Abs Fin Nt</option>
          <option value="keynote_offer">Key Offer</option>
          <option value="organizer_offer">Orgn Offer</option>
          <option value="upl_spc_prs_file">Spc Prs Upl</option>
          <option value="thanx_org">Organizer Thanks</option>
          <option value="send_proofread_tool">Send Proofread Tool</option>
          <option value="send_ttsurvey">Send TT Survey</option>
          <option value="send_dist_prs">Send Dist Prs Guide</option>
          <option value="status_.pub_tt">Pub, TT, Map</option>
          <option value="payment_reminder">Last Paym Remd</option>
          <option value="part_survey">Part. Feedback Survey</option>
          <option value="progress_status4">Progress4 TT Venue Download</option>
          <option value="post_conf_tt_pub_proc_photo">Post conf tt pub proc photo</option>
          <option value="venue_change">Venue Update</option>
          <option value="remn-feedb">Part Feedb Survey</option>
          <option value="pay-ext">Payment Deadline Extension</option>
          <option value="payment-proof-upload">Payment Proof Request</option>
          <option value="email_adr_reqst">Email Address Request</option>
          <option value="publishing_survey">Publishing Survey</option>
          <option value="transfer_survey">Transfer Survey</option>
          <option value="noname_doc_request">Request Noname version</option>
          <option value="testimonial_offer">Request Testimonial</option>
          <option value="publishing_info">Publishing Info after Survey</option>
          <option value="covid_notice_virt_paid">Send Covid Survey Notice to Virtual Paid</option>
          <option value="covid_survey_inperson_unpaid">Send Covid Survey Notice to In-Person Unpaid</option>
          <option value="covid_survey_virtual_unpaid">Send Covid Survey Notice to Virtual Unpaid</option>
          <option value="covid_survey_inperson_paid">Send Covid Survey Notice to In-person Paid</option>
          <option value="transform_note">Email Transform Payment Reminder</option>
          <option value="payment_extension_covid">Email Extended Payment Reminder Covid</option>
          <option value="visit _forum_inv_upl">Invite visit uploaded on forum</option>
          <option value="visit _forum_inv_unupl">Invite visit unuploaded on forum</option>
          <option value="email_presentation_survey">Send Presentation Survey to Paid</option>
          <option value="email_unpaid_presentation_survey">Send Presentation Survey to Unpaid</option>
          <option value="post_conf_journal_publ_info">post conf journal publ info</option>

         </select>
          <select id="fps">
          <option value="select">FPS</option>
          <option <?php if ($fps == 'sent') echo 'selected="selected"' ?> value="sent">S</option>
          <option <?php if ($fps == 'unsent') echo 'selected="selected"' ?> value="unsent">US</option>

        </select>
        </div>

        <table class="table-responsive" cellspacing='0' style="width: 200%;">

          <thead>
            <tr>
              <th></th>
              <th><a href="javascript:;" style="color: red" id="select_all">all</a></th>
              <th>Date</th>
              <th>NR</th>
              <th>Code</th>
              <th>Registration Notes</th>
              <th title="
1 - MA/MSc
2 - Researcher
3 - PhD. Cand.
4 - Dr.
5 - Assist. Prof. Dr.
6 - Assoc. Prof. Dr.
7 - Prof. Dr.
8 - Ms/Mr
">
</th>
              <th>Name & Surname</th>
              <th>Prsnc</th>
              <th>Time</th>
              <th>Co</th>
              <th>Question</th>
              <th>Message</th>
              <th>Answer</th>
              <th>Recommendation</th>
              <th>Country</th>
              <th>Tel</th>
              
              <th>Email</th>
              <th title="1-Abstract
                        2-Full Paper
                        3-Poster
                        4-Power Point File
">Ppr</th>
              <th title="0-In-Person
1-Virtual
2-Second Paper
">Ptc</th>
              <th>E</th>
              <th title="0-None
1-EJMS
2-IF JOURNALS
">J</th>
              <th>F</th>
              <th>BNK</th>
              <th>CRT</th>
              <th>Country</th>
              <th>Due</th>
              <th>Dsc</th>
              <th>Paid</th>
              <!--                     <th>Actions</th> -->
              <th>Appr</th>
              <th>Chkcd</th>
              <th>RW</th>
              <th>EDT</th>
              <th>RWC</th>
              <th>R1</th>
              <th>R2</th>
              <th>R3</th>
              <th>FPS</th>
              <th>Letters</th>
              <th>Status</th>
              <th>OG</th>
              <th>PG</th>
              <th>KT</th>
              <th>Published</th>
              <th>Jrn Vl</th>
              <th>Jrn Nr</th>
              <th>Book Vl</th>
              <th>Notes</th>

              <?php 
                   $surveys = explode(',', gc('surveys'));
                  foreach ($surveys as $si => $sis) {
                    $snumber = explode('-',$sis);
                    if ($snumber[0] && $snumber[1]) echo '<th>'.gc($snumber[0].'_si_'.$snumber[1].'_name').'</th>';
                  }
                  ?>
            </tr>
          </thead>

          <tbody>
            <?php 
      
//       foreach($new as $i => $s) {
//        if (unserialize($s['surveys']['organizer'])['org'] == "0")  echo $s['name_surname'].'<br>';
//       }
//                                               print_r($snames);

                      $nr = count($new) + 1;
                      foreach($new as $i => $s) {
                        
                        
                                $nr--;
                                $data = $s;
                                $code = explode('.', $newFile[$i])[0];

                                $serc = $snames;
                                                                    unset($serc[$i]);
                                                                    unset($nameshash[$i]);

//                         print_r($serc);
                        
                                $hash = md5(mb_substr(strtoupper(str_replace(' ', '', $data['paper_title'])), 0, 50, 'UTF-8'));
                        
                                $hash1 = md5(strtoupper(str_replace(' ', '', $data['name_surname'] . implode('', unserialize($data['co_authors'])))));
                                $hash2 = md5(strtoupper(str_replace(' ', '', $data['name_surname'] )));
                        
                                $found = in_array($hash, $serc, true);
                                $secp2 = in_array($hash2, $spc2, true);
                                $secp1 = in_array($hash1, $spc, true);
                                $secp = ($spc[$hash1] <= 1 && $data['fee'] == 100 && $spc2[$hash2] <= 1) ? 1 : 0;
                                $secpa = ($data['fee'] == 100 && $spc2[$hash2]  <= 1 && $data['how_many_co'] <= 0) ? 1 : 0;
                        
                        
                                $secpb = ($data['fee'] == 100 && $spc2[$hash2] <= 1 && $data['how_many_co'] > 0) ? 1 : 0;
                                
                                $pot = $ptc[$hash2];
                                unset($pot[$code]);

                                $_ipr = (in_array($hash2, $nameshash, true)) ? '<br>'.implode('<br>', $pot) : '';        
                                echo '<tr>';
                                echo '<td id="nrdc"></td>';
                                echo '<td><input type="checkbox" value="'.$code.'" name="selects[]"></td>';
                                echo '<td style="font-size: 9px;">'.date('Y.m.d H:i ', $data['time']).'</td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.$nr.'</a></td>';
                                echo '<td';
                                // echo $found == 1 ? ' style="background: orange; font-weight: bold;"' : '';
                                // echo $secpa == 1 ? ' style="background: #ff00003b;"' : '';
                                // echo $secp == 1 ? ' style="background: #d75f0061;"' : '';
                                // echo $secpb == 1 ? ' style="background: #0024ff3b;"' : '';
                                echo '><a href="__edit.php?code='.$code.'" target="_blank">'.$code.'</a></td>';
                                echo '<td ';
                               
                                echo '><a href="__edit.php?code='.$code.'" target="_blank">'.$found.' '.mb_substr(strtotitle($data['paper_title']), 0, 50, 'UTF-8').'</a></td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.($data['academic_title']).'</a></td>';
                                echo '<td><a href="__edit.php?code='.$code.'" target="_blank">'.strtotitle($data['name_surname']).'</a></td>';
                                echo '<td>'.@$data['presence']['author'].'&nbsp;';
                                echo @implode('&nbsp;&nbsp;', @$data['presence']['co_author']);
                          echo '<br>';

                        foreach (@$data['co_authors_present'] as $coi => $cos) {
                          if ($cos == "yes") echo '&nbsp&nbsp;Y';
                          else echo '&nbsp&nbsp;N';
                        }
                                echo ($data['presence']['email'] == 'yes') ? '<br>M' : '';
                                echo '<br><a href="presence-confirmation.php?code='.$code.'" target="_blank" style="font-size: 9px;">edit</a>';
                        
                                echo '</td>';
                                echo '<td>'.$data['presence']['author_time'].'</td>';
                                echo '<td>'.$data['how_many_co'].'</td>';
                                echo '<td>'.$data['abstract'].'</td>';
                                echo '<td>'.$data['message'].'</td>';
                                echo '<td>'.$data['answer'].'</td>';
                                echo '<td>'.$data['recommend'].'</td>';
                                echo '<td>'.$data['countryCode'].'</td>';
                                echo '<td>'.$data['mobile'].'</td>';
                                echo '<td style="font-size: 9px;">'.$data['email'].'</td>';
                                echo '<td>'.($data['paper_type']).'</td>';
                                echo '<td>'.($data['fee']).$_ipr.'</td>';
                                echo '<td>'.($data['edited_book']).'</td>';
                                echo '<td>'.($data['journal']).'</td>';
                                echo '<td>'.count($data['files']).'</td>';
                                echo '<td>'.$data['bankreq'].'</td>';
                                echo '<td>'.$data['certmail'].'</td>';
                                echo '<td>'.$data['country'].'</td>';
                                echo '<td>'.$data['total'].'€</td>';
                                echo '<td>'.$data['discount_amount'].'€</td>';
                                echo '<td>'.@$data['paid_amount'].'€</td>';
//                                 echo '<td>';
//                                  echo '<a href="__delete.php?code='.$code.'">Delete</a>&nbsp;∙&nbsp;';
//                                  echo '<a href="__edit.php?code='.$code.'" target="_blank">Edit</a>&nbsp;∙&nbsp;';
//                                  echo '<a href="__approve.php?code='.$code.'" target="_blank">Approve</a>&nbsp;∙&nbsp;';
//                                  echo '<a href="invoice.php?code='.$code.'" target="_blank">Invoice</a>';
//                                 echo '</td>';
                                echo '<td>';
                                echo @$data['approved_no'];
                                echo '</td>';
                        
                                echo '<td style="font-size: 11px;">';
                                foreach (@$data['chkdmail'] as $chi => $chs) {
                                  echo substr($chs, 0, 6).'<br>';
                                }
                                echo '</td>';
                                
                        
                                echo '<td>';
                                echo is_array($data['rw']) ? implode('<br>', $data['rw']) : @$data['rw'];
                                echo ($data['emaileditnote'] == "yes") ? 'edt note' : '';
                                echo '</td>';
                        
                                echo '<td>';
                                echo @$data['edt'];
                                echo '</td>';
                                echo '<td>';
                                echo @$data['review_portal']['review_count'] ? @$data['review_portal']['review_count'] : 0;
                                echo '</td>';
                                
                        
                                echo '<td>';
                               
                                echo @$data['review_portal']['under_review'];
                                echo @$data['review_portal']['under_review_2'];
                                echo @$data['review_portal']['under_review_3'];
                                echo @$data['review_portal']['under_review_4'];
                                echo '</td>';
                        
                                echo '<td>';
                                echo @$data['surveys']['review_report--time'] ? '<span style="font-size: 9px;">'.date('d.m.Y', $data['surveys']['review_report--time']).'</span><br>' : '';
                                echo @$data['surveys']['review_report2--time'] ? '<span style="font-size: 9px;">'.date('d.m.Y', $data['surveys']['review_report2--time']).'</span><br>' : '';
                                echo @$data['surveys']['review_report3--time'] ? '<span style="font-size: 9px;">'.date('d.m.Y', $data['surveys']['review_report3--time']).'</span><br>' : '';
                                echo @$data['surveys']['review_report4--time'] ? '<span style="font-size: 9px;">'.date('d.m.Y', $data['surveys']['review_report4--time']).'</span><br>' : '';
                                echo @$data['review_portal']['mypaperreviewed'];
                                echo @$data['review_portal']['mypaperreviewed2'];
                                echo @$data['review_portal']['mypaperreviewed3'];
                                echo @$data['review_portal']['mypaperreviewed4'];
                                echo '</td>';
                        
                        
                                echo '<td>';
                                echo @$data['rpu'];
                                echo '</td>';
                        
                                
                        
                                echo '<td>';
                                echo @$data['fps'];
                                echo '</td>';
                        
                                echo '<td>';
                                echo @$data['letter'];
                                echo '</td>';
                        
                        
                                echo '<td>';
                        if ($data['additional_amount_desc'] == 'Pay on site') echo 'POS';

                                else if (@$data['status'] == "paid" || $data['paid_amount'] == $data['total']) echo '<span style="color: green">PAID</span>';
                        else if         (@$data['status'] == "claimed") echo 'CLAIMED';
                        else if         (@$data['status'] == "partly paid") echo 'PARTLY PAID';
                        else if         (@$data['status'] == "declined") echo 'DECLINED';
                        else echo 'PENDING';
                        
                                echo '</td>';
                        
                                echo '<td>';
                                echo ($data['organizer'] == 1) ? 'Yes' : '' ;
                                echo '</td><td>';
                                echo @$data['program'];
                            
                              
                                echo '</td><td>';
                                echo @$data['keynote_title'];
                                echo '</td>';
                        
                        
                                echo '<td>';
                                echo ($data['prcs']['published']).'</td><td>';
                                echo ($data['prcs']['journal_volume']).'</td><td>';
                                echo ($data['prcs']['journal_name']).'</td><td>';
                                echo ($data['prcs']['prb_volume']);
                            
                              
                                echo '</td>';
                        
                        
                                echo '<td>';
                                echo nl2br(@$data['notes']);
                                echo '</td>';
                        
                                $surveys = explode(',', gc('surveys'));
                                foreach ($surveys as $si => $sis) {
                                  $snumber = null;
                                  $snumber = explode('-',$sis);
                                  if ($snumber[0] && $snumber[1]) {
                                    $srv = ($data['surveys']);
//                                     echo '<td>'. var_dump($data['surveys']) .'</td>';
                                    echo '<td>'.unserialize($srv[$snumber[0]])[gc($snumber[0].'_si_'.$snumber[1].'_name')].'</td>';
                                  }
                                }
                        
                                echo '</tr>';
                        
                      }
                      
                      
                      
                      
                    }
                ?>
          </tbody>

        </table>

      </div>

    </form>
    <script src="jquery.js"></script>
    <script>
      function count_tr() {
        var ii = 0;
        $('table > tbody > tr').each(function() {
          ii++;
          $(this).find('#nrdc').html(ii);
        });
      }
      count_tr();

      $('body').on('click', 'table th', function() {
        count_tr();

      });


      $('body').on('click', '#select_all', function() {
        $("input[type='checkbox']").attr('checked', true);
        $(this).attr('id', 'unselect_all');
      });

      $('body').on('click', '#unselect_all', function() {
        $("input[type='checkbox']").attr('checked', false);
        $(this).attr('id', 'select_all');
      });


      $('#export').on('click', function() {
        var val = $('#ptype').val();
        var payment = $('#paidq').val();
        var actit = $('#actit').val();
        var letters = $('#letters').val();
        var papertype = $('#papertype').val();
        var nonamep = $('#nonamep').val();
        var fps = $('#fps').val();

        window.location = "__export.php?ptype=" + val + "&paidq=" + payment + "&actit=" + actit + "&letters=" + letters + "&nonamep=" + nonamep + "&papertype=" + papertype + "&fps=" + fps;
      });


      $('#nonamep, #letters, #paidq, #fps, #papertype, #actit, #ptype').on('change', function() {
        var ptype = $('#ptype').val();
        var paidq = $('#paidq').val();
        var actit = $('#actit').val();
        var letters = $('#letters').val();
        var nonamep = $('#nonamep').val();
        var papertype = $('#papertype').val();
        var fps = $('#fps').val();


        window.location = "?ptype=" + ptype + "&paidq=" + paidq + "&letters=" + letters + "&nonamep=" + nonamep + "&actit=" + actit + "&papertype=" + papertype + "&fps=" + fps;
      });

      $("#selectedmail").on('click', function() {
        //     $( "#selectedmail" ).dblclick(function() {
        var ptype = $('#ptype').val();
        var actit = $('#actit').val();
        var payment = $('#paidq').val();
        var letters = $('#letters').val();
        var papertype = $('#papertype').val();
        var nonamep = $('#nonamep').val();
        var fps = $('#fps').val();

        window.location = "__selected_mail.php?ptype=" + ptype + "&letters=" + letters + "&nonamep=" + nonamep + "&paidq=" + payment + "&actit=" + actit + "&papertype=" + papertype + "&fps=" + fps;
      });

      function sortTable(table, col, reverse) {
        var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
          tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
          i;
        reverse = -((+reverse) || -1);
        tr = tr.sort(function(a, b) { // sort rows
          return reverse // `-1 *` if want opposite order
            *
            (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
              .localeCompare(b.cells[col].textContent.trim())
            );
        });
        for (i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
      }

      function makeSortable(table) {
        var th = table.tHead,
          i;
        th && (th = th.rows[0]) && (th = th.cells);
        if (th) i = th.length;
        else return; // if no `<thead>` then do nothing
        while (--i >= 0)(function(i) {
          var dir = 1;
          th[i].addEventListener('click', function() {
            sortTable(table, i, (dir = 1 - dir))
          });
        }(i));
      }

      function makeAllSortable(parent) {
        parent = parent || document.body;
        var t = parent.getElementsByTagName('table'),
          i = t.length;
        while (--i >= 0) makeSortable(t[i]);
      }

      makeAllSortable();
    </script>

  </body>

  </html>