<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 




?>
<style>
div#main{
	padding-left: 60px;
    padding-right: 60px;
    padding-top: 20px;
}
</style>

<body>
    <div id="main">
        <div>
        <h3>Payment Page</h3>
        </div>
       
        <h4>Rician Pembayaran</h4>
        <div id="rincian" style="display:flex;justify-content:space-between">
            <table id="rincian">
                <tr>
                    <th>Keterangan</th>
                    <th>Biaya</th>
                </tr>
                <tr>
                    <td>Pembayaran Uang Muka</td>
                    <td>Rp.xxx</td>
                </tr>
                <tr>
                    <td>Biaya Administrasi</td>
                    <td>Rp.xxx</td>
                </tr>
                <tr>
                    <td>Biaya Asuransi</td>
                    <td>Rp XXXXX </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <th>Rp.xxx</th>
                </tr>
            </table>

            <div>
            <h5>NAMA PERUSAHAAN</h5>
            <h5>ALAMAT PERUSAHAAN </h5>
            <h5>NAMA PEMBELI </h5>
            <h5>ALAMAT PEMBELI</h5>
            <h5>WAKTU PENGERJAAN</h5>

            </div>
            
            <div>
            <form method='post'>
            <label for="payment">Payment Method :</label>
            <select name="payment" 
            onchange="if(this.options[this.selectedIndex].value=='customOption'){
                toggleField(this,this.nextSibling);
                this.selectedIndex='0';
            }" required> <h4>
            <option default></option>
            <option value="Transfer">Transfer Bank</option>
            <option value="Debit">Kartu Debit</option>
             </h4></select>
            <input name="filter" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <br>
            <br>
            <button type="submit" name="sub">Search</button>
            </form>
            </div>
            
        </div>
    </div>
</body>








<?php include 'footer2.html'; ?>