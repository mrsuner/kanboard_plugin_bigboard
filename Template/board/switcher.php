<div class="table-list">
	<div class="views-switcher-component">
		<ul class="views">
			<?php if (! empty($portfolio_scopes)): ?>
			<li class="bigboard-portfolio-scope">
				<label for="bigboard-portfolio-scope"><?= t('Portfolio group') ?></label>
				<select id="bigboard-portfolio-scope" onchange="window.location.href=this.value">
					<option value="<?= $this->text->e($this->url->href('Bigboard', 'index', array('plugin' => 'Bigboard', 'scope' => 'selected'))) ?>" <?= $scope['key'] === 'selected' ? 'selected' : '' ?>><?= t('Selected projects') ?></option>
					<?php foreach ($portfolio_scopes as $portfolio_scope): ?>
						<option value="<?= $this->text->e($this->url->href('Bigboard', 'index', array('plugin' => 'Bigboard', 'scope' => $portfolio_scope['key']))) ?>" <?= $scope['key'] === $portfolio_scope['key'] ? 'selected' : '' ?>><?= $this->text->e($portfolio_scope['name']) ?> (<?= count($portfolio_scope['project_ids']) ?>)</option>
					<?php endforeach ?>
				</select>
			</li>
			<?php endif ?>
			<li>
				<a href="<?= $this->app->config('application_url') ?>"><i class="fa fa-home fa-fw"></i><?= t('Home') ?></a>
			</li>
			<li>
				<?= $this->url->icon('eye', t('Projects Selection'), 'Bigboard', 'select', ['plugin' => 'Bigboard', 'boardview' => 'active', ], false, 'js-modal-medium') ?>
			</li>
			<li class="collapse_all">
				<a href="#"><i class="fa fa-folder-o fa-fw"></i><?= t('Collapse projects') ?></a>
			</li>
			<li class="expand_all">
				<a href="#"><i class="fa fa-folder-open-o fa-fw"></i><?= t('Expand projects') ?></a>
			</li>
			<li>
				<span class="filter-display-mode" <?= $bigboarddisplaymode ? '' : 'style="display: none;"' ?>>
				<?= $this->url->icon('expand', t('Expand tasks'), 'Bigboard', 'expandAll', array('plugin' => 'Bigboard', 'scope' => $scope['key']), false, 'board-display-mode') ?>
				</span>
				<span class="filter-display-mode" <?= $bigboarddisplaymode ? 'style="display: none;"' : '' ?>>
				<?= $this->url->icon('compress', t('Collapse tasks'), 'Bigboard', 'collapseAll', array('plugin' => 'Bigboard', 'scope' => $scope['key']), false, 'board-display-mode') ?>
				</span>
			</li>
			<li>
				<span class="filter-compact">
					<a href="#" class="filter-toggle-scrolling" title="<?= t('Keyboard shortcut: "%s"', 'c') ?>">
						<i class="fa fa-th fa-fw"></i><?= t('Compact view') ?>
					</a>
				</span>
				<span class="filter-wide" style="display: none">
					<a href="#" class="filter-toggle-scrolling" title="<?= t('Keyboard shortcut: "%s"', 'c') ?>">
						<i class="fa fa-arrows-h fa-fw"></i><?= t('Horizontal scrolling') ?>
					</a>
				</span>
			</li>
			<li>
				<a href="/?controller=ActivityController&amp;action=user" class="js-modal-medium" title=""><i class="fa fa-dashboard fa-fw js-modal-medium" aria-hidden="true"></i><?= t('Activity') ?></a>
			</li>
		</ul>
	</div>
</div>
