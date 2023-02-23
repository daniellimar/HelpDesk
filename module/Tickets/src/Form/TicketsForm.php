<?php
namespace Tickets\Form;

use Zend\Form\Form;

class TicketsForm extends Form {
	public function __construct() {
		parent::__construct('tickets', []);

		$this->add(new \Zend\Form\Element\Hidden('id'));
		$this->add(new \Zend\Form\Element\Text('name', ['label'=> 'Assunto']));
		$this->add(new \Zend\Form\Element\Text('description', ['label'=> 'Descrição']));
		$this->add(new \Zend\Form\Element\Text('priority', ['label'=> 'Prioridade']));
		$this->add(new \Zend\Form\Element\Text('sector', ['label'=> 'Setor']));
		$this->add(new \Zend\Form\Element\Text('myCountry', ['label'=> 'myCountry']));

		$submit = new \Zend\Form\Element\Submit('submit');
		$submit->setAttributes(['value' => 'Salvar', 'id' => 'submitbutton']);
		$this->add($submit);
	}
}
?>