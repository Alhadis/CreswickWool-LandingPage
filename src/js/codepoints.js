function f(s){
	var s		=	s.replace(/\\n\n/g, "\n");
	var output	=	[];
	for(var i = 0, l = s.length; i < l; ++i){
		output.push("0x" + (s.codePointAt(i).toString(16).toUpperCase()));
	}
	return output.join(", ");
}
