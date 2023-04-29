<?php
    include('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Search</title>

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
                <a asp-page="/Index" class="navbar-brand" href="#">Street Crime</a>
            </div>
        </div>
    </nav>

    <partial name="_CookieConsentPartial" />

    <div class="container body-content">
        @RenderBody()
        <hr />

        <?php
            $data = $_GET['data'];
            //echo $data;
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
                            WHERE crime_type.Crime_Type_ID = $data";

                            $result = mysqli_query($conn, $sql);

                            if($result)
                            {
                                $row = mysqli_fetch_assoc($result);
                                echo '<div class="container">
                                            <div class="jumbotron">
                                              <h1 class="display-4 text-center">Crime Type ID: '.$row['Crime_Type_ID'].'</h1>
                                              <p class="lead">Crime Type 1: '.$row['Crime_Type_1']. ' <br>'. ' Crime Type 2: '.$row['Crime_Type_2']. ' <br>'. ' Date: '.$row['Month_Year'].'</p>
                                              <p class="lead">Force Name: '.$row['Reported_By']. ' <br>'. ' Longitude: '.$row['Longitude']. ' <br>'. ' Latitude: '.$row['Latitude'].'</p>
                                              <p class="lead">LSOA Code: '.$row['LSOA_Code']. ' <br>'. ' LSOA Name: '.$row['LSOA_Name']. ' <br>'. ' Outcome: '.$row['Last_Outcome_Category_1'].'</p>
                                              <hr class="my-4">
                                              <p class="lead">
                                                <a class="btn btn-primary btn-lg" href="sql_query.php" role="button">Back</a>
                                              </p>

                                            </div>
                                    </div>';
                            }
        ?>

                                                
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