let URL_BASE="/messenger";

$(document).ready(
		function(){
			updateTheme();
			let UpTheme = setInterval(()=> updateTheme(),1000);
			updateDialog();
			let UpDialog = setInterval(()=> updateDialog(),1000);
			updateAccess();
			let UpAccess = setInterval(()=> updateAccess(),1000);
		});


let st_butt = document.querySelector('#saveTheme');

	if(st_butt!==null){
					st_butt.onclick = function () {
						let ImgElement = document.querySelector('#avatar');
						let ThemeElement = document.querySelector('[name=theme]');
						let ChatElement = document.querySelector('[name=chat_name]');
						let AvatarElement = document.querySelector('[name=avatar]').files[0];

						let formData = new FormData;
						formData.append('id', ThemeElement.value);
						formData.append('chat_name', ChatElement.value);
						if(AvatarElement!=""){
	    					formData.append('avatar', AvatarElement);
	    					}
						$.ajax({
							type: 'POST',
							url:URL_BASE+"/theme/updatelog",
							data: formData,
		        			processData: false,
		        			contentType: false,
		        			dataType: "json",
							success: function( data ){
							ChatElement.value=data[1];
							if(data['avatar']!=null)
								ImgElement.src=URL_BASE+"/"+data['avatar'][0];
							}
						});
					};
	}

	let send_butt = document.querySelector('#sendMess');

	if(send_butt!==null){
					send_butt.onclick = function () {
						let MessElement = document.querySelector('[name=message]');
						let IdElement = document.querySelector('[name=idm]');

						let formData = new FormData;
						formData.append('id', IdElement.value);
						formData.append('mess', MessElement.value);
						$.ajax({
							type: 'POST',
							url:URL_BASE+"/dialog/send",
							data: formData,
		        			processData: false,
		        			contentType: false,
							success: function( data ){
							}
						});}}

let invite_butt = document.querySelector('#outchat');

	if(invite_butt!==null){
					invite_butt.onclick = function () {
						$("#inchat").removeClass("selected");
						$("#outchat").addClass("selected");
						let IdElement = document.querySelector('[name=theme]');

						let formData = new FormData;
						formData.append('id', IdElement.value);
						$.ajax({
							type: 'POST',
							url:URL_BASE+"/cabinet/notmemberlist",
							data: formData,
		        			processData: false,
		        			contentType: false,
							dataType: "json",
							success: function( data ){
							let i=0;
							let options="";
							$(".mail_list").empty();
							$(".mail_list").prepend("<hr id=\"end_id\">");
						if(data!=null){
						for(i=0;i<data.length;i++){
								$("#end_id").before(
					"<div class=\"mail_dialog\">"+
                       "<img src=\""+URL_BASE+data[i][4]+"\" class=\"mail_photo\">\n"+
                       "<div>\n"+
                           "<div class=\"row mail_hat\">\n"+
                               "<p>"+data[i][1]+"</p>\n"+
                               "<input type=\"hidden\" name=\"id\" value=\""+data[i][0]+"\">\n"+
                               "<div class=\"mail_right\">"+
                               "<a onclick=\"updateOutList("+data[i][0]+")\"><i class=\"fas fa-plus-circle\"></i></a>"+
                               "</div>\n"+
                           "</div>\n"+
                       "</div>\n"+
                   "</div>\n"
    								);
								}}
							}
						});}}

	function updateOutList(id){

						let IdElement = document.querySelector('[name=theme]');

						let formData = new FormData;
						formData.append('id', IdElement.value);
						formData.append('oid', id);
						$.ajax({
							type: 'POST',
							url:URL_BASE+"/cabinet/notmemberadd/0",
							data: formData,
		        			processData: false,
		        			contentType: false,
							dataType: "json",
							success: function( data ){
							let i=0;
							let options="";
							$(".mail_list").empty();
							$(".mail_list").prepend("<hr id=\"end_id\">");
							if(data!=null){
						for(i=0;i<data.length;i++){
								$("#end_id").before(
					"<div class=\"mail_dialog\">"+
                       "<img src=\""+URL_BASE+data[i][4]+"\" class=\"mail_photo\">\n"+
                       "<div>\n"+
                           "<div class=\"row mail_hat\">\n"+
                               "<p>"+data[i][1]+"</p>\n"+
                               "<input type=\"hidden\" name=\"id\" value=\""+data[i][0]+"\">\n"+
                               "<div class=\"mail_right\">"+
                               "<a href=\"#\" onclick=\"updateOutList("+data[i][0]+")\"><i class=\"fas fa-plus-circle\"></i></a>"+
                               "</div>\n"+
                           "</div>\n"+
                       "</div>\n"+
                   "</div>\n"
    								);
								}}
							}

	});
					}

	let chat_butt = document.querySelector('#inchat');

	if(chat_butt!==null){
					chat_butt.onclick = function () {
						$("#outchat").removeClass("selected");
						$("#inchat").addClass("selected");
						let IdElement = document.querySelector('[name=theme]');
						let formData = new FormData;
						formData.append('id', IdElement.value);
						$.ajax({
							type: 'POST',
							url:URL_BASE+"/cabinet/memberlist",
							data: formData,
		        			processData: false,
		        			contentType: false,
		        			dataType: "json",
							success: function( data ){
							let i=0;
							let options="";
							$(".mail_list").empty();
							$(".mail_list").prepend("<hr id=\"end_id\">");
						for(i=0;i<data.length;i++){

							switch(data[i][9]){
									case '1': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-spinner\"></i>\n"+
                                					"</a>\n";break;
									case '2': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-user\"></i>\n"+
                                					"</a>\n"+
                                					"<a onclick=\"updateInList("+data[i][0]+",1)\">\n"+
                                   					"<i class=\"fas fa-thumbs-up\" ></i>\n"+
                                					"</a>\n";break;
									case '3': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fas fa-crown\"></i>\n"+
                                					"</a>\n"+
                                					"<a onclick=\"updateInList("+data[i][0]+",2)\">\n"+
                                   					"<i class=\"fas fa-thumbs-down\" ></i>\n"+
                                					"</a>\n";break;
                                	case '4': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-pen-fancy\"></i>\n"+
                                					"</a>\n";break;
								}

								$("#end_id").before(
					"<div class=\"mail_dialog\">"+
                       "<img src=\""+URL_BASE+data[i][4]+"\" class=\"mail_photo\">\n"+
                       "<div>\n"+
                           "<div class=\"row mail_hat\">\n"+
                               "<p>"+data[i][1]+"</p>\n"+
                               "<input type=\"hidden\" name=\"id\" value=\""+data[i][0]+"\">\n"+
                               "<div class=\"mail_right\">"+
                               options+
                               "<a href=\"#\"><i class=\"fas fa-times-circle\"></i></a>"+
                               "</div>\n"+
                           "</div>\n"+
                       "</div>\n"+
                   "</div>\n"
    								);
								}
							}
						});}}

	function updateInList(id,option){
						let IdElement = document.querySelector('[name=theme]');

						let formData = new FormData;
						formData.append('id', IdElement.value);
						formData.append('oid', id);
						$.ajax({
							type: 'POST',
							url:URL_BASE+"/cabinet/memberadd/"+option,
							data: formData,
		        			processData: false,
		        			contentType: false,
							dataType: "json",
							success: function( data ){
								console.log(data);
							let i=0;
							let options="";
							$(".mail_list").empty();
							$(".mail_list").prepend("<hr id=\"end_id\">");
						for(i=0;i<data.length;i++){

							switch(data[i][9]){
									case '1': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-spinner\"></i>\n"+
                                					"</a>\n";break;
									case '2': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-user\"></i>\n"+
                                					"</a>\n"+
                                					"<a onclick=\"updateInList("+data[i][0]+",1)\">\n"+
                                   					"<i class=\"fas fa-thumbs-up\" ></i>\n"+
                                					"</a>\n";break;
									case '3': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fas fa-crown\"></i>\n"+
                                					"</a>\n"+
                                					"<a onclick=\"updateInList("+data[i][0]+",2)\">\n"+
                                   					"<i class=\"fas fa-thumbs-down\" ></i>\n"+
                                					"</a>\n";break;
                                	case '4': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-pen-fancy\"></i>\n"+
                                					"</a>\n";break;
								}

								$("#end_id").before(
					"<div class=\"mail_dialog\">"+
                       "<img src=\""+URL_BASE+data[i][4]+"\" class=\"mail_photo\">\n"+
                       "<div>\n"+
                           "<div class=\"row mail_hat\">\n"+
                               "<p>"+data[i][1]+"</p>\n"+
                               "<input type=\"hidden\" name=\"id\" value=\""+data[i][0]+"\">\n"+
                               "<div class=\"mail_right\">"+
                               options+
                               "<a href=\"#\"><i class=\"fas fa-times-circle\"></i></a>"+
                               "</div>\n"+
                           "</div>\n"+
                       "</div>\n"+
                   "</div>\n"
    								);
								}
							}

	});
					}


function del_butt(id){
		let formData = new FormData;
		formData.append('id', id);
		$.ajax({
			type: 'POST',
			url:URL_BASE+"/theme/dellog",
			data: formData,
		    processData: false,
		    contentType: false,
		    success: function( data ){
		    }
	});}

function updateTheme(){
	let chat_zone = document.querySelector('#chats_main');
	if(chat_zone!==null){
		let formData = new FormData;
		formData.append('id', "");
					$.ajax({
						type: 'POST',
						url:URL_BASE+"/main/updateTheme",
						data: formData,
					    processData: false,
					    contentType: false,
		        		dataType: "json",
						success: function(data){
							let i=0;
							let control="";
							let chat="";
							$(".mail_all").empty();
							$(".mail_all").prepend("<hr id=\"hr_id\">");

						for(i=0;i<data.length;i++){
								if(data[i]['creator']==1){
									control="<p class=\"mail_right\">\n"+
                      							"<a  href=\"#\" class=\"list_a\" onclick=\"del_butt("+data[i][0]+")\">\n"+
                        							"<i  class=\"fas fa-trash-restore\"></i>\n"+
                      							"</a>\n"+
							                    "<a  href=\""+URL_BASE+"/theme/index/"+data[i][0]+"\" class=\"list_a\">\n"+
							                        "<i class=\"fas fa-cog\"></i>\n"+
							                    "</a>\n"+
                    						"</p>";
								}

								if(data[i]['mess']!==undefined){
										chat="<div class=\"row mail_hat\"><p class=\"mail_message\">"+
										data[i]['mess'][6]+" : "+data[i]['mess'][3]+"</p>\n"+
										"<p class=\"mail_date\">"+data[i]['mess'][5]+"</p></div>\n";
									}
								else
									chat="<p class=\"mail_message\">Начните общение сейчас!</p>";

								$("#hr_id").before(
									"<hr>\n"+
										"<a href=\""+URL_BASE+"/dialog/index/"+data[i][0]+"\">"+
       									"<div class=\"mail_dialog mail_theme\">\n" +
	           								"<img src=\""+URL_BASE+data[i][3]+"\" class=\"mail_photo\">\n" +
	           									"<div>\n"+
	               									"<div class=\"row mail_hat\">\n"+
	                   									"<p>Чат: "+data[i][2]+"</p>\n"+
	                   									control+
	               									"</div>\n"+
		               								chat+
	           									"</div>\n"+
           								"</div>\n"+
           								"</a>"
    								);
								}
						}});
				}
			}

function updateDialog(){
	let dialog_zone = document.querySelector('#dialog_main');
	if(dialog_zone!==null){
			let formData = new FormData;
			let IdElement = document.querySelector('[name=idm]');

			formData.append('id',IdElement.value);
					$.ajax({
						type: 'POST',
						url:URL_BASE+"/dialog/updateDialog",
						data: formData,
					    processData: false,
					    contentType: false,
		        		dataType: "json",
						success: function(data){
							let i=0;
							let control="";
							let line="";
							$(".mail_all").empty();
							$(".mail_all").prepend("<hr id=\"hr_id\">");
							console.log(data);
						for(i=0;i<data.length;i++){
							if(i>0){
								if(data[i-1][1]!=data[i][1])
									line="<hr>";
								else
									line="";
							}
								$("#hr_id").before(
									line+
									"<div class=\"mail_dialog "+data[i]['me']+"\">\n"+
            							"<img src="+URL_BASE+data[i][7]+" class=\"mail_photo\">\n"+
            							"<div>\n"+
                							"<div class=\"row mail_hat\">\n"+
                    							"<p>"+data[i][6]+"</p>\n"+
                    							"<p class=\"mail_date\">"+data[i][5]+"</p>\n"+
               								"</div>\n"+
                						"<p class=\"mail_message\">"+data[i][3]+"</p>\n"+
            							"</div>\n"+
       								"</div>"
    								);
								}
						}});
	}
}

function updateAccess(){
	let dialog_zone = document.querySelector('#cabinet_main');
	if(dialog_zone!==null){
			let formData = new FormData;
					$.ajax({
						type: 'POST',
						url:URL_BASE+"/cabinet/listaccess",
						data: formData,
					    processData: false,
					    contentType: false,
		        		dataType: "json",
						success: function(data){
							console.log(data);
							let i=0;
							let options="";

							$(".cab_history").empty();
							$(".cab_history").prepend("<input type=\"hidden\" id=\"theme_flag\">");
							if(data.length>0){
								
							for(i=0;i<data.length;i++){
								switch(data[i][4]){
									case '1': options="<a onclick=\"UpAccess("+data[i][1]+")\">\n"+
                                   					"<i class=\"fas fa-plus-circle\"></i>\n"+
                                					"</a>\n";break;
									case '2': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-user\"></i>\n"+
                                					"</a>\n";break;
									case '3': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fas fa-crown\"></i>\n"+
                                					"</a>\n";break;
								}
								

								$("#theme_flag").before(
									"<div class=\"mail_dialog\">\n"+
                       					"<img src=\""+URL_BASE+data[i][7]+"\" class=\"mail_photo\">\n"+
                       					"<div>\n"+
                           					"<div class=\"row mail_hat\">\n"+
                               					"<p>Чат: "+data[i][6]+"		(Создатель: "+data[i][5]+")</p>\n"+
                               					"<input type=\"hidden\" name=\"ida\" value=\""+data[i][1]+"\">\n"+
                               					"<div class=\"mail_right\">\n"+
                               						options+
                               					"<a onclick=\"DenAccess("+data[i][1]+")\"><i class=\"fas fa-times-circle\"></i></a>"+
                               					"</div>"+
                          					 "</div>"+
                       					"</div>"+
                   					"</div>\n");
													}}
						else							
							$("#theme_flag").before("<p class=\"cab_his cab_fio\"> Нет приглашений в чаты </p>");
						}});
	}
}

function UpAccess(id){
	let dialog_zone = document.querySelector('#cabinet_main');
	if(dialog_zone!==null){
			let formData = new FormData;
			formData.append('id',id);
					$.ajax({
						type: 'POST',
						url:URL_BASE+"/cabinet/upaccess",
						data: formData,
					    processData: false,
					    contentType: false,
		        		dataType: "json",
						success: function(data){
							console.log(data);
							let i=0;
							let options="";

							$(".cab_history").empty();
							$(".cab_history").prepend("<input type=\"hidden\" id=\"theme_flag\">");
							if(data.length>0){
								
							for(i=0;i<data.length;i++){
								switch(data[i][4]){
									case '1': options="<a onclick=\"UpAccess("+data[i][1]+")\">\n"+
                                   					"<i class=\"fas fa-plus-circle\"></i>\n"+
                                					"</a>\n";break;
									case '2': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-user\"></i>\n"+
                                					"</a>\n";break;
									case '3': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fas fa-crown\"></i>\n"+
                                					"</a>\n";break;
								}
								

								$("#theme_flag").before(
									"<div class=\"mail_dialog\">\n"+
                       					"<img src=\""+URL_BASE+data[i][7]+"\" class=\"mail_photo\">\n"+
                       					"<div>\n"+
                           					"<div class=\"row mail_hat\">\n"+
                               					"<p>Чат: "+data[i][6]+"		(Создатель: "+data[i][5]+")</p>\n"+
                               					"<input type=\"hidden\" name=\"ida\" value=\""+data[i][1]+"\">\n"+
                               					"<div class=\"mail_right\">\n"+
                               						options+
                               					"<a onclick=\"DenAccess("+data[i][1]+")\"><i class=\"fas fa-times-circle\"></i></a>"+
                               					"</div>"+
                          					 "</div>"+
                       					"</div>"+
                   					"</div>\n");
													}}
						else							
							$("#theme_flag").before("<p class=\"cab_his cab_fio\"> Нет приглашений в чаты </p>");
						
						}});
	}						
}

function DenAccess(id){
	let dialog_zone = document.querySelector('#cabinet_main');
	if(dialog_zone!==null){
			let formData = new FormData;
			formData.append('id',id);
					$.ajax({
						type: 'POST',
						url:URL_BASE+"/cabinet/denaccess",
						data: formData,
					    processData: false,
					    contentType: false,
		        		dataType: "json",
						success: function(data){
							let i=0;
							let options="";

							$(".cab_history").empty();
							$(".cab_history").prepend("<input type=\"hidden\" id=\"theme_flag\">");
							if(data.length>0){
								
							for(i=0;i<data.length;i++){
								switch(data[i][4]){
									case '1': options="<a onclick=\"UpAccess("+data[i][1]+")\">\n"+
                                   					"<i class=\"fas fa-plus-circle\"></i>\n"+
                                					"</a>\n";break;
									case '2': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fa-user\"></i>\n"+
                                					"</a>\n";break;
									case '3': options="<a href=\"#\">\n"+
                                   					"<i class=\"fas fas fa-crown\"></i>\n"+
                                					"</a>\n";break;
								}
								

								$("#theme_flag").before(
									"<div class=\"mail_dialog\">\n"+
                       					"<img src=\""+URL_BASE+data[i][7]+"\" class=\"mail_photo\">\n"+
                       					"<div>\n"+
                           					"<div class=\"row mail_hat\">\n"+
                               					"<p>Чат: "+data[i][6]+"		(Создатель: "+data[i][5]+")</p>\n"+
                               					"<input type=\"hidden\" name=\"ida\" value=\""+data[i][1]+"\">\n"+
                               					"<div class=\"mail_right\">\n"+
                               						options+
                               					"<a onclick=\"DenAccess("+data[i][1]+")\"><i class=\"fas fa-times-circle\"></i></a>"+
                               					"</div>"+
                          					 "</div>"+
                       					"</div>"+
                   					"</div>\n");
													}}
						else							
							$("#theme_flag").before("<p class=\"cab_his cab_fio\"> Нет приглашений в чаты </p>");
						
						}});
	}						
}