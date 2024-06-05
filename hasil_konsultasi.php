<!-- proses menampilkan data hasil konsultasi -->
<?php 

// Mengambil id dari parameter
$id_konsultasi=$_GET['id_konsultasi'];

$sql = "SELECT * FROM tb_konsultasi WHERE id_konsultasi='$id_konsultasi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


<!-- tampilan halaman hasil konsultasi -->
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                        <div class="card-header bg-success text-white border-dark" align ="center"><strong>HASIL KONSULTASI</strong></div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="">Nama Pasien</label>
                                <input type="text" class="form-control" value="<?php echo $row['nama'] ?>" name="nama" readonly>
                            </div>

                            <!-- tabel gejala gejala -->
                            <label for="">Gejala Gejala Penyakit Yang Dipilih :</label>
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="40px">No</th>
                                <th width="700px">Nama Gejala</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no=1;
                                $sql = "SELECT tb_detail_konsul.id_konsultasi,tb_detail_konsul.id_gejala,tb_gejala.nama_gejala FROM tb_detail_konsul 
                                INNER JOIN tb_gejala ON tb_detail_konsul.id_gejala=tb_gejala.id_gejala WHERE id_konsultasi='$id_konsultasi'";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama_gejala']; ?></td>
                                </tr>
                            <?php 
                                }
                            ?>
                            </tbody>
                            </table>

                            <!-- hasil konsultasi penyakitnya -->
                            
                            <label for="">Hasil Konsultasi Penyakit Anda :</label>
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="40px">No</th>
                                <th width="150px">Nama Penyakit</th>
                                <th width="100px">Persentase</th>
                                <th width="700px">Solusi</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no=1;
                                $sql = "SELECT tb_detail_penyakit.id_konsultasi,tb_detail_penyakit.id_penyakit,tb_penyakit.nama_penyakit,tb_penyakit.solusi,tb_detail_penyakit.persentase FROM tb_detail_penyakit
                                INNER JOIN tb_penyakit ON tb_detail_penyakit.id_penyakit=tb_penyakit.id_penyakit WHERE id_konsultasi='$id_konsultasi' ORDER BY persentase DESC";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama_penyakit']; ?></td>
                                    <td><?php echo $row['persentase'] . "%"; ?></td>
                                    <td><?php echo $row['solusi']; ?></td>
                                </tr>
                            <?php 
                                }
                                $conn->close();
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>