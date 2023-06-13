<?php include 'conn.php'; 
        include 'headerA.html';
        $tender_id = 15;
        ?>
<html>
    <head>
    </head>
    <body>
    <label>Kota Tujuan : </label>
            <select id="cityname" required>
                    <option default></option>
                    <?php 
                            $sql = mysqli_query($conn, "SELECT city_name FROM cities");
                            while ($row = $sql->fetch_assoc()){
                                ?>
                            <option value="<?php echo $row['city_name'] ?>">
                            <?php echo $row['city_name'] ?>
                            </option>   
                           <?php
                            }
                            ?>
                </select>
                <input name="cityname" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
                <br>    
        <br>
        <label>Biaya Jasa Pengiriman : </label>
        <h3 id="shipment" type="number"></h3>
        <script>
    $(document).ready(function() {
      $('#cityname').change(function() {
        var selectedCity = $(this).val();
        var tender = '<?php echo $tender_id ?>';
        if (selectedCity !== "") {
          $.ajax({
            url: 'ajax_getcost.php',
            type: 'GET',
            data: { city: selectedCity,
                tender_id: tender,},
            success: function(response) {
              $('#shipment').html(response);
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          });
        } else {
          $('#shipment').empty();
        }
      });
    });
  </script>
    </body>
</html>