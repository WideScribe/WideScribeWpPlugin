<div class="t_about t_product t_service t_news t_sitemap t_blog t_full t_gallery t_search t_login t_contact t_portfolio post_edit_page t_default t_mpopular">

<?php

    
        $tips[] = array(
            'header' => 'Get analytics', 
            'text' => 'Looking for a prediction on your next payment? At your partner Portal you can access advanced analytics on this site - '
            . 'and manage additional sites if you have more than one. ', 
            'link' => 'https://www.widescribe.com/partnerPortal');
        
        
        $tips[] = array(
            'header' => 'Partner Portal', 
            'text' => 'At WideScribe.com, you can access the Partner Portal analytics on this site - '
            . 'and manage additional sites if you have more than one. Check out', 
            'link' => 'https://www.widescribe.com/partnerPortal');
        
        
        $tips[] = array(
            'header' => 'WideScribe community', 
            'text' => 'Do you know what Coopetition is? To compete on content, but not on converting users. Join the discussion groups at WideScribe.com for discussions. Meet other sites  '
            . 'and start link-sharing with each other.', 
            'link' => 'https://www.widescribe.com/community');
        
          
        $tips[] = array(
            'header' => 'Additional features', 
            'text' => 'Do you need additional features? WideScribe collaborates with system integrators '
            . '. Check out our list of accredited system integrators on WideScribe.com', 
            'link' => 'https://www.widescribe.com/support');
        
          $tips[] = array(
            'header' => 'Are you a developer?', 
            'text' => 'The WideScribe plugin is Open Source, and you are welcome to modify the content of '
              . 'the WideScribe plugin '
            . '. Before you do, you might want to check out the WideScribe docs, where we tell you about new features of the API that you can use to drive engagement and convert even more users to the WideScrive platform', 
            'link' => 'https://www.widescribe.com/developer');
          
            $rand = rand(0, count($tips)-1);
            
       print  '<h2>'.$tips[$rand]['header'].'</h2>';
       print   '<p>'.$tips[$rand]['text'].'</p>';
       print    'Check out <br><a href="'.$tips[$rand]['link'].'">'.$tips[$rand]['link'].'</a';
          
?>
    
 