<?php
    include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Query</title>

    <environment include="Development">
        <link rel="stylesheet" href="~/lib/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="~/css/site.css" />
    </environment>
    <environment exclude="Development">
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/3.3.7/css/bootstrap.min.css"
              asp-fallback-href="~/lib/bootstrap/dist/css/bootstrap.min.css"
              asp-fallback-test-class="sr-only" asp-fallback-test-property="position" asp-fallback-test-value="absolute" />
        <link rel="stylesheet" href="~/css/site.min.css" asp-append-version="true" />
    </environment>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a asp-page="/Index" class="navbar-brand" href="index.php">Street Crime</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a asp-page="/Index" href="london.php">Maps</a></li>
                    <li><a asp-page="/About" href="#">About</a></li>
                    <li><a asp-page="/Contact" href="#">Contact</a></li>
                    <li><a asp-page="/Intelligence" href="localhost:8501">Intelligence</a></li>
                    <li><a asp-page="/Borough" href="borough.php">Borough</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <partial name="_CookieConsentPartial" />

    <div class="container body-content">
        @RenderBody()
        <hr />
        <br>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Please enter a search on the database.</p>
        <!----------Start of PHP Code to connect to MySQL Database--------->
        <?php
            // Write SQL Statements
            $sql = "SELECT * FROM crime_type LIMIT 100;";
            // Querying the code
            $result = mysqli_query($conn, $sql);
            // Display results
            $resultcheck = mysqli_num_rows($result);
            // Checks if there is any results and if it is more than 0 then it will display
            if($resultcheck > 0)
            {
                // Gets all data and insert the row into the array
                while($row = mysqli_fetch_assoc($result))
                {
                    //echo $row['Crime_Type_ID'] . " " . $row['Crime_Type_1'] . "<br>";
                }
            }

        ?>

        <br>
        <div class="container">
            <form method="post">
                <input type="text" placeholder="Query Data" style="width:500px" name="search">
                <button class="btn btn-dark btn-sm" name="submit">Search</button>
            </form><br>
            <div class="container">
                <table class="table">
                    <?php
                        if(isset($_POST['submit']))
                        {
                            $search=$_POST['search'];
                            
                            $sql = "SELECT crime_type.Crime_Type_ID, crime_type.Crime_Type_1, crime_type.Crime_Type_2, dates.Month_Year, 
                            force_name.Reported_By, geo_location.Longitude, geo_location.Latitude, geo_location.LSOA_Code, 
                            geo_location.LSOA_Name, outcome.Last_Outcome_Category_1
                            FROM crime_type
                            JOIN dates
                            ON crime_type.Dates_ID=dates.Dates_ID
                           JOIN force_name
                            ON crime_type.Force_Name_ID=force_name.Force_Name_ID
                            JOIN geo_location
                            ON crime_type.Location_ID=geo_location.Location_ID
                            JOIN outcome
                            ON crime_type.Outcome_ID=Outcome.Outcome_ID
                            WHERE crime_type.Crime_Type_ID = '$search'
                            OR crime_type.Crime_Type_1 = '$search'
                            OR crime_type.Crime_Type_2 = '$search'
                            OR dates.Month_Year = '$search'
                            OR force_name.Reported_By = '$search'
                            OR geo_location.Longitude = '$search'
                            OR geo_location.Latitude = '$search'
                            OR geo_location.LSOA_Code = '$search'
                            OR geo_location.LSOA_Name = '$search'
                            OR outcome.Last_Outcome_Category_1 = '$search'
                            ORDER BY crime_type.Crime_Type_ID";

                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            $numberPages = 100;
                            $totalPages = ceil($num / $numberPages);
                            //echo $totalPages;
                            for($btn = 1; $btn <= $totalPages; $btn++)
                            {
                                echo '<button class="btn"><a href="pagination.php?page='.$btn.'" class="text">'.$btn.'</a></button>';
                            }
                            if(isset($_GET['page']))
                            {
                                $page = $_GET['page'];
                                //echo $page;
                            }else
                            {
                                $page = 1;
                            }
                            //1-----> 0, 10
                            //2-----> 10, 10
                            //3-----> 20, 10
                            //(pnum - 1) * $numberPages
                            $startinglimit = ($page - 1) * $numberPages;

                            $sql = "SELECT crime_type.Crime_Type_ID, crime_type.Crime_Type_1, crime_type.Crime_Type_2, dates.Month_Year, 
                            force_name.Reported_By, geo_location.Longitude, geo_location.Latitude, geo_location.LSOA_Code, 
                            geo_location.LSOA_Name, outcome.Last_Outcome_Category_1
                            FROM crime_type
                            JOIN dates
                            ON crime_type.Dates_ID=dates.Dates_ID
                            JOIN force_name
                            ON crime_type.Force_Name_ID=force_name.Force_Name_ID
                            JOIN geo_location
                            ON crime_type.Location_ID=geo_location.Location_ID
                            JOIN outcome
                            ON crime_type.Outcome_ID=Outcome.Outcome_ID
                            WHERE crime_type.Crime_Type_ID = '$search'
                            OR crime_type.Crime_Type_1 = '$search'
                            OR crime_type.Crime_Type_2 = '$search'
                            OR dates.Month_Year = '$search'
                            OR force_name.Reported_By = '$search'
                            OR geo_location.Longitude = '$search'
                            OR geo_location.Latitude = '$search'
                            OR geo_location.LSOA_Code = '$search'
                            OR geo_location.LSOA_Name = '$search'
                            OR outcome.Last_Outcome_Category_1 = '$search'
                            ORDER BY crime_type.Crime_Type_ID LIMIT " . $startinglimit . ',' . $numberPages;
                            $result = mysqli_query($conn, $sql);

                            if($result)
                            {
                                if(mysqli_num_rows($result) > 0)
                                {
                                    echo '<thead>
                                    <tr>
                                    <th>Crime_Type_ID</th>
                                    <th>Crime_Type_1</th>
                                    <th>Crime_Type_2</th>
                                    <th>Month_Year</th>
                                    <th>Reported_By</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>LSOA_Code</th>
                                    <th>LSOA_Name</th>
                                    <th>Last_Outcome_Category_1</th>
                                    </tr>
                                    </thead>';

                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo '<tbody>
                                        <tr>
                                        <td><a href="search_data.php?data='.$row['Crime_Type_ID'].'">'.$row['Crime_Type_ID'].'</a></td>
                                        <td>'.$row['Crime_Type_1'].'</td>
                                        <td>'.$row['Crime_Type_2'].'</td>
                                        <td>'.$row['Month_Year'].'</td>
                                        <td>'.$row['Reported_By'].'</td>
                                        <td>'.$row['Longitude'].'</td>
                                        <td>'.$row['Latitude'].'</td>
                                        <td>'.$row['LSOA_Code'].'</td>
                                        <td>'.$row['LSOA_Name'].'</td>
                                        <td>'.$row['Last_Outcome_Category_1'].'</td>
                                        </tr>
                                        </tbody>';
                                        }
                                }else
                            {
                                echo '<h2 class=text-danger>Could not find your query in the database.</h2>';
                            }
                            }
                        }
                    ?>
                </table>
            </div>
        </div>

        <!----------End of PHP Code to connect to MySQL Database---------->
        <br>
        <footer>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&copy; 2023 - Street Crime</p>
        </footer>
    </div>

    <environment include="Development">
        <script src="~/lib/jquery/dist/jquery.js"></script>
        <script src="~/lib/bootstrap/dist/js/bootstrap.js"></script>
        <script src="~/js/site.js" asp-append-version="true"></script>
    </environment>
    <environment exclude="Development">
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.3.1.min.js"
                asp-fallback-src="~/lib/jquery/dist/jquery.min.js"
                asp-fallback-test="window.jQuery"
                crossorigin="anonymous"
                integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/bootstrap/3.3.7/bootstrap.min.js"
                asp-fallback-src="~/lib/bootstrap/dist/js/bootstrap.min.js"
                asp-fallback-test="window.jQuery && window.jQuery.fn && window.jQuery.fn.modal"
                crossorigin="anonymous"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa">
        </script>
        <script src="~/js/site.min.js" asp-append-version="true"></script>
    </environment>

    <!--@RenderSection("Scripts", required: false)-->
</body>
</html>