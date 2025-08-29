<?php

  require '../form/func.php';


  if ($_POST || $_FILES) {
      require 'post.php';
      die();
  }
  
  function topics() {
    $f = [];
    $files = scandir('topics');
    foreach ($files as $fi => $fs) :
    if ($fs != '.' && $fs != '..') $f[] = $fs;
    endforeach;
    return $f;
  }

  function papers($n) {
    $f = [];
    $files = getcontents('topics/'.$n);
    $files = explode("\n", $files);
    foreach ($files as $fi => $fs) :
    if (trim($fs)) $f[] = $fs;
    endforeach;
    return $f;
  }

  function title_number($n) {
    $c = getcontents('topics/'.$n);
    $a = explode("\n", $c);
    return count($a);
  }

  function post_number($n) {
    $c = scandir('posts/'.$n);
    return count($c) - 2;
  }

  function exist_topic($n) {
    if (getcontents('topics/'.$n)) return true;
    else die('TOPIC NOT EXIST.');
  }

  function exist_paper($n) {
    if (paper_data($n)['paper_title']) return true;
    else die('PAPER NOT EXIST.');
  }



  function list_keytitle() {
    
    
    ?>

<div class="large-12 forum-category rounded top">
        <div class="large-8 small-10 column lpad">
          Plenary Session
        </div>
        <div class="large-4 small-2 column lpad ar">
          <a data-connect>
            <i class="icon-collapse-top"></i>
          </a>
        </div>
      </div>
      
      <div class="toggleview">
        <div class="large-12 forum-head">
          <div class="large-8 small-8 column lpad">
            Papers
          </div>
          <div class="large-1 column lpad">
           &nbsp;
          </div>
          <div class="large-1 column lpad">
            &nbsp;
          </div>
          <div class="large-2 small-4 column lpad">
            Author
          </div>
        </div>
        <?php
    if ($handle = opendir(DIR.'_database')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && $file != 'allcap.txt' && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt') {
        
        $data = getcontents(DIR.'_database/'.$file);

          $data = unserialize($data);
        
          $_code = explode('.', $file)[0];
        $ky = null;
        $ky = unserialize(@$data['surveys']['keynote']);
        
        if (@$ky['keytitle']) { 
        
//         if ()
    ?>
  
     <div class="large-12 forum-topic">
        <div class="large-1 column lpad">
          <i class="icon-file"></i>
        </div>
        <div class="large-7 small-8 column lpad">
          <span class="overflow-control">
            <a href="thread.php?keytitle=<?php echo md5($_code) ?>&code=<?php   echo   _encrypt($_code) ?>"><?php   echo @$ky['keytitle'] ?></a>
          </span>
        </div>
        <div class="large-1 column lpad">
        </div>
        <div class="large-1 column lpad">
        </div>
        <div class="large-2 small-4 column pad">
          <span>
            <?php  echo paper_author($_code) ?>
          </span>
        </div>
      </div> 
    <?php
      }
      }
    }
    }
    echo '      </div>
';
  }
   
  function list_topics() {
      $topics = topics();
    
      foreach ($topics as $fi => $fs) :
     $datas = papers($fs);
    
    ?>

<div class="large-12 forum-category rounded top">
        <div class="large-8 small-10 column lpad">
          SESSION <?php echo $fs ?>
        </div>
        <div class="large-4 small-2 column lpad ar">
          <a data-connect>
            <i class="icon-collapse-top"></i>
          </a>
        </div>
      </div>
      
      <div class="toggleview">
        <div class="large-12 forum-head">
          <div class="large-8 small-8 column lpad">
            Papers
          </div>
          <div class="large-1 column lpad">
           &nbsp;
          </div>
          <div class="large-1 column lpad">
            &nbsp;
          </div>
          <div class="large-2 small-4 column lpad">
            Author
          </div>
        </div>
        <?php
    
      foreach ($datas as $fi => $fs) :
    ?>
    
     <div class="large-12 forum-topic">
        <div class="large-1 column lpad">
          <i class="icon-file"></i>
        </div>
        <div class="large-7 small-8 column lpad">
          <span class="overflow-control">
            <a href="thread.php?code=<?php echo _encrypt($fs) ?>"><?php echo paper_title($fs); ?></a>
          </span>
        </div>
        <div class="large-1 column lpad">
        </div>
        <div class="large-1 column lpad">
        </div>
        <div class="large-2 small-4 column pad">
          <span>
            <?php echo paper_author($fs) ?>
          </span>
        </div>
      </div>
    <?php
    endforeach;
    echo '      </div>
';
    endforeach;
  }
   
  function paper_data($code) {
    $data = getcontents(DIR.'_database/'.$code.'.txt');
    $data = unserialize($data); 
    return $data;
  }
  
  function paper_title($code) {
    $data = paper_data($code);

    return __ucwords($data['paper_title']);
  }
  
  function paper_author($code) {
     $data = paper_data($code);
    return __ucwords($data['name_surname']);
  }

  function list_papers($cat) {
      $datas = papers($cat);
    
      foreach ($datas as $fi => $fs) :
    ?>
    
     <div class="large-12 forum-topic">
        <div class="large-1 column lpad">
          <i class="icon-file"></i>
        </div>
        <div class="large-7 small-8 column lpad">
          <span class="overflow-control">
            <a href="thread.php?code=<?php echo _encrypt($fs) ?>"><?php echo paper_title($fs); ?></a>
          </span>
        </div>
        <div class="large-1 column lpad">
        </div>
        <div class="large-1 column lpad">
        </div>
        <div class="large-2 small-4 column pad">
          <span>
            <?php echo paper_author($fs) ?>
          </span>
        </div>
      </div>
    <?php
    endforeach;
  }

function _forum_header() {
  ?>

<header id="#top">
    <div class="row">
      <div class="large-4 column lpad">
        <div class="logo">
          <span><?php echo gc('conf_name_shortest') ?></span>
          <span>FORUM</span>
        </div>
      </div>
      <div class="large-8 column ar lpad">
        <nav class="menu">
          <a href="<?php echo gc('forum_url') ?>">Forum Homepage</a>
          <a href="<?php echo gc('ltr_conf_web') ?>" target="_blank">Conference Website</a>
          
          <a href="<?php echo gc('forum_contact_link') ?>" target="_blank">Contact</a>
        </nav>     
      </div>
    </div>
  </header>
<?php
}
