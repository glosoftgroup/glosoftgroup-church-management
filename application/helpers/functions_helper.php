<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');

/**
 * @author       Ben
 */
// ------------------------------------------------------------------------
function time_ago($time)
{
        $time = (is_numeric($time) ? $time : strtotime($time));
        $delta = time() - $time;

        switch (TRUE)
        {
                case ($delta < 0):
                        $str = 'Time is in the future!';
                        break;
                case ($delta < 60):
                        $str = 'Just Now';
                        break;
                case ($delta < 120):
                        $str = '1 minute ago';
                        break;
                case ($delta < 3600):
                        $str = round($delta / 60) . ' minutes ago';
                        break;
                case ($delta < 7200):
                        $str = '1 hour ago';
                        break;
                case ($delta < 3600 * 24):
                        $str = round($delta / 3600) . ' hours ago';
                        break;
                case ($delta < 3600 * 48):
                        $str = 'Yesterday';
                        break;
                default:
                        $str = round($delta / 86400) . ' days ago';
        }

        return $str;
}

function twoword($digit)
{
        switch ($digit)
        {
                case "0":
                        return "zero";
                case "1":
                        return "one";
                case "2":
                        return "two";
                case "3":
                        return "three";
                case "4":
                        return "four";
                case "5":
                        return "five";
                case "6":
                        return "six";
                case "7":
                        return "seven";
                case "8":
                        return "eight";
                case "9":
                        return "nine";
        }
}

function file_sizer($kb, $precision = 2)
{
        $base = log($kb) / log(1024);
        $suffixes = array(' kb', ' MB', ' GB', ' TB');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

function get_perm()
{
        $ci = &get_instance();
        $ci->load->library('Pad');
        $padl = new Padl\License(true, true, true, true);
        return $padl->validate($ci->school->active->license);
}

function starts_with($haystack, $needle)
{
        return substr($haystack, 0, strlen($needle)) === $needle;
}

/**
 * @author       Ben
 */
// ------------------------------------------------------------------------
function in_multiarray($elem, $array, $field)
{
        $top = sizeof($array) - 1;
        $bottom = 0;
        while ($bottom <= $top)
        {
                if ($array[$bottom][$field] == $elem)
                        return true;
                else
                if (is_array($array[$bottom][$field]))
                        if (in_multiarray($elem, ($array[$bottom][$field])))
                                return true;

                $bottom++;
        }
        return false;
}

/**
 * asort Function Extension to Add capability for Sorting Multidimensional Array by Specific key
 *
 * @param array $array
 * @param type $key
 * @return array
 */
function aasort(&$array, $key, $dir = FALSE)
{
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va)
        {
                $sorter[$ii] = $va[$key];
        }
        if ($dir)
        {
                arsort($sorter);
        }
        else
        {
                asort($sorter);
        }

        foreach ($sorter as $ii => $va)
        {
                $ret[$ii] = $array[$ii];
        }
        $array = $ret;
        return $array;
}

/**
 * Determine if Array Contains Duplicates
 * 
 * @param array $array
 * @return boolean
 */
function has_duplicate($array)
{
        return (count($array) == count(array_unique($array))) ? FALSE : TRUE;
}

/**
 * Return Count of All Duplicate instances for each element in an array
 * 
 * @param array $array
 * @param type $dupval
 * @return int
 */
function duplicates($array, $dupval)
{
        $nb = 0;
        foreach ($array as $key => $val)
        {
                if ($val == $dupval)
                {
                        $nb++;
                }
        }
        return $nb;
}

function sort_by_field(&$arr, $col, $dir = SORT_ASC)
{
        $sort_col = array();
        foreach ($arr as $key => $row)
        {
                $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
        return $arr;
}

function trim_str($str, $len)
{
        $length = strlen($str);
        if ($length > $len)
        {
                return substr($str, 0, $len) . '...';
        }
        else
        {
                return $str;
        }
}

function seconds_from_time($time)
{
        list($h, $m, $s) = explode(':', $time);
        return ($h * 3600) + ($m * 60) + $s;
}

function seconds_to_time($seconds)
{
        $h = floor($seconds / 3600);
        $m = floor(($seconds % 3600) / 60);
        $s = $seconds - ($h * 3600) - ($m * 60);
        return sprintf('%02d:%02d:%02d', $h, $m, $s);
}

function get_extension($filename)
{
        $x = explode('.', $filename);
        return end($x);
}

function gen_string()
{
        return substr(number_format(time() * rand(), 0, '', ''), 0, 5);
}

/**
 * Generate Random Ref Number
 * 
 * @return string
 */
function refNo()
{
        $chars = "123456789ABCEDFGHJKLMNPQRSTUVWXYZ";
        srand((double) microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 8)
        {
                $num = rand() % 11;
                $tmp = substr($chars, $num, 1);
                $pass = $pass . $tmp;
                $i++;
        }
        return $pass;
}

/**
 * Sort by array
 * 
 * @param array $main_array
 * @param array $sorter_array
 * @return array
 */
function sort_by_array($main_array, $sorter_array)
{
        return array_replace(array_flip($sorter_array), $main_array);
}

function sort_multi_array($array, $key)
{
        $keys = array();
        for ($i = 1; $i < func_num_args(); $i++)
        {
                $keys[$i - 1] = func_get_arg($i);
        }

        // create a custom search function to pass to usort
        $func = function ($a, $b) use ($keys)
        {
                for ($i = 0; $i < count($keys); $i++)
                {
                        if ($a[$keys[$i]] != $b[$keys[$i]])
                        {
                                return ($a[$keys[$i]] < $b[$keys[$i]]) ? -1 : 1;
                        }
                }
                return 0;
        };

        usort($array, $func);

        return $array;
}

function sort_function(array $a, array $b)
{

        $arr1_val = array_sum($a);
        $arr2_val = array_sum($b);
        return $arr2_val - $arr1_val;
}

function get_bk()
{
        return array(
            'total_count' => 1,
            'created_by' => 1,
            'created_on' => time()
        );
}

function cmp($a, $b)
{
        foreach ($a as $key => $value)
        {
                foreach ($b as $bKey => $bValue)
                {
                        return $bValue - $value;
                }
        }
}

function convert_number_to_words($number)
{
        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number))
        {
                return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX)
        {
                // overflow
                trigger_error(
                             'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
                );
                return false;
        }

        if ($number < 0)
        {
                return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false)
        {
                list($number, $fraction) = explode('.', $number);
        }

        switch (true)
        {
                case $number < 21:
                        $string = $dictionary[$number];
                        break;
                case $number < 100:
                        $tens = ((int) ($number / 10)) * 10;
                        $units = $number % 10;
                        $string = $dictionary[$tens];
                        if ($units)
                        {
                                $string .= $hyphen . $dictionary[$units];
                        }
                        break;
                case $number < 1000:
                        $hundreds = $number / 100;
                        $remainder = $number % 100;
                        $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                        if ($remainder)
                        {
                                $string .= $conjunction . convert_number_to_words($remainder);
                        }
                        break;
                default:
                        $baseUnit = pow(1000, floor(log($number, 1000)));
                        $numBaseUnits = (int) ($number / $baseUnit);
                        $remainder = $number % $baseUnit;
                        $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                        if ($remainder)
                        {
                                $string .= $remainder < 100 ? $conjunction : $separator;
                                $string .= convert_number_to_words($remainder);
                        }
                        break;
        }

        if (null !== $fraction && is_numeric($fraction))
        {
                $string .= $decimal;
                $words = array();
                foreach (str_split((string) $fraction) as $number)
                {
                        $words[] = $dictionary[$number];
                }
                $string .= implode(' ', $words);
        }

        return $string;
}
