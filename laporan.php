<?php

$title = 'Semua Laporan';

require_once "template/theHeader.php";

midAuth();

?>

<h1 class="title is-4">Semua Laporan</h1>

<hr>

<div class="table-container">
    <table class="table is-hoverable is-striped is-fullwidth">
        <thead>
            <tr>
                <th>#</th>
                <th>Kamar</th>
                <th>Nama Pelanggan</th>
                <th>Lama Inap</th>
                <th>Harga</th>
                <th>Total Bayar</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM transaksi";

            $query = $conn->prepare($sql);

            $query->execute();

            $total = 0;

            while ($item = $query->fetch(PDO::FETCH_OBJ)) {
                $sqlKamar = sprintf("SELECT * FROM kamar WHERE kamar = '%s'", $item->kamar);

                $queryKamar = $conn->prepare($sqlKamar);
                $queryKamar->execute();

                $itemKamar = $queryKamar->fetch(PDO::FETCH_OBJ);

                $harga = $itemKamar->harga;

                $subtotal = $harga * $item->lama_inap;

                $total += $subtotal;

            ?>
                <tr>
                    <td><?= $item->id_transaksi; ?></td>
                    <td><?= $item->kamar; ?></td>
                    <td><?= $item->nm_user; ?></td>
                    <td><?= $item->lama_inap; ?></td>
                    <td><?= money($harga); ?></td>
                    <td><?= money($subtotal); ?></td>
                    <td><?= $item->tgl_transaksi; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="5">Total Pendapatan</td>
                <td colspan="2"><?= money($total) ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="columns">
    <div class="column is-9">
    </div>
    <div class="column">
        <h1 class="title is-6 mb-6">Kampar, <?= date('d F Y') ?></h1>
        <br><br>
        <strong>Operator</strong>
    </div>
</div>

<?php

require_once "template/theFooter.php"

?>