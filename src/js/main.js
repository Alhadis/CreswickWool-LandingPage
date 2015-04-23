(function(){

	/** Global shorthand/MUNGE bench */
	var	win			=	window,
		doc			=	document,
		body		=	doc.body,
		each		=	Array.prototype.forEach,
		HIDDEN		=	"hidden",


	/** Which property to use when getting/setting an HTMLElement's textual content (thanks for NaN, IE8) */
		TEXT		=	"textContent" in body ? "textContent" : "innerText",



	/**
	 * Ascertains a browser's support for a CSS property.
	 * 
	 * @param {String} n - CSS property name, supplied in sentence case (e.g., "Transition")
	 * @return {Boolean} TRUE if the browser supports the property in either prefixed or unprefixed form. 
	 */
	cssSupport	=	function(n){
		var s	=	document.documentElement.style;
		if(n.toLowerCase() in s) return true;
		for(var p = "Webkit Moz Ms O Khtml", p = (p.toLowerCase() + p).split(" "), i = 0; i < 10; ++i)
			if(p[i]+n in s) return true;
		return false;
	};


	/** Store whether the browser supports CSS3 animations or not */
	if(!cssSupport("Animation")){
		win.NO_ANIM	=	true;
		doc.documentElement.classList.add("no-anim");
	}





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


	var Message	=	function(selector, lifespan){
		var THIS		=	this,
			shownClass	=	"show";

		THIS.el			=	doc.querySelector(selector);
		THIS.visible	=	THIS.el.classList.contains(shownClass);
		THIS.show		=	function(){			

			/** Briefly hide the previous message if it was already visible. */
			if(THIS.visible){
				THIS.hide();
				setTimeout(function(){ THIS.show(); }, 100);
				return;
			}

			THIS.visible	=	true;
			THIS.el.removeAttribute(HIDDEN);
			setTimeout(function(){ THIS.el.classList.add(shownClass); }, 100);
			
			/** Queue a removal of the message if a lifespan was specified */
			if(lifespan) setTimeout(function(){ THIS.hide(1)}, lifespan);
		};

		THIS.hide	=		function(fade){
			if(THIS.fading) return;

			/** Fade out */
			if(fade){
				THIS.fading	=	true;
				setTimeout(function(){
					THIS.fading = false;
					THIS.hide();
				}, 300);
				THIS.el.classList.remove(shownClass);
			}

			/** Hide immediately, no transition */
			else{
				THIS.el.setAttribute(HIDDEN, HIDDEN);
				THIS.el.classList.remove(shownClass);
				THIS.visible	=	false;
			}
		}
	},

	msgAdded	=	new Message("#cart-add"),
	msgError	=	new Message("#cart-error", 5000),




	addProduct	=	function(productID, quantity, size){
		var req	=	new XMLHttpRequest();
		req.addEventListener("readystatechange", function(e){
			
			/** AJAX request's finished loading */
			if(XMLHttpRequest.DONE === this.readyState){

				/** Server didn't send an error code. */
				(this.status < 400 ? msgAdded : msgError).show();
			}
		});

		req.open("POST", "api.php");
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		req.send("action=add_to_cart&product_id="+productID+"&quantity="+Math.min(1, quantity)+"&size="+(size||1));
	}
	/** Debounce addProduct so clicking/tapping too quickly won't add multiple products. */
	.debounce(1000, true),




	products	=	doc.getElementById("products");
	each.call(products.querySelectorAll("article"), function(THIS){
		var	productID	=	THIS.getAttribute("data-product-id"),
			quantity	=	THIS.querySelector(".quantity-field"),
			menu		=	THIS.querySelector(".folding-choice"),
			menuControl	=	menu.querySelector("input.control"),
			sizes		=	menu.querySelectorAll(".choices input"),
			GLOW		=	"glow", /** MUNGIN' IT. */


			/** Retrieves the ID of the product's currently-selected size. */
			getSelectedSize	=	function(){
				for(var i = 0, l = sizes.length; i < l; ++i)
					if(sizes[i].checked) return sizes[i].value;
				return null;
			},


			/** Flash the menu a bright red if the user's not filled it out. */
			showError	=	function(){

				if(win.NO_ANIM){
					var iterations		=	6,
						callbackID		=	setInterval(function(){
							menu.classList.toggle(GLOW);
							if(!(--iterations)){
								menuControl.checked	=	false;
								clearInterval(callbackID);
							}
						}, 300);
				}

				else menu.classList.add(GLOW);
			}.debounce(1800, true);



		/** Callback triggered when flash animation's finished playing. */
		menu.addEventListener("animationend", function(e){
			
			/** Remove glow animation and open menu. */
			if(GLOW === e.animationName){
				menuControl.checked	=	false;
				menu.classList.remove(GLOW);
			}
		});


		THIS.querySelector(".add.btn").addEventListener("click", function(e){
			
			var size = getSelectedSize();
			size ?
				addProduct(productID, quantity.value, size) :
				showError();

			e.preventDefault();
			return false;
		});
	});


}());