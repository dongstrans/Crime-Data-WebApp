# Add R Libraries
library(sf)
library(leaflet)
library(mapview)
library(ggplot2)
library(rgdal)
library(sp)

# Create a leaflet map
leaflet()%>%
  addTiles()

# Load London leaflet map
leaflet()%>%
  addTiles()%>%
  setView(0.1276, 51.5072, 10)

# Add basemaps to leaflet
leaflet()%>%
  addProviderTiles(providers$OpenStreetMap)%>%
  setView(0.1276, 51.5072, 10)

# Select shapefile
shp_file <- choose.files()

# Reads an OGR data source and layer into a suitable Spatial vector object.
London <- readOGR(shp_file)

# Convert a curves and points object to a data frame for ggplot2
data_frame <- fortify(London)

# Create map in ggplot
ggplot(data = data_frame, aes(x = long, y = lat, group = group)) + geom_path() + theme_void()
mapview(London)


## Open shapefile
lon_shp <- readOGR('C:/xampp/htdocs/maps/statistical-gis-boundaries-london/statistical-gis-boundaries-london/ESRI/OA_2011_London_gen_MHW.shp')

## Plot the map
plot(lon_shp)

## Read csv file
lon_data <- read.csv('C:/xampp/htdocs/maps/final.csv')

## Ordering the datasets
lon_shp = lon_shp[order(as.vector(lon_shp$LSOA11CD)),]
lon_data = lon_data[order(as.vector(lon_data$Lsoa11Cd)),]

## Merge datasets
lon_merge = sp::merge(lon_shp,lon_data,by='lsoa11cd', duplicateGeoms = TRUE)
