<?php
/**
 * Securing class file.
 *
 * @author Konstantinos Apazidis (konapaz@gmail.com)
 * @contributors
 * @copyright istocosmos.gr
 * @link http://www.github.com/addboo/yaf
 * @license http://www.opensource.org/licenses/mit-license.php
 * @requires
 *
 * @version: 0.1
**/

/**
 * DESCRIPTION:
 * Framework's Securing and sanity value of variables Class
 *
 *
**/

class PureValidator {

    /* pattern help
    Here are some more special characters:

    \n		# A newline
    \t		# A tab
    \w		# Any alphanumeric (word) character.
                    # The same as [a-zA-Z0-9_]
    \W		# Any non-word character.
                    # The same as [^a-zA-Z0-9_]
    \d		# Any digit. The same as [0-9]
    \D		# Any non-digit. The same as [^0-9]
    \s		# Any whitespace character: space,
                    # tab, newline, etc
    \S		# Any non-whitespace character
    \b		# A word boundary, outside [] only
    \B		# No word boundary
    Clearly characters like $, |, [, ), \, / and so on are peculiar cases in regular expressions. If you want to match for one of those then you have to preceed it by a backslash. So:

    \|		# Vertical bar
    \[		# An open square bracket
    \)		# A closing parenthesis
    \*		# An asterisk
    \^		# A carat symbol
    \/		# A slash
    \\		# A backslash
    */

    // 0 - 1F , 7F
    // "$'()*;<>\^{}|   and space,   \=x5c
    //static $char_cutted_url='\\"\$\'\(\)\*\;\<\>\^\{\}\| \,';

    public function init() {} //'virtual' function

    static $char_cutted_url='$()*;<>^{}|, \"\'\x5c';
    static $preg_cutted_url ='\x00-\x1F\07F';

    //return substring array that are urls
    static function getUrls($val) {
            $alpr=self::$preg_cutted_url.self::$char_cutted_url; //get pattern and region ascii patterns
            preg_match_all("/((ht|f)tp(s)?:\/\/)?(www\.)[^$alpr]+[^$alpr.]/",$val,$ret);
            //print_r($ret);
            return ret;
    }

    //change the matched pattern urls to real link urls and return modified text
    static function setUrls($val,$replacement='<a href=${0} target="_blank">$0</a>') {
            $alpr=self::$preg_cutted_url.self::$char_cutted_url;
            //preg_match('/((f|ht)tp:\/\/)?(www\.){1}[^'.self::$preg_cutted_url.self::$char_cutted_url.']+/',$val,$ret);
            //print_r($ret);
            return preg_replace("/(((ht|f)tp(s)?:\/\/)|(www\.))[^$alpr]+[^$alpr.]/", $replacement, $val);
    }

    //check if $val string is less or equal length than $maxlen
    static function maxLength($val,$maxlen){
            //echo strlen($val),' ';
            return ($maxlen>=strlen($val));
    }

    //check if $val string is greater or equal length than $maxlen
    static function minLength($val,$minlen){
            return ($minlen<=strlen($val));
    }

    static function rangeLength($val,$minmax){ //$min,$max
            return ((strlen($val)>=$minmax[0]) && (strlen($val)<=$minmax[1]));
    }

    static function minLengthOrZero($val,$minlen){
        if ($val=='') return true;
        return  self::minLength($val,$minlen);
    }



    //check if the type of variable is boolean
    static function isBoolean($val){
            return is_bool($val);
    }

    //check if string is integer value
    static function isCastInt($val){
            return ((string)(int)$val == $val); //like is_numeric()
    }

    //check if string is float value
    static function isCastFloat($val){
            return ((string)(float)$val == $val); //like is_numeric()
    }

    //check if $val is equal or greater of $maxlen
    static function minValue($val,$min){
            return ($val>=$min);
    }

    //check if $val is equal or less of $minlen
    static function maxValue($val,$max){
            return ($val<=$max);
    }

     static function rangeValue($val,$minmax){ //$min,$max
            return (($val>=$minmax[0]) && ($val<=$minmax[1]));
    }


    static function isCastWordOrEmpty($val) {
        if ($val==="") return true;
        return self::isCastWord($val);
    }

    //check if an variable is alphanumerical, _ or - character value
    static function isCastWord($val) {
            return preg_match('/^[A-Z0-9_\-]+$/i',$val);
    }

    //check if an variable is alphanumerical value --only english characters
    static function isCastAlphaNum($val){
            return ctype_alnum($val);
    }


    //check if email pattern, next from this check if dns email server respond
    function isCastEmail($email)
    {
      // checks proper syntax //or TODO $checkEmail = '/^[^@]+@[^\s\r\n\'";,@%]+$/';??
      return preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email);
    }

      /* no certified functionality
      // gets domain name
      list($username,$domain)=split('@',$email);
      // checks for if MX records in the DNS
      $mxhosts = array();
      if(!getmxrr($domain, $mxhosts))
      {
        // no mx records, ok to check domain
        if (!fsockopen($domain,25,$errno,$errstr,30))
        {
          return false;
        }
        else
        {
          return true;
        }
      }
      else
      {
        // mx records found
        foreach ($mxhosts as $host)
        {
          if (fsockopen($host,25,$errno,$errstr,30))
          {
            return true;
          }
        }
        return false;
      }
      */



    //check if an variable has alphanumerical internationalization value (all language)
    //--TODO under constructor-- only english characters
    static function isCastAlphaNumI18n($val){
            return preg_match('/^[A-Z0-9Α-Ζ]+$/i',$val); //ctype_alnum($val);
    }

    //convert malicius or dangerous character to inactive
    static function encodeStr($val){
            return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    }

    //sanity value appropriate to database mysql
    static function pureStrToDB($val) {
            return mysql_real_escape_string($val);
    }

}//end of class
?>