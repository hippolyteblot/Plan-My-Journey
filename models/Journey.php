<?php

require_once(PATH_MODELS . 'Connexion.php');
require_once(PATH_MODELS . 'types.php');

class Journey {

    private $id;
    private $title;
    private $description;
    private $schema;
    private $date;
    private $start;
    private $end;
    private $place;
    private $creator;
    private $creatorName;
    private $rating;
    private $public;

    public function __construct($id) {
        $this->id = $id;
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT * FROM journey INNER JOIN place ON journey.place_id = place.place_id INNER JOIN user ON journey.user_id = user.user_id
            WHERE journey_id = :id");
        $query->execute([
            'id' => $id
        ]);
        $journey = $query->fetch();
        $this->date = $journey['creation_date'];
        $this->title = $journey['title'];
        $this->description = $journey['description'];
        $this->place = $journey['place_name'];
        $this->creator = $journey['user_id'];
        $this->creatorName = $journey['firstname'] . " " . $journey['lastname'];
        $this->rating = $journey['journey_rating'];
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
                    'end' => $step['end'],
                    'type_id' => $step['type_id'],
                    'type_name' => $typeName
                ];
            }
        }
        $this->start = $startTimes[0]['start'];
        $this->end = $startTimes[count($startTimes) - 1]['end'];
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
        // Put the steps with the isSelected attribute to 1 in the first position of the array
        foreach ($schema as $key => $step) {
            $isSelected = false;
            foreach ($step['candidates'] as $candidateKey => $candidate) {
                if ($candidate['isSelected'] == 1) {
                    $isSelected = true;
                    $temp = $step['candidates'][0];
                    $step['candidates'][0] = $candidate;
                    $step['candidates'][$candidateKey] = $temp;
                }
            }
            if (!$isSelected) {
                $step['candidates'][0]['isSelected'] = 1;
            }
            $schema[$key] = $step;
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

    public function getDate() {
        return $this->date;
    }

    public function getPlace() {
        return $this->place;
    }

    public function getCreator() {
        return $this->creator;
    }

    public function getCreatorName() {
        return $this->creatorName;
    }

    public function getRating() {
        return $this->rating;
    }

    public function isPublic() {
        return $this->public;
    }

    public function getStart() {
        return $this->start;
    }

    public function getEnd() {
        return $this->end;
    }
    public function getSteps() {
        $steps = [];
        foreach ($this->schema as $step) {
            $steps[] = $step['candidates'][0];
        }
        return $steps;
    }

    public function getDuration() {
        return $this->soustractTime($this->end, $this->start);
    }

    public function getDistance() {
        return 0;
    }

    private function soustractTime($time1, $time2) {
        $time1 = explode(':', $time1);
        $time2 = explode(':', $time2);
        $hours = (int) $time1[0] - (int) $time2[0];
        $minutes = $time1[1] - $time2[1];
        if ($minutes < 0) {
            $hours--;
            $minutes += 60;
        }
        // Add a 0 to minutes if it's less than 10
        if ($minutes < 10) {
            $minutes = '0' . $minutes;
        }
        // Same for hours
        if ($hours < 10) {
            $hours = '0' . $hours;
        }
        return $hours . ':' . $minutes;
    }
}