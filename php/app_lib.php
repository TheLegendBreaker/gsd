<?php
/*-- deponds on crud_lib.php --*/
// tag tabl

//function get_all_tags($link) {
	//$rows = select_all_from($link, "tag");
	//if($rows) {
		//$req_items = array();

		//foreach ($rows as &$value) {
			//$tag = array(
				//"id" => $value[0],
				//"entered" => $value[1],
				//"updated" => $value[2],
				//"label" => $value[3],
			//);
			//array_push($req_items, $tag);
		//}
		//return $req_items;
	//}
		//return $rows;
//}

//function get_tag($link, $id) {
	//$conditions = "WHERE tag.id='".$id."'";
	//$row = select_all_from($link, "tag", $conditions);
	//if($row) {

		//$req_item = array(
			//"id" => $row[0],
			//"entered" => $row[1],
			//"updated" => $row[2],
			//"label" => $row[3],
		//);
		//return json_encode( $req_item );
	//}
		//return false;
//}

//function update_tag($link, $tag) {
	//$update_query = "label='".$tag["label"]."' WHERE id = '".$tag["id"]."'";
	//$row = update_set($link, 'tag', $update_query);
	//if($row) {
		//return $row;
	//}
		//return false;
//}

function create_inbox_entry($item) {
	include './link.php';
	// create item
	$item_id = create_item($link, $item);
	$values = $item_id.", (SELECT id FROM tag WHERE label='inbox'), 0";
	//$values = $item_id.", 2, 0";
	// create backlog_entry with new item id and inbox label id=1
	return create_backlog_item($link, $values);
	//return "true-ish";
}

//function delete_tag($link, $id) {
	//$result = delete_from($link, 'tag', $id);
	//if($result) {
		//return true;
	//}
		//return false;
//}

// end tag table
