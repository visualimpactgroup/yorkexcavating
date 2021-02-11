<?php
  //counts
  $ftCount = '0';
  $ptCount = '0';
  $seCount = '0';
  $ctCount = '0';
  $totalC  = '0';


  //

  //full-time
  echo '<div class="columns is-multiline is-mobile">';
  foreach( $recent_posts as $recent ){
    $jobStatus           = get_field('status', $recent["ID"]);
    $jobTitle 				   = get_the_title($recent["ID"]);
    $jobType             = get_field('job_type', $recent["ID"]);
    $jobContent          = get_the_content($recent["ID"]);
    $jobLink             = get_the_permalink($recent["ID"]);

    if($jobStatus == 'active'){
      if($jobType == 'ft'){
        $ftCount++;

        if($ftCount == '1'){
          echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen section-title is-paddingless"><h4>Full-Time Positions</h4></div>';
        }

        echo '
          <div class="column is-12-mobile is-6-tablet is-4-desktop is-4-widescreen is-paddingless">
            <div class="job-block">
              <div class="job-title"><a href="'.$jobLink.'" title="View Job">'.$jobTitle.'</a></div>
              <div class="button-block">
                <a class="more" href="'.$jobLink.'" title="View Job">View Job'.$morelinkafter.'</a>
              </div>
            </div>
          </div>
        ';
      }
    }
  }
  echo '</div>';
  //end full-time


  //part-time
  echo '<div class="columns is-multiline is-mobile">';
  foreach( $recent_posts as $recent ){
    $jobStatus           = get_field('status', $recent["ID"]);
    $jobTitle 				   = get_the_title($recent["ID"]);
    $jobType             = get_field('job_type', $recent["ID"]);
    $jobContent          = get_the_content($recent["ID"]);
    $jobLink             = get_the_permalink($recent["ID"]);

    if($jobStatus == 'active'){
      if($jobType == 'pt'){
        $ptCount++;

        if($ftCount == '1'){
          echo '<div class="column is-12-mobile  is-12-tablet is-12-desktop is-12-widescreen section-title is-paddingless"><h4>Full-Time Positions</h4></div>';
        }

        echo '
          <div class="column is-12-mobile is-6-tablet is-4-desktop is-4-widescreen is-paddingless">
            <div class="job-block">
              <div class="job-title"><a href="'.$jobLink.'" title="View Job">'.$jobTitle.'</a></div>
              <div class="button-block">
                <a class="btn more" href="'.$jobLink.'" title="View Job">View Job'.$morelinkafter.'</a>
              </div>
            </div>
          </div>
        ';
      }
    }
  }
  echo '</div>';
  //end part-time

  //contract
  echo '<div class="columns is-multiline is-mobile">';
  foreach( $recent_posts as $recent ){
    $jobStatus           = get_field('status', $recent["ID"]);
    $jobTitle 				   = get_the_title($recent["ID"]);
    $jobType             = get_field('job_type', $recent["ID"]);
    $jobContent          = get_the_content($recent["ID"]);
    $jobLink             = get_the_permalink($recent["ID"]);

    if($jobStatus == 'active'){
      if($jobType == 'ct'){
        $ctCount++;

        if($ftCount == '1'){
          echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen section-title is-paddingless"><h4>Full-Time Positions</h4></div>';
        }

        echo '
          <div class="column is-12-mobile is-6-tablet is-4-desktop is-4-widescreen is-paddingless">
            <div class="job-block">
              <div class="job-title"><a href="'.$jobLink.'" title="View Job">'.$jobTitle.'</a></div>
              <div class="button-block">
                <a class="btn more" href="'.$jobLink.'" title="View Job">View Job'.$morelinkafter.'</a>
              </div>
            </div>
          </div>
        ';
      }
    }
  }
  echo '</div>';
  //end contract

  //seasonal
  echo '<div class="columns is-multiline is-mobile">';
  foreach( $recent_posts as $recent ){
    $jobStatus           = get_field('status', $recent["ID"]);
    $jobTitle 				   = get_the_title($recent["ID"]);
    $jobType             = get_field('job_type', $recent["ID"]);
    $jobContent          = get_the_content($recent["ID"]);
    $jobLink             = get_the_permalink($recent["ID"]);

    if($jobStatus == 'active'){
      if($jobType == 'se'){
        $seCount++;

        if($ftCount == '1'){
          echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen section-title is-paddingless"><h4>Full-Time Positions</h4></div>';
        }

        echo '
          <div class="column is-12-mobile is-6-tablet is-4-desktop is-4-widescreen is-paddingless">
            <div class="job-block">
              <div class="job-title"><a href="'.$jobLink.'" title="View Job">'.$jobTitle.'</a></div>
              <div class="button-block">
                <a class="btn more" href="'.$jobLink.'" title="View Job">View Job'.$morelinkafter.'</a>
              </div>
            </div>
          </div>
        ';
      }
    }
  }
  echo '</div>';
  //end seasonal

  foreach( $recent_posts as $recent ){
    $jobTitle 				   = get_the_title($recent["ID"]);
    $jobType             = get_field('job_type', $recent["ID"]);
    $jobContent          = get_the_content($recent["ID"]);
    $jobLink             = get_the_permalink($recent["ID"]);

    if(((($ftCount == '0') && ($ptCount == '0') && ($ctCount == '0') && ($seCount == '0')))){

      echo '
        <div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen centered is-paddingless" style="text-align: center;">
          <p class="nothing">There are currently no openings available. Please check again soon!</p>
        </div>
      ';
    }
  }
  echo '</div>';
  //end empty
?>
