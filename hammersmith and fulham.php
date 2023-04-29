<?php
    include("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
    
    <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    </style>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hammersmith and Fulham</title>

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
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a asp-page="/Index" href="sql_query.php">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <partial name="_CookieConsentPartial" />

    <div class="container body-content">
        @RenderBody()
        <hr />
        <h1>Hammersmith and Fulham</h1>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39740.94499917423!2d-0.25755826128795833!3d51.498371267207204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760fc15cd337c3%3A0x40eae2da2ec6700!2sLondon%20Borough%20of%20Hammersmith%20and%20Fulham%2C%20London!5e0!3m2!1sen!2suk!4v1682622490666!5m2!1sen!2suk"
width="1024" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <br><br>
        <p>Here is the list of list and totals of crimes at Hammersmith and Fulham.</p>
        <div class="container">
            
            <div class="container">
                <table class="table">
                    <?php
                        $sql = "SELECT Crime_Type_1, COUNT(Crime_Type_1) AS Crime_Type_Count
                                    FROM Crime_Type
                                    JOIN geo_location
                                    ON crime_type.Location_ID=geo_location.Location_ID
                                    WHERE geo_location.LSOA_Name LIKE 'Hammersmith%'
                                    GROUP BY Crime_Type_1
                                    ORDER BY Crime_Type_Count DESC;";
                            $result = mysqli_query($conn, $sql);
                            $resultcheck = mysqli_num_rows($result);
                            if($resultcheck > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo $row['Crime_Type_1']." " . $row['Crime_Type_Count']."<br>";
                                }
                            }
                    ?>
                </table>
            </div>
        </div>
        
        <h2>List of London Boroughs</h2>

        <p>Select any London Boroughs below to take you to the links.</p>

        <table style="width:100%">
          <tr>
            <td><a href="borough.php">Barking and Dagenham</a></td>
            <td><a href="barnet.php">Barnet</a></td>
            <td><a href="bexley.php">Bexley</a></td>
            <td><a href="brent.php">Brent</a></td>
            <td><a href="bromley.php">Bromley</a></td>
            <td><a href="camden.php">Camden</a></td>
            <td><a href="croydon.php">Croydon</a></td>
            <td><a href="ealing.php">Ealing</a></td>
          </tr>
          <tr>
            <td><a href="enfield.php">Enfield</a></td>
            <td><a href="greenwich.php">Greenwich</a></td>
            <td><a href="hackney.php">Hackney</a></td>
            <td><a href="hammersmith and fulham.php">Hammersmith and Fulham</a></td>
            <td><a href="haringey.php">Haringey</a></td>
            <td><a href="harrow.php">Harrow</a></td>
            <td><a href="havering.php">Havering</a></td>
            <td><a href="hillingdon.php">Hillingdon</a></td>
          </tr>
          <tr>
            <td><a href="hounslow.php">Hounslow</a></td>
            <td><a href="islington.php">Islington</a></td>
            <td><a href="kensington and chelsea.php">Kensington and Chelsea</a></td>
            <td><a href="kingston upon thames.php">Kingston upon Thames</a></td>
            <td><a href="lambeth.php">Lambeth</a></td>
            <td><a href="lewisham.php">Lewisham</a></td>
            <td><a href="merton.php">Merton</a></td>
            <td><a href="newham.php">Newham</a></td>
          </tr>
          <tr>
            <td><a href="redbridge.php">Redbridge</a></td>
            <td><a href="richmond upon thames.php">Richmond upon Thames</a></td>
            <td><a href="southwark.php">Southwark</a></td>
            <td><a href="sutton.php">Sutton</a></td>
            <td><a href="tower hamlets.php">Tower Hamlets</a></td>
            <td><a href="waltham forest.php">Waltham Forest</a></td>
            <td><a href="wandsworth.php">Wandsworth</a></td>
            <td><a href="westminster.php">Westminster</a></td>
          </tr>
        </table>

        <footer>
            <p>&copy; 2023 - Street Crime</p>
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