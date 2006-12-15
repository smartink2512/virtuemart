function newAttribute(attribute_id)
{
	var d = document;
	
	var container = d.getElementById('attribute_container');
	var next_inc  = attribute_id + 1;
	var toolbar   = "<a href='#' onclick='newAttribute("+next_inc+")'>New Attribute</a> | <a href='#' onclick='deleteAttribute("+attribute_id+")'>Delete Attribute</a> | <a href='#' onclick='newProperty("+attribute_id+")'>New Property</a>";
	
	var table = d.createElement('table');
	table.id  = 'attributeX_table_'+attribute_id;
	table.className = 'adminform';
	
	var tbody = d.createElement("tbody");
	var tr    = d.createElement('tr');
	var tr2   = d.createElement('tr');
	tr2.id    = "attributeX_tr_"+attribute_id+"_0";
	

	var td_01 = d.createElement('td');
	td_01.style.width = '5%';
	td_01.innerHTML = 'Name';
	
	var td_02 = d.createElement('td');
	td_02.colSpan = '2';
	td_02.align = 'left';
	td_02.innerHTML = '<input type="text" name="attributeX['+attribute_id+'][name]" value="" size="60"/>';
	
	var td_03 = d.createElement('td');
	td_03.colSpan = '3';
	td_03.align = 'left';
	td_03.innerHTML = toolbar;
	
	
	
	var td_04 = d.createElement('td');
	td_04.style.width = '5%';
	td_04.innerHTML = '&nbsp;';
	
	var td_05 = d.createElement('td');
	td_05.style.width = '10%';
	td_05.align = 'left';
	td_05.innerHTML = 'Property';
	
	var td_06 = d.createElement('td');
	td_06.style.width = '20%';
	td_06.align = 'left';
	td_06.innerHTML = "<input type='text' name='attributeX["+attribute_id+"][value][]' value='' size='40'/>";
	
	var td_07 = d.createElement('td');
	td_07.style.width = '5%';
	td_07.align = 'left';
	td_07.innerHTML = 'Price';
	
	var td_08 = d.createElement('td');
	td_08.style.width = '60%';
	td_08.align = 'left';
	td_08.innerHTML = "<input type='text' name='attributeX["+attribute_id+"][price][]' size='5' value=''/><a href='#' onclick='deleteProperty("+attribute_id+",\""+attribute_id+"_0\");'>X</a>";
	
	
	table.appendChild(tbody);
	  tbody.appendChild(tr);
	    tr.appendChild(td_01);
	    tr.appendChild(td_02);
	    tr.appendChild(td_03);
	  tbody.appendChild(tr2);  
	    tr2.appendChild(td_04); 
	    tr2.appendChild(td_05);
	    tr2.appendChild(td_06);
	    tr2.appendChild(td_07);
	    tr2.appendChild(td_08);
	
	container.appendChild(table);
}


function deleteAttribute(attribute_id)
{
	var container = document.getElementById('attribute_container');
	
	//var table = container.getElementsByTagName("table")[attribute_id];
	var table = document.getElementById("attributeX_table_"+attribute_id);
	
	container.removeChild(table);
}


function newProperty(attribute_id)
{
	var d     = document;
	var table = document.getElementById("attributeX_table_"+attribute_id);
	var tbody = table.getElementsByTagName('tbody')[0];
	var tr_id = table.getElementsByTagName('tr').lenght + 1;
	
	var tr    = d.createElement('tr');
	tr.id = "attributeX_tr_"+attribute_id+"_"+tr_id;
	
	
	
	var td_01 = d.createElement('td');
	td_01.style.width = '5%';
	td_01.innerHTML = '&nbsp;';
	
	var td_02 = d.createElement('td');
	td_02.style.width = '10%';
	td_02.align = 'left';
	td_02.innerHTML = 'Property';
	
	var td_03 = d.createElement('td');
	td_03.style.width = '20%';
	td_03.align = 'left';
	td_03.innerHTML = "<input type='text' name='attributeX["+attribute_id+"][value][]' value='' size='40'/>";
	
	var td_04 = d.createElement('td');
	td_04.style.width = '5%';
	td_04.align = 'left';
	td_04.innerHTML = 'Price';
	
	var td_05 = d.createElement('td');
	td_05.style.width = '60%';
	td_05.align = 'left';
	td_05.innerHTML = "<input type='text' name='attributeX["+attribute_id+"][price][]' size='5' value=''/><a href='#' onclick='deleteProperty("+attribute_id+",\""+attribute_id+"_"+tr_id+"\");'>X</a>";
	
	tbody.appendChild(tr);
	  tr.appendChild(td_01);
	  tr.appendChild(td_02);
	  tr.appendChild(td_03);
	  tr.appendChild(td_04);
	  tr.appendChild(td_05);
}


function deleteProperty(attribute_id, property_id)
{
	var d     = document;
	var table = document.getElementById("attributeX_table_"+attribute_id);
	var tbody = table.getElementsByTagName('tbody')[0];
	var tr    = document.getElementById("attributeX_tr_"+property_id);
	
	tbody.removeChild(tr);
}