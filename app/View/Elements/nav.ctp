<?php if($this->Session->check('Auth.User')): ?>
<div class="nav-collapse">
    <ul class="nav">
        <li class="dropdown">
            <a id="drop-articles" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Articles'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="drop-articles">
                <li><?php echo $this->Html->link(__('List %s', __('Article')), array('controller' => 'articles', 'action' => 'index', 'plugin' => false)); ?></li>
                <li class="divider"></li>
                <li><a href="#modal-import-articles" data-toggle="modal"><?php echo __('Import Articles'); ?></a></li>
                <li><?php echo $this->Html->link(__('Add %s', __('Article')), array('controller' => 'articles', 'action' => 'add', 'plugin' => false)); ?></li>
            </ul>
        </li>
        <li class="dropdown">
            <a id="drop-journals" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Journals'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="drop-journals">
                <li><?php echo $this->Html->link(__('List %s', __('Journal')), array('controller' => 'journals', 'action' => 'index', 'plugin' => false)); ?></li>
                <li class="divider"></li>
                <li><?php echo $this->Html->link(__('Import Journals'), array('controller' => 'journals', 'action' => 'import', 'plugin' => false)); ?></li>
                <li><?php echo $this->Html->link(__('Add %s', __('Journal')), array('controller' => 'journals', 'action' => 'add', 'plugin' => false)); ?></li>
                <li><?php echo $this->Html->link(__('Export Journals'), array('controller' => 'journals', 'action' => 'export', 'plugin' => false)); ?></li>
            </ul>
        </li>
        <li class="dropdown">
            <a id="drop-users" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Users'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="drop-users">
                <li><?php echo $this->Html->link(__('List %s', __('User')), array('controller' => 'users', 'action' => 'index', 'plugin' => false)); ?></li>
                <li class="divider"></li>
                <li><?php echo $this->Html->link(__('Add %s', __('User')), array('controller' => 'users', 'action' => 'add', 'plugin' => false)); ?></li>
            </ul>
        </li>
        <li class="dropdown">
            <a id="drop-settings" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Settings'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="drop-settings">
                <li><?php echo $this->Html->link(__('Statuses'), array('controller' => 'author_statuses', 'action' => 'index', 'plugin' => false)); ?></li>
                <li class="divider"></li>
                <li><?php echo $this->Html->link(__('DocumentTemplates'), array('controller' => 'document_templates', 'action' => 'index', 'plugin' => false)); ?></li>
                <li><?php echo $this->Html->link(__('Add %s', __('DocumentTemplate')), array('controller' => 'document_templates', 'action' => 'add', 'plugin' => false)); ?></li>
                <li class="divider"></li>
                <li><?php echo $this->Html->link(__('PageContents'), array('controller' => 'page_contents', 'action' => 'index', 'plugin' => false)); ?></li>
                <li class="divider"></li>
                <li><?php echo $this->Html->link(__('Plugins'), array('controller' => 'pages', 'action' => 'display', 'plugins', 'plugin' => false)); ?></li>
            </ul>
        </li>
        <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout', 'plugin' => false)); ?></li>
    </ul>
</div><!--/.nav-collapse -->
<?php endif; ?>