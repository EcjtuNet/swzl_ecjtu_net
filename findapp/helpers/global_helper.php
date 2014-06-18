<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_random_string') )
{
	function get_random_string($len)
	{
        $chars = array( 
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
            "3", "4", "5", "6", "7", "8", "9" 
        ); 
        $charsLen = count($chars) - 1; 
        $output = ""; 
        for ($i=0; $i<$len; $i++) 
        {
            $output .= $chars[mt_rand(0, $charsLen)]; 
        }
        return $output; 
    }
}

if ( ! function_exists('cut_string') )
{
    function cut_string($string, $sublen, $start = 0, $code = 'UTF-8') 
    {
        if ($code == 'UTF-8')
        {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);
            if (count($t_string[0]) - $start > $sublen)
            {
                return join('', array_slice($t_string[0], $start, $sublen)) . "...";
            }
            return join('', array_slice($t_string[0], $start, $sublen) );
        }
        else
        {
            $start = $start * 2;
            $sublen = $sublen * 2;
            $strlen = strlen($string);
            $tmpstr = '';
            for($i=0; $i< $strlen; $i++)
            {
                if($i>=$start && $i<($start+$sublen) )
                {
                    if(ord(substr($string, $i, 1) )>129)
                    {
                        $tmpstr .= substr($string, $i, 2);
                    }
                    else
                    {
                        $tmpstr.= substr($string, $i, 1);
                    }
                }
            }
            if(ord(substr($string, $i, 1) ) > 129)
            {
                $i++;
            }
        }
        if(strlen($tmpstr) < $strlen)
        {
            $tmpstr .= '...';
        }
        return $tmpstr;
    }
}