// <?php // This should fool phpDocumentor into parsing this file

/**
* All these functions are there in Joomla!
* But we have modified them here to be able
* to handle multiple forms at once
*/
function vm_isChecked(isitchecked, frmName){
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
function vm_listItemTask( id, task, frmName, pageName, func ) {
	var f = eval( "document."+frmName );
	cb = eval( 'f.' + id );
	if (cb) {
		cb.checked = true;
		f.page.value = pageName;
		vm_submitListFunc(task, frmName, func);
	}
	return false;
}
/**
* Default function.  Usually would be overriden by the component
*/
function vm_submitButton(pressbutton, frmName, pageName) {
	vm_submitForm(pressbutton, frmName, pageName);
}

/**
* Submit the admin form
*/
function vm_submitForm(pressbutton, frmName, pageName){

	var f = eval( "document."+frmName );
	if( pressbutton == "cancel" ) {
		f.func.value = "";
	}
	f.task.value = pressbutton;
	f.page.value = pageName;
	try {
		f.onsubmit();
	}
	catch(e){}
	f.submit();
}

function vm_submitListFunc( pressbutton, frmName, funcName ) {
	var f = eval( "document."+frmName );
	f.task.value = pressbutton;
	f.func.value = funcName;
	try {
		f.onsubmit();
	}
	catch(e){}
	f.submit();
}