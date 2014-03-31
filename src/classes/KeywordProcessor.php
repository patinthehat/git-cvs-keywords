<?php

require_once('src/classes/ApplicationData.php');
$appData = ApplicationData::getInstance();

class KeywordProcessor extends BasicTextProcessor {


  static function checkKeywords($text) {
    global $appData;
    $hasKeywords = '/\$(Author|Date|Header|Id|Revision|Tags)(:|\$)/';
    if (preg_match($hasKeywords, $text, $m) > 0) {
      $appData->haskeywords = true;
    } else {
      $appData->haskeywords = false;
    }
    return $appData->haskeywords;
  }
  
  static function processText($text) {
    global $appData;
    //process text and return it
    $kwReplaceCount = 0;
    
    $hasKeywords = '/\$(Author|Date|Header|Id|Revision|Tags)(:|\$)/';
    if (preg_match($hasKeywords, $text, $m) > 0) {
      $appData->haskeywords = true;
      //found valid keyword string in this file, so process it

      $patterns = array(
          '/\$(Author|Author: [^$]* )\$/',
          '/\$(Date|Date: [^$]* )\$/',
          '/\$(Header|Header: [^$]* )\$/',
          '/\$(Id|Id: [^$]* )\$/',          
          '/\$(Revision|Revision: [^$]* )\$/',
          '/\$(Tags|Tags: [^$]* )\$/',
      );
      $IdData = $appData->Filename ." ". $appData->Revision ." " . $appData->Date ." ". $appData->Author ." ".rand(1000,9999)." ".$appData->Tags;
      echo $IdData . PHP_EOL;
      $replacements = array(
          '\$Author: '.$appData->Author.' \$',
          '\$Date: '.$appData->Date  .' \$',
          '\$Header: '.$appData->Header  .' \$',
          '\$Id: '.$IdData  .' \$',
          '\$Revision: '.$appData->Revision  .' \$',
          '\$Tags: '.$appData->Tags  .' \$',  
      );

      $text = preg_replace($patterns, $replacements, $text, -1, $kwReplaceCount);
      
    } else {
      //no keywords found, do nothing
      $appData->haskeywords = false;
    }
    return $text;  
  }
  
  
}