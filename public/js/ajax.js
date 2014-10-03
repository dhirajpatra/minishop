$(document).ready(function () {


	$.ajaxSetup ({
			cache: false
		});
	
	// this function will make a ajax call with specified form
	function callAjaxForm(frm){
		
		$.ajax({
		    url: urlform,
		    type: 'POST',
		    dataType: 'json',
		    async: true,
		    data: $("#" + frm).serialize(),
		    success: function (data) {
		        console.log(data);
		    }
		    
		});
		
	}
	
	// this function can be used for ajax call from a link
	function callAjax(urlToProcess, valueToPass, displayDiv){
		
		$.ajax({
	      url: urlToProcess,
	      context: document.body,
	      success: function(result){
	        $("#" + displayDiv).html(result);
	      }
	    });
			
	}
	
	function errorAlert(e, jqxhr){
	
		alert("Your request was not successful: " + jqxhr);
	
	}
	
	
});