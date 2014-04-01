<?php
/**
 * $Author$
 *  
 * $Id$
 *
 */ 

require_once('src/classes/ApplicationData.php');
require_once('src/classes/BasicTextProcessor.php');

if (!defined('PROCESSOR_CHECK_FOR_KEYWORDS_RE')) {
  $ValidKeywords = array('Author', 'Date', 'Header', 'Id', 'Revision', 'Tags');
  $CheckForValidKeywordsRegEx = KeywordProcessor::GenerateRegExKeywordMatching($ValidKeywords);
  define('PROCESSOR_CHECK_FOR_KEYWORDS_RE', $CheckForValidKeywordsRegEx);
}

class KeywordProcessor extends BasicTextProcessor {

  
  /**
   * Generates a regular expression that checks a file for valid Keywords.
   * @param array $Keywords
   * @return string
   */
  public static function GenerateRegExKeywordMatching(array $Keywords) {
    //'/\$(Author|Date|Header|Id|Revision|Tags)(\: |\$)/'
    $kws = implode('|', $Keywords);
    return sprintf('/\$(%s)(\: |\$)/', $kws);
  }
  
  
  //TODO change data storage - not happy with the way data is passed around
  public static function checkKeywords($text) {
    global $appData;
    $hasKeywords =PROCESSOR_CHECK_FOR_KEYWORDS_RE;
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
    
    $hasKeywords = PROCESSOR_CHECK_FOR_KEYWORDS_RE;
    if (preg_match($hasKeywords, $text, $m) > 0) {
      $appData->haskeywords = true;
      
      if (strpos($text,"@@IGNORE"."KEYWORDS")!==false) {
        return $text; //no processing
      }
      //found valid keyword string in this file, so process it

      $patterns = array(
          '/\$(Author|Date|Header|Tags|Revision)(\$|: [^\\$]* \$)/',  //match most keywords 
          "/\\$(Id)(\\$|: ".str_replace('/','\/', $appData->Filename)." [^$]* \\$)/",   /// match (Id filename  ... ) keyword seperately
      );
      //generate Id data
      $IdData = $appData->Filename ." ". $appData->Revision ." " . $appData->Date ." ". $appData->Author ." ".rand(1000,9999)." ".$appData->Tags;
      $appData->Id = $IdData;
      
      
      $start = microtime();
      $text = preg_replace_callback($patterns, 
        function($m) { 
            global $appData; 
             return "$".$m[1].": ".$appData->{$m[1]}." $";  
        }, $text, -1, $kwReplaceCount);

      $end = microtime();
      //printf("$kwReplaceCount %.4f\n", $end*1000 - $start*1000);
    } else {
      //no keywords found, do nothing
      $appData->haskeywords = false;
    }
    return $text;  
  }
  
  
}