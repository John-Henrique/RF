<a href="#"><?php __('Rastreamento'); ?></a>
<ul>
    <li><?php echo $this->Html->link(__('Adicionar', true), array( 'plugin' => 'rastreamento', 'controller' => 'rastreamentos', 'action' => 'add' )); ?></li>
    <li><?php echo $this->Html->link(__('Listar', true), array( 'plugin' => 'rastreamento', 'controller' => 'rastreamentos', 'action' => 'index' )); ?></li>
    <li><?php echo $this->Html->link(__('Atualizar', true), array( 'plugin' => 'rastreamento', 'admin' => false, 'controller' => 'rastreamentos', 'action' => 'automatico' )); ?></li>
</ul>