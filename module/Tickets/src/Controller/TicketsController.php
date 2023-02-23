<?php

namespace Tickets\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Tickets\Model\TicketsTable;
use Tickets\Form\TicketsForm;

use Zend\Validator\Explode as ExplodeValidator;

class TicketsController extends AbstractActionController {

	private $table;

	public function __construct($table) {
		$this->table = $table;
	}

	public function indexAction() {
		return new ViewModel(['tickets' => $this->table->getAll()]);
	}

	public function adicionarAction() {
        $form = new TicketsForm();
        $form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]);
        }
        $pessoa = new \Tickets\Model\Tickets();
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return new ViewModel(['form' => $form]);
        }
        $pessoa->exchangeArray($form->getData());
        $this->table->salvarPessoa($pessoa);
        return $this->redirect()->toRoute('tickets');
    }

	public function salvarAction() {
		return new ViewModel();
	}

	public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('tickets', ['action' => 'adicionar']);
        }
        try {
            $pessoa = $this->table->getPessoa($id);
        } catch (Exception $exc) {
            return $this->redirect()->toRoute('tickets', ['action' => 'index']);
        }
        $form = new TicketsForm();
        $form->bind($pessoa);
        $form->get('submit')->setAttribute('value', 'Salvar');
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];
        if (!$request->isPost()) {
            return $viewData;
        }
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return $viewData;
        }
        //$pessoa->exchangeArray($form->getData());
        $this->table->salvarPessoa($form->getData());
        return $this->redirect()->toRoute('tickets');
    }
    public function removerAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('tickets');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del','Não');
            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->table->deletarPessoa($id);
            }
            return $this->redirect()->toRoute('tickets');
        }
        return ['id' => $id, 'tickets' => $this->table->getPessoa($id)];
    }

    public function confirmacaoAction() {
        return new ViewModel();
    }

    public function relatorioAction() {
        return new ViewModel();
    }

    public function upgradeAction() {
        return new ViewModel();
    }

    public function manuaisAction() {
        return new ViewModel();
    }
}
?>