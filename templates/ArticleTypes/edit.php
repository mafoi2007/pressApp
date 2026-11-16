<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArticleType $articleType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $articleType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $articleType->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Article Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="articleTypes form content">
            <?= $this->Form->create($articleType) ?>
            <fieldset>
                <legend><?= __('Edit Article Type') ?></legend>
                <?php
                    echo $this->Form->control('label');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
