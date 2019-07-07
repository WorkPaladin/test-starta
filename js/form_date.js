//Подсветка выбранной даты
$('table').on('click', '.day_color', function () {
	//Если выбранная не занята то при клике подсвечиваем ячейку
	if(!$(this).hasClass("reserved_date")) {
    	$('td').not($(this).toggleClass('click')).removeClass('click');
    	$(".error").text("");
	}
	else {
		$(".error").text("Выбранная дата уже занята!");
	}
});


    // Добавляем новую запись, когда произошел клик по кнопке
    $("#send").click(function (e) {

        e.preventDefault();

        //Проверяем введен ли номер
        if($('[name = "tel"]').val()==="") {
            $(".error").text("Введите номер!");
            return false;
        }
        else 
        	$(".error").text("");

        //Проверяем выбрана ли дата
        if(!$(".calendar_day").hasClass("click")) {
        	$(".error").text("Выберите дату!");
            return false;
        }
        else {
        	var calendar_day = $('.click').attr('data-day');
        	$(".error").text("");
        }

    	year = new Date().getFullYear();
		var rez_date = new Date(year, 0, calendar_day);

        var myData = "phone=" + $('[name = "tel"]').val() + "&day=" + calendar_day + "&date=" + rez_date; //передаваемые данные
        
        jQuery.ajax({
            type: "POST", 
            url: "http://zadanie/php/response.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос
            data:myData, //данные, которые будут отправлены на сервер (post переменные)
            success:function(response){
            $("#result").text("");
            $("#result").append(response);
            $('[name = "tel"]').val(''); //очищаем текстовое поле после успешной вставки
            $(".click").addClass("reserved_date");
            $(".reserved_date").removeClass("click");
            $("#responds, .background").css('display', 'flex');
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
    });


    //Подстветка зарезервированных дат
    $(document).ready(function() {

    	//Получаем строку с занятыми днями
    	var rez_days = $(".reserved_days").text();
    	//Удаляем последний символ так как он - ','
    	var rez_days_new = rez_days.substring(0, rez_days.length - 1);
    	//Преобразуем строку в массив
		var arr = rez_days_new.split(',');
		//Запрещаем выбирать уже занятые числа
		for(var i = 0; i < arr.length; i++) {
			$('[data-day = ' + arr[i] + ']').addClass("reserved_date");
		}

		$(".background").click(function(){
			$(this).css('display','none');
			$("#responds").css('display','none');
		});

	}); 