docReady = function (fn) {
	if (
		document.readyState === "complete" ||
		document.readyState === "interactive"
	) {
		window.setTime(fn, 1);
	} else {
		document.addEventListener("DOMContentLoaded", fn);
	}
};

getParentByClass = function (el, className) {
	let rent = el.parentElement,
		stop = 0;
	while (!rent.classList.contains(className)) {
		rent = rent.parentElement;
		if (stop == 1000) {
			return false;
		}
		stop++;
	}
	return rent;
};

toggleClass = function (el, trgtClss) {
	if (el.classList.contains(trgtClss)) {
		el.classList.remove(trgtClss);
	} else {
		el.classList.add(trgtClss);
	}
};

toggleShow = function (trgt) {
	toggleClass(trgt, "show");
};

toggleHide = function (trgt) {
	toggleClass(trgt, "hide");
};

addAction = function (trgt, trggr, actnFn) {
	trgt.addEventListener(trggr, () => {
		actnFn();
	});
};

allAddActions = function (trgts, trggr, actnFn) {
	trgts.forEach((trgt) => addAction(trgt, trggr, actnFn));
};

getAll = function (slctr) {
	const trgts = document.querySelectorAll(slctr);
	if (trgts[0] !== undefined) {
		return trgts;
	}
	return false;
};

getOne = function (slctr) {
	const trgt = document.querySelector(slctr);
	if (trgt !== undefined) {
		return trgt;
	}
	return false;
};

var replacement;

allowDrop = function (ev) {
	ev.preventDefault();
	ev.stopPropagation();
};

drag = function (ev) {
	swp = ev.target;
	//log("swp", swp, ev.target);
	ev.dataTransfer.effectAllowed = "move";
	ev.dataTransfer.setData("text/html", swp.innerHTML);
};

function log(msg, ...values) {
	console.log(msg + ": ", ...values);
}
swap = function (swpd, ev, target, stack) {
	if (!swpd.classList.contains(target)) {
		swpd = getParentByClass(swpd, target);
	}
	const nodeStack = document.querySelectorAll(".priority");
	stack = [...nodeStack];
	let index = stack.indexOf(swp),
		rm = stack.splice(index, 1)[0];
	index = stack.indexOf(swpd);
	const spliced = stack.splice(index, 0, rm),
		parent = getParentByClass(rm, "container"),
		length = stack.length;

	parent.replaceChildren(...stack);
	updatePriority(swpd.id, rm.firstChild.id);
};
updatePriority = function (priorityId, itemId) {
	// sends put req with only the item's id and new priority id.
	// the server does the heavy lifting of updating all the priorities
	console.log("priority.id = " + priorityId + "; item.id= " + itemId + ";");
};
swapPriority = function (swpd, swp) {
	const form = swpd.firstChild,
		itemId = form.id,
		priorityId = swpd.id,
		swporityId = swp.id,
		swpItemId = swp.firstChild.id;
	updatePriority(priorityId, swpItemId);
	updatePriority(swporityId, itemId);
};
drop = function (ev) {
	ev.preventDefault();
	let swpd = ev.target;
	if (swp !== swpd) {
		swap(swpd, ev, "priority");
	}
};

docReady(function () {
	// toggle modal w/ btn
	const addBtn = getOne("button.add-item");

	action = function () {
		const modal = getOne(".add-item.modal");
		if (modal) {
			toggleHide(modal);
		}
	};

	addAction(addBtn, "click", action);

	const mdlClsBtns = getAll(".add-item.modal button");

	addAction(mdlClsBtns[0], "click", action);
});
