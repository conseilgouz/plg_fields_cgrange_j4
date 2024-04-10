/*
; Fields CG Range
; Version			: 1.0.0
; Package			: Joomla 4.x/5.x
; copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
; license    		: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

document.addEventListener('DOMContentLoaded', function() {
    let cgranges = document.querySelectorAll('.form-cgrange');
    for(var i=0; i< cgranges.length; i++) {
        cgranges[i].addEventListener('input',function() {
            let $id = this.getAttribute('id');
            label = document.querySelector('#cgrange-label-'+$id);
            label.innerHTML = this.value;
        })
    }
    // initialize
    let cglabels = document.querySelectorAll('.cgrange-label');
    for(var i=0; i< cglabels.length; i++) {
        let $id = cglabels[i].getAttribute('data');
        var value = document.querySelector('#'+$id).getAttribute('value');
        cglabels[i].innerHTML = value;
    }

});
