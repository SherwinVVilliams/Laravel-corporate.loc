jQuery(document).ready(function($){
	$('.commentlist li').each(function(i){
		$(this).find('div.commentNumber').text('#'+ (i+1));
		// для нумерації коментарів
	});

	$('#commentform').on('click', '#submit', function(e){

		e.preventDefault();//відміннили стандартне поведення
		var comParent = $(this);//данні кнопки

		$('.wrap_result').css('color', 'green').text('Сохранение коментария').fadeIn(500,function(){
		//fadeIn відповідає за появлення блока появлення задається в
		// мілі секундах

			var data = $('#commentform').serializeArray();// повертаєм содержиме форми в вигляді массиву

			$.ajax({
				url: $('#commentform').attr('action'),
				data: data,
				type: "POST",
				datatype: "JSON",
				headers: { "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')},
				success: function(html){
					if(html.error){
						//якщо повернули помилку, тобто користувач не пройшов валідацію тощо
						$('.wrap_result').css('color' , 'red').append('<br><strong> ОШИБКА:  </strong>' + html.error.join('<br>'));
						$('.wrap_result').delay(2000).fadeOut(500);
					}
					else if(html.success){
						//звертаємось до блока який зявляеться після натиснення на кнопку і передаємо йому деякий текст і ефекти
						$('.wrap_result').append('<br><strong>Cохраненно</strong>').delay(2000).fadeOut(500, function(){
							//якщо в данних які ми передали parent_id > 0  ми формуємо відповідний вивід під коментарем
							if(html.data.parent_id > 0){
								comParent.parents('div#respond').prev().after("<ul class = 'children'>"+html.comment+"</ul>");
							}
							else{
									//код добавлення коментаря в якого немає родітєля
									$('ol.commentlist').append(html.comment);
							}
							$('#cancel-comment-reply-link').click();
						});
					}
				},
				error: function(){
					$('.wrap_result').css('color', 'red').append('<br><strong> ОШИБКА </strong>');
					$('.wrap_result').delay(2000).fadeOut(500, function(){
						$('#cancel-comment-reply-link').click();
					});
				},
			});

		});

	});
	
});

