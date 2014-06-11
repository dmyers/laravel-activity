<ul class="list-unstyled">
	<?php
	if (!$feed->isEmpty()) {
		$feed->each(function($activity) {
			?>
			<li class="activity">
				<span class="doer">
					<img src="http://gravatar.com/avatar/<?php echo md5($activity->doer->email); ?>?s=50" alt="<?php echo $activity->doer->activity_display_name; ?>" class="avatar" />
					<a href="#"><?php echo $activity->doer->activity_display_name; ?></a>
				</span>
				
				<span class="action">
					<?php echo $activity->action; ?>
				</span>
				
				<?php if ($activity->victim): ?>
					<span class="victim">
						<a href="#"><?php echo $activity->victim->activity_display_name; ?></a>
					</span>
				<?php endif; ?>
				
				<!--<?php if ($activity->item_type): ?>
					<span class="item_type">
						<?php echo $activity->item_type; ?>
					</span>
				<?php endif; ?>-->
				
				<?php if ($activity->item): ?>
					<span class="item">
						<a href="#"><?php echo $activity->item->activity_display_name; ?></a>
					</span>
				<?php endif; ?>
				
				<span class="date">
					<?php echo $activity->date->diffForHumans() ?>
				</span>
			</li>
			<?php
		});
	}
	else {
		?>
		There's no activity for this user.
		<?php
	}
	?>
</ul>