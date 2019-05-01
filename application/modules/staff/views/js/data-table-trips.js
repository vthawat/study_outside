$(function () {

	/* Data table */
 	onTable = $('.table').dataTable();
		$('#searching').keyup(function(){
		      onTable.fnFilter( $(this).val() );
		});
		
	 	person_detailTable = $('.person-details').dataTable();
		$('#searching-person-detail').keyup(function(){
		      person_detailTable.fnFilter( $(this).val() );
		});
	  	
});