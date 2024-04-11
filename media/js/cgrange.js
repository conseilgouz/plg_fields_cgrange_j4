/*
; Fields CG Range
; Version			: 1.1.1
; Package			: Joomla 4.x/5.x
; copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
; license    		: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/
var cgrange = [];

document.addEventListener('DOMContentLoaded', function() {
    
    // Standard Range : more like a cursor 
    let cgranges = document.querySelectorAll('.form-cgrange');
    
    for(var i=0; i< cgranges.length; i++) {
        id = cgranges[i].getAttribute("data");
    	let options_range = Joomla.getOptions(id);
        cgrange[id] = new CGRange(id,options_range);
    }
})
function CGRange(id,options) {
    
    if (options.type == 'cursor') {
        let onerange = document.querySelector('#'+id);
        onerange.addEventListener('input',function() {
            let $id = this.getAttribute('id');
            label = document.querySelector('#cgrange-label-'+$id);
            label.innerHTML = this.value;
        })
    // initialize
        let cglabels = document.querySelectorAll('.cgrange-label');
        for(var i=0; i< cglabels.length; i++) {
            let $id = cglabels[i].getAttribute('data');
            var value = document.querySelector('#'+$id).getAttribute('value');
            cglabels[i].innerHTML = value;
        }
    }
    // RSlider
	if (options.type == "range") {
		let	min_range = options.valmin;
		let max_range = options.valmax;
		rangeSlider = new rSlider({
			target: '#'+id,
			values: {min:options.min, max:options.max},
			step: options.step,
			set: [min_range,max_range],
			range: true,
			tooltip: true,
			scale: false,
			labels: false,
			onChange: this.rangeUpdated,
		});
        if (options.enabled == 'false') {
            rangeSlider.disabled('true');
        }
        if (options.limits == 'hide') {
            limits = document.querySelectorAll('.'+id+' .rs-container .rs-scale span ins');
            for(var i=0; i< limits.length; i++) {
                limits[i].style.display = "none";
            }
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

