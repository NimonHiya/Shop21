<?php
ob_start();
include 'header.php';
?>

<!-- Hero Banner Section -->
<div class="container-fluid py-4 mb-4" id="hero-banner">
  <div class="d-flex align-items-center justify-content-center text-center text-white">
    <div class="overlay"></div>
    <div class="hero-content">
      <h1>Welcome to Shop21</h1>
      <p>Produk Karya Anak Bangsa !!</p>
      <a href="#products" class="btn btn-primary btn-lg">Beli Sekarang</a>
    </div>
  </div>
</div>

<!-- Main content area (Products) -->
<div class="container my-5" id="products">
  <?php include './template/_products.php'; ?>
</div>

<?php
include 'footer.php';
?>

<style>
 /* Hero Banner Section */
#hero-banner {
  background: linear-gradient(135deg, #333, #555);  /* Gradien warna abu-abu gelap ke lebih terang untuk tema hitam putih */
  position: relative;
  height: 500px;  /* Menyesuaikan tinggi banner */
  border-radius: 15px;  /* Memberikan sudut yang lebih lembut */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Bayangan lebih gelap untuk efek kedalaman */
  overflow: hidden;
}

#hero-banner .overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);  /* Latar belakang semi-transparan lebih gelap */
  z-index: 1;
}

#hero-banner .hero-content {
  position: relative;
  z-index: 2;
  color: white;  /* Warna teks putih agar kontras dengan background */
  display: flex;
  flex-direction: column;  /* Menata elemen secara vertikal */
  justify-content: center;  /* Menempatkan elemen di tengah secara vertikal */
  align-items: center;  /* Menempatkan elemen di tengah secara horizontal */
  text-align: center;
  height: 100%;  /* Memastikan konten memenuhi tinggi banner */
  padding: 0 20px;
}

#hero-banner h1 {
  font-size: 3.5rem;  /* Ukuran lebih besar untuk judul */
  font-weight: bold;
  text-transform: uppercase; /* Ubah teks menjadi huruf besar */
  letter-spacing: 2px; /* Beri spasi antar huruf */
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Bayangan untuk teks yang lebih halus */
  margin-bottom: 30px;  /* Menambahkan jarak bawah untuk judul */
  margin-top: 100px;  /* Menurunkan teks lebih jauh ke bawah */
}

#hero-banner p {
  font-size: 1.5rem;  /* Ukuran teks lebih besar */
  margin-top: 15px;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Bayangan untuk teks lebih ringan */
  margin-bottom: 20px;  /* Menambahkan jarak bawah untuk teks */
}

#hero-banner .btn {
  font-size: 1.3rem;  /* Ukuran tombol lebih besar */
  padding: 12px 30px;
  border-radius: 50px;  /* Sudut tombol membulat */
  background-color: #fff;  /* Tombol putih */
  color: #333;  /* Teks tombol gelap agar kontras */
  border: 2px solid #333;  /* Border tombol dengan warna yang lebih gelap */
  text-transform: uppercase; /* Membuat teks tombol semua huruf besar */
  font-weight: bold;
  transition: all 0.3s ease;
}

#hero-banner .btn:hover {
  background-color: #333;  /* Ubah warna tombol menjadi lebih gelap saat hover */
  color: #fff;  /* Teks tombol menjadi putih saat hover */
  transform: scale(1.05); /* Efek tombol membesar saat hover */
}

</style>
