<!Doctype html>
<html>
    <head>
        <style>
table, th, td {
  border: 1px solid;
}
        </style>
</head>
<body>
<?php
    $connect= mysqli_connect('localhost', 'root', '', 'test');
    if ($connect->connect_errno!=0)
        {
            echo "Error: ".$connect->connect_errno;
        }
        else
        {
        $reviewsquery ="SELECT * FROM reviews";
        $resultreviews = mysqli_query($connect,$reviewsquery);
        if(!$resultreviews)
        {
            echo "Coś poszło nie tak z wczytaniem poprzednich recenzji :C";
        }
        else
        {
            $resultset = array();
            while ($tab=mysqli_fetch_array($resultreviews))
            {
                $resultset[] = $tab;
            }
            echo "<table>";
            echo "<tr><th>ID</th><th>IMIĘ</th><th>RECENZJA</th>";
            foreach($resultset as list($a,$b,$c))
            {
            echo "<tr><th>$a</th><th>$b</th><th>$c</th>";
            }
            echo "</table>";
        }
        mysqli_close($connect);
        }
        
?>



<form action="index.php" method="post">
    <center>
    Imię: </br><input type="text" name="name"></br>
    Recenzja: </br><input type="text" name="review"></br></br>
    <input type="submit" name="Send" value="Prześlij">
</center>
</form>

<?php
if (isset($_POST['Send']) && (null !== $_POST["name"]) && (null !== $_POST["review"]))
{
    $connect= mysqli_connect('localhost', 'root', '', 'test');
    if ($connect->connect_errno!=0)
        {
            echo "Error: ".$connect->connect_errno;
        }
        else
        {
            $name = $_POST['name'];
            $review = $_POST['review'];
            $query ="INSERT INTO reviews (name,review) VALUES ('$name','$review')";
            $result = mysqli_query($connect,$query);
            if(!$result)
            {
                echo "<center>Coś poszło nie tak...</center>";
            }
            else
            {
                echo "<center>Recenzję pomyślnie dodano :)</center>";
            }
            mysqli_close($connect);
        }
}
?>
</body>
</html>