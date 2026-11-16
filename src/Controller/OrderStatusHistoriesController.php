<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrderStatusHistories Controller
 *
 * @property \App\Model\Table\OrderStatusHistoriesTable $OrderStatusHistories
 */
class OrderStatusHistoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrderStatusHistories->find()
            ->contain(['Orders', 'Users']);
        $orderStatusHistories = $this->paginate($query);

        $this->set(compact('orderStatusHistories'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Status History id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderStatusHistory = $this->OrderStatusHistories->get($id, contain: ['Orders', 'Users']);
        $this->set(compact('orderStatusHistory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderStatusHistory = $this->OrderStatusHistories->newEmptyEntity();
        if ($this->request->is('post')) {
            $orderStatusHistory = $this->OrderStatusHistories->patchEntity($orderStatusHistory, $this->request->getData());
            if ($this->OrderStatusHistories->save($orderStatusHistory)) {
                $this->Flash->success(__('The order status history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order status history could not be saved. Please, try again.'));
        }
        $orders = $this->OrderStatusHistories->Orders->find('list', limit: 200)->all();
        $users = $this->OrderStatusHistories->Users->find('list', limit: 200)->all();
        $this->set(compact('orderStatusHistory', 'orders', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Status History id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderStatusHistory = $this->OrderStatusHistories->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderStatusHistory = $this->OrderStatusHistories->patchEntity($orderStatusHistory, $this->request->getData());
            if ($this->OrderStatusHistories->save($orderStatusHistory)) {
                $this->Flash->success(__('The order status history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order status history could not be saved. Please, try again.'));
        }
        $orders = $this->OrderStatusHistories->Orders->find('list', limit: 200)->all();
        $users = $this->OrderStatusHistories->Users->find('list', limit: 200)->all();
        $this->set(compact('orderStatusHistory', 'orders', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Status History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderStatusHistory = $this->OrderStatusHistories->get($id);
        if ($this->OrderStatusHistories->delete($orderStatusHistory)) {
            $this->Flash->success(__('The order status history has been deleted.'));
        } else {
            $this->Flash->error(__('The order status history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
