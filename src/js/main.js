(function(){

	/** Global shorthand/MUNGE bench */
	var	win			=	window,
		doc			=	document,
		body		=	doc.body,
		each		=	Array.prototype.forEach,


	/** Which property to use when getting/setting an HTMLElement's textual content (thanks for NaN, IE8) */
		TEXT		=	"textContent" in body ? "textContent" : "innerText",


	/** Page anatomy */
		etc			=	doc.getElementById("etc"),
		whatever	=	doc.getElementById("whatever"),
		main		=	doc.querySelector("main");








	/** DOM Extensions */
	NodeList.prototype.forEach			=
	HTMLCollection.prototype.forEach	=	Array.prototype.forEach;
	if(win.StaticNodeList)
		StaticNodeList.prototype.forEach	=	Array.prototype.forEach;




	/**
	 * Stops a function from firing too quickly.
	 *
	 * This method returns a copy of the original function that runs only after the designated
	 * number of milliseconds have elapsed. Useful for throttling onResize handlers.
	 *
	 * @param {Number} limit - Threshold to stall execution by, in milliseconds.
	 * @param {Boolean} soon - If TRUE, will call the function *before* the threshold's elapsed, rather than after.
	 * @return {Function}
	 */
	Function.prototype.debounce	=	function(limit, soon){
		var fn		=	this,
			limit	=	limit < 0 ? 0 : limit,
			started, context, args, timer,
	
	
			delayed	=	function(){
	
				/** Get the time between now and when the function was first fired. */
				var timeSince	=	Date.now() - started;
	
				if(timeSince >= limit){
					if(!soon) fn.apply(context, args);
					if(timer) clearTimeout(timer);
					timer = context = args	=	null;
				}
	
				else timer = setTimeout(delayed, limit - timeSince);
			};
	
	
		/** Debounced copy of the original function. */
		return function(){
			context		=	this,
			args		=	arguments;
	
			if(!limit)
				return fn.apply(context, args);
	
			started	=	Date.now();
			if(!timer){
				if(soon) fn.apply(context, args);
				timer	=	setTimeout(delayed, limit);
			}
		};
	};





	/** Webapp's logic starts here: */
	/** Resize folding regions to fit their (possibly-resized) content on window resize. */
	var folds	=	document.getElementsByClassName("fold");
	window.addEventListener("resize", (new function(){

		each.call(folds, function(o){
			o.style.maxHeight = o.scrollHeight + "px";
		});

		return this.constructor;
	}).debounce(80));


	

	/** Folding choice menus */
	var foldingChoices	=	document.getElementsByClassName("folding-choice");
	each.call(foldingChoices, function(THIS){

		var	foldControl	=	THIS.querySelector(".control"),
			foldLabel	=	THIS.querySelector(".disclosure"),
			choices		=	THIS.querySelectorAll(".choices input"),

			textBlank	=	foldLabel[TEXT],
			textPicked	=	foldLabel.getAttribute("data-text-selected");

		each.call(choices, function(o){
			o.addEventListener("change", function(e){
				var THIS			=	e.target;
				foldLabel[TEXT]		=	parseInt(THIS.value) ? textPicked.replace("%s", THIS.nextSibling[TEXT]) : textBlank;
				foldControl.checked	=	true;
			});
		});
	});




}());