$(document).ready(function() {
	let $btnSearch          = $("#btn-search");
	let $btnClearSearch	    = $("#btn-clear");

	let $inputSearchField   = $("#search-field");
	let $inputSearchValue   = $("#search-value");

	let $inputPerPage       = $("#per-page");
	let $inputPage          = $("#page");
	let $fieldToFilters     = $("#field-to-filter");

    //Cap nhat val cua hidden input search field/type
	$("a.select-field").click(function(e) {
		e.preventDefault();
		let field = $(this).data('field');
    	$inputSearchField.val(field);
	});

    $inputSearchValue.on('keypress', function (e) {
        if(e.which === 13){
           $(this).attr("disabled", "disabled"); //Disable textbox to prevent multiple submit
           executeSearch(); //Do Stuff, submit, etc..
           //$(this).removeAttr("disabled"); //Enable the textbox again if needed.
        }
    });

	$btnSearch.on('click', function () {
        executeSearch();
	});

	$inputPerPage.on('change', function () {
        executeSearch();
	});

    function executeSearch(){
        let perPage     = $inputPerPage.find('option:selected').val();
        let page        = $inputPage.val();
        let searchField = $inputSearchField.find('option:selected').val();
        let searchValue = $inputSearchValue.val();
        let fieldToFilters = $fieldToFilters.val();

		let link		= "";
		var pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);
		let params      = (fieldToFilters) ? fieldToFilters : [];

		$.each( params, function( key, value ) {
			if (searchParams.has(value) ) {
				link += value + "=" + searchParams.get(value) + "&"
			}
		});

        let queryParams = new URLSearchParams(link);

        if (searchValue) {
            queryParams.set('searchField', searchField);
            queryParams.set('searchValue', searchValue.replace(/\s+/g, '+').toLowerCase());
        }

        if (perPage) {
            queryParams.set('perPage', perPage);
        }

        if (page) {
            queryParams.set('page', page);
        }

        window.location.href = `${pathname}?${queryParams.toString()}`;
    }

	$btnClearSearch.click(function() {
		window.location.href = window.location.pathname + "?clearSearch=1";
	});

	// $selectChangeAttrAjax.on('change', function() {
	// 	let selectValue = $(this).val();
	// 	let $url = $(this).data('url');
	// 	let csrf_token = $("input[name=csrf-token]").val();

	// 	$.ajax({
	// 		url : $url.replace('value_new', selectValue),
	// 		type : "GET",
	// 		dataType: "json",
	// 		headers: {'X-CSRF-TOKEN': csrf_token},
	// 		success : function (result){
	// 			if(result) {
	// 				$.notify({
	// 					message: "Cập nhật giá trị thành công!"
	// 				}, {
	// 					delay: 500,
	// 					allow_dismiss: false
	// 				});
	// 			}else {
	// 				console.log(result)
	// 			}
	// 		}
	// 	});

	// });
});
