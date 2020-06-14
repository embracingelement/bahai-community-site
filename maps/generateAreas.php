<?php

class FeatureCollection {
    public String $type = "FeatureCollection";
    public array $features;

    /**
     * FeatureCollection constructor.
     */
    public function __construct()
    {
        $this->type = "FeatureCollection";
        $this->features = [];
    }
}

class Feature {
    public String $type;
    public FeatureProperties $properties;
    public FeatureGeometry $geometry;

    /**
     * Feature constructor.
     */
    public function __construct()
    {
        $this->type = "Feature";
        $this->properties = new FeatureProperties();
        $this->geometry = new FeatureGeometry();
    }
}

class FeatureProperties {
    public String $APY;
}

class FeatureGeometry {
    public string $type;
    public array $coordinates;

    /**
     * FeatureGeometry constructor.
     */
    public function __construct()
    {
        $this->type = "Polygon";
        $this->coordinates = [];
    }
}

class FeatureCollectionFactory {
    public function createFeatureCollectionFromZipCodes($areas, $zipCodes) : FeatureCollection {
        $zipCodeFeatures = $this->getZipCodeFeatures($zipCodes);
        $areaByZipCode = $this->getAreaByZipCode($areas);

        $featureCollection = new FeatureCollection();

        foreach($areaByZipCode as $area => $zipCodes) {
            $feature = $this->mapAreaZipCodesToFeature($area, $zipCodes, $zipCodeFeatures);
            array_push($featureCollection->features, $feature);
        }

        return $featureCollection;
    }

    private function getZipCodeFeatures($zipCodes)
    {
        $featuresByZipCode = [];

        foreach($zipCodes["features"] as $feature) {
            $featuresByZipCode[$feature["properties"]["name"]] = $feature;
        }

        return $featuresByZipCode;
    }

    private function getAreaByZipCode($areas)
    {
        $areaByZipCode = [];

        foreach($areas["areasToZipCodes"] as $area) {
            if(!isset($areaByZipCode[$area["area"]])){
                $areaByZipCode[$area["area"]] = [];
            }

            array_push($areaByZipCode[$area["area"]], $area["zipCode"]);
        }

        return $areaByZipCode;
    }

    private function mapAreaZipCodesToFeature($area, $zipCodes, $zipCodeFeatures) : Feature
    {
        $feature = new Feature();

        $feature->properties->APY = $area;

        foreach($zipCodes as $zipCode) {
            if(isset($zipCodeFeatures[$zipCode])) {
                $zipCoordinates = $zipCodeFeatures[$zipCode]["geometry"]["coordinates"];

                array_push($feature->geometry->coordinates, $zipCoordinates);
            }
        }

        return $feature;
    }
}

$areas = json_decode(file_get_contents("areasToZipCodes.json"), true);
$zipCodes = json_decode(file_get_contents("zip-code-tabulation-areas-2012.geojson"), true);

$featureCollectionFactory = new FeatureCollectionFactory();

$featureCollection = $featureCollectionFactory->createFeatureCollectionFromZipCodes($areas, $zipCodes);

file_put_contents("areas.json", json_encode($featureCollection, JSON_PRETTY_PRINT));
