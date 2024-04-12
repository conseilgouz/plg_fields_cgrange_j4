/*
; Fields CG Range
; Version			: 1.1.1
; Package			: Joomla 4.x/5.x
; copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
; license    		: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/
var cgrangeslider = [];
document.addEventListener('DOMContentLoaded', function() {
    
    // Standard Range : more like a cursor 
    let cgranges = document.querySelectorAll('.form-cgrange');
    
    for(var i=0; i< cgranges.length; i++) {
        id = cgranges[i].getAttribute("data");
        if (!id) id = cgranges[i].getAttribute("id");
    	let options_range = Joomla.getOptions(id);
        let cgrange = new CGRange(id,options_range);
    }
    // bug admin if slider not shown on the screen
    let buttons = document.querySelectorAll('.admin [role="tablist"] [role="tab"]');
    for(var i=0; i< buttons.length; i++) {
       buttons[i].addEventListener('click', function() {
           cgrangeslider.forEach((range) => {
                    range.onResize();
           }) 
       })
    }
})
function CGRange(id,options) {
    let vals = [];
	let	min_range = options.valmin;
	let max_range = options.valmax;
    if (options.type == 'cursor') {
        range = false;
        vals.push(min_range);
    } else {
        range = true;
        vals.push(min_range);
        vals.push(max_range);
    }
	let cgrange = new rSlider({
		target: '#'+id,
		values: {min:options.min, max:options.max},
		step: options.step,
		set: vals,
		range: range,
        tooltip: true,
		scale: false,
		labels: false,
        width: options.width,
		onChange: this.rangeUpdated,
	});
    cgrangeslider.push(cgrange);
    if (options.enabled == 'false') {
        cgrange.disabled('true');
     }
     if (options.limits == 'hide') {
         limits = document.querySelectorAll('.'+id+' .rs-container .rs-scale span ins');
         for(var i=0; i< limits.length; i++) {
             limits[i].style.display = "none";
         }
	}
}

CGRange.prototype.rangeUpdated = function() {
/*	let rangeid = this.target;
	let obj = document.querySelector(rangeid);
	let isoid = obj.getAttribute('data');
	let isoobj = cgisotope[isoid];
	isoobj.range_sel = isoobj.rangeSlider.getValue();
	isoobj.range_init = isoobj.rangeSlider.conf.values[0]+','+isoobj.rangeSlider.conf.values[isoobj.rangeSlider.conf.values.length - 1];*/
}

