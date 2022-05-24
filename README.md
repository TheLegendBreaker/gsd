# Get S##t Done

----------------

## Introduction

My take on David Allen's Getting Things Done methodology. Sorry Mr. Allen. 

heart of the workflow design is one list for everything. The almighty Backlog. To give some sense to the pile are tags. And the Backlog is halfed, inbox items being entries of unprocessed stuff. When stuff gets processed and earns its self a tag it graduates to main half of the Backlog, backlog. 

That's the heart of my current task management system. Under the recommendation of a one of the best human beings I have had the pleasure to work with, I ditched all the apps for a google doc and then a google sheet. I went form taking 2 hours to maintain 40+ local clients websites to 20 minutes. Despite complete a couple projects I found myself reaching for freatures and general feelings of, "this could be faster..." 

--------------
## Methodology

Think of the tags as a way to create new views or pages with in app. Tagging an item removes it from the Inbox and adds it to the tag's view. Adding multiple tags gives multiple views access to that same item. Now think of those views as workspaces. Eventaully each workspace will become a list of clearly defined individual task that help accomplish or maintain the object, as defined by the tag's label, of that workspace. 

The most important workspace in the application is the ** Inbox **. The genisis of this project came from how difficult a spread sheet makes it to enter data in the way I needed. GSD's main goal is to become a catch for my stuff as descirbed in GTD methodology. I wanted a big easy pad to jot out a quick idea. 

Everytime you visit the app, it promotes you to add an item to the inbox. It also has a big "add item to inbox" button available in all views.Inbox items are items without a tag. There is no limit on how small or big, within reason, you can make an entry to the inbox. As in GTD, in order to add a tag to an inbox item, you have to review the inbox (detailed instructions here). The makes it easy in the inbox reveiw mode by supplying all of the active tags, allow you to create new tags, and make multiple new items with specified tags.Only in this view can you add tags to newly created items. This gives us a chance to breack each item down into specific tasks for each of our workspaces. 



--------------
## Thinking

**white board section for working out features and functionality.**

5/23/21
Since items have several rows that can be updated, the update item function needs to handle the possiblities of each row's update. 

At first it seemed like concatenating a query string with the specific updates needed would be a great solution.

*Pseudo code*
``` 
update_item_query($item){
$query_string = "UPDATE item SET";

	foreach($item as $key=>$value){
		if($key != "id"){
			// concatenate each key and value in the request data into the query string.
			$query_string = $query_string." item.".$key."=".$value;
		}
	}

	if(isset($item['id'])){
		$query_string = $query_string." WHERE $item.id=".$item['id'].";";
	}

	return $query_string;
}
```

This sort of approach would also work for creating a new item. I could also set the table with a function like that.

```
// intial query_string set up
$query_string = "UPDATE ".$data['table']." SET";
```

My biggest concern with doing something like this is SQL injection. With the $data being added to a query string in such an abstracted way, someone could easily set one of the values to be valid and harmful SQL. One way to prevent this to check the incoming data for ';'. If found, the func will fail.

But there is also the use of the loop in function. I am trying to write scripts in such a way as to minimally use conditions and loops. This leads me to the second approach:

**One function for each row to be updated**

At first glance, this will cause there to be many more queries made to the db. However, it would even out, as every change to an item client side means a query. Wheather that's done with one function or many, the number of queries to the db are the same. 

This technique has the benfit of lower processing power needed for the application as the functions could be written with no loops and fewer conditionals. Also it could potential make it easier to manage the relationships between the information. Different db tables can be updated or created at the same time by combining the specific function calls. Such functions would be triggerd by event listeners. 

*Pseudo code*
```
// or I could set up an eventlistener that triggers when the user is typing in the textarea and the ":" or "-" key is pressed. That way at the moment a tag is entered the process of creating a tag or backlog item begins even before the user is done updating an item.
// this would avoid the need of the first conditional.And the following code block would not be triggerd each time a backlog item is updated. 
// the if backlog item can be done away with, as this approach would mean that the user is adding a tag to an item and therefore requires the app to create a backlog item.
// To check if a tag exists, the scripts will check if the tag's label is the key to its id in the allTags object. The allTags object is made when a user logs in. The client request all the tags from the db and process that info into the allTag obj w/ tag labels as keys and their ids as the value.
// if the tag's label does not exisits as a key in the allTags object then make a new tag and get its id. Add it to the allTags obj and to the new backlog item. 
if (.item textare.value contains ':') {
	let tags = split(textarea.value, ':');
	// tags are denoted in the textarea by a start with '-' and end with ':'.
	tags = split(tags[0], '-');
	// at this point tags is an array with each index containing a tag.

	for(let i=0, i<tags.lenth, i++){
		// check if tag exits
		// if so:
			// check if item id and tag id match a backlog item.
			// if not:
			// create a backlog item with the item's id and tag's id. Also make a new priority for the item.
		// if not:
		// create a new tag
		// create a backlog item w/ item's id and tag's id and create a new priority for the item.
	}
}
.item textarea.oninput = updateItemDesc(textarea.value);
.item select.onchange = updateItemStatus(select.value);
```


