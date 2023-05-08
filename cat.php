<?php include 'conn.php';

if(isset($_POST['sub'])) {
    if(isset($_POST['name']) and isset($_POST['myfile'])) {
        $name = trim($_POST['name']);
        $fil = $_POST['myfile'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $fil);
        finfo_close($finfo);

        $query = "SELECT cat_pic FROM category where category_id = 1";
        // "INSERT INTO category (category_name, cat_pic) VALUES ('$name','$fil')";

        if ($conn->query($query) === TRUE) {
            // echo
            // "<script language=javascript>
            // alert('New Category Added Successfully');
            // </script>
            // ";
            $result = $conn->query($query1);
            $row = $result->fetch_assoc();
            $cat_pic = $row['cat_pic'];
            $image = base64_encode( $cat_pic );
            $mimetype = 'image/jpg';

            echo "<img src='data:$mimetype;base64,$image'>";
            
            unset($name,$fil);

          } else {
            echo '<script language="javascript">';
            echo 'alert("Error: " . $query1 . "<br>" . $conn->error;)';
            echo '</script>';
          
    }
}
}


?>

<!Doctype html>
<html lang="en">
    <head>
        <title>Category</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
    
    <h3>Add new request</h3>
            <form action="#" method="post">
                <label for="name"><h6>Category name :</h6></label>
                <input type="text" id="name" name="name" required><br>
                <label for="title"><h6>Select picture :</h6></label>
                <input type="file" id="myfile" name="myfile" accept="image/*"required>
                <button type="submit" name="sub">Submit</button>
            </form>

            </body>
            </html>