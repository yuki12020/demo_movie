function func(movie_id) {
	//movie_idに固有のIDが送信される
	console.log(movie_id);
	console.log("#ajax_"+movie_id);
    //二回クリックで送信の原因は
	//下記のonclickイベントとタグ内関数のonclickの二回記述により二重クリックが必要になっていた
	//$("#ajax_"+movie_id).on("click", function() {		
        $.get(//送信先URL
		"js.php",
		//"./../class/indexClass.php",
		{css : movie_id	},	
		//送信先URLで処理されたデータが返ってくる。そのデータをspanタグに反映される
		function(data) {
			//console.log(data.match("red"));
				if(data.match("red")){				
					$("#ajax_"+movie_id).css('color','rgb(255,0,0)');
					$("#ajax_"+movie_id).text("✔");
				}else if(data.match("blue")){					
					//$("#ajax_"+movie_id).css('background','rgb(0,255,0)');					
					$("#ajax_"+movie_id).css('color','rgb(0,0,255)');
					$("#ajax_"+movie_id).text("✘");
				}
			$("#span").text(data);
			//$("#span").text("167y981b");
			
			console.log(data);
			}				
		);    
	//});
};


//background-color change
$(function(){
    var nowchecked = $('input[name=bgc]:checked').val();
    var color="";
	console.log(nowchecked);
	
	$('input[name=bgc]').click(function(){
        if($(this).val() == nowchecked) {
            $(this).prop('checked', false);
			nowchecked = false;
			console.log("チェック外す");
			var element = document.getElementById("table"); 
			element.style.backgroundColor = '#ffffff'; 
			        
		} else {
			nowchecked = $(this).val();
			console.log("チェック");
			var element = document.getElementById("table"); 
			element.style.backgroundColor = '#696969'; 						
			//$("#table").css(' background-color','rgb(255,0,0)');
						
		}
    });
});

// $(function() {
    // var mail = '';
    // var name = '';

    // //**** 初期処理 ****
    // (function (){
        // // 初期処理でセッション情報を取得　getItem内のuser_emailがid名
        // mail = window.sessionStorage.getItem(['user_email']);        
        // name = window.sessionStorage.getItem(['user_name']);

        // if(mail!=null && name !=null){
			// //id="result"にafter（）内のhtmlタグを反映させる
            // $('#result').after('<div id="submit_result" class="section__block section__block--notification"><p>メール:'+mail+'</br>名前  :'+name+'</br>セッション情報を保持しています。</p></div>');             
        // }

    // })();

    // // 登録ボタン押下イベント　inputタグid="submit"をクリックすると、onClickSubmitを発火する
    // $('#submit').click(onClickSubmit);
    // //登録ボタン押下処理
    // function onClickSubmit(){
        // $('#submit_result').remove();
        // mail = $('#user_mail').val();
        // name = $('#user_name').val();

        // if(mail!='' && name !=''){

            // //セッションストレージ開始
            // window.sessionStorage.setItem(['user_email'],[mail]);
            // window.sessionStorage.setItem(['user_name'],[name]); 

            // //セッション登録完了メッセージ
            // $('#result').after('<div id="submit_result" class="section__block section__block--notification"><p>メール:'+mail+'</br>名前  :'+name+'</br>セッション情報に登録しました。</p></div>');            

        // }else{
            // //登録失敗メッセージ
            // $('#result').after('<div id="submit_result" class="section__block section__block--notification-red"><p>メールアドレス・名前を入力してください。</p></div>');            
        // }
    // }
// });

// $(function() {
	// var element  = '';
	// var bc='';
    // //**** 初期処理 **** session setした値を初期に呼び出す
    // (function (){
        // // 初期処理でセッション情報を取得getItem(['セットアイテムで設定したキー値'])
		// element  = window.sessionStorage.getItem(['element']);
		// console.log(element);	
    // })();

    // // 登録ボタン押下イベント　inputタグid="submit"をクリックすると、onClickSubmitを発火する
    // // $('#submit').click(onClickSubmit);
    // // //登録ボタン押下処理
    // // function onClickSubmit(){
			// // element = document.getElementById("table"); 
			// // element=element.style.backgroundColor = '#fff000'; 
			// // console.log(element);			
            // // //セッションストレージ開始
			// // window.sessionStorage.setItem(['element'],[element]); 			
    // // }
	// var nowchecked = $('input[name=bg]:checked').val();	
	// $('#submit').click(function(){
		// if($(this).val() == nowchecked){
			// $(this).prop('checked', false);
			// nowchecked = false;
			// console.log("1");
			// element = document.getElementById("table"); 
			// element=element.style.backgroundColor = '#fff'; 
			// console.log(element);			
            // //セッションストレージ開始
			// window.sessionStorage.setItem(['element'],[element]);
		// } else {
			// nowchecked = $(this).val();
			// console.log("2");
			// element = document.getElementById("table"); 
			// element=element.style.backgroundColor = '#696969'; 
			// console.log(element);			
            // //セッションストレージ開始
			// window.sessionStorage.setItem(['element'],[element]);
		// }
    // });
		
// });


$(function() {
	var element  = '';
	var bc='';
    //**** 初期処理 **** session setした値を初期に呼び出す
    (function (){
        // 初期処理でセッション情報を取得getItem(['セットアイテムで設定したキー値'])
		element  = window.sessionStorage.getItem(['element']);
		console.log(element);
		window.addEventListener('load', function(element) {
		  console.log('リンゴ');
		  console.log(element);
		})
		//down script that is error
		//element.style.backgroundColor = '#fff';		
    })();

	var nowchecked = $('input[name=bg]:checked').val();	
	$('#submit').click(function(){
		if($(this).val() == nowchecked){
			$(this).prop('checked', false);
			nowchecked = false;
			console.log("1");
			element = document.getElementById("table"); 
			element=element.style.backgroundColor = '#fff'; 
			console.log(element);			
            //セッションストレージ開始
			window.sessionStorage.setItem(['element'],[element]);
		} else {
			nowchecked = $(this).val();
			console.log("2");
			element = document.getElementById("table"); 
			element=element.style.backgroundColor = '#696969'; 
			console.log(element);			
            //セッションストレージ開始
			window.sessionStorage.setItem(['element'],[element]);
		}
    });
		
});
