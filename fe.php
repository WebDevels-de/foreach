<?php
/**
 * Projectname:   ForEach
 * Version:       0.6.1
 * Author:        Fatih Guersu | fg at webdevels dot de
 * Last modified: 22.09.2007
 * Last modified: 26.04.2009
 * Last modified: 06.12.2016
 * Copyright (C): 2006 Fatih Guersu, all rights reserved
 * 
 * GNU General Public License (Version 2, June 1991)
 * This program is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 * 
 * Description:
 * Will show you all keys and values in arrays & multidimensional arrays
 */

/**
 * Simple PHP Function that will dump an Array in a visual HTML Table.
 *
 * Usage: include this file & run fe()
 * include 'path/to/this/fe.php';
 * $var = fe($myArray); // will return html code to $var
 * fe($myArray, false); // will echo out the html code
 * 
 * @param   array   $inputArray this is the array/variable for output
 * @param   bool    $returnOuput if true the output will be returned, false will produce a direct echo
 * @param   bool    $firstRun (internal use) do not change this! 
 * 
 * @return  string/void based on $returnOuput: true=string (html table), false=direct echo 
 */
function fe($inputArray, $returnOuput=true, $firstRun=true) {
    $op = '';

    if(is_array($inputArray)) {
        $op .= ($firstRun == true) ? '<table border="1" class="fetable" style="border-collapse:separate; border-spacing:2px 1px; background-color:#fff; border:1px solid #000; margin:4px">'.PHP_EOL : '<table border="1" style="border-collapse:separate; border-spacing:2px 1px; background-color:#fff; border:1px solid #fff">'.PHP_EOL;

        foreach($inputArray as $key1 => $val1) {
            if(is_array($inputArray[$key1])) {
                $op .= '<tr style="vertical-align:top">'.PHP_EOL;
                $op .= '<td style="padding:2px 4px; background-color:#069; border:none; color:#fff; font-weight:bold">[\''.$key1.'\']</td>'.PHP_EOL;
                $op .= '<td style="padding:2px 4px; background-color:#fff; border:none; color:#333; font-weight:normal">'.PHP_EOL;
                $op .= fe($inputArray[$key1], true, false);
            } else {
                $op .= '<tr style="vertical-align:top" data-popup="tooltip" data-placement="left" data-original-title="gettype( '.strtoupper(gettype($val1)).' )" title="gettype( '.strtoupper(gettype($val1)).' )">'.PHP_EOL;
                $op .= '<td style="padding:2px 4px; background-color:#CCC; border:none; color:#069; font-weight:bold">[\''.$key1.'\']</td>'.PHP_EOL;
                $op .= '<td style="padding:2px 4px; background-color:#f5f5f5; border:none; color:#333; font-weight:normal; word-break:break-word">'.PHP_EOL;
                if(is_bool($val1)) {
                    if($val1 === true) {
                        $op .= 'TRUE'.PHP_EOL;
                    } elseif($val1 === false) {
                        $op .= 'FALSE'.PHP_EOL;
                    } else {
                        $op .= 'unknown (bool)'.PHP_EOL;
                    }
                } elseif(is_float($val1) || is_int($val1)) {
                    $op .= $val1.PHP_EOL;
                } elseif(is_null($val1)) {
                    $op .= 'NULL';
                } elseif(is_string($val1)) {
                    if(is_numeric($val1)) {
                        $op .= '"'.$val1.'"'.PHP_EOL;
                    } else {
                        if(empty($val1)) {
                            $op .= '(empty)'.PHP_EOL;
                        } else {
                            $op .= $val1.PHP_EOL;
                        }
                    }
                } elseif(is_object($val1)) {
                    $op .= 'OBJECT';
                } elseif(is_resource($val1)) {
                    $op .= 'RESOURCE';
                } elseif(is_scalar($val1)) {
                    $op .= 'SCALAR';
                } else {
                    $op .= 'unkown: '.$val1.PHP_EOL;
                }
            }
            $op .= '</td>'.PHP_EOL;
            $op .= '</tr>'.PHP_EOL;
        }

        $op .= '</table>'.PHP_EOL;
    } else {
        $op .= '<table border="1" style="border-collapse:separate; border-spacing:2px 1px; background-color:#fff; border:1px solid #000; margin:4px">'.PHP_EOL;
        $op .= '<tr>'.PHP_EOL;
        $op .= '<td colspan="2" style="padding:2px 4px; background-color:#069; border:none; color:#fff; font-weight:bold">Info: fe() needs an array to proceed.</td>'.PHP_EOL;
        $op .= '</tr>'.PHP_EOL;
        $op .= '<tr style="vertical-align:top" data-popup="tooltip" data-placement="left" data-original-title="gettype( '.strtoupper(gettype($inputArray)).' )"  title="gettype( '.strtoupper(gettype($inputArray)).' )">'.PHP_EOL;
        $op .= '<td style="padding:2px 4px; background-color:#CCC; border:none; color:#069; font-weight:bold">Your values content is:</td>'.PHP_EOL;
        $op .= '<td style="padding:2px 4px; background-color:#f5f5f5; border:none; color:#333; font-weight:normal">'.PHP_EOL;
        if(is_bool($inputArray)) {
            if($inputArray === true) {
                $op .= 'TRUE'.PHP_EOL;
            } elseif($inputArray === false) {
                $op .= 'FALSE'.PHP_EOL;
            } else {
                $op .= 'unknown (bool)'.PHP_EOL;
            }
        } elseif(is_float($inputArray) || is_int($inputArray)) {
            $op .= $inputArray.PHP_EOL;
        } elseif(is_null($inputArray)) {
            $op .= 'NULL';
        } elseif(is_string($inputArray)) {
            if(is_numeric($inputArray)) {
                $op .= '"'.$inputArray.'"'.PHP_EOL;
            } else {
                if(empty($inputArray)) {
                    $op .= '(empty)'.PHP_EOL;
                } else {
                    $op .= $inputArray.PHP_EOL;
                }
            }
        } elseif(is_object($inputArray)) {
            $op .= 'OBJECT';
        } elseif(is_resource($inputArray)) {
            $op .= 'RESOURCE';
        } elseif(is_scalar($inputArray)) {
            $op .= 'SCALAR';
        } else {
            $op .= 'unkown: '.$inputArray.PHP_EOL;
        }
        $op .= '</td>'.PHP_EOL;
        $op .= '</tr>'.PHP_EOL;


        $op .= '</table>'.PHP_EOL;
    }

    if($returnOuput == FALSE) {
        echo $op;
    } else {
        return $op;
    }
}
?>
