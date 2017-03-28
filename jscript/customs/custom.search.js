// JavaScript Document

(function(window) {
	var is_rm = true;
	var load_data = function(data_url, data_sent) {
		var search_str = $("input[name=search-ch]").val();
		search_str = search_str.replace(/(\s+)$/, "")
		var search_count = search_str.split(/\s+/).length;
		data_sent['ch'] = search_str;

		if (search_str == "") {
			$('#result-tab').fadeOut();
			$('#result-download').fadeOut();
			$('#error-msg').html(['請輸入上方資訊']);
            $(".overlay").css("display", "none");
            $(".loading-img").css("display", "none"); 
		}
		else if (search_count > 1) {
			$('#result-tab').fadeOut();
			$('#result-download').fadeOut();
			$('#error-msg').html(['請輸入"一個"單字']);
            $(".overlay").css("display", "none");
            $(".loading-img").css("display", "none"); 			
		}
		else {
			$('#error-msg').html(['']);
			$.ajax({
				url: (data_url),
				cache: false,
				dataType: "html",
				type: "POST",
				data: data_sent,
				success: function(response) {
					var contents_list = $.parseJSON(response);

					if (response != "[]")
					{
						for(var key in contents_list)
						{
							$('#' + key).html(contents_list[key]);
						}
					}
					else
					{
						$('#table-header').html(['不好意思，查無結果']);
					}
				},
               	complete:function(){
               		$(".overlay").css("display", "none");
               		$(".loading-img").css("display", "none");
               		$('#result-tab').fadeIn(); 
               		$('#result-download').fadeIn();
		  			$("#downloadc").click(function() {
		  				is_rm = false;
					});
		  	// 		$("#downloadj").click(function() {
		  	// 			is_rm = false;
					// });            		
               	},			
			});
		}
		return false;
	};

	var load_table = function(table_url, data_sent) {
		$.ajax({
			url: (table_url),
			cache: false,
			dataType: "html",
			async: false,
			type: "POST",
			data: data_sent,
			success: function(response) {
				$("#table-header").html(response);
			}

		});
	};

	var initial_tab = function(tab_id) {
		var tab_list = {
			character: {example1: '我', example2: '饥', placeholder: '單字...'},
			phone: {example1: 'ㄓㄥˋ', example2: 'wǒ', placeholder: '字音...'},
			part: {example1: '糹', example2: '糹丩', placeholder: '部件...'}
		};

		var ex_list = ['example1', 'example2'];

		document.getElementById("search-ch").value = "";
		var ph = eval("tab_list." + tab_id + ".placeholder");

		$('#search_type').val(tab_id);

		$(this).tab('show');
		$('#error-msg').html(['']);

		if (tab_id == "phone") $('#only-phone').show();
		else $('#only-phone').hide();

		$.map(ex_list, function(value_ex) {
			var ex = eval("tab_list." + tab_id + "." + value_ex);
			$('button[id=' + value_ex + ']').html(ex);

			$('#' + value_ex).click(function(){
				document.getElementById("search-ch").value = ex;
			});
		});	 
		$("#search-ch").attr("placeholder", ph);
	};

	var rm_file = function() {
		if ($("input[name=rm_tmp]").val())
		{
			$.ajax({
				url: ('pages/rm_file'),
				cache: false,
				dataType: "html",
				type: "POST",
				data: {rm_name: $("input[name=rm_tmp]").val()},
				success: function(response) {
					$("#rm_tmp").html('');
				}

			});
		}
	};

	window.PageSearch = {
	
		initialize: function() {
			var data_sent = {};
			var files;

			if ($('#active-type').attr('class'))
			{
				var tab_id = $('#active-type').attr('class');
		  		$("#downloadc").click(function() {
		  			is_rm = false;
				});
		  // 		$("#downloadj").click(function() {
		  // 			is_rm = false;
				// }); 
			}
			else
			{
				var tab_id = "character";
				$('#only-phone').hide();
			}

			$('#result-tab').hide();
			$("a#" + tab_id).parent("li").addClass("active");

			initial_tab(tab_id);

			$("#file-0a").fileinput({
				'allowedFileExtensions' : ['txt']
			});

		    $(".nav-tabs a").click(function(){
		    	tab_id = $(this).attr('id');
		    	$('#result-tab').fadeOut();
		    	$('#result-download').fadeOut();
		    	initial_tab(tab_id);
		    });

			$( "#search-ch" ).keypress(function( event ) {
			  if ( event.which == 13 ) {
			     event.preventDefault();
			  }
			});

			$("#validate").click(function() {
               		$(".overlay").css("display", "block");
               		$(".loading-img").css("display", "block");    					
					if (tab_id == "phone")
					{
						var ph_radio = $("input[type=radio]:checked").val();
						data_sent = {ph_table: ph_radio};
					}

					rm_file();
					load_table("pages/" + tab_id, data_sent);
					load_data("asyncs/get" + tab_id, data_sent);
			});

			$(window).bind('beforeunload', function(){
				if (is_rm)
				{
					rm_file();
				}
				is_rm = true;
			})
		}
	};
	
})(window);


$(document).ready(function() {
	window.PageSearch.initialize();
});
