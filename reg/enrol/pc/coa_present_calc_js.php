    $('body').on('click', '.coaptrigger', function () {
          coa_present_calc();
        });

$('select[name=how_many_co]').on('change', function () {
   coa_present_calc();
        });


  function coa_present_calc() {
      var val = $('select[name=how_many_co]').val();
      val = parseInt(val);


      var pp = 0;
      for (i = 0; i < val; i++) {
        var iii = i + 1;
        if ($('input[name=co_authors_present_'+iii+']').is(':checked')) {} else pp++;
      }
        
      var res = val - pp;
    
      if (pp > 0 && $('#radio_<?php echo gc('discount_just_in_person_name') ?>_<?php echo gc('discount_just_in_person_val') == 0 ? '0' : gc('discount_just_in_person_val');  ?>').is(':checked')) {

        if (pp == 1) {
            add_price('coa_present', 'Co-author Presence Discount', <?php echo gc('discount_eq_1') ?> * -1, 1);
        }
        else if (pp > 1) {
            add_price('coa_present', 'Co-author Presence Discount', <?php echo gc('discount_more_t_1') ?> * -1, pp);
        }

      }
      else {
        remove_price('coa_present');
      }
            
            if ($('#radio_<?php echo gc('discount_just_in_person_name') ?>_<?php echo gc('discount_just_in_person_val') == 0 ? '0' : gc('discount_just_in_person_val');  ?>').is(':checked') == false) {
            $('.onlyinperson').hide();
        }
            else {
            $('.onlyinperson').show();
        }
    }
            
            $('body').on('click', '.uk-radio', function() {
              coa_present_calc();
            });