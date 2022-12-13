<?php

require_once(PATH_MODELS . 'Connexion.php');
require_once(PATH_MODELS . 'types.php');

class Journey {

    private $id;
    private $title;
    private $description;
    private $schema;
    private $place;
    private $creator;
    private $public;

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
        $this->creator = $journey['user_id'];
        if($journey['public'] == 1)
            $this->public = true;
        else
            $this->public = false;

        $this->schema = $this->buildSchema();

    }

    public function buildSchema() {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT * FROM step 
            INNER JOIN compose ON step.step_id = compose.step_id
            LEFT OUTER JOIN primary_type pt on pt.primary_type_id = compose.type_id
            LEFT OUTER JOIN secondary_type st on st.secondary_type_id = compose.type_id
            WHERE journey_id = :id ORDER BY start");
        $query->execute([
            'id' => $this->id
        ]);
        $steps = $query->fetchAll();
        // Get all the different start time of the steps
        $startTimes = [];
        foreach ($steps as $step) {
            if (!in_array(['start' => $step['start'], 'type' => $step['type_id']], $startTimes)) {
                $typeName = $step['primary_type_name'];
                if($step['primary_type_name'] == null || $step['primary_type_name'] == "") {
                    $typeName = $step['secondary_type_name'];
                }
                $startTimes[] = [
                    'start' => $step['start'],
                    'type_id' => $step['type_id'],
                    'type_name' => $typeName
                ];
            }
        }
        // Build the schema
        $schema = [];
        foreach ($startTimes as $startTime) {
            $schema[$startTime['start']] = [];
            $schema[$startTime['start']]['type_id'] = $startTime['type_id'];
            $schema[$startTime['start']]['type_name'] = $startTime['type_name'];
            foreach ($steps as $step) {
                if ($step['start'] == $startTime['start']) {
                    $schema[$startTime['start']]['candidates'][] = $step;
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

    public function getCreator() {
        return $this->creator;
    }

    public function isPublic() {
        return $this->public;
    }
}