<?php global $data; ?>
<h2>
Participation Replanning Feedback Survey
</h2>
Dear author <?php echo __ucwords($data['name_surname']) ?>, PhD</b>,
<br>
<br>
This is to inform you about the actual status of the conference participation in regard to the recent developments in Covid figures. Most of our registered and paid participants have changed their preference to "Realtime-Online-Oral-Presentation" option.We would like to underline the fact that only a few participants will be available as-inperson on the conference venue. To make the conference more effective, we would like to suggest you to shift to "Realtime-Online-Oral-Presentation" instead of in-person. In this case we will reimburse you the fee difference.
<br>
The authors will use our online platform for a distant interactive presentation. All the publishing and certification will be completed as ususal.
<br>
<br>
At this point, we would like to ask you to provide a short feedback regarding your participation replanning preference to <?php echo gc('conf_name_shortest')?>.
<br>
Kindly provide information and <b>SUBMIT</b> the feedback survey below:
<br>

<?php global $survey_type; $survey_type = $_GET['type']; gc('survey_inputs'); ?>

<script>

      chng();
      $('._radio_inpaid').on('change', function() {
        chng();
      });
          function chng() {
          var val = $('._radio_inpaid:checked').val();
          
          if (val == 2) {
            $('#survey_item_2').show();
          }
          else 
            $('#survey_item_2').hide();
        }
 
</script>
