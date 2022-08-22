/*=========================================================================================
  File Name: footer.js
  Description: Template footer js.
==========================================================================================*/

//Check to see if the window is top if not then display button
$(document).ready(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 400) {
			$('.scroll-top').fadeIn();
		} else {
			$('.scroll-top').fadeOut();
		}
	});

	//Click event to scroll to top
	$('.scroll-top').click(function () {
		$('html, body').animate({
			scrollTop: 0
		}, 1000);
	});

	//select2
    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%',
        language: "fa"
    });


    //ajax data select2 products
   /* $(".select2-data-ajax-products").select2({
        dropdownAutoWidth: true,
        width: '100%',
        language: "fa",
        ajax: {
            url: "/dashboard/products-search",
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term,
                };
            },
            processResults: function (data, params) {
                return {
                    results: data.items,
                };
            },
        },
        placeholder: 'نام یک محصول را جستجو کنید',
        escapeMarkup: function (markup) {
            return markup;
        },
        minimumInputLength: 1,
        templateResult: formatRepo_title,
        templateSelection: formatRepoSelection_title
    });

    function formatRepo_title(repo) {
        if (repo.loading) return repo.text;

        var markup = "<div class='select2-result-repository clearfix'>" + repo.fa_title + "</div>";

        return markup;
    }
    function formatRepoSelection_title(repo) {
        return repo.fa_title;
    }*/

    //ajax data select2 users
    $(".select2-data-ajax-users").select2({
        dropdownAutoWidth: true,
        width: '100%',
        language: "fa",
        ajax: {
            url: "http://localhost:8000/dashboard/users-search",
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term,
                };
            },
            processResults: function (data, params) {
                return {
                    results: data.items,
                };
            },
        },
        placeholder: 'ایمیل کاربر را جستجو کنید',
        escapeMarkup: function (markup) {
            return markup;
        },
        minimumInputLength: 1,
        templateResult: formatRepo_email,
        templateSelection: formatRepoSelection_email
    });

    function formatRepo_email(repo) {
        if (repo.loading) return repo.text;

        var markup = "<div class='select2-result-repository clearfix'>" + repo.email + "</div>";

        return markup;
    }
    function formatRepoSelection_email(repo) {
        return repo.email;
    }
});
