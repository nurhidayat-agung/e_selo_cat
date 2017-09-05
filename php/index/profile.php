<?php
    include "../connection.php";
    if($_POST['nip_nrp']) {
        $nip_nrp = $_POST['nip_nrp'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = "SELECT * FROM user WHERE nip_nrp = $nip_nrp";
        $result = $koneksi->query($sql);
        foreach ($result as $baris) { ?>
 
        <!-- MEMBUAT FORM -->
        <form action="#" method="post">
            <input type="hidden" name="id" value="<?php echo $baris['nip_nrp']; ?>">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $baris['nama']; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" name="password" value="<?php echo $baris['password']; ?>">

            </div>
              <button class="btn btn-primary" type="submit">Update</button>
        </form>
 
        <?php } }
    $conn->close();
?>