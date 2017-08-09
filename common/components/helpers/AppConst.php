<?php

namespace common\components\helpers;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class AppConst extends Component
{

    //KLINIK
    const APP_NAME_CLINIC = 'KLINIK';


    //APOTIK
    const APP_NAME_PHARMACY = 'APOTIK';


    const APP_NAME = 'Klinik';
    const APP_ADDRESS = 'Jl. Kepulan Asap no.113';
    const APP_CITY = 'Jambi';
    const APP_PROVINCE = 'Jambi';
    const APP_ZIP_CODE = '';
    const APP_PHONE = '(0741) 21292';
    const APP_MOBILE = '';
    const APP_INVOICE_PRINTER = '2';
    const APP_RECEIPT_PRINTER = '2';
    const CASHSALE_INVOICE = 'CS';
    const EXPENSE_INVOICE = 'EX';
    const INCOME_INVOICE = 'IN';
    const PRODUCT_HISTORY_INVOICE = 'PH';
    const PURCHASE_ORDER_INVOICE = 'PO';
    const PURCHASE_PAYMENT_INVOICE = 'PP';
    const PURCHASE_RETURN_INVOICE = 'PR';
    const PURCHASE_RECEIPT_INVOICE = 'PT';
    const DELIVERY_ORDER_INVOICE = 'DO';
    const SALE_ORDER_INVOICE = 'SO';
    const SALE_PAYMENT_INVOICE = 'SP';
    const SALE_RETURN_INVOICE = 'SR';
    const SALE_RECEIPT_INVOICE = 'ST';

    const GENDER_UNKNOWN = 0;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_NOT_APPLICABLE = 9;

    const MR_SINGLE = 1;
    const MR_MARRIED = 2;
    const MR_DIVORCED = 3;

    const SELF_SERVICE = "SS";
    const HAVE_VEHICLE = "HV";
    const NEED_TRANSPORT = "NT";

    public static $GENDER = [
        self::GENDER_UNKNOWN => 'Unknown',
        self::GENDER_MALE => 'Male',
        self::GENDER_FEMALE => 'Female',
        self::GENDER_NOT_APPLICABLE => 'Not Applicable'
    ];

    public static $MARRIAGE_STATUS = [
        self::MR_SINGLE => 'Single',
        self::MR_MARRIED => 'Married',
        self::MR_DIVORCED => 'Divorced',
    ];

    public static $TRANSPORTATION = [
        self::SELF_SERVICE => 'Self service',
        self::HAVE_VEHICLE => 'I have vehicle',
        self::NEED_TRANSPORT => 'I need transport'
    ];

    public static $yesNo = [
        'N' => 'No',
        'Y' => 'Yes'
    ];

    /**
     *
     * @var array get months from january to december
     * @example TsConst::$month
     */
    public static $month = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    /**
     *
     * @var array get months from january to december
     * @example TsConst::$month
     */
    public static $mnth = [
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '1  0' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    /**
     * code
     */
    public static $code = [
        0 => 's',
        1 => 'c',
        2 => 'h',
        3 => 'a',
        4 => 'n',
        5 => 'd',
        6 => 'r',
        7 => 'i',
        8 => 'k',
        9 => 'u',
    ];

}
