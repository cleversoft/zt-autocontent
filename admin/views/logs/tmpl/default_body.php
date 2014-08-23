<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$user		= JFactory::getUser();
$userId		= $user->get('id');
?>
<?php
	foreach($this->items as $i => $item):
?>
	<tr class="row<?php echo $i % 2; ?>">
		<td align="center">
			<?php echo $item->id; ?>
		</td>
		<td>
			<?php echo JHTML::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
			<?php echo $item->message; ?>
		</td>
		<td align="center">
			<?php echo $item->created_on; ?>
		</td>
	</tr>
<?php endforeach; ?>