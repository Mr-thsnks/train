window.onload = function () {
    $('.back3').hover(function () {
        $(this).addClass('active');
        $(this).find('ul').show();
    }, function () {
        $(this).removeClass('active');
        $(this).find('ul').hide();
    })
    $('.mainA_tit').find('li').eq(0).find('a').click(function () {
        $('.mainA_tit').find('li').eq(0).find('a').css('color', '#666');
        $(this).css('color', '#ff9c00');
    })
    $('.mainA_tit').find('li').eq(1).find('a').click(function () {
        $('.mainA_tit').find('li').eq(1).find('a').css('color', '#666');
        $(this).css('color', '#ff9c00');
    })
    $('.mainA_cont').find('ul').eq(0).find('li').click(function () {
        $('.mainA_cont').find('ul').eq(0).find('li').removeClass('active');
        $(this).addClass('active');
    })

}
$(function () {
    $('.listUl').attr('id', 'list');
    var oUl = document.getElementById('list');
    var aH3 = oUl.getElementsByTagName('h3');
    var aUl = oUl.getElementsByTagName('ul');
    for (var i = 0; i < aH3.length; i++) {
        aH3[i].index = i;
        aH3[i].onclick = function () {
            for (var i = 0; i < aH3.length; i++) {
                if (aH3[i] != this) {
                    aH3[i].className = '';
                    aUl[i].style.display = 'none';
                }
            }
            if (this.className == '') {
                this.className = 'active';
                aUl[this.index].style.display = 'block';
            } else {
                this.className = '';
                aUl[this.index].style.display = 'none';
            }

        }
    }

})
$(function () {
    var oUl = document.getElementById('list');
    var aH3 = oUl.getElementsByTagName('h3');
    var aUl = oUl.getElementsByTagName('ul');
    for (var i = 0; i < aH3.length; i++) {
        aH3[i].index = i;
        aH3[i].onclick = function () {
            for (var i = 0; i < aH3.length; i++) {
                if (aH3[i] != this) {
                    aH3[i].className = '';
                    aUl[i].style.display = 'none';
                }
            }
            if (this.className == '') {
                this.className = 'active';
                aUl[this.index].style.display = 'block';
            } else {
                this.className = '';
                aUl[this.index].style.display = 'none';
            }

        }
    }

})