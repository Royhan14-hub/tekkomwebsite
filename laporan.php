<?php
// laporan.php
require 'koneksi.php';
require 'helpers.php';
// optional: require_admin();

$q = $_GET['q'] ?? '';
$filter = '';
if ($q === 'masuk') $filter = "WHERE stype='masuk'";
if ($q === 'keluar') $filter = "WHERE stype='keluar'";

$res = mysqli_query($koneksi, "SELECT bm.tanggal_masuk as tanggal, 'masuk' as tipe, b.kode, b.nama_barang, bm.jumlah, bm.sumber as note FROM barang_masuk bm JOIN barang b ON bm.id_barang=b.id_barang
UNION ALL
SELECT bk.tanggal_pinjam as tanggal, 'keluar' as tipe, b.kode, b.nama_barang, bk.jumlah, bk.keperluan as note FROM barang_keluar bk JOIN barang b ON bk.id_barang=b.id_barang
ORDER BY tanggal DESC LIMIT 500");

$list = mysqli_fetch_all($res, MYSQLI_ASSOC);

// export CSV
if (isset($_GET['export']) && $_GET['export']=='csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=laporan_transaksi_'.date('Ymd').'.csv');
    $out = fopen('php://output','w');
    fputcsv($out, ['Tanggal','Tipe','Kode','Nama Barang','Jumlah','Keterangan']);
    foreach($list as $r) fputcsv($out, [$r['tanggal'],$r['tipe'],$r['kode'],$r['nama_barang'],$r['jumlah'],$r['note']]);
    fclose($out);
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Laporan</title><link rel="stylesheet" href="style.css"></head>
<body>
  <header class="topbar">
    <div class="brand">Inventory</div>
    <div class="top-actions">
      <?php if(is_admin()): ?><a class="btn small" href="admin.php">Admin</a><?php else: ?><a class="btn small" href="login.php">Login</a><?php endif; ?>
    </div>
  </header>

  <div class="container">
    <aside class="sidebar">
      <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="laporan.php">Laporan</a></li>
      </ul>
    </aside>

    <main class="main">
      <h1>Laporan Transaksi</h1>
      <a class="btn primary" href="laporan.php?export=csv">Export CSV</a>
      <div class="card">
        <table class="table">
          <thead><tr><th>Tanggal</th><th>Tipe</th><th>Kode</th><th>Nama</th><th>Jumlah</th><th>Keterangan</th></tr></thead>
          <tbody>
            <?php foreach($list as $r): ?>
              <tr>
                <td><?=h($r['tanggal'])?></td>
                <td><?=h($r['tipe'])?></td>
                <td><?=h($r['kode'])?></td>
                <td><?=h($r['nama_barang'])?></td>
                <td><?=h($r['jumlah'])?></td>
                <td><?=h($r['note'])?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
