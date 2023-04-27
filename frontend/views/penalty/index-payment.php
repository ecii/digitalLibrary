

<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title="Pembayaran";

$id_rent_record=['rent_record_id'=>$_GET['rent_record_id']];
?>
<div class="card border-info">
    <div class="card-header">
        <h3 class="display-3">Pembayaran</h3>
    </div>
    <div class="card-body">
        
       
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Peminjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjam</th>
                    <th>Lama Peminjaman</th>
                    <th>Jumlah Hari Denda</th>
                    <th>Jumlah Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <!-- <td>".$pinjam->book->title."</td> 
            dimana $pinjam itu adalah record yang diambil dari model book dan akan menampikan field title -->
                <?php
                $no=1;
               
                $dataPinjam=$model->find()->where($id_rent_record)->all();
                foreach($dataPinjam as $pinjam){
                    
                    echo"
                        <tr>
                            <td>".$no++."</td>
                            <td>".$pinjam->book->title."</td>
                            <td>".$pinjam->rentRecord->profile->name."</td>
                            <td>".$pinjam->rentRecord->created_at."</td>
                            <td>".$pinjam->rentRecord->return_at."</td>
                            <td>".$pinjam->rentRecord->rent_status."</td>
                            <td>".$pinjam->penalty->lamaPeminjaman($id_rent_record)." Hari</td>
                            <td>".$pinjam->penalty->lamaDenda($id_rent_record)." Hari</td>
                            <td>Rp. ".$pinjam->penalty->hitungDenda($id_rent_record).",-</td>
                            <td>".Html::a('Print', ['penalty/print','rent_record_id' => $pinjam->rent_record_id],['class' => 'btn btn-success'])."</td>
                            
                        </tr>
                        
                        ";

                }
               echo" <tr>
                        <td colspan=\"8\" align=\"center\"><b>Total Harga : </b></td>
                        <td colspan=\"2\"><b>".$pinjam->penalty->totalHarga($id_rent_record)."</b></td>
                    </tr>  
                ";          
                ?>
               
            </tbody>
        </table>
    </div>
</div>

