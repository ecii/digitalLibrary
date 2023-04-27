<div class="card border-info">
    <div class="card-header">
        <center>
        <h1 class="display-3">Resi Pembayaran</h1>
        </center>
        
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
                 
                </tr>
            </thead>
            <tbody>
            <?php
                $id_rent_record=$_GET['rent_record_id'];
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
                                                  
                        </tr>
                    ";
                }
               
                ?>
            </tbody>
        </table>
    </div>
</div>
