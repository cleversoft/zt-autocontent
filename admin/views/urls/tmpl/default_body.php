<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$user		= JFactory::getUser();
$userId		= $user->get('id');
?>
<?php
	foreach($this->items as $i => $item):
	$canChange = $user->authorise('core.edit.state', 'com_autocontent.url.'.$item->id);
?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->id; ?>
		</td>
		<td>
			<?php echo JHTML::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_autocontent&task=url.edit&id=' . $item->id); ?>" title="<?php echo $item->feed_name; ?>">
				<?php echo $item->feed_name; ?>
			</a>
		</td>
		<td align="center">
			<?php echo ucfirst($item->feed_type); ?>
		</td>
		<td align="center">
			<?php echo $this->getModel()->getCategoryName($item->feed_type, $item->content_id, $item->k2_id); ?>
		</td>
		<td align="center">
			<?php echo JHTML::_('jgrid.published', $item->published, $i, 'urls.', $canChange, 'cb', 1, 0); ?>
		</td>
	</tr>
<?php endforeach; ?>