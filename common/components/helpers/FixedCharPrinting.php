<?php

namespace common\components\helpers;

/*
 * layout:
 * array (totalWidth, array(col1Align => col1Width), array(col2Align => col2Width), ...);
 * 
 * linebreak: $sign;
 * 
 * format data
 * array (
 *  [0] => $item,
 *  [1] => array(
 *      [0] => array(
 *      [0] => $item,
 *      [1] => $item,
 *      ...
 *  ),
 *  [1] => array(
 *      [0] => $item,
 *      [1] => $item,
 *      ...
 *  ),
 * );
 */

/**
 * Description of FixedWidthHelper
 *
 * @author Tonny Sofijan
 */
#App::uses('AppHelper', 'Helper');
use yii\base\Component;

class FixedCharPrinting extends Component {

    public static $maxLength;
    public static $colWidth = array();
    public static $colAlign = array();
    public static $data = array();
    public static $command = null;

    public function __construct(View $view, $settings = array()) {
        parent::__construct($view, $settings);
        //return self::$data[] = chr(27) . chr(64);
    }

    public function __destruct() {
        //unset(self::$maxLength, self::colWidth, self::colAlign, self::$data);
    }

    public static function initialize() {
        return $data[] = chr(27) . chr(64);
    }

    public static function formFeed() {
        return self::$data[] = chr(12);
    }

    public static function lineFeed() {
        return self::$data[] = chr(10);
    }

    public static function cr() {
        return self::$data[] = chr(13);
    }
    
    public static function cut() {
        return self::$data[] = chr(29) . 'V' . chr(66) . chr(0);
    }

    // in cm
    public static function setPageLength($length = 14) {
        $unit = 360;
        $lengthCm = 14;
        $lengthInch = round($lengthCm / 2.54, 1);
        $lengthUnit = $lengthInch * $unit;
        $mh = floor($lengthUnit / 256);
        $ml = $lengthUnit % 256;
        
        $result = chr(27) . '(U' . chr(1) . chr(0) . chr(10);
        $result .= chr(27) . '(C' . chr(2) . chr(0) . chr($ml) . chr($mh);

        self::$data[] = $result;
    }

    public static function setLineSpacing($val = '1/6') {
        if ($val == '1/6') {
            $result = chr(27) . chr(48);
        } else {
            $result = chr(27) . chr(50);
        }

        self::$data[] = $result;
    }

    public static function setCPI($cpi = 10) {
        $result = chr(27);
        switch ((int) $cpi) {
            case 10:
               $result .= chr(80); // P
                break;
            case 12:
               $result .= chr(77); // M
                break;
            case 15:
               $result .= chr(103); // g
                break;
            case 0:
               $result .= chr(113); // p
                break;
        }
        
        self::$data[] = $result;
    }
    
    public static function setPrintQuality($type = 0) {
        $result = chr(27) . 'x';
        switch (strtolower($type)) {
            case 0:
                $result .= chr(48);
                break;
            case 1:
                $result .= chr(49);
                break;
        }
        
        self::$data[] = $result;
    }

    public static function setBold($bool = true) {
        if ($bool) {
            $result = chr(27) . chr(69);
        } else {
            $result = chr(27) . chr(70);
        }

        self::$data[] = $result;
    }

    public static function setItalic($bool = true) {
        if ($bool) {
            $result = chr(27) . chr(52);
        } else {
            $result = chr(27) . chr(53);
        }

        self::$data[] = $result;
    }

    public static function setUnderline($bool = true) {
        if ($bool) {
            $result = chr(27) . chr(45) . chr(49);
        } else {
            $result = chr(27) . chr(45) . chr(48);
        }
        
        self::$data[] = $result;
    }

    public static function setCondensed($bool = true) {
        if ($bool) {
            $result = chr(15);
        } else {
            $result = chr(18);
        }
        
        self::$data[] = $result;
    }

    /*
     * 0 = Roman           7 = Orator
     * 1 = Sans serif      8 = Orator-S
     * 2 = Courier         9 = Script C
     * 3 = Prestige       10 = Roman T
     * 4 = Script         11 = San serif H
     * 5 = OCR-A          30 = SV Busaba
     * 6 = OCR-B          31 = SV Jittra
     */

    public static function setTypeface($typeface = 2) {
        $result = chr(27) . 'k';
        switch ((int) $typeface) {
            case 0:
                $result .= chr(0);
                break;
            case 1:
                $result .= chr(1);
                break;
            case 2:
                $result .= chr(2);
                break;
            case 3:
                $result .= chr(3);
                break;
            case 4:
                $result .= chr(4);
                break;
            case 5:
                $result .= chr(5);
                break;
            case 6:
                $result .= chr(6);
                break;
            case 7:
                $result .= chr(7);
                break;
            case 8:
                $result .= chr(8);
                break;
            case 9:
                $result .= chr(9);
                break;
            case 10:
                $result .= chr(10);
                break;
            case 30:
                $result .= chr(30);
                break;
            case 31:
                $result .= chr(31);
                break;
        }
        
        self::$data[] = $result;
    }

    public static function layout($data) {
        self::$maxLength = null;
        self::$colWidth = array();
        self::$colAlign = array();

        self::$maxLength = $data[0];
        unset($data[0]);
        foreach ($data as $item) {
            foreach ($item as $colAlign => $colWidth) {
                self::$colWidth[] = floor($colWidth);
                self::$colAlign[] = strtolower(trim($colAlign));
            }
        }
        unset($data);
    }

    public static function emptyData() {
        self::$data = array();
    }

    public static function lineBreak($sign) {
        self::$data[] = str_repeat($sign, self::$maxLength) . "\r\n";
    }

    public static function receipt($data) {
        if (isset(self::$maxLength)) {
            # if array count == 1, center. else, for the last item, right
            foreach ($data as $item) {
                if (!is_array($item)) {
                    $item = trim($item);
                    $strLen = strlen($item);
                    if ($strLen > self::$maxLength) {
                        substr($item, 0, self::$maxLength);
                    } else {
                        $remainingLen = self::$maxLength - $strLen;
                        $prefix = str_repeat(' ', floor($remainingLen / 2));
                        $postfix = str_repeat(' ', ceil($remainingLen / 2));
                        self::$data[] = $prefix . $item . $postfix . "\r";
                    }
                } elseif (count($item) >= 2) {
                    $temp = array();
                    foreach ($item as $idx => $subitem) {
                        if (strlen($subitem) > self::$colWidth[$idx]) {
                            $subitem = substr($subitem, 0, self::$colWidth[$idx] - 3); // . '..';
                        }
                        $siLength = strlen($subitem);

                        $charSpacing = str_repeat(' ', self::$colWidth[$idx] - $siLength);
                        if (self::$colAlign[$idx] == 'left') {
                            $temp[] = $subitem . $charSpacing;
                        } elseif (self::$colAlign[$idx] == 'right') {
                            $temp[] = $charSpacing . $subitem;
                        } elseif (self::$colAlign[$idx] == 'center') {
                            $pre = str_repeat(' ', floor(self::$colWidth[$idx] - $siLength) / 2);
                            $post = str_repeat(' ', ceil(self::$colWidth[$idx] - $siLength) / 2);
                            $temp[] = $pre . $subitem . $post;
                        }
                    }
                    self::$data[] = implode('', $temp) . "\r\n";
                }
            }
        }

        // add header, like initialize printer, cpi, bold, page length, etc.
    }
    
    public static function getResult() {
        $result = implode("", self::$data);
        self::emptyData();
        return $result;
    }

}
