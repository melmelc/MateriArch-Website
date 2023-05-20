<?php include 'conn.php';
include 'header.html';

    if(isset($_POST['sub'])) {
        $name = trim($_POST['cname']);
        $file_name = $_FILES['myfile']['name'];
        $query = "INSERT INTO category (category_name, cat_pic) VALUES ('$name','$file_name')";

        if ($conn->query($query) === TRUE) {
            echo
            "<script language=javascript>
            alert('New Category Added Successfully');
            </script>
            ";
            unset($name);
            unset($file_name);
        }
        else {
            echo "ERROR DUPLICATE DATA";
        }
    }
    echo"<img src='assets/".$cat_pic."' style='width:50px'>";
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
    <div style="padding:40px">
    <h3>Add new request</h3>
            <form action="cat.php" method="post" enctype="multipart/form-data">
                <label for="cname"><h6>Category name :</h6></label>
                <input type="text" id="cname" name="cname" required><br>
                <label for="title"><h6>Select picture :</h6></label>
                <input type="file" id="myfile" name="myfile" accept="image/*"required>
                <button type="submit" name="sub">Submit</button>
            </form>


    </div>
    

            </body>
            </html>