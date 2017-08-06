<?php

namespace common\components\helpers;

use yii\base\Component;
use yii\web\NotFoundHttpException;

class Printing extends Component {

    private static $filename = 'temp.txt';
    private static $printer = NULL;
    private static $data = NULL;

    public function __construct($config = array()) {
        parent::__construct($config);
    }

    public function __destruct() {
        
    }

    public static function setFilename($filename) {
        self::$filename = $filename;
    }

    public static function setPrintData($printer) {
        self::$printer = $printer;
    }

    public static function setData($data) {
        self::$data = $data;
    }

    public static function printing() {
        if (empty(self::$filename)) {
            throw new NotFoundHttpException('Program tidak bisa membuat file untuk menyimpan data sementara');
        }
        if (empty(self::$printer)) {
            throw new NotFoundHttpException('Data printer harus ada. Silakan kontak pembuat program ini.');
        }
        if (empty(self::$data)) {
            throw new NotFoundHttpException('Data yang ingin di cetak tidak ada. Silakan kontak pembuat program ini.');
        }

        $filename = self::$filename;
        //$directory = \yii\helpers\Url::to('/temp/') . $filename;
        $fh = fopen($filename, 'w');
        fwrite($fh, self::$data);
        fclose($fh);

        ## SET PRINTER / WINDOWS
        $printerName = "\\\\" . self::$printer->computer_name . "\\" . self::$printer->printer_name;
        $port = self::$printer->printer_port;
        $username = self::$printer->computer_user;
        $password = self::$printer->computer_password;

        ## CONNECT TO PRINTER
        // system('net user');
        exec("net use $port /delete");
        system("net use $port $printerName /persistent:no /user:$username $password");
        //system("net use $port \\\\tsx220\\lx310 /persistent:yes /user:$username $password");
        system("copy $filename $port");
        echo "<br />Proses cetak Nota selesai. Layar ini sudah bisa ditutup<br />";
        //system("copy $filename $printerName");
    }

}

// use temporary folder?
//    $tempdir = sys_get_temp_dir();
//    $filename = tempnam($tempdir, 'temp.txt');
//copy ($filename, '\\\\ts-pc\\lx300');
//exit;
// set printer
//$printerName = DS . DS . $printer['server'] . DS . $printer['name'];

/*
  exit;
  if (!copy($filename, $printerName)) {
  echo 'cannot print!';
  } else {
  //unlink($filename);
  }
 */
?>