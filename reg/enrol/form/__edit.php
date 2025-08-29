<?php

    error_reporting(0);

    require 'func.php';

    $code = vget('code');


    if (!file_exists(DIR.'_database/'.$code.'.txt')) alert('Data not found.');

    $data = getcontents(DIR.'_database/'.$code.'.txt');

    $time =  filemtime(DIR.'_database/'.$code.'.txt');

    $data = unserialize($data);


function fixObject ($class = 'stdClass', $object)
{
  return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
}

?>
<?php _header(); ?>

    <style>
        .soluk {
            color: #ddd;
            font-size: 12px;
            padding-top: 22px !important;
        }
        .price {
            text-align: right;
        }
        form.uk-form-horizontal.uk-margin-large {
            margin-top: 0px !important;
            padding-top: 0px !important;
        }

        h6 {
            text-align: center;
            font-size: 15px;
            padding: 20px;
            clear: both;
            position: fixed;
            right: 20px;
            bottom: 20px;
            color: #fff;
            background: #333;
            letter-spacing: 2px;
        }
      
      
      .error .uk-form-label {color: red !important}
      .error textarea, .error input, .error select {border: 1px solid red;}
    </style>

    <h6>
        EDITTING
    </h6>

    <form class="uk-form-horizontal uk-margin-large" method="post" enctype="multipart/form-data">
        

        <div class="uk-container">
            <div uk-grid>
                <div class="uk-width-expand">
                        
                        <fieldset class="uk-fieldset">

                            <br>
                          
                          <?php 
                            if ($data['bankreq'] == "yes") {
                              echo '<div class="uk-alert uk-alert-warning ">This user requested bank account details.</div>';
                            }
                          ?>

                            <div class="uk-margin">
                                <div class="uk-form-label">Paid Amount</div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" value="<?php echo $data['paid_amount'] ?>" name="paid_amount">
                                </div>
                            </div>
                          
                            <div class="uk-margin">
                                <div class="uk-form-label">Discount Amount</div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" value="<?php echo $data['discount_amount'] ?>" name="discount_amount">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <div class="uk-form-label">Additional Amount</div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" value="<?php echo $data['additional_amount'] ?>" name="additional_amount">
                                </div>
                            </div>
                          
                            <div class="uk-margin">
                                <div class="uk-form-label">Additional Amount Desc</div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" value="<?php echo $data['additional_amount_desc'] ?>" name="additional_amount_desc">
                                </div>
                            </div>
                            
                            <hr>
                          
                          
                          <?php 
                          
                          
                          gc('form_inputs', array('data' => $data, 'imadmin' => 1));
                          
                          
                          ?>
                          <div class="uk-margin">
                            <div class="uk-form-label">Select bank account</div>
                            <a href="javascript:;" id="bank1" class="uk-button uk-button-default" style="margin-left: 14px; width: 80px; padding: 0px; margin-right: 10px;">Bank BE</a>
                            <a href="javascript:;" id="bank2" class="uk-button uk-button-default" style="width: 80px; padding: 0px; margin-right: 10px;">Bank AL</a>
                            <a href="javascript:;" id="bank3" class="uk-button uk-button-default" style="width: 80px; padding: 0px; margin-right: 10px;">Bank TR</a>
                            <a href="javascript:;" id="WU" class="uk-button uk-button-default" style="width: 80px; padding: 0px; margin-right: 10px;">WU</a>
                            <a href="javascript:;" id="sendbank" class="uk-button uk-button-primary" style="width: 80px; padding: 0px;">Send</a>
                          </div>
                          
                           <div class="uk-margin" id="formss">
                                <div class="uk-form-label">Published</div>
                                <div class="uk-form-controls">
                                    <select class="uk-select " name="published_tf">
                                       <option value="0">-- Select --</option>
                                       <option value="1" <?php echo $data['prcs']['published'] == 1 ? 'selected="selected"' : ''; ?>>-- Yes --</option>
                                       <option value="2" <?php echo $data['prcs']['published'] == 2 ? 'selected="selected"' : ''; ?>>-- No --</option>
                                    </select>
                                </div>
                            </div>
                          
                          
                          <div class="uk-margin" id="">
                                <div class="uk-form-label">Journal Volume</div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" value="<?php echo $data['prcs']['journal_volume'] ?>" name="journal_volume">
                                </div>
                            </div>
                          
                          <div class="uk-margin" id="">
                                <div class="uk-form-label">Journal Name</div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" value="<?php echo $data['prcs']['journal_name'] ?>" name="journal_name">
                                </div>
                            </div>
                          
                          <div class="uk-margin" id="">
                                <div class="uk-form-label">Proceeding Book Volume</div>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" value="<?php echo $data['prcs']['prb_volume'] ?>" name="prb_volume">
                                </div>
                            </div>
                          
                          
                          



                            <div class="uk-margin">
                                <div class="uk-form-label">Upload your Paper <em>*</em></div>
                                <div class="uk-form-controls">
                                    <div uk-form-custom>
                                        <input type="file" name="file">
                                        <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
                                        
                                    </div>

                                    <label>
                                        <br>
                                        <small>
                                            <b>Upload here to replace the document </b>
                                            <br>
                                            <br>
                                            <a href="_files/<?php echo urlencode($data['file_name']) ?>" class="uk-button uk-button-default uk-width-1-1 " target="_blank" >See Uploaded file</a>
                                        </small>
                                    </label>
                                </div>
                              
                               <div class="uk-margin">
                                        <?php if (@$data['files']) : ?>
                                            <br>
                                            <br>
                                            <small>
                                                <b>Uploaded files: </b>
                                                <br>
                                                <br>
                                              <?php 
                                                foreach ($data['files'] as $i => $s) {
                                                  ?>
                                              <a href="_files/<?php echo urlencode($s) ?>" class="uk-button uk-button-default uk-width-1-2 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;"><?php
                                                    
                                                    echo @$data['files_types'][$i] ? ' <span style="text-transform: lowercase;">('.$data['files_types'][$i].')</span> ' : '';
                                                    ?><?php echo $s ?></a>
                                              <a href="__remove_file.php?code=<?php echo $code ?>&id=<?php echo $i ?>" class="uk-button uk-button-danger uk-width-1-2 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;"><?php
                                                   
                                                    ?>remove file</a>
                                              <br>
                                              <span><?php echo date('H:i d.m.Y', filemtime(DIR.'_files/'.$s)); ?></span>
                                              <br>
                                              <?php
                                                }
                                               ?>
                                                
                                            </small>
                                        <?php endif; ?>
                                 
                                  <?php if (@$data['reviewed_files']) : ?>
                                  <small>
                                              <?php 
                                                foreach ($data['reviewed_files'] as $i => $s) {
                                                  ?>
                                              <a href="_files/<?php echo urlencode($s) ?>" class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;">
                                                <?php echo $s ?></a>
                                              <br>
                                              <span><?php echo date('H:i d.m.Y', filemtime(DIR.'_files/'.$s)); ?></span>
                                              <br>
                                              <?php
                                                }
                                               ?>
                                                
                                            </small>
                                        <?php endif; ?>
                                 
                                 <?php if ($data['files_mod']) : ?>
                          
                          <a class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;" href="_files_modified_from_user/<?php echo $data['files_mod'] ?>">Proofread file</a>
                                 
                          <?php endif; ?>
                                 <?php if ($data['files_final_version']) : ?>
                          
                          <a class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;" href="_final_proposal_upload/<?php echo $data['files_final_version'] ?>">Final Version file</a>
                                 
                          <?php endif; ?>
                              </div>
                            </div>
                           

                        </fieldset>

                </div>

                <div class="uk-width-1-3" style="z-index: 980;">
                    <div>
                        <br>
                        <br>
                        <div class="uk-margin">
                            <table class="uk-table">
                                <caption>Summary</caption>
                                <tbody calculations>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="price __total_price"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                       <div class="uk-margin">
                      <a href="_files/<?php echo urlencode($data['file_name']) ?>" class="uk-button uk-button-default uk-width-1-1 " target="_blank" >See Uploaded file</a>
                      <div class="uk-margin">
                                        <?php if (@$data['files']) : ?>
                                            <br>
                                            <br>
                                            <small>
                                                <b>Uploaded files: </b>
                                                <br>
                                                <br>
                                              <?php 
                                                foreach ($data['files'] as $i => $s) {
                                                  ?>
                                                                                                <div class="uk-button-group">

                                              <a href="_files/<?php echo urlencode($s) ?>" class="uk-button uk-button-default " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;"><?php
                                                    
                                                    echo @$data['files_types'][$i] ? ' <span style="text-transform: lowercase;">('.$data['files_types'][$i].')</span> ' : '';
                                                    ?><?php echo $s ?></a>
                                              
                                              
                                              <a href="__remove_file.php?code=<?php echo $code ?>&id=<?php echo $i ?>" class="uk-button uk-button-danger " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;"><?php
                                                   
                                                    ?>X</a>
                                              </div>
                                              <br>
                                              <span><?php echo date('H:i d.m.Y', filemtime(DIR.'_files/'.$s)); ?></span>
                                              <br>
                                              <?php
                                                }
                                               ?>
                                                
                                            </small>
                                        <?php endif; ?>
                                 
                                  <?php if (@$data['reviewed_files']) : ?>
                                  <small>
                                              <?php 
                                                foreach ($data['reviewed_files'] as $i => $s) {
                                                  ?>
                                              <a href="_files/<?php echo urlencode($s) ?>" class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;">
                                                <?php echo $s ?></a>
                                              <br>
                                              <span><?php echo date('H:i d.m.Y', filemtime(DIR.'_files/'.$s)); ?></span>
                                              <br>
                                              <?php
                                                }
                                               ?>
                                                
                                            </small>
                                        <?php endif; ?>
                                 
                                 <?php if ($data['files_mod']) : ?>
                          
                          <a class="uk-button uk-button-default uk-width-1-1 " target="_blank" style="margin-bottom: 10px; text-transform: lowercase;" href="_files_modified_from_user/<?php echo $data['files_mod'] ?>">Proofread file</a>
                                 
                          <?php endif; ?>
                              </div>
                            </div>
                        <div class="uk-margin">
                          
                          
                            <button class="uk-button uk-button-primary uk-width-1-1 " style="margin-bottom: 6px;" type="submit">Save</button>
                            <a href="__delete.php?code=<?php echo $code ?>" class="uk-button uk-button-danger uk-width-1-1 " style="margin-bottom: 6px;">Delete and Email</a>
                            <a href="__delete.php?noemail=yes&code=<?php echo $code ?>" class="uk-button uk-button-secondary uk-width-1-1 " style="margin-bottom: 6px;">Delete No Email</a>
                            <a href="__approve.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="margin-bottom: 6px;">Approve</a>
                             <a href="__approve_listener.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="margin-bottom: 6px;">Approve Listener</a>
                            <a href="__approve_no_coauthor.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="margin-bottom: 6px;">Approve No Coauthor</a> 
                            <a href="__refuse.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-secondary uk-width-1-1 " style="margin-bottom: 6px;">Refuse Listener bad  CV</a>
                            <a href="__send_mail.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-default uk-width-1-1 " style="margin-bottom: 6px;">Mail Templates</a>
                             <a href="__review.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-default uk-width-1-1 " style="margin-bottom: 6px;">Send Review note</a>
                            <a href="__review_2.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-default uk-width-1-1 " style="margin-bottom: 6px;">Send Review note <b>SIMPLE</b></a>
                            <a href="__approve_final.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="margin-bottom: 6px;">Final letter</a>
                            <a href="__approve_final_no_coau.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="margin-bottom: 6px;">Final letter No Coau</a>
                            <a href="__approve_final_list.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="margin-bottom: 6px;">Final letter Listener</a> 
                            <a href="__email_final_paper_upload.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-3-4 " style="float: left; margin-bottom: 6px;">Author FP</a>
                            <a href="upload-final-paper.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-default uk-width-1-4 " style="padding: 0px; margin-bottom: 6px;">Editor Fp</a>
                            <a href="__final_paper_approved.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-default uk-width-1-1 " style="margin-bottom: 6px;">Approve Final Paper</a>
                            <a href="__email_edit_reg.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-<?php echo @$data['emaileditnote'] == 'yes' ? 'success' : 'default'; ?> uk-width-1-1 " style="margin-bottom: 6px;">Send Edit Note</a>  
                            <a href="__mail_log.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-width-1-1 " style="margin-bottom: 6px;">Mail Log</a>
                             <?php if ($data['review_portal']['under_review'] != 'yes') : ?><a href="__list_reviewers.php?from=<?php echo $code ?>" target="_blank" class="uk-button uk-width-1-1 " style="margin-bottom: 6px;">Send to reviewer</a>  <?php else: echo '<a href="javascript:;" class="uk-button uk-width-1-1 " style="margin-bottom: 6px;">Sent to reviewer</a>'; endif; ?>
                            
                          
                          <?php if ($data['status'] != "claimed") : ?><br><a href="__claim.php?code=<?php echo $code ?>" target="_self" class="uk-button uk-button-default uk-width-1-1 " style="margin-bottom: 6px;">Claim Payment</a><?php  endif; ?>
                          <?php if ($data['status'] == "claimed") : ?><br><a href="__unclaim.php?code=<?php echo $code ?>" target="_self" class="uk-button uk-button-default uk-width-1-1 " style="background: darkgreen; color: #fff; margin-bottom: 6px;">Set as Pending</a><?php  endif; ?>
                          
                          <a href="<?php echo ROOT_URL.'myprofile/index.php?'.$code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="padding: 0px; margin-bottom: 6px;"> Go to Author Page</a>
                          
                          
                          
                          <br><a href="invoice.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-default uk-width-1-1 " style="margin-bottom: 6px;">Invoice</a>
                           <br><a href="invoice_list.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-default uk-width-1-1 " style="margin-bottom: 6px;">Invoice Listener</a>
                          
                          <a href="upload-final-paper.php?noname=1&code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="padding: 0px; margin-bottom: 6px;">Upload Noname</a>
                          <a href="upload-after-review.php?code=<?php echo $code ?>" target="_blank" class="uk-button uk-button-primary uk-width-1-1 " style="padding: 0px; margin-bottom: 6px;"> Review Report and Upload Tool</a>
                          
                          <?php if ($data['status'] == "paid") : ?>
                          <button class="uk-button uk-button-default  uk-width-1-1 " type="button">Certificates <?php echo $data['certmail'] ?></button>
                          <div uk-dropdown>
                              <ul class="uk-nav uk-dropdown-nav">
                                  <li><a href="<?php echo URL.'get-your-certificate.php?code='.$code ?>" target="_blank"><?php echo $data['name_surname'] ?></a></li>
                                  <?php 
                                    foreach (unserialize($data['co_authors']) as $ci => $cs) {
                                      echo '<li><a href="'.URL.'get-your-certificate.php?code='.$code.'-'.$ci.'" target="_blank">'.$cs.'</a></li>';
                                    }
                                ?>
                                <li><a href="<?php echo URL.'__cert_email.php?code='.$code ?>" target="_blank">SEND MAIL</a></li>
                              </ul>
                          </div>
                           </div>
                          <?php endif; ?>
                          
                           <?php if ($data['status'] == "paid") : ?>
                          <button class="uk-button uk-button-default  uk-width-1-1 " type="button">Certificates Assistance <?php echo $data['certmail'] ?></button>
                          <div uk-dropdown>
                              <ul class="uk-nav uk-dropdown-nav">
                                  <li><a href="<?php echo URL.'get-your-certificate-assist.php?code='.$code ?>" target="_blank"><?php echo $data['name_surname'] ?></a></li>
                                  <?php 
                                    foreach (unserialize($data['co_authors']) as $ci => $cs) {
                                      echo '<li><a href="'.URL.'get-your-certificate-assist.php?code='.$code.'-'.$ci.'" target="_blank">'.$cs.'</a></li>';
                                    }
                                ?>
                                <li><a href="<?php echo URL.'__cert_email_assist.php?code='.$code ?>" target="_blank">SEND MAIL ASSIST</a></li>
                              </ul>
                          </div>
                           </div>
                          <?php endif; ?>
                          
                          
                      <?php $tr = @unserialize($data['braintree']); $trs = @unserialize($data['braintree_list']); ?>
                      <div class="uk-margin">
                        <table class="uk-table">
                          <tr>
                            <td>Registered time</td>
                            <td><?php echo @$data['time'] ? date('H:i d.m.Y', $data['time']) : ''; ?></td>
                          </tr> <tr>
                            <td>Updated time</td>
                            <td><?php echo date('H:i d.m.Y', $time); ?></td>
                          </tr>
                          <?php 
                            if (strlen($tr['id']) <= 10) {
                          ?>
                          <tr>
                            <td>Braintree</td>
                            <td> <a href="https://www.braintreegateway.com/merchants/6sdbt9dmpwfvmgxh/transactions/<?php echo $tr['id'] ?>" target="_blank"><?php echo $tr['id'] ?></a> 
                            <?php 
                                foreach ($data['braintree_list'] as $bri => $brs) {
                                  $brd = unserialize($brs);
                                  if ($brd['id'] != $tr['id']) echo '<br><a href="https://www.braintreegateway.com/merchants/6sdbt9dmpwfvmgxh/transactions/'.$brd['id'].'" target="_blank">'.$brd['id'].'</a>';
                                }
                              ?>
                            
                            </td>
                          </tr><tr>
                            <td>Amount</td>
                            <td><?php echo $tr['amount'] ?><?php 
                                foreach ($data['braintree_list'] as $bri => $brs) {
                                  $brd = unserialize($brs);
                                  if ($brd['id'] != $tr['id']) echo '<br>'.$brd['amount'];
                                }
                              ?></td>
                          </tr>
                          <tr>
                            <td>Full Name</td>
                            <td><?php echo $tr['payer']['firstName']. ' '.$tr['payer']['lastName'] ?></td>
                          </tr>
<!--                           <tr>
                            <td>Created</td>
                            <td><?php echo date_format($tr['created'], 'H:i d.m.Y'); ?></td>
                          </tr> -->
                          <tr>
                            <td>Charged</td>
                            <td><?php echo date_format($tr['updated'], 'H:i d.m.Y'); ?></td>
                          </tr>
<!--                           <tr>
                            <td>Status</td>
                            <td><?php echo $tr['status'] ?></td>
                          </tr> -->
                          <?php } else { ?>
                          
                          <tr>
                            <td>Paypal</td>
                            <td> <a href="https://www.paypal.com/activity/payment/<?php echo $tr['id'] ?>" target="_blank"><?php echo $tr['id'] ?></a> 
                            
                            </td>
                          </tr><tr>
                            <td>Amount</td>
                            <td><?php echo $tr['amount'] ?></td>
                          </tr>
                          <tr>
                            <td>Charged</td>
                            <td><?php echo date('H:i d.m.Y', $tr['updated']); ?></td>
                          </tr>
                          
                          
                          <?php } ?>
                          <?php if ($data['review_portal']['mypaperreviewed'] == 'yes') : ?>
                          
                          <tr>
                            <td colspan='2'><a target="_blank" href="print_review_report.php?code=<?php echo $code ?>">Review Report</a></td>
                          </tr>
                          <?php endif; ?>
                          
                          
                          </table>
                          <h3>Surveys</h3>
                          <table class="uk-table">
                            <?php 
                              if ($handle = opendir(DIR.'surveys')) {
                                while (false !== ($file = readdir($handle))) {
                                  if ($file != "." && $file != ".." && end(explode('-', $file)) != 'success.php') {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo '<a href="survey.php?code='.$code.'&type='.explode('.', $file)[0].'" target="_blank">'.explode('.', $file)[0].'</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                  }
                                }
                              }
                            ?>
                        </table>
                        
                        
                        
                        <?php if (@$data['reviewed_files']) : ?>
                                            <h4>Reviewed Files</h4>
                                              <?php 
                                                foreach ($data['reviewed_files'] as $i => $s) {
                                                  ?>
                                              <a href="_files/<?php echo urlencode($s) ?>" class="uk-button uk-button-default uk-width-1-1 uk-button-large" target="_blank" style="margin-bottom: 10px; text-transform: lowercase;"><?php
                                                    
                                                    ?>... <?php echo substr($s, -30) ?></a>
                                              <br>
                                              <?php
                                                }
                                               ?>
                                                
                                <?php endif; ?>
                        
                        <h4>My profile links</h4>
                        <?php 
                          foreach (_links($code) as $i => $s) {
                            ?>
                         <div class="uk-margin">


                           <?php 



                                echo '<label><input class="uk-checkbox" type="checkbox"  ';

                                echo $data['myprofile']['links']["'".$i."'"] == 1 ? 'checked="checked"' : '';

                                echo 'name="myprofile_links[\''.$i.'\']" value="1">&nbsp;&nbsp;'.$i.'</label><br>';



                            ?>

                      </div>
                        <?php
                          }
                        ?>
                      </div>


                    </div>
                </div>
            </div>
            

        </div>

        <input type="hidden" name="code" value="<?php echo $code ?>">
        <input type="hidden" name="file_name" value="<?php echo $data['file_name'] ?>">
        <input type="hidden" name="__type" value="adminedit">
        <input type="hidden" name="banksend" value="">

    </form>
    <br>

<?php gc('presence_info_modal') ?>
    <script>
      
      $('body').on('keydown keyup', 'input[name=discount_amount]', function() {
            add_price('discount', 'Discount amount', ($('input[name=discount_amount]').val() * -1), 1);
        });
      $('body').on('keydown keyup', 'input[name=paid_amount]', function() {
             add_price('paid', 'Paid amount', ($('input[name=paid_amount]').val() * -1), 1);
        });
      $('body').on('keydown keyup', 'input[name=additional_amount]', function() {
            add_price('additional', $('input[name=additional_amount_desc]').val(), $('input[name=additional_amount]').val() * 1, 1);
        });
      $('body').on('keydown keyup', 'input[name=additional_amount_desc]', function() {
            add_price('additional', $('input[name=additional_amount_desc]').val(), $('input[name=additional_amount]').val() * 1, 1);
        });
      $('#sendbank').on('click', function() {
        var val = $('textarea[name="bank"]').val(); 
        if (val) {
            $('input[name=banksend]').val('yes');
            $('form').submit();
            UIkit.modal.blockUI("Sending bank account details.. Please wait....");
          }
        else UIkit.modal.alert("Please enter bank details!");
        
      });
      <?php 
        ob_start();
        echo gc('bank1');
        $bank1 = ob_get_contents();
        ob_end_clean();
        
               ob_start();
        echo gc('bank2');
        $bank2 = ob_get_contents();
        ob_end_clean();
           
               ob_start();
        echo gc('bank3');
        $bank3 = ob_get_contents();
        ob_end_clean();
                
               ob_start();
        echo gc('WU');
        $WU = ob_get_contents();
        ob_end_clean();
               
               $bank1 = json_encode($bank1);
               $bank2 = json_encode($bank2);
               $bank3 = json_encode($bank3);
               $WU = json_encode($WU);
               
               
      ?>
      var bank1 = <?php echo $bank1 ?>;
      var bank2 = <?php echo $bank2 ?>;
      var bank3 = <?php echo $bank3 ?>;
      var WU = <?php echo $WU ?>;
      
      $('#bank1').on('click', function() {
         $('textarea[name="bank"]').val(bank1);
      });
      $('#bank2').on('click', function() {
         $('textarea[name="bank"]').val(bank2);
      });
      $('#bank3').on('click', function() {
         $('textarea[name="bank"]').val(bank3);
      });
       $('#WU').on('click', function() {
         $('textarea[name="bank"]').val(WU);
      });  
      

        $('select[name=how_many_co]').on('change', function () {
            
            var val = $(this).val();

            var template = '';

            if (val > 0) {

                for (i = 1; i <= val; i++) {

                    template += ''
                    +'<div class="uk-margin">'
                    +'<div class="uk-form-label">Co-author'+i+' Name Surname<em>*</em></div>'
                    +'<div class="uk-form-controls">'
                    +'<input class="uk-input co_authors_'+i+'" type="text" style="width: 60%;" required name="co_authors['+i+']">'
                    +'<div  style="width: 38%; float: right; margin-top: 8px;"  class="onlyinperson"> <label><input class="uk-checkbox coaptrigger" type="checkbox" checked="checked" name="co_authors_present_'+i+'" value="yes"> &nbsp;Present </label>  <a href="javascript:;" title="<?php echo gc('presence_info_text') ?>" id="presence_info">?</a> <span style="margin-left: 6px; font-weight: bold" id="coalp_'+i+'"></span> </div>'
                    +'</div>'
                    +'</div>';

                }

            }

            $('[callback-1]').html(template);
          
          
          setTimeout(function () {
            <?php 
              foreach(unserialize($data['co_authors']) as $i => $s) {
                echo ' $(".co_authors_'.$i.'").val("'.$s.'"); ';
                if ($data['co_authors_present'][$i] == "yes" || count($data['co_authors_present']) <= 0) echo ' $("input[name=co_authors_present_'.$i.']").prop("checked", true); ';
                else echo ' $("input[name=co_authors_present_'.$i.']").prop("checked", false); ';
                
                          echo ' $("#coalp_'.$i.'").html('.@$data['presence']['co_author'][$i].'); ';
              }
                           ?>

               
              
               
                              
      coa_present_calc();
      }, 200);

 
        });
      
       var nmp = $('input[name=name_surname]').parent();
               
               nmp.find('input').css({
                 'width':'80%'
               });
               
               nmp.append('<span style="width: 15%; float: right;  font-weight: bold;"><?php echo @$data['presence']['author'] ?></span>');
      
      
      
            $('<div callback-1></div>').insertAfter($('select[name=how_many_co]').parent().parent());

      
      setTimeout(function () {
        var val = $('select[name=how_many_co]').val();

            var template = '';

            if (val > 0) {

                for (i = 1; i <= val; i++) {

                    template += ''
                    +'<div class="uk-margin">'
                    +'<div class="uk-form-label">Co-author '+i+' <em>*</em></div>'
                    +'<div class="uk-form-controls">'
                    +'<input class="uk-input co_authors_'+i+'" type="text" style="width: 60%;" required name="co_authors['+i+']">'
                    +'<div  style="width: 38%; float: right; margin-top: 8px;"  class="onlyinperson"> <label><input class="uk-checkbox coaptrigger" type="checkbox" checked="checked" name="co_authors_present_'+i+'" value="yes"> &nbsp;Present </label>  <a href="javascript:;" title="<?php echo gc('presence_info_text') ?>" id="presence_info">?</a> <span style="margin-left: 6px; font-weight: bold" id="coalp_'+i+'"></span> </div>'
                    +'</div>'
                    +'</div>';

                }

            }

            $('[callback-1]').html(template);
      }, 00);
      
      
      setTimeout(function () {
      <?php 
        foreach(unserialize($data['co_authors']) as $i => $s) {
          echo ' $(".co_authors_'.$i.'").val("'.$s.'"); ';
          if ($data['co_authors_present'][$i] == "yes" || count($data['co_authors_present']) <= 0) echo ' $("input[name=co_authors_present_'.$i.']").prop("checked", true); ';
          else echo ' $("input[name=co_authors_present_'.$i.']").prop("checked", false); ';
           
          
          echo ' $("#coalp_'.$i.'").html('.@$data['presence']['co_author'][$i].'); ';
          
        }
      ?>
      coa_present_calc();
      }, 800);
      
      
      
       <?php gc('coa_present_calc_js') ?>
      
      
        


        /**
         * 
         * Form on submit
         * 
         */
         $('form').on('submit', function(e) {
             e.preventDefault();

             var data = $('form').serialize();
             var form_data = new FormData(); 
           
             var file_data = $('input[type=file]').prop('files')[0];   
             form_data.append("file", file_data);

             var other_data = $('form').serializeArray();
            $.each(other_data,function(key,input){
                form_data.append(input.name,input.value);
            });
             $.ajax({
                url: 'index.php',
                data: form_data,
                method: 'post',
                cache: false,
                contentType: false,
                processData: false,
                success: function(a) {
                    console.log(a);
                    $('body').append(a);
                }
             });
         })


        <?php gc('form_calc') ?>



        
        
        
        
        function add_price(name, title, s, t) {
            s = parseInt(s);
            t = parseInt(t);
          if (title) {
            var html = "<tr class='n__"+name+"'>"+
                "<td>"+title+"</td>"+
                "<td class='soluk'>"+s+"€</td>"+
                "<td class='soluk'>x</td>"+
                "<td class='soluk'>"+t+"</td>"+
                "<td class='soluk'>=</td>"+
                "<td class='price' calc-total='"+(s * t)+"'>"+(s * t)+"€</td>"+
            "</tr>";

            }
                                  $(".n__"+name).remove();

            if (name == 'fee') $('[calculations]').prepend(html);
            else $('[calculations]').append(html);
            calculate();
        }

        function remove_price(name) {
            $(".n__"+name).remove();
            calculate();
        }

        function calculate() {
            var total = 0;
            $('[calc-total]').each(function() {
                var pr = $(this).attr('calc-total');
                total = parseInt(total) + parseInt(pr);
            });

            $('.__total_price').html(total+'€');
        }
        
      add_price('discount', 'Discount amount', ($('input[name=discount_amount]').val() * -1), 1);
      add_price('paid', 'Paid amount', ($('input[name=paid_amount]').val() * -1), 1);
      add_price('additional', $('input[name=additional_amount_desc]').val(), $('input[name=additional_amount]').val() * 1, 1);
      

    </script>

<?php _footer(); ?>