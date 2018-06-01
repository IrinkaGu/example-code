var changeDateByDatepick = false;
(function ($) {
    var originalVal = $.fn.val;
    $.fn.val = function (value) {
        var res = originalVal.apply(this, arguments);

        if (this.is('input:text') && arguments.length >= 1) {
            this.trigger("input");
        }

        return res;
    };


    // ќтдельна€ инициализаци€ datepicker'ов. ƒл€ инициализации полей динамически добавл€емого контента
    $.fn.initDatepicker = function() {
        $(this).datepick({
            dateFormat: 'dd.mm.yyyy',
            showOnFocus: true,
            showTrigger: '#calImg',
            showAnim: 'fadeIn',
            onSelect: function() {
                inputDatepicker(this);
            }
        });
        return false;
    };

    $.fn.initTabsSwitch = function() {
        $(this).click(function (){
            if ($(this).hasClass("change_diagram")){
                $(this).closest(".switch_box").find(".diagram_box").slideDown("slow");
                $(this).closest(".switch_box").find(".table_box").slideUp("slow");
            }

            if ($(this).hasClass("change_table")){
                $(this).closest(".switch_box").find(".table_box").slideDown("slow");
                $(this).closest(".switch_box").find(".diagram_box").slideUp("slow");
            }
        });
    };
})(jQuery);

/***
 number - исходное число
 decimals - количество знаков после разделител€
 dec_point - символ разделител€
 thousands_sep - разделитель тыс€чных
 ***/
function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
            .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

// —охранение таблиц в xls
function saveTable(elem) {
	var htmlTable = '',
	    title = '',
        dateCur = $(elem).closest('.switch_box').find('.datepick-comp').val()
            || $(elem).closest('.switch_box').find('.datepick-comp').text()
            || $(elem).closest('.component-block').find('.datepick-comp').val()
            || $(elem).closest('.shadow-block').find('.datepick-comp').val(),
        unit = '≈диница измерени€: тыс. руб.',
        tableHeadRefact = '<thead>',
        tableBodyRefact = '<tbody>';
    // -------------------------------
    //ƒл€ случае когда в tableDiv несколько таблиц выбираем только ту, у которой нет display=none и строки с €чейками
    // выбираем по такому же принципу
	$(elem).closest('.switch_box').find('.table_box').find('.tableDiv table').each(function() {
       if($(this).css('display') !== 'none') {
           htmlTable = '<table>' + $(this).html() + '</table>';
           var table = $.parseHTML($(this).html());
           $.each( table, function( i, el ) {
               if (el.tagName === 'THEAD' || el.tagName === 'TBODY') {
                   var trLines = '';
                   $(el).find('tr').each(function() {
                       if ($(this).css('display') !== 'none') {
                           if (this.attributes.length) {
                               trLines += '<tr ';
                               $.each(this.attributes, function () {
                                   if (this.specified) {
                                       trLines += ' ' + this.name + '="' + this.value + '"';
                                   }
                               });
                               trLines += '>';
                           } else {
                               trLines += '<tr>';
                           }
                           var tagCell = el.tagName === 'THEAD' ? 'th' : 'td';
                           var tdHTML = $(this).find(tagCell).filter(function () {
                               return $(this).css("display") != "none" && typeof $(this).attr('data-exclude') === 'undefined';
                           });

                           tdHTML.each(function () {
                               trLines += $(this).prop('outerHTML');
                           });
                           trLines += '</tr>';
                       }
                   });
                   if (el.tagName === 'THEAD') {
                       tableHeadRefact += trLines;
                   } else {
                       tableBodyRefact += trLines;
                   }
               }

           });
       }
    });
    tableHeadRefact += '</thead>';
    tableBodyRefact += '</tbody>';
    htmlTable = htmlTable.replace(/<thead[^>]*>([\s\S]*?)<\/thead>/, tableHeadRefact);
    htmlTable = htmlTable.replace(/<tbody[^>]*>([\s\S]*?)<\/tbody>/, tableBodyRefact);
    // -------------------------------

    var tableBody = htmlTable.match(/<tbody[^>]*>([\s\S]*?)<\/tbody>/);
    tableBody = tableBody[0];
    htmlTable = htmlTable.replace(/<tbody[^>]*>([\s\S]*?)<\/tbody>/, tableBody);

    if ($(elem).closest('.switch_box').find('h3.page__title').length
        || $(elem).closest('.switch_box').find('h4.page__title').length
    ) {
        title = $(elem).closest('.switch_box').find('h3.page__title').length
            ? $(elem).closest('.switch_box').find('h3.page__title').text()
            : $(elem).closest('.switch_box').find('h4.page__title').text();
    } else if ($(elem).closest('.shadow-block').find('h4.page__title').length
        || $(elem).closest('.component-block').find('h4.page__title').length
    ) {
       title = $(elem).closest('.component-block').find('h4.page__title').length
        ? $(elem).closest('.component-block').find('h4.page__title').text()
        : $(elem).closest('.shadow-block').find('h4.page__title').text()
    }
    if ($(elem).closest('.switch_box').find('.table_box').find('.page__subtitle').length) {
        unit = $(elem).closest('.switch_box').find('.table_box').find('.page__subtitle').text();
    } else if ($(elem).closest('.shadow-block').find('.table_box').find('.page__subtitle').length
        || $(elem).closest('.component-block').find('.table_box').find('.page__subtitle').length
    ) {
        unit = $(elem).closest('.component-block').find('.table_box').find('.page__subtitle').length
            ? $(elem).closest('.component-block').find('.table_box').find('.page__subtitle').text()
            : $(elem).closest('.shadow-block').find('.table_box').find('.page__subtitle').text()
    }
   	$.post('/fileXlsDownload.php',
        {
            'html': htmlTable,
            'title': typeof title !== 'undefined' ? title.replace("\r\n", '') : '',
            'subtitle': typeof dateCur !== 'undefined' ? 'ƒанные на ' + dateCur : '',
            'unit': unit
        },
        function(t) {
            t = t.replace(/\s+/g, '');
            var a = document.createElement("a");
            a.href = t;
            document.body.appendChild(a);
            a.click();
	});
}

// »зменение даты в datepicker'ах
function inputDatepicker(elem) {

    if ($(elem).hasClass('datepick-comp')) {
        var thElem = elem;
        if ($(thElem).parent('form').length) {
            var tab = 'diagram_box';
            if ($(thElem).closest('.' + $(thElem).attr('data-parent')).find('.table_box').not('.static-table').is(':visible')) {
                tab = 'table_box';
            }
            $(thElem).closest('.' + $(thElem).attr('data-parent')).find('.table_box').slideUp();
            if ($(thElem).closest('.' + $(thElem).attr('data-parent')).find('.diagram_box').is(':visible')) {
                $(thElem).closest('.' + $(thElem).attr('data-parent')).find('.diagram_box').slideUp();
            }
            $(thElem).closest('.' + $(thElem).attr('data-parent')).find('.loading_box').slideDown(200);
            var url = $(thElem).parent('form').attr('action');
            var name = $(thElem).attr('name');
            var data = {};
            if ($(thElem).closest('.diagram__toggle').find('.autocomplete_rev').length
                && $(thElem).closest('.diagram__toggle').find('.autocomplete_rev').attr('data-kbk') !== ''
				&& $(thElem).closest('.diagram__toggle').find('.autocomplete_rev').attr('data-kbk') !== 'null'
            ) {
                data['type_revenues'] = $(thElem).closest('.diagram__toggle').find('.autocomplete_rev').val();
                data['kbk'] = $(thElem).closest('.diagram__toggle').find('.autocomplete_rev').attr('data-kbk');
            }
            data[name] = $(thElem).val();
            data['ajax'] = 'Y';
			data['tab'] = tab;
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'html',
                success: function (html) {
                    $('.' + $(thElem).attr('data-parent')).detach();
                    $('.' + $(thElem).attr('data-after')).after(html);
                    if (typeof $.fn.styler !== 'undefined' && location.host.substr(0, 2) == 'm.') {
                        $('select').styler();
                    }
                    $(thElem).closest('.' + $(thElem).attr('data-parent')).find('.loading_box').slideUp(200, function() {
                        if (!$(thElem).closest('.' + $(thElem).attr('data-parent')).find('.' + tab).is(':visible')) {
                            var parentElem = undefined;
                            if (tab === 'diagram_box') {
                                $('.change_diagram').each(function() {
                                    parentElem = $(this).closest('.component-block').length
                                        ? $(this).closest('.component-block') : $(this).closest('.shadow-block');
                                    if (parentElem.hasClass($(thElem).attr('data-parent'))) {
                                        $(this).trigger('click');
                                    }
                                });
                            } else if (tab === 'table_box') {
                                $('.change_table').each(function() {
                                    parentElem = $(this).closest('.component-block').length
                                        ? $(this).closest('.component-block') : $(this).closest('.shadow-block');
                                    if (parentElem.hasClass($(thElem).attr('data-parent'))) {
                                        $(this).trigger('click');
                                    }
                                });
                            }
                        }
                    });
                }
            });
        }
    }
}

$(document).ready( function (){
	$(".diagram__toggle .switch label").click(function (){
		if ($(this).hasClass("change_diagram")){
			$(this).closest(".switch_box").find(".diagram_box").slideDown("slow");
			$(this).closest(".switch_box").find(".table_box").slideUp("slow");
		}

		if ($(this).hasClass("change_table")){
			$(this).closest(".switch_box").find(".table_box").slideDown("slow");
			$(this).closest(".switch_box").find(".diagram_box").slideUp("slow");
		}
	});	

	// ќбработка нажати€ на ссылки скачивани€ таблиц в Excel.
	$('.container').on('click', 'a', function() {
        if ($(this).hasClass('btn-download')) {
            saveTable(this);
        }
    });

	// »зменение значений в select'ах которые вместо одного datepicker'a (т.е. выбор года или мес€ца с числом)
    $('.container').on('change', 'select', function() {
        if ($(this).hasClass('sel-for-datepick')) {
            var year = $(this).closest('.container-dtpick-selects').find('.year-datepick').length
                ? $(this).closest('.container-dtpick-selects').find('.year-datepick').val() : (new Date()).getFullYear();
            var dayMonth = $(this).closest('.container-dtpick-selects').find('.daymonth-datepick').length
                ? $(this).closest('.container-dtpick-selects').find('.daymonth-datepick').val() : '01-01';
            $(this).closest('.container-dtpick-selects').find('input.datepick-comp').val(year + '-' + dayMonth);
            inputDatepicker($(this).closest('.container-dtpick-selects').find('input.datepick-comp'));
        }
    });

	// »зменение значений в datepicker'ах
    // $("input").bind('input', inputDatepicker);
});







