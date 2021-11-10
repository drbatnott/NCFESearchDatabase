<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <?php
    //Connect to the database and search for the commonName
        $commonName = $_POST['commonName'];
        function FindData($searchName){
            $servername = "localhost";
            //database username
            $username = "root";
            $password = "";
            $dbase = "penguins";
            //Following line creates the connection to the database penguins
            $conn = new mysqli($servername,$username,$password,$dbase);
            //the next line sets up a query which is going to ask the penguins database whether
            //$searchName exists in the penguins database 
            $sql = "Select * from penguin where commonName Like '" . $searchName ."';";
            //the next line tries to execute that search
            //when it works it will store an array of results in $result
            $result = $conn->query($sql);
            //Because our test showed that the code worked so far we will now return $result
            return $result;
            
        }
    //Elements are sent from the calling page using the post method in an array called $_POST
        
        //$scientificName = $_POST['scientificName'];
        if($commonName === "%")
            echo "<title>Here is the data on Penguins All the penguins we have</title>";
        else
            echo "<title>Here is the data on Penguins " . $commonName . "</title>";
    
    ?>
</head>
<body>
    <h3>Data about <?php 
        if($commonName === "%"){
            echo "All the penguins we have:<br />";
        }
        else{
            echo $commonName; 
        }
        ?>
    </h3>
    <form action="index.html" method="post">
        <p>
        <?php
            $result = FindData($commonName);
            //the next line will tell us if we found the data
            //$result->num_rows will give us a count of how many results were found
            if ($result->num_rows > 0) {
            // output data of each row stop when we have loaded all the results
               while($row = $result->fetch_assoc()) {
                    echo "id: " . $row['penguinID']. " Common Name: " . $row['commonName']. 
                        " Scientific Name: " . $row['scientificName']. "<br>";
               }
            }           
            else {
                echo "result is no matches to " . $commonName . "<br/>";
            }
        ?>
        </p>
        <input type="submit" value="Return to Search Page" />
    </form>
</body>
</html>