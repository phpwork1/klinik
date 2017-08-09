<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Klinik';
?>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pasien / Member</span>
                        <span class="info-box-number">
                  	<small>
                    	<?php //echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pasien")); ?> orang
                    </small>
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Registrasi</span>
                        <span class="info-box-number">
					<?php
                    $tglskrg=date("Y-m-d");
                    ?>
                            <small>Praktik : <?php //echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM registrasi WHERE jenis=1 AND tglreg='$tglskrg' AND ver=0 ORDER BY noreg")); ?> orang</small>
                  </span>
                        <span class="info-box-number">
                   	<small>Klinik : <?php //echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM registrasi WHERE jenis=2 AND tglreg='$tglskrg' AND ver=0")); ?> orang</small>
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pasien / Member <br> Ultah</span>
                        <span class="info-box-number">
                  	<small>

                    	<?php //echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pasien WHERE tgllahir='".date("Y-m-d")."'")); ?> orang
                    </small>
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pasien / Member <br>Baru</span>
                        <span class="info-box-number">
					<?php
                    $tgl1=mktime(0,0,0,date("m"),date("d")-7,date("y"));$tgl1=date("Y-m-d",$tgl1);
                    $tgl2=date("Y-m-d");
                    //echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pasien WHERE tglrekmed>='$tgl1' AND tglrekmed<='$tgl2'")); ?> orang
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Registrasi Pasien</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th width="10%">No. Reg.</th>
                                    <th width="20%">Nama Pasien</th>
                                    <th width="12%">Posisi</th>
                                    <th width="12%">Keluhan</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php /*
                                $no=0;
                                $tglskrg=date("Y-m-d");
                                $qryregistrasi=mysqli_query($koneksi, "SELECT * FROM registrasi WHERE tglreg='$tglskrg' ORDER BY noreg DESC");
                                while ($rsregistrasi=mysqli_fetch_assoc($qryregistrasi)){
                                    ?>

                                    <tr>
                                        <td><?php echo $rsregistrasi['noreg']; ?></td>
                                        <td>
                                            <?php
                                            $norekmed=$rsregistrasi['norekmed'];
                                            $rspasien=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM pasien WHERE norekmed='$norekmed'"));
                                            echo $rspasien['nama'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($rsregistrasi['jenis']=="1"){
                                                echo "Praktik Dokter";
                                            }else{
                                                echo "Klinik Kecantikan";
                                            }
                                            ?>
                                        </td>

                                        <td><?php echo $rsregistrasi['keluhan']; ?></td>
                                    </tr>

                                <?php } */?>
                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="?show=registrasi" class="btn btn-sm btn-info btn-flat pull-left">Lihat Pendaftaran</a>
                        <a href="?show=pasien" class="btn btn-sm btn-default btn-flat pull-right">Pasien Baru</a>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-4">
                <!-- REGISTRASI PASIEN / MEMBER -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pasien / Member Baru</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">

                            <?php /*
                            $no=0;
                            $qrypasien=mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY norekmed DESC LIMIT 0,5");
                            while ($rspasien=mysqli_fetch_assoc($qrypasien)){
                                ?>

                                <li class="item">
                                    <div class="product-img">
                                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript::;" class="product-title"><?php echo $rspasien['nama']; ?> <span class="label label-warning pull-right"><?php echo $rspasien['norekmed']; ?> </span></a>
                                        <span class="product-description">
                          <?php echo $rspasien['alamat']; ?> HP : <?php echo $rspasien['telp']; ?>
                        </span>
                                    </div>
                                </li><!-- /.item -->

                            <?php } */?>
                        </ul>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="?show=pasien" class="uppercase">Pasien Lainnya</a>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

