(function(){

	/** Global shorthand/MUNGE bench */
	var	win			=	window,
		doc			=	document,
		body		=	doc.body,
		each		=	Array.prototype.forEach,
		HIDDEN		=	"hidden",


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
	var folds	=	doc.getElementsByClassName("fold");
	win.addEventListener("resize", (new function(){

		each.call(folds, function(o){
			o.style.maxHeight = o.scrollHeight + "px";
		});

		return this.constructor;
	}).debounce(80));


	

	/** Folding choice menus */
	var foldingChoices	=	doc.getElementsByClassName("folding-choice");
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


	var Message	=	{
		el:			doc.getElementById("cart-message"),
		visible:	false,
		show:	function(){

			/** Briefly hide the previous message if it was already visible. */
			if(Message.visible){
				Message.hide();
				setTimeout(function(){ Message.show(); }, 100);
				return;
			}

			Message.visible	=	true;
			Message.el.removeAttribute(HIDDEN);
			setTimeout(function(){ Message.el.classList.add("show"); }, 100);
		},

		hide:	function(){
			Message.el.setAttribute(HIDDEN, HIDDEN);
			Message.el.classList.remove("show");
			Message.visible	=	false;
		}
	},



	addProduct	=	function(productID, quantity, size){
		if(!size){
			
			return;
		}
		
		var req	=	new XMLHttpRequest();
		req.addEventListener("readystatechange", function(e){

			/** AJAX request's finished loading, and the server didn't send an error code. */
			if(XMLHttpRequest.DONE === this.readyState && this.status < 400)
				Message.show();
		});

		req.open("POST", "api.php");
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		req.send("action=add_to_cart&product_id="+productID+"&quantity="+Math.min(1, quantity));
	}
	/** Debounce addProduct so clicking/tapping too quickly won't add multiple products. */
	.debounce(1000, true),



	products	=	doc.getElementById("products");
	each.call(products.querySelectorAll("article"), function(THIS){
		var	productID	=	THIS.getAttribute("data-product-id"),
			quantity	=	THIS.querySelector(".quantity-field"),
			sizes		=	THIS.querySelectorAll(".choices input"),

			/** Retrieves the ID of the product's currently-selected size. */
			getSelectedSize	=	function(){
				for(var i = 0, l = sizes.length; i < l; ++i)
					if(sizes[i].checked) return sizes[i].value;
				return null;
			};


		THIS.querySelector(".add.btn").addEventListener("click", function(e){
			addProduct(productID, quantity.value, getSelectedSize());
			e.preventDefault();
			return false;
		});
	});



}());