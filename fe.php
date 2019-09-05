<?php
 /***********************************************************************
  * Projectname:   For-Each
  * Version:       0.6.1
  * Author:        Fatih Guersu | fg at webdevels dot de
  * Last modified: 22.09.2007
  * Last modified: 26.04.2009
  * Last modified: 06.12.2016
  * Last modified: 11.06.2019
  * Last modified: 16.06.2019
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
  ************************************************************************/

/**
 * Shows the content of an array/variable, better alternative to var_dump.
 *
 * @param   mixed   $input the array/variable to show
 * @param   boolean $firstRun for internal use only (do not use or change it)
 * @return  string  html table with arrays/variables content
 */
function fe($input, $firstRun=true) {
    $nl = PHP_EOL;

    $op = '';
    $style = '';

    $style .= '<style>'.$nl;
    $style .= 'tr { vertical-align:top; }'.$nl;
    $style .= '.fe-table-outer { border-collapse:separate; border-spacing:2px 1px; background-color:#fff; border:1px dotted #000; margin:8px; }'.$nl;
    $style .= '.fe-table-inner { border-collapse:separate; border-spacing:2px 1px; border:0px solid #336699; }'.$nl;
    $style .= '.fe-array-name { padding:2px 4px; background-color:#069; border:none; color:#fff; font-weight:bold; }'.$nl;
    $style .= '.fe-array-child { padding:8px 0px; background-color:transparent; border:none; color:#333; font-weight:normal; }'.$nl;
    $style .= '.fe-array-key { padding:2px 4px; background-color:#d5d5d5; border:none; color:#069; font-weight:bold; }'.$nl;
    $style .= '.fe-array-var { padding:2px 4px; background-color:#f5f5f5; border:none; color:#333; font-weight:normal; }'.$nl;
    $style .= '.fe-empty { padding:8px 10px; background-color:#a5011c; border:none; color:#fff; font-weight:normal; }'.$nl;
    $style .= '</style>'.$nl;

    if(is_array($input)) {
        $op .= ($firstRun == true) ? '<table class="fe-table-outer rounded">'.$nl : '<table class="fe-table-inner rounded">'.$nl;
        if(count($input) === 0) {
            $op .= '<tr class="rounded">'.$nl;
            $op .= '<td class="fe-array-child fe-empty rounded">Array given but no entries found.</td>'.$nl;
            $op .= '</tr>'.$nl;
        }
        foreach($input as $key1 => $val1) {
            if(is_array($input[$key1])) {
                $op .= '<tr class="rounded">'.$nl;
                $op .= '<td class="fe-array-name rounded" data-toggle="tooltip" data-placement="top" title="count( '.count($input[$key1]).' )">[\''.$key1.'\']</td>'.$nl;
                $op .= '<td class="fe-array-child rounded">'.$nl;
                $op .= fe($input[$key1], false);
                $op .= '</td>'.$nl;
                $op .= '</tr>'.$nl;
            } else {
                $op .= '<tr data-toggle="tooltip" data-placement="right" title="gettype( '.strtoupper(gettype($val1)).' )">'.$nl;
                $op .= '<td class="fe-array-key rounded">[\''.$key1.'\']</td>'.$nl;
                $op .= '<td class="fe-array-var rounded">'.$nl;
                $op .= feValueHelper($val1);
                $op .= '</td>'.$nl;
                $op .= '</tr>'.$nl;
            }
        }

        $op .= '</table>'.$nl;
    } else {
        $op .= '<table class="fe-table-outer rounded">'.$nl;
        $op .= '<tr data-toggle="tooltip" data-placement="right" title="gettype( '.strtoupper(gettype($input)).' )">'.$nl;
        $op .= '<td class="fe-array-key rounded">Content of Variable:</td>'.$nl;
        $op .= '<td class="fe-array-var rounded">'.$nl;
        $op .= feValueHelper($input);
        $op .= '</td>'.$nl;
        $op .= '</tr>'.$nl;
        $op .= '</table>'.$nl;
    }

    return ($firstRun===true ? $style : '').$op;
}

/**
 * Helper for fe() function
 *
 * @param   mixed   $value variables content to show infos about
 * @return  string  infos about the content, printable infos (string, numbers) are shown directly
 */
function feValueHelper($value) {
    if(is_bool($value)) {
        if($value === true) {
            return 'TRUE';
        } elseif($value === false) {
            return 'FALSE';
        } else {
            return 'unknown (bool)'; // ?
        }
    } elseif(is_float($value) || is_int($value)) {
        return $value;
    } elseif(is_null($value)) {
        return 'NULL';
    } elseif(is_string($value)) {
        if(is_numeric($value)) {
            return '"'.$value.'"';
        } else {
            if(empty($value)) {
                return '(empty)';
            } else {
                return $value;
            }
        }
    } elseif(is_object($value)) {
        return 'OBJECT';
    } elseif(is_resource($value)) {
        return 'RESOURCE';
    } elseif(is_scalar($value)) {
        return 'SCALAR';
    } else {
        return 'unkown: '.$value;
    }
}
?>