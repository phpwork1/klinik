<?php

namespace common\components\helpers;

use Yii;
use yii\base\Component;

class AppFunction extends Component {

    /**
     * 
     * @return array return array of year, range from -5 to +5, anchor this year
     * @example path description
     */
    public static function year() {
        $year = $temp = array();

        $date = new \DateTime();
        $date->sub(new \DateInterval('P5Y'));
        $temp[0] = $date->format('Y');

        $date->add(new \DateInterval('P10Y'));
        $temp[1] = $date->format('Y');

        for ($i = $temp[0]; $i <= $temp[1]; $i++) {
            $year[$i] = $i;
        }
        return $year;
    }

    public static function dateInterval($fromDate, $toDate) {
        $fdate = new \DateTime($fromDate);
        $tdate = new \DateTime($toDate);
        $tdate->modify('+1 day');
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($fdate, $interval, $tdate);

        $dateInc = array();
        foreach ($period as $dt) {
            $dateInc[$dt->format('Y-m-d')] = $dt->format('Y-m-d');
        }
        return $dateInc;
    }

    public static function minus1Day($date) {
        $date = new \DateTime($date);
        $date->modify('-1 day');
        return $date->format('Y-m-d');
    }

    public static function dateIntervalInMonth($period) {
        $start = date($period . '-01');
        $end = date($period . '-t');

        $dateRange = self::dateInterval($start, $end);
        return $dateRange;
    }

    public static function isInPastOrFuture($date) {
        $today = new \DateTime();
        $eventDate = new \DateTime($date);

        $date->modify('-1 day');
        return $date->format('Y-m-d');
    }

    /**
     * Generate Invoice with format XXYYMMDD-0000
     * @param $lastInvoice
     * @param $prefix
     * @return string return auto-generated invoice_no
     * @throws Yii\web\NotFoundHttpException
     */
    public static function generateInvoiceNo($lastInvoice, $prefix) {
        $invoiceLength = 4;
        ## LAST INVOICE DO NOT FOLLOW CONSTRAINT
        $invoice = empty($lastInvoice) || (strtotime(substr($lastInvoice, 2, 6)) === FALSE) ? $prefix . date('ymd') . '-0000' : $lastInvoice;

        // check time system. if backtrack, show error
        $today = new \DateTime();
        $invoiceDate = new \DateTime('20' . substr($invoice, 2, 6));
        $interval = $invoiceDate->diff($today);
        if ($interval->format('%R') == '-' && $interval->format('%a') != 0) {
            throw new yii\web\NotFoundHttpException('Tanggal sistem mundur dari catatan terakhir di database. Periksa tanggal di sistem Anda, atau hubungi admin Anda.');
        } elseif ($interval->format('%R') == '+' && $interval->format('%a') > 365) {
            throw new yii\web\NotFoundHttpException('Data baru selisih 1 tahunan dari data lama. Periksa tanggal di sistem Anda, atau hubungi admin Anda.');
        } else {
            if (substr($invoice, 2, 6) != date('ymd')) {
                $invoice = $prefix . date('ymd') . '-0001';
            } else {
                $invoice = self::decryptInvoice($invoice);
                $temp = (int) self::decryptInvoice(substr($invoice, -4));
                $temp++;
                // pad zeros to number
                $tempNo = str_pad($temp, $invoiceLength, '0', STR_PAD_LEFT);
                $invoice = $prefix . date('ymd') . '-' . $tempNo;
            }
        }

        return self::encryptInvoice($invoice);
    }

    /**
     * Encrypt invoice
     * @param type $invoice
     * @return type
     */
    public static function encryptInvoice($invoice) {
        ## GET LAST 4 DIGIT FROM INVOICE, AND ENCRYPT
        $inv1 = substr($invoice, 0, 8);
        $inv2 = substr($invoice, -4);
        $inv3 = '';
        for ($i = 0; $i < 4; $i++) {
            $inv3 .= AppConst::$code[$inv2[$i]];
        }
        return $inv1 . '-' . $inv3;
    }

    /**
     * Decrypt invoice
     * @param type $invoice
     * @return type
     */
    public static function decryptInvoice($invoice) {
        ## GET LAST 4 DIGIT FROM INVOICE, AND DECRYPT
        $inv1 = substr($invoice, 0, 8);
        $inv2 = substr($invoice, -4);
        $inv3 = '';
        
        if ((int) $inv2 !== 0) {
            return $invoice;
        } else {
            ## REVERSE KEY <-> VALUE of CODE
            $keys = array_keys(AppConst::$code);
            $values = array_values(AppConst::$code);
            $code = array_combine($values, $keys);

            for ($i = 0; $i < 4; $i++) {
                $inv3 .= $code[$inv2[$i]];
            }
            return $inv1 . '-' . $inv3;
        }
    }

}
