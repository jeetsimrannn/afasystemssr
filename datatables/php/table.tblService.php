<?php

/*
 * Editor server script for DB table tblService
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// The following statement can be removed after the first run (i.e. the database
// table has been created). It is a good idea to do this to help improve
// performance.
// $db->sql( "IF object_id('tblService', 'U') is null
// 	CREATE TABLE tblService (
// 		[ServiceID] int not null identity,
// 		[servicedate] datetime,
// 		[orderid] nvarchar(255),
// 		PRIMARY KEY( [ServiceID] )
// 	);" );
 
// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tblService', 'ServiceID' )
	->fields(
		Field::inst( 'tblService.ServiceID' ),
		Field::inst( 'tblService.ServiceDate' )
			->validator( Validate::dateFormat( 'Y-m-d H:i:s' ) )
			->getFormatter( Format::datetime( 'Y-m-d H:i:s', 'Y-m-d H:i:s' ) )
			->setFormatter( Format::datetime( 'Y-m-d H:i:s', 'Y-m-d H:i:s' ) ),
		Field::inst( 'tblService.OrderID' ),
		Field::inst( 'tblCustOrders.OrderNo' )
		->where( 'tblService.ServiceID', '27', '=' )
		
	)
	->leftJoin( 'tblCustOrders', 'tblCustOrders.OrderID', '=', 'tblService.OrderID' )
	->leftJoin( 'tblEmployee', 'tblEmployee.EmployeeID', '=', 'tblService.EmployeeID' )
	// ->join(
    //     Mjoin::inst( 'tblCustOrders' )
    //         ->link( 'tblService.OrderID', 'tblCustOrders.OrderID' )
    //         ->fields(
    //             Field::inst( 'OrderNo' )         
    //         )
    // )
	->process( $_POST )
	->json();
