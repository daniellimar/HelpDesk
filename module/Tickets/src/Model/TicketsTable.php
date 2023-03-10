<?php
namespace Tickets\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class TicketsTable {
	private $tableGateway;

	public function __construct(TableGatewayInterface $tableGateway) {
		$this->tableGateway = $tableGateway;
	}

	public function getAll() {
		return $this->tableGateway->select();
	}

	public function getPessoa($id) {
		$id = (int) $id;
		$rowset = $this->tableGateway->select(['id' => $id]);
		$row = $rowset->current();

		if (!$row) {
			throw new RuntimeException(sprintf("Não foi encontrado o id %id ", $id));
		}
		return $row;
	}

	public function salvarPessoa(Tickets $aluno) {
        $data = [
            'name' => $aluno->getName(),
            'description' => $aluno->getDescription(),
            'priority' => $aluno->getPriority(),
            'sector' => $aluno->getSector()
        ];

        $id = (int) $aluno->getId();
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

	public function deletarPessoa($id) {
		$this->tableGateway->delete(['id' => (int) $id]);
	}
}
?>