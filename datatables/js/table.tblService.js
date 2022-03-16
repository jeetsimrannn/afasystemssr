
/*
 * Editor client script for DB table tblService
 * Created by http://editor.datatables.net/generator
 */

(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: 'php/table.tblService.php',
		table: '#tblService',
		fields: [
			{
				"label": "ServiceID:",
				"name": "tblService.ServiceID"
			},
			{
				"label": "ServiceDate:",
				"name": "tblService.ServiceDate",
				"type": "datetime",
				"format": "YYYY-MM-DD HH:mm:ss"
			},
			{
				"label": "OrderID:",
				"name": "tblService.OrderID"
			},
			// {
			// 	"label": "OrderNo:",
			// 	"name": "tblCustOrders.OrderNo"
			// }
		]
	} );

	var table = $('#tblService').DataTable( {
		dom: 'Bfrtip',
		ajax: 'php/table.tblService.php',
		columns: [
			{
				"data": "tblService.ServiceID"
			},
			{
				"data": "tblService.ServiceDate"
			},
			{
				"data": "tblService.OrderID"
			},
			{
				"data": "tblCustOrders.OrderNo"         
			}
		],
		select: true,
		responsive: true,
		buttons: [ 
			{
                text: 'New',
				attr: {
					id: 'newBtn',
					onclick: "getSecurityCode();return false;"      
				},
                // action: function ( e, dt, node, config ) {
                //     window.location='../servicereports.php';
                // }
            },
			'New SR',
			'Update SR',
			// { extend: 'create', editor: editor },
			{ extend: 'edit',   editor: editor },
			{ extend: 'remove', editor: editor },
			
		]
	} );

	// $('#tblService tbody').on( 'click', 'tr', function () {
	// 	console.log( table.row( this ).data() );
	// } );

	table.on( 'select', function () {
		var rowData = table.rows( { selected: true } ).data()[0]['tblService']['ServiceID'];
		// now do what you need to do wht the row data
		sessionStorage.setItem("ServiceID", rowData);
		var ame = sessionStorage.getItem("ServiceID");
		alert(ame);
		console.log(rowData);
	} );
} );

}(jQuery));

