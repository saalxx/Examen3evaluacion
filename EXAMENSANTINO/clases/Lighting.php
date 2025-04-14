<?

    class Lighting extends Conection{
        public function getAllLamps(){
            $lamps = [];
            $sql = "SELECT lamps.lamp_id, lamps.lamp_name, lamp_on,
                lamp_models.model_part_number,lamp_models.model_wattage,
                zones.zone_name FROM lamps INNER JOIN lamp_models ON
                lamps.lamp_model=lamp_models.model_id INNER JOIN zones ON
                lamps.lamp_zone = zones.zone_id ORDER BY lamps.lamp_id;";
            $result = $this->conn->query($sql);
            if ($result->rowCount() > 0){
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $lamps[] = new Lamp($row['lamp_id'], $row['lamp_name'], $row['lamp_on'],
                    $row['model_part_number'], $row['model_wattage'], $row['zone_name']);
                }
            }
            return $lamps;
        }
        public function drawLampList(){
            $MIRAR = $this->getAllLamps();
            for($i = 0; $i < count($MIRAR); $i++){
                echo 
                "<div class='element ". ($MIRAR[$i]->getStatus())."'>
                <h4>
                <a href='changestatus.php?id=".$MIRAR[$i]->getId()."'><img src='img/bulb-icon-off.png'></a>
                </h4>
                <h4><a href='changestatus.php?id=''></a>".$MIRAR[$i]->getNombre()."</h4>
                <h1>".$MIRAR[$i]->getPotencia()."</h1>
                <h4>".$MIRAR[$i]->getZona()."</h4>
                </div>";
            }
        }
        public function getPotenciaZona(){
            $sql = "SELECT SUM(lamp_models.model_wattage) as power FROM
                `lamps` INNER JOIN lamp_models on
                lamp_model=lamp_models.model_id WHERE lamp_on = 1 ;";
            $stmt = $this->conn->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC)['power'];
        }
        public function changeStatus($id){
            $sql = "SELECT lamp_on as lamp_id FROM lamps where lamp_id=$id";
            $result = $this->conn->query($sql);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                if ($row['lamp_id'] == 0){
                    $sql = "UPDATE lamps SET lamp_on = 1 where lamp_id=$id";
                }else{
                    $sql = "UPDATE lamps SET lamp_on = 0 where lamp_id=$id";
                }
                $result = $this->conn->query($sql);
            }
        }
        public function drawZoneOptions($zona){
            $lamps = [];
            $sql = "SELECT lamps.lamp_id, lamps.lamp_name, lamp_on,
                lamp_models.model_part_number,lamp_models.model_wattage,
                zones.zone_name FROM lamps INNER JOIN lamp_models ON
                lamps.lamp_model=lamp_models.model_id INNER JOIN zones ON
                lamps.lamp_zone = zones.zone_id where lamps.lamp_zone = '$zona'";
            $result = $this->conn->query($sql);
            if ($result->rowCount() > 0){
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $lamps[] = new Lamp($row['lamp_id'], $row['lamp_name'], $row['lamp_on'],
                    $row['model_part_number'], $row['model_wattage'], $row['zone_name']);
                }
            }
            return $lamps;
        }
        public function drawLampListZone($zona){
            if ($zona == 'all'){
                $this->drawLampList();
            }else{
                $MIRAR = $this->drawZoneOptions($zona);
                for($i = 0; $i < count($MIRAR); $i++){
                    echo 
                    "<div class='element ". ($MIRAR[$i]->getStatus())."'>
                    <h4>
                    <a href='changestatus.php?id=".$MIRAR[$i]->getId()."'><img src='img/bulb-icon-off.png'></a>
                    </h4>
                    <h4><a href='changestatus.php?id=''></a>".$MIRAR[$i]->getNombre()."</h4>
                    <h1>".$MIRAR[$i]->getPotencia()."</h1>
                    <h4>".$MIRAR[$i]->getZona()."</h4>
                    </div>";
                }
            }
        }
    }

?>