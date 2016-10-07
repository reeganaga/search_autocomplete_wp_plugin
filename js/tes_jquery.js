// jQuery(document).ready(function($) {
// 	alert('jQuery loaded.');
// });


 jQuery(document).ready(function($) {	
	$( "#Autocomplete1" ).keypress(function( event ) {
	  // alert( event.type ); // "click"
	  console.log('coba')
	});
	

// var availableTags = [
//           "ActionScript",
//           "AppleScript",
//           "Asp",
//           "BASIC",
//           "C",
//           "C++",
//           "Clojure",
//           "COBOL",
//           "ColdFusion",
//           "Erlang",
//           "Fortran",
//           "Groovy",
//           "Haskell",
//           "Java",
//           "JavaScript",
//           "Lisp",
//           "Perl",
//           "PHP",
//           "Python",
//           "Ruby",
//           "Scala",
//           "Scheme"
//         ];
	var url = MyAutocomplete.url + "?action=my_search";
	$('#Autocomplete1').autocomplete({
		minChars: 1,
		source: //url
		function(term, response) {

			jQuery.post(url, term, function(data) {
				// alert('Got this from the server: ' + response);
				response(data)
			},'json')
			console.log(term)
		// 	$.ajax({
		// 		type: 'POST',
		// 		dataType: 'json',
		// 		url: url,
		// 		data: 'action=my_search&name='+name,
		// 		success: function(data) {
		// 			response(data);
		// 		}
		// 	});
		// 	// var data = {
		// 	// 	'action': 'my_action_callback',
		// 	// 	'name': 'a'      // We pass php values differently!
		// 	// };
		// 	// jQuery.post(url, data, function(response) {
		// 	// 	alert('Got this from the server: ' + response);
		// 	// });
		
		}
	});

});