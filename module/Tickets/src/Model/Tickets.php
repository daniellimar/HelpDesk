<?php
namespace Tickets\Model;

class Tickets implements \Zend\Stdlib\ArraySerializableInterface {
	private $id;
	private $name;
	private $description;
    private $priority;
	private $sector;

	public function exchangeArray (array $data) {
		$this->id = !empty($data['id']) ? $data['id'] : null;
		$this->name = !empty($data['name']) ? $data['name'] : null;
		$this->description = !empty($data['description']) ? $data['description'] : null;
        $this->priority = !empty($data['priority']) ? $data['priority'] : null;
        $this->sector = !empty($data['sector']) ? $data['sector'] : null;
        $this->created_at = !empty($data['created_at']) ? $data['created_at'] : null;
        $this->myCountry = !empty($data['myCountry']) ? $data['myCountry'] : null;
	}

 	public function getId(){
        return $this->id;
    }

    public function setId($id){
        return $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        return $this->name = $name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        return $this->description = $description;
    }

    public function getPriority(){
        return $this->priority;
    }

    public function setPriority($priority){
        return $this->priority = $priority;
    }

    public function getSector(){
        return $this->sector;
    }

    public function setSector($sector){
        return $this->sector = $sector;
    }

    public function getCreated_at(){
        return $this->created_at;
    }

    public function setCreated_at($created_at){
        return $this->created_at = $created_at;
    }

    public function getArrayCopy(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'priority' => $this->priority,
            'sector' => $this->sector,
            'created_at' => $this->created_at
        ];
    }
}
?>