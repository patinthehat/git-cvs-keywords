<?php
/**
 * $Author$
 *  
 * $Id$
 *
 */ 

require_once('src/classes/ApplicationData.php');
$appData = ApplicationData::getInstance();



class KeywordProcessor extends BasicTextProcessor {

  //TODO change data storage - not happy with the way data is passed around
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
    
    $hasKeywords = '/\$(Author|Date|Header|Id|Revision|Tags)(\: |\$)/';
    if (preg_match($hasKeywords, $text, $m) > 0) {
      $appData->haskeywords = true;
      if (strpos($text,"@@IGNORE"."KEYWORDS")!==false) {
        return $text; //no processing
      }
      //found valid keyword string in this file, so process it

      $patterns = array(
         // '/(@@([SE]IGNORE))/',
          '/\$(Author|Date|Header|Tags|Revision)(\$|: [^\\$]* \$)/',
          //'/\$(Date)(\$|: [^$]* \$)/',
         // '/\$(Header)(\$|: [^$]* \$)/',
          "/\\$(Id)(\\$|: ".str_replace('/','\/', $appData->Filename)." [^$]* \\$)/",          
         // '/\$(Revision)(\$|: [^$]* \$)/',
         // '/\$(Tags)(\$|: [^$]* \$)/',
      );
      $IdData = $appData->Filename ." ". $appData->Revision ." " . $appData->Date ." ". $appData->Author ." ".rand(1000,9999)." ".$appData->Tags;
      $appData->Id = $IdData;
      /*
      $replacements = array(
         // "___IGNORE_KEYWORDS $2 $1  IGNORE_KEYWORDS__",
          '\$$1: '.$appData->Author.' \$',
          '\$Date: '.$appData->Date  .' \$',
          '\$Header: '.$appData->Header  .' \$',
          '\$Id: '.$IdData  .' \$',
          '\$Revision: '.$appData->Revision  .' \$',
          '\$$1: '.$appData->Tags  .' \$',  
      );*/
      
     
      
      //print_r($patterns);
      
      $start = microtime();
      $text = preg_replace_callback($patterns, function($m) { 
          global $appData;  //print_r($m); 
           return "$".$m[1].": ".$appData->{$m[1]}." $";  }, $text, -1, $kwReplaceCount);
      
        $end = microtime();
        printf("$kwReplaceCount %.4f\n", $end*1000 - $start*1000);
    } else {
      //no keywords found, do nothing
      $appData->haskeywords = false;
    }
    return $text;  
  }
  
  
}