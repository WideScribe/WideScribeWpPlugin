function ligthest_brigths(color,pracent){
	if(typeof(color)=='undefined')
			return '';
		new_color=color;
		if(!(new_color.length==6 || new_color.length==7))
		{
			return color;
		}
		var color_vandakanishov=new_color.indexOf('#');
		if(color_vandakanishov != -1) {
			new_color= new_color.replace('#','');
		}
		var color_part_1=new_color.substr(0, 2);
		var color_part_2=new_color.substr(2, 2);
		var color_part_3=new_color.substr(4, 2);
		color_part_1=dechex( (hexdec( color_part_1 ) + (( 255-( hexdec( color_part_1 ) ) ) * pracent / 100 )));
		color_part_2=dechex( (hexdec( color_part_2)  + (( 255-( hexdec( color_part_2 ) ) ) * pracent / 100 )));
		color_part_3=dechex( (hexdec( color_part_3 ) + (( 255-( hexdec( color_part_3 ) ) ) * pracent / 100 )));
		new_color=color_part_1+color_part_2+color_part_3;
		if(color_vandakanishov != false){
			return new_color;
		}
		else{
			return '#'.new_color;
		}
	
}
function hex_to_rgba(hex,alpha){
	if( alpha == 'undefined')
		alpha=1;
	if(typeof(hex)=='undefined')
			return '';	
	return 'rgba('+hexToRgb(hex).r+","+hexToRgb(hex).g+","+hexToRgb(hex).b+","+alpha+")";
}
function hexToRgb(hex) {
	if(typeof(hex)=='undefined')
			return '';
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}
function hexdec(hex_string) {
	if(typeof(hex_string)=='undefined')
			return '';
  hex_string = (hex_string + '')
    .replace(/[^a-f0-9]/gi, '');
  return parseInt(hex_string, 16);
}
function dechex(number) {
	if(typeof(number)=='undefined')
			return '';
  if (number < 0) {
    number = 0xFFFFFFFF + number + 1;
  }
  return parseInt(number, 10)
    .toString(16);
}
function negativeColor(color)
	{
		if(typeof(color)=='undefined')
			return '';
		//get red, green and blue
		var r = color.substr(0, 2);
		var g = color.substr(2, 2);
		var b = color.substr(4, 2);
		
		//revert them, they are decimal now
		r = 0xff-hexdec(r);
		g = 0xff-hexdec(g);
		b = 0xff-hexdec(b);
		
		//now convert them to hex and return.
		return dechex(r).dechex(g).dechex(b);
	}