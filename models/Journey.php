<?php

require_once(PATH_MODELS . 'Connexion.php');
// Class Journey

class Journey {

    private $id;
    private $title;
    private $description;
    private $schema;
    private $place;

    public function __construct($id) {
        $this->id = $id;
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT * FROM journey INNER JOIN place ON journey.place_id = place.place_id WHERE journey_id = :id");
        $query->execute([
            'id' => $id
        ]);
        $journey = $query->fetch();
        $this->title = $journey['title'];
        $this->description = $journey['description'];
        $this->place = $journey['place_name'];

        $this->schema = $this->buildSchema();

    }

    public function buildSchema() {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT * FROM step 
            INNER JOIN compose ON step.step_id = compose.step_id 
            WHERE journey_id = :id ORDER BY start");
        $query->execute([
            'id' => $this->id
        ]);
        $steps = $query->fetchAll();
        // Get all the different start time of the steps
        $startTimes = [];
        foreach ($steps as $step) {
            if (!in_array($step['start'], $startTimes)) {
                $startTimes[] = $step['start'];
            }
        }
        // Build the schema
        $schema = [];
        foreach ($startTimes as $startTime) {
            $schema[$startTime] = [];
            foreach ($steps as $step) {
                if ($step['start'] == $startTime) {
                    $schema[$startTime][] = $step;
                }
            }
        }
        return $schema;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getSchema() {
        return $this->schema;
    }

    public function getPlace() {
        return $this->place;
    }
}