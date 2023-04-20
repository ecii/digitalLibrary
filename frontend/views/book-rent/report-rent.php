<?php
$this->title="Laporan Peminjaman";
?>
<div class="card border-info">
    <div class="card-header">
        <h3 class="display-3">Laporan Peminjaman</h3>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Status Peminjam</th>
                    <th>Jumlah Pinjam</th>
                </tr>
            </thead>
            <tbody>
            <!-- <td>".$pinjam->book->title."</td> 
            dimana $pinjam itu adalah record yang diambil dari model book dan akan menampikan field title -->
                <?php
                $no=1;
                $dataPinjam=$model->find()->all();
                foreach($dataPinjam as $pinjam){
                    
                    echo"
                        <tr>
                            <td>".$no++."</td>
                            <td>".$pinjam->book->title."</td>
                            <td>".$pinjam->rentRecord->profile->name."</td>
                            <td>".$pinjam->rentRecord->rent_status."</td>
                            <td>".$pinjam->book->jumPinjam()." Kali</td>
                        </tr>
                    ";
                }
               
                ?>
                
            </tbody>
        </table>
    </div>
</div>