

$(function(){
	/*var aLi=$('.listUl').children();
	var aUl=$(aLi).find('ul');
	var offOn=true;
	for(i=0;i<aLi.length;i++){
		$(aLi).eq(i).find('h3').click(function(){
			if(offOn){
				$(this).addClass('active');
				offOn=false;
				$(aUl).eq(i).show();
			}else{
				$(this).removeClass('active');
				offOn=true;
				$(this).find('ul').hide();
			}
		})	
	}*/
	
	$('.listUl').attr('id','list');
	var oUl = document.getElementById('list');
	var aH3 = oUl.getElementsByTagName('h3');
	var aUl = oUl.getElementsByTagName('ul');	
	
	for(var i=0; i<aH3.length; i++){
		aH3[i].index = i;
		aH3[i].onclick = function(){
			for(var i=0; i<aH3.length; i++){ 
				if(aH3[i] != this){
					aH3[i].className = '';
					aUl[i].style.display = 'none';
				}	
			}
			if(this.className == ''){	
				this.className = 'active';
				aUl[this.index].style.display = 'block';
			}else{
				this.className = '';
				aUl[this.index].style.display = 'none';	
			}
				
		}
	}

})

$(function(){
	
	var oUl = document.getElementById('list');
	var aH3 = oUl.getElementsByTagName('h3');
	var aUl = oUl.getElementsByTagName('ul');	
	
	for(var i=0; i<aH3.length; i++){
		aH3[i].index = i;
		aH3[i].onclick = function(){
			for(var i=0; i<aH3.length; i++){ 
				if(aH3[i] != this){
					aH3[i].className = '';
					aUl[i].style.display = 'none';
				}	
			}
			if(this.className == ''){	
				this.className = 'active';
				aUl[this.index].style.display = 'block';
			}else{
				this.className = '';
				aUl[this.index].style.display = 'none';	
			}
				
		}
	}

})
