<?

    class Lamp{
        private $id;
        private $nombre;
        private $status;
        private $modeloDenom;
        private $potencia;
        private $zona;

        public function __construct($id, $nombre, $status, $modeloDenom, $potencia, $zona){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->status = $status;
            $this->modeloDenom = $modeloDenom;
            $this->potencia = $potencia;
            $this->zona = $zona;
        }

        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getStatus(){
         $result = '';
        if ($this->status == 1){
                $result = 'on';
            }
        else $result = 'off';
            return $result;
        }
        public function getModeloDenom(){
            return $this->modeloDenom;
        }
        public function getPotencia(){
            return $this->potencia;
        }
        public function getZona(){
            return $this->zona;
        }
        
        public function setId($id){
            $this->id = $id;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setStatus($status){
            $this->status = $status;
        }
        public function setModeloDenom($modeloDenom){
            $this->modeloDenom = $modeloDenom;
        }
        public function setPotencia($potencia){
            $this->potencia = $potencia;
        }
        public function setZona($zona){
            $this->zona = $zona;
        }
    }

?>