<?php

class barang
{
    private $db;

    public function __construct($con)
    {
        $this->db = $con;
    }

    ### Start : fungsi insert data ke database ###

    public function insertData($merek, $nama, $stok, $harga)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO tbl_barang(merek,nama_produk,stock,harga_satuan) VALUES(:merek, :nama_produk, :stock, :harga_satuan)");
            $stmt->bindparam(":merek", $merek);
            $stmt->bindparam(":nama_produk", $nama);
            $stmt->bindparam(":stock", $stok);
            $stmt->bindparam(":harga_satuan", $harga);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    ### End : fungsi insert data ke database ###

    ### Start : fungsi ambil data dari database ###

    public function getID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbl_barang WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    ### End: fungsi ambil data dari database ###

   

    ### Start : fungsi untuk menampilkan data dari database ###

    public function viewData($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

             <tr>

                 <td><?php echo($row['id']); ?></td>
                 <td><?php echo($row['merek']); ?></td>
                 <td><?php echo($row['nama_produk']); ?></td>
                 <td><?php echo($row['stock']); ?></td>
                 <td><?php echo($row['harga_satuan']); ?></td>
                 <td align="center">
                     <a href="editbarang.php?edit_id=<?php echo($row['id']); ?>" class="btn-success btn-sm">
                         Edit</a>
                 </td>
                 <td align="center">
                     <a href="hapusbarang.php?delete_id=<?php echo($row['id']); ?>" class="btn-danger btn-sm">
                        Hapus</a>
                 </td>

             </tr>

         <?php
            }
        } else {
            ?>
         <tr>
             <td>Data tidak ditemukan...</td>
         </tr>
     <?php
        }
    }

    ### End : fungsi untuk menampilkan data dari database ###

    ### Start : fungsi untuk memperbaharui data###

    public function updateData( $id,$merek, $nama, $stok, $harga)
    {
        try {
            $stmt = $this->db->prepare("UPDATE tbl_barang SET merek=:merek,
                                                                nama_produk=:nama_produk,
                                                                stock=:stock,
                                                                harga_satuan=:harga_satuan
                                                            WHERE id=:id ");

            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":merek", $merek);
            $stmt->bindparam(":nama_produk", $nama);
            $stmt->bindparam(":stock", $stok);
            $stmt->bindparam(":harga_satuan", $harga);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    ### End : fungsi untuk memperbaharui data###

    ### Start : fungsi untuk menghapus data###

    public function deleteData($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tbl_barang WHERE id=:id");

        $stmt->bindparam(":id", $id);

        $stmt->execute();

        return true;
    }

    ### End : fungsi untuk menghapus data###

    ### Start : fungsi paging###

    public function paging($query, $records_per_page)
    {
        $starting_position = 0;

        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }

        $query2 = $query . " limit $starting_position,$records_per_page";

        return $query2;
    }

    ### End : fungsi paging###

    ### Start : fungsi pindah page###

    public function paginglink($query, $records_per_page)
    {
        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if ($total_no_of_records > 0) {
            ?><ul class="pagination"><?php

                                    $total_no_of_pages = ceil($total_no_of_records / $records_per_page);

            $current_page = 1;

            if (isset($_GET["page_no"])) {
                $current_page = $_GET["page_no"];
            }

            if ($current_page != 1) {
                $previous = $current_page - 1;

                echo "<li><a href='" . $self . "?page_no=1'>First</a></li>";

                echo "<li><a href='" . $self . "?page_no=" . $previous . "'>Previous</a></li>";
            }

            for ($i = 1; $i <= $total_no_of_pages; $i++) {
                if ($i == $current_page) {
                    echo "<li><a href='" . $self . "?page_no=" . $i . "' style='color:red;'>" . $i . "</a></li>";
                } else {
                    echo "<li><a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
                }
            }

            if ($current_page != $total_no_of_pages) {
                $next = $current_page + 1;

                echo "<li><a href='" . $self . "?page_no=" . $next . "'>Next</a></li>";

                echo "<li><a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Last</a></li>";
            } ?></ul><?php
        }
    }

    ### End : fungsi pindah page###
}