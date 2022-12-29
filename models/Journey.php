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
    private $placeId;
    private $budget;
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
        $this->placeId = $journey['place_id'];
        $this->budget = $journey['journey_budget'];
        $this->creator = $journey['user_id'];
        $this->creatorName = $journey['firstname'] . " " . $journey['lastname'];

        $query = $db->prepare("SELECT AVG(value) as rating FROM rating WHERE journey_id = :id");
        $query->execute([
            'id' => $id
        ]);
        $rating = $query->fetch();
        $this->rating = round($rating['rating'], 1);


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

    public static function calculateDistance($step1, $step2) {
        $x1 = $step1['step_lng'];
        $y1 = $step1['step_lat'];
        $x2 = $step2['step_lng'];
        $y2 = $step2['step_lat'];
        // Aversinus formula
        $distance = 1.3 * 6371 * acos(cos(deg2rad($x1)) * cos(deg2rad($x2)) * cos(deg2rad($y2) - deg2rad($y1)) + sin(deg2rad($x1)) * sin(deg2rad($x2)));

        $distance = round($distance, 2);
        return $distance;
    }

    public static function calculateEachDistance($steps) {
        $totalDistance = 0;
        for ($i = 0; $i < count($steps) - 1; $i++) {
            $totalDistance += Journey::calculateDistance($steps[$i], $steps[$i + 1]);
        }
        return $totalDistance;
    }

    public function setNotation($value, $userId) {
        $db = Connexion::getInstance()->getBdd();
        // Check if the user has already rated the journey
        $query = $db->prepare("SELECT * FROM rating WHERE journey_id = :journeyId AND user_id = :userId");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId
        ]);
        $rating = $query->fetch();
        if ($rating) {
            // Update the rating
            $query = $db->prepare("UPDATE rating SET value = :value WHERE journey_id = :journeyId AND user_id = :userId");
            $query->execute([
                'journeyId' => $this->id,
                'userId' => $userId,
                'value' => $value
            ]);
        } else {
            // Insert the rating
            $query = $db->prepare("INSERT INTO rating (journey_id, user_id, value) VALUES (:journeyId, :userId, :value)");
            $query->execute([
                'journeyId' => $this->id,
                'userId' => $userId,
                'value' => $value
            ]);
        }
        // Update the journey rating
        $query = $db->prepare("SELECT AVG(value) as rating FROM rating WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $rating = $query->fetch();
        $this->rating = round($rating['rating'], 1);
    }

    public function getUserNotation($userId) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT value FROM rating WHERE journey_id = :journeyId AND user_id = :userId");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId
        ]);
        $rating = $query->fetch();
        if ($rating) {
            return $rating['value'];
        } else {
            return null;
        }
    }

    public function saveJourney($userId) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("INSERT INTO save (journey_id, user_id) VALUES (:journeyId, :userId)");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId
        ]);
    }

    public function unsaveJourney($userId) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("DELETE FROM save WHERE journey_id = :journeyId AND user_id = :userId");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId
        ]);
    }

    public function alreadySaved($userId) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT * FROM save WHERE journey_id = :journeyId AND user_id = :userId");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId
        ]);
        $save = $query->fetch();
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function addFavorite($userId) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("INSERT INTO favorite (journey_id, user_id) VALUES (:journeyId, :userId)");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId
        ]);
    }

    public function removeFavorite($userId) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("DELETE FROM favorite WHERE journey_id = :journeyId AND user_id = :userId");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId
        ]);
    }

    public function alreadyFavorite($userId) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT * FROM favorite WHERE journey_id = :journeyId AND user_id = :userId");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId
        ]);
        $favorite = $query->fetch();
        if ($favorite) {
            return true;
        } else {
            return false;
        }
    }

    public function setPublic($value) {
        $value = $value ? 1 : 0;
        if($value == 0) {
            if($this->isSaved()) {
                $this->copyJourney();
            }
        }
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("UPDATE journey SET public = :value WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id,
            'value' => $value
        ]);
        $this->public = $value;
    }

    private function copyJourney() {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("INSERT INTO journey (title, description, public, user_id, place_id, journey_start, journey_end, journey_budget, creation_date) VALUES (:title, :description, :public, :userId, :placeId, :journeyStart, :journeyEnd, :journeyBudget, :creationDate)");
        $query->execute([
            'title' => $this->title,
            'description' => $this->description,
            'public' => 1,
            'userId' => 0,
            'placeId' => $this->placeId,
            'journeyStart' => $this->start,
            'journeyEnd' => $this->end,
            'journeyBudget' => $this->budget,
            'creationDate' => $this->date
        ]);
        $newId = $db->lastInsertId();
        echo $newId;
        $query = $db->prepare("SELECT * FROM save WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $saves = $query->fetchAll();
        foreach($saves as $save) {
            $query = $db->prepare("INSERT INTO save (journey_id, user_id) VALUES (:journeyId, :userId)");
            $query->execute([
                'journeyId' => $newId,
                'userId' => $save['user_id']
            ]);
        }
        $query = $db->prepare("SELECT * FROM favorite WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $favorites = $query->fetchAll();
        foreach($favorites as $favorite) {
            $query = $db->prepare("INSERT INTO favorite (journey_id, user_id) VALUES (:journeyId, :userId)");
            $query->execute([
                'journeyId' => $newId,
                'userId' => $favorite['user_id']
            ]);
        }
        $query = $db->prepare("SELECT * FROM rating WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $ratings = $query->fetchAll();
        foreach($ratings as $rating) {
            $query = $db->prepare("INSERT INTO rating (journey_id, user_id, value) VALUES (:journeyId, :userId, :value)");
            $query->execute([
                'journeyId' => $newId,
                'userId' => $rating['user_id'],
                'value' => $rating['value']
            ]);
        }
        foreach($this->getSchema() as $moment) {
            $steps = $moment["candidates"];
            foreach($steps as $step) {
                $query = $db->prepare("INSERT INTO compose (journey_id, step_id, type_id, start, end, isSelected) VALUES (:journeyId, :stepId, :typeId, :start, :end, :isSelected)");
                $query->execute([
                    'journeyId' => $newId,
                    'stepId' => $step["step_id"],
                    'typeId' => $step["type_id"],
                    'start' => $step["start"],
                    'end' => $step["end"],
                    'isSelected' => $step["isSelected"]
                ]);
            }
        }
        $query = $db->prepare("SELECT * FROM commentary WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $comentaries = $query->fetchAll();
        foreach($comentaries as $comentary) {
            $query = $db->prepare("INSERT INTO commentary (journey_id, user_id, content, date, is_reported) VALUES (:journeyId, :userId, :content, :date, :isReported)");
            $query->execute([
                'journeyId' => $newId,
                'userId' => $comentary['user_id'],
                'content' => $comentary['content'],
                'date' => $comentary['date'],
                'isReported' => $comentary['is_reported']
            ]);
        }
        // Delete user interaction with the old journey
        $query = $db->prepare("DELETE FROM save WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $query = $db->prepare("DELETE FROM favorite WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $query = $db->prepare("DELETE FROM rating WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $query = $db->prepare("DELETE FROM commentary WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
    }

    public function printSchema() {
        echo "<pre>";
        print_r($this->getSchema());
        echo "</pre>";
    }

    private function isSaved() {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT * FROM save WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $save = $query->fetch();
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteJourney() {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("DELETE FROM journey WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        // Delete user interaction with the journey
        $query = $db->prepare("DELETE FROM save WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $query = $db->prepare("DELETE FROM favorite WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $query = $db->prepare("DELETE FROM rating WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $query = $db->prepare("DELETE FROM commentary WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);
        $query = $db->prepare("DELETE FROM compose WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);

    }

    public function modifyJourney($title, $description, $selectedArray) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("UPDATE journey SET title = :title, description = :description WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id,
            'title' => $title,
            'description' => $description
        ]);
        $this->title = $title;
        $this->description = $description;

        $query = $db->prepare("UPDATE compose SET isSelected = 0 WHERE journey_id = :id");
        $query->execute([
            'id' => $this->id
        ]);

        $array = explode(',', $selectedArray);

        foreach ($array as $selected) {
            $query = $db->prepare("UPDATE compose SET isSelected = 1 WHERE journey_id = :journeyId AND step_id = :stepId");
            $query->execute([
                'journeyId' => $this->id,
                'stepId' => $selected
            ]);
        }
    }

    public function addCommentary($userId, $commentary) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("INSERT INTO commentary (journey_id, user_id, content, date) VALUES (:journeyId, :userId, :content, NOW())");
        $query->execute([
            'journeyId' => $this->id,
            'userId' => $userId,
            'content' => $commentary
        ]);
    }

    public function deleteCommentary($commentaryId) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("DELETE FROM commentary WHERE commentary_id = :id");
        $query->execute([
            'id' => $commentaryId
        ]);
    }

    public function canSee($userId) {
        return ($this->public == 1) || ($this->creator == $userId);
    }

    public function canModify($userId) {
        return ($this->creator == $userId) && ($this->public == 0);
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
        return Journey::calculateEachDistance($this->getSteps());
    }

    public function getCommentaries() {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare("SELECT *, DATE_FORMAT(date, '%d/%m/%Y %H:%i') AS date
            FROM commentary INNER JOIN user ON commentary.user_id = user.user_id 
            WHERE journey_id = :journeyId ORDER BY date ASC");
        $query->execute([
            'journeyId' => $this->id
        ]);
        $commentaries = [];
        while ($commentary = $query->fetch()) {
            $commentaries[] = $commentary;
        }
        return $commentaries;
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