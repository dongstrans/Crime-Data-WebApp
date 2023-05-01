<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maps</title>

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

		<h1>London Crimes from all Boroughs</h1>
		<p>Here is a table below that directs to a map of London and the displays the points of each particular crime.</p>
		<p>Once the page loads you can hover your mouse cursor to the points and it will display the individual crimes of that area.</p>

		<table style="width:100%">
          <tr>
            <td><a href="bicycle_theft.php">Bicycle Theft</a></td>
            <td><a href="burglary.php">Burglary</a></td>
            <td><a href="criminal_damage.php">Criminal Damage</a></td>
            <td><a href="drugs.php">Drugs</a></td>
            <td><a href="Other_crime.php">Other Crime</a></td>
            <td><a href="possession_of_weapons.php">Possession of Weapons</a></td>
          </tr>
          <tr>
            <td><a href="public_order.php">Public Order</a></td>
            <td><a href="robbery.php">Robbery</a></td>
            <td><a href="shoplifting.php">Shoplifting</a></td>
            <td><a href="theft_from_the_person.php">Theft from a Person</a></td>
            <td><a href="vehicle_crime.php">Vehicle Crime</a></td>
            <td><a href="violent_offences.php">Violent Offences</a></td>
          </tr>
        </table>

		<br>
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