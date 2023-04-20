<?php

/** @var yii\web\View $this */

use common\models\Book;
use common\models\Profile;
use common\models\RentRecord;

$this->title = 'Pasaribu\'s Digital Library';
$mBook=new Book();
$mProfile=new Profile();
$mRentRecord=new RentRecord();
?>

<div class="container">
    <div class="col-lg-12">
        <h3 class="dispaly-3">Daftar Buku</h3>
        <hr>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Jumlah Pinjam</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    $dataBuku = Book::listBookIndex(); 

                    //dari model Book gunakan function List book index dan masukkan ke variabel dataBuku

                    foreach($dataBuku as $buku){ 
                    // setiap gabungan record yang ada di data buku pecah lagi menggunakan 
                    //foreach dan simpan ke variabel buku
                    $style = "";   
                    if ($buku->jumPinjam()>0){
                        $style = "background-color:red";
                    }
                    
                        echo
                        '
                            <tr style="'.$style.'">
                                <td>'.$no++.'</td>
                                <td>'.$buku->title.'</td>
                                <td>'.$buku->author.'</td>
                                <td>'.$buku->publisher.'</td>
                                <td>'.$buku->year.'</td>
                                <td>'.$buku->jumPinjam().'</td>
                            </tr>
                        
                        ';
                    
                    }
                ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-success">
                    <div class="card-header">
                        <h3>Judul Buku</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        echo"<h1>".$buku->jumBuku()."</h1>";
                        ?>
                        
                        <small>Judul</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-info">
                    <div class="card-header">
                        <h3>Jumlah Member</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        echo"<h1>".$mProfile->jumMember()."</h1>";
                        ?>
                        <small>Anggota</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-Primary">
                    <div class="card-header">
                        <h3>Jumlah Pinjaman</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        echo"<h1>".$mRentRecord->jumPeminjaman()."</h1>";
                        ?>
                        <small>Pinjaman</small>
                    </div>
                </div >
            </div>

        </div>
    </div>
</div>
