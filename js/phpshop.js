/**
* Toggles the check state of a group of boxes
*
* Checkboxes can have an id attribute in the form cb0, cb1...
* @param The number of box to 'check'
* @param An alternative field name
*/
function checkAllBoxes( n, fldName, frmName ) {
  if (!fldName) {
     fldName = 'cb';
  }
	var f = eval( "document."+frmName );
	var c = f.toggle.checked;
	var n2 = 0;
	for (i=0; i < n; i++) {
		cb = eval( 'f.' + fldName + '' + i );
		if (cb) {
			cb.checked = c;
			n2++;
		}
	}
	if (c) {
		f.boxchecked.value = n2;
	} else {
		f.boxchecked.value = 0;
	}
}
function ms_isChecked(isitchecked, frmName){
    var f = eval( "document."+frmName );
	if (isitchecked == true){
		f.boxchecked.value++;
	}
	else {
		f.boxchecked.value--;
	}
}

/**
*/
function ms_listItemTask( id, task, frmName ) {
	var f = eval( "document."+frmName );
	cb = eval( 'f.' + id );
	if (cb) {
		cb.checked = true;
		submitbutton(task);
	}
	return false;
}
/**
* Default function.  Usually would be overriden by the component
*/
function ms_submitbutton(pressbutton, frmName) {
	ms_submitform(pressbutton, frmName);
}

/**
* Submit the admin form
*/
function ms_submitform(pressbutton, frmName){

	var f = eval( "document."+frmName );
	f.task.value=pressbutton;
	try {
		f.onsubmit();
		}
	catch(e){}
	f.submit();
}
