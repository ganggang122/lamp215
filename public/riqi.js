function getYear(){
  			var yearNode = document.getElementById("year");
  			//创建年，从1900年到现在
  			var minYear = 1950;
  			var maxYear = new Date().getFullYear()+50;
			
  			for(var i=minYear;i<=maxYear;i++){
  				//创建Option
  				var opt = document.createElement("option");
  				//设置option标签体
  				opt.innerHTML=i;
  				opt.value=i;
  				//添加节点
  				yearNode.appendChild(opt);
  			}
  		}
  		
  		//创建月
  		function getMonth(){
  		 //创建option 
  			var monthNode = document.getElementById("month");
  			for(var i=1;i<=12;i++){
  				var opt = document.createElement("option");
  				//设置option标签体
  				if(i<10){
  					opt.innerHTML="0"+i;
  					opt.value=i;
  				}else {
  					opt.innerHTML=i;
  					opt.value=i;
  				}
  				monthNode.appendChild(opt);
  			}
  			month.onchange=getDay();
  			
  		}
  		//创建天
  		// 大月1 3 5 7 8 10 12 ,小月4 6 9 11    闰年2月 非闰年的2月
  		function getDay(){
  			clear();
  			//获取年
  			var year = document.getElementById("year").value;
  			//获取月
  			var month = document.getElementById("month").value;
  			//判断
  			if(year ==""){
  				alert("请选择年！");
  				return;
  			}
  			if(month == ""){
  				alert("请选择月！");
  				return;
  			}
  			//获取天的select
  			var day = document.getElementById("day");
  			//一个月至少有28天
  			for(var i=1;i<=28;i++){
  				var opt = document.createElement("option");
  				if(i<10){
  					opt.innerHTML="0"+i;
  					opt.value=i;
  				}else{
  					opt.innerHTML=i;
  					opt.value=i;
  				}
  				day.appendChild(opt);
  			}
  			//大月  1 3 5 7 8 10 12
  			var isBigMonth = month ==1 || month ==3 || month ==5 || month ==7 || month ==8 ||
  			month == 10 || month ==12;
  			//小月 4 6 9 11
  			var isSmallMonth = month==4 || month ==6 || month ==9 || month ==12;
  			//闰年  可以整除4 但不能整除100，或者年份可以整除400
  			var isLeapYear = (year % 4 == 0 && year % 100 != 0) || year %  400 == 0;
  			 //判断如果是大月加3天
  			 if(isBigMonth){
  			 	for(var i=29;i<=31;i++){
  			 		var opt = document.createElement("option");
  			 		opt.innerHTML=i;
  			 		opt.value=i;
  			 		day.appendChild(opt);
  			 		//如果是小月加两天
  			 		}
	  			 		}else if(isSmallMonth){
	  			 		for(var i=29;i<30;i++){
	  			 			var opt = document.createElement("option");
	  			 			opt.innerHTML=i;
	  			 			opt.value=i;
	  			 			day.appendChild(opt);
	  			 			//闰年加一天
	  			 			}
			  			 		}else if(isLeapYear){
			  			 		var opt = document.createElement("option");
			  			 		opt.innerHTML=29;
			  			 		opt.value=29;
			  			 		day.appendChild(opt);
			  			 		}
			  			 }
	function clear(){
		var day = document.getElementById("day");
		var optarr = day.childNodes;
		for(var i = optarr.length-1;i >= 0;i--){
			day.removeChild(optarr[i]);
		}
	}
	function getBirthday(){
		getYear();
		getMonth();
	}
	

