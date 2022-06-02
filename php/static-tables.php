<?php

// review items

$result = mysqli_query($link, "INSERT INTO review_item (updated, name) VALUES (NOW(),'time logs');", MYSQLI_USE_RESULT);
if($result) {
	echo "`review_item.name = time logs` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO review_item (updated, name) VALUES (NOW(),'work flow');", MYSQLI_USE_RESULT);
if($result) {
	echo "`review_item.name = work flow` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO review_item (updated, name) VALUES (NOW(),'backlog');", MYSQLI_USE_RESULT);
if($result) {
	echo "`review_item.name = backlog` Entry Created. \n";
}

// end review items
//item status

$result = mysqli_query($link, "INSERT INTO status (updated, label) VALUES (NOW(),'open');", MYSQLI_USE_RESULT);
if($result) {
	echo "`status.label = open` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO status (updated, label) VALUES (NOW(),'next action');", MYSQLI_USE_RESULT);
if($result) {
	echo "`status.label = next action` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO status (updated, label) VALUES (NOW(),'done');", MYSQLI_USE_RESULT);
if($result) {
	echo "`status.label = done` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO status (updated, label) VALUES (NOW(),'deferred');", MYSQLI_USE_RESULT);
if($result) {
	echo "`status.label = deferred` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO status (updated, label) VALUES (NOW(),'closed');", MYSQLI_USE_RESULT);
if($result) {
	echo "`status.label = closed` Entry Created. \n"; }

//end item status
// wip limit

$result = mysqli_query($link, "INSERT INTO wip_limit (updated, time_limit) VALUES (NOW(),'1 hour');", MYSQLI_USE_RESULT);
if($result) {
	echo "`wip_limit.time_limit = 1 hour` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO wip_limit (updated, time_limit) VALUES (NOW(),'2 hour');", MYSQLI_USE_RESULT);
if($result) {
	echo "`wip_limit.time_limit = 2 hour` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO wip_limit (updated, time_limit) VALUES (NOW(),'3 hour');", MYSQLI_USE_RESULT);
if($result) {
	echo "`wip_limit.time_limit = 3 hour` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO wip_limit (updated, time_limit) VALUES (NOW(),'4 hour');", MYSQLI_USE_RESULT);
if($result) {
	echo "`wip_limit.time_limit = 4 hour` Entry Created. \n";
}

// end wip limit
// goal

$result = mysqli_query($link, "INSERT INTO goal (updated, label, status_id, limit_id, done_def, done) VALUES (NOW(),'goal1',(SELECT id FROM status WHERE label='open'), (SELECT id FROM wip_limit WHERE time_limit='2 hour'),'what does done look like?', false);", MYSQLI_USE_RESULT);
if($result) {
	echo "`goal.label = goal1` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO goal (updated, label, status_id, limit_id, done_def, done) VALUES (NOW(),'goal2',(SELECT id FROM status WHERE label='open'), (SELECT id FROM wip_limit WHERE time_limit='2 hour'),'what does done look like?', false);", MYSQLI_USE_RESULT);
if($result) {
	echo "`goal.label = goal2` Entry Created. \n";
}

$result = mysqli_query($link, "INSERT INTO goal (updated, label, status_id, limit_id, done_def, done) VALUES (NOW(),'goal3',(SELECT id FROM status WHERE label='open'), (SELECT id FROM wip_limit WHERE time_limit='2 hour'), 'what does done look like?', false);", MYSQLI_USE_RESULT);
if($result) {
	echo "`goal.label = goal3` Entry Created. \n";
}

// end goal
// projects

$result = mysqli_query($link, "INSERT INTO project (updated, label) VALUES (NOW(),'inbox');", MYSQLI_USE_RESULT);
if($result) {
	echo "`project.label = inbox` Entry Created. \n";
}

// end projects

?>
