<?php
// lap_rusak.php
require 'koneksi.php';
require 'helpers.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_barang = intval($_POST['id_barang']);
    $laporan_by = $_POST['laporan_by'] ?? $_SESSION['nama'];
    $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
    $keterangan = $_POST['keterangan'] ?? '';

    if ($id_barang) {
        $stmt = mysqli_prepare($koneksi,"INSERT INTO laporan_rusak (id_barang, laporan_by, tanggal, keterangan) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt,'isss',$id_barang,$laporan_by,$tanggal,$keterangan);
        mysqli_stmt_execute($stmt);
        header('Location: lap_rusak.php');
        exit;
    }
}

$res = mysqli_query($koneksi,"SELECT lr.*, b.nama_barang FROM laporan_rusak lr LEFT JOIN barang b ON lr.id_barang=b.id_barang ORDER BY lr.created_at DESC");
$list = mysqli_fetch_all($res, MYSQLI_ASSOC);

$res2 = mysqli_query($koneksi,"SELECT * FROM barang ORDER BY nama_barang");
$barangs = mysqli_fetch_all($res2, MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Laporan Kerusakan</title><link rel="stylesheet" href="style.css"></head>
<body>
  <div class="container">
    <aside class="sidebar">
      <ul>
        <li><a href="admin.php">Dashboard</a></li>
        <li><a href="lap_rusak.php" class="active">Laporan Kerusakan</a></li>
      </ul>
    </aside>

    <main class="main">
      <h1>Laporan Kerusakan Barang</h1>

      <div class="card">
        <form method="post" class="form">
          <label>Barang</label>
          <select name="id_barang" required>
            <option value="">-- Pilih --</option>
            <?php foreach($barangs as $b): ?>
              <option value="<?=h($b['id_barang'])?>"><?=h($b['nama_barang'])?></option>
            <?php endforeach;?>
          </select>
          <label>Pelapor</label>
          <input name="laporan_by" value="<?=h($_SESSION['nama'])?>" />
          <label>Tanggal</label>
          <input name="tanggal" type="date" value="<?=date('Y-m-d')?>" />
          <label>Keterangan</label>
          <textarea name="keterangan"></textarea>
          <button class="btn primary" type="submit">Laporkan</button>
        </form>
      </div>

      <div class="card">
        <h3>Daftar Laporan Kerusakan</h3>
        <table class="table">
          <thead><tr><th>Tanggal</th><th>Barang</th><th>Pelapor</th><th>Keterangan</th><th>Status</th></tr></thead>
          <tbody>
            <?php foreach($list as $r): ?>
              <tr>
                <td><?=h($r['tanggal'])?></td>
                <td><?=h($r['nama_barang'])?></td>
                <td><?=h($r['laporan_by'])?></td>
                <td><?=h($r['keterangan'])?></td>
                <td><?=h($r['status'])?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
