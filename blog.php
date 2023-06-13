<?php 
session_start();
if (!isset($_SESSION['company_id']) AND !isset($_SESSION['customer_id']))
{   
	include 'header.html';
    echo
    "<script language=javascript>
    alert('You haven't logged in yet !');
    </script>
    ";
}
else{
  if(isset($_SESSION['company_id'])) {
	include 'headerB.html';
	$c_id =$_SESSION['company_id'];
  }

else if(isset($_SESSION['customer_id'])){
	include 'headerA.html';
	$c_id = $_SESSION['customer_id'];

	}
}


?>
<style>
/* .card-text{
  white-space: nowrap; 
  width: 100%; 
  overflow: hidden;
  text-overflow: ellipsis; 
} */
</style>
<body>
  <div id="content" style="padding-left:18%;padding-top : 40px">

      <div class="card mb-3" style="width:800px;text-align:center">
        <img src="assets/hardwood-vs-softwood-770x385-1536x768.jpg" style="width:800px;" alt="Hardwood vs Softwood">
        <div class="card-body">
          <h5 class="card-title">Softwoods vs. Hardwoods</h5>
          <p class="card-text">Softwood biasanya diambil dari pohon pinus dan pohon cemara. Jenis pohonnya juga memiliki ciri khas lain yaitu memproduksi jenis biji yang tidak dilindungi seperti biji buah seperti pada umumnya salah satu contohnya adalah buah pinus. Softwood juga memiliki struktur yang lebih sederhana dan variasi yang relatif sama.
          Hardwood diambil dari pohon seperti pohon maple dan pohon Ek. Jenis pohon ini menghasilkan buah dan bijinya terdapat di dalam buah tersebut, seperti biji pohon ek dan jenis biji-bijian lain yang tumbuh dari pohon bersamaan dengan buahnya. Hardwood memiliki struktur yang yang lebih kompleks dan memiliki variasi yang lebih banyak.
          </p>
          <br>
          <a href="https://pineconelumber.com/blog/85717/wood-basics"><p>Source : https://pineconelumber.com/blog/85717/wood-basics</p></a>
        </div>
      </div>
      <br><br>

      <div class="card mb-3" style="width:800px;text-align:center">
        <img src="https://media.istockphoto.com/photos/texture-of-steel-rusty-wire-in-a-construction-site-picture-id856627468" style="width:800px;" alt="Kawat Baja Berkarat">
        <div class="card-body">
          <h5 class="card-title">Kawat Baja Nirkarat (stainless steel) bisa berkarat</h5>
          <p class="card-text">stainless steel biasanya memiliki masa hidup yang cukup lama dan mempertahankan kekuatannya. Meski begitu, dalam beberapa situasi, stainless steel juga bisa berkarat. Faktor-faktor yang menyebabkan stainless steel berkarat diantara adalah sebagai berikut: 
          # Tidak membersihkan mesin las dan peralatan lainnya saat melakukan pengelasan plain steel ke stainless steel
          # Menggunakan sikat logam yang sama untuk plain steel dan stainless steel.
          # Penggunaan bahan kimia yang dapat menghilangkan lapisan oksida pada stainless steel
          </p>
          <br>
          <a href="https://www.smsperkasa.com/blog/5-fakta-baja-yang-tak-terduga"><p>Source : https://www.smsperkasa.com/blog/5-fakta-baja-yang-tak-terduga</p></a>
          
        </div>
      </div>

      <br><br>
      <div class="card mb-3" style="width:800px;text-align:center">
        <img src="https://civiconcepts.com/wp-content/uploads/2020/09/Eco-Friendly-Building-Materials.jpg" style="width:800px;" alt="Hardwood vs Softwood">
        <div class="card-body">
          <h5 class="card-title">5 Macam bahan bangunan yang lebih hijau dibanding beton</h5>
          <p class="card-text">Beton adalah material yang menyatukan kota-kota kita. Dari rumah, bangunan apartemen, sampai ke jembatan, terowongan dan jalur pejalan kaki. Bahan berwarna abu-abu ini terbukti sangat penting untuk kebutuhan kehidupan di dunia modern ini. Namun, tidak banyak orang tahu tentang fakta dibalik beton. Produksi bahan-bahan pembentuk beton menghasilkan berton-ton gas rumah kaca berupa karbondioksida (CO2) ke atmosfer setiap tahunnya. Polusi tersebut memicu proses perubahan iklim yang kita rasakan sekarang. Untuk mengatasi kebutuhan pengganti bahan beton tersebut, berikut ini 5 bahan bangunan “hijau” sebagai sebuah alternatif terhadap beton dan menurunkan efek buruknya terhadap lingkungan:
                Beton rumput,
                Bambu,
                Plastik Daur Ulang,
                Ashcrete,
                Timbercrete,
          </p>
          <br>
          <a href="https://www.greeners.co/ide-inovasi/11-macam-bahan-banguan-lebih-hijau-dibanding-beton/"><p>Source : https://www.greeners.co/ide-inovasi/11-macam-bahan-banguan-lebih-hijau-dibanding-beton/</p></a>
          
        </div>
      </div>
      <br><br>

  </div>

</body>

<?php include 'footer2.html';?>
</html>
