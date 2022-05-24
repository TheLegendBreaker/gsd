<?php
/*-- deponds on crud_lib.php --*/

function create_inbox_entry($item) {
	include './link.php';
	create_item($link, $item);
	$values = "(SELECT id FROM item WHERE item='{$item}'), (SELECT id FROM tag WHERE label='inbox'), 0";
	//$values = $item_id.", (SELECT id FROM tag WHERE label='inbox'), 0";
	//return $values;
	return create_backlog_item($link, $values);
}

