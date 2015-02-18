SmartCore = {
	main : function () {
		SmartCore.libs.gallery.init();
		SmartCore.libs.scrollBar.init();
		$('.ctgr').on ('click', SmartCore.constructor.templates.catClick);
		$('.ctgrList').on ('click', SmartCore.constructor.templates.openCatList);
        SmartCore.navigation.menuAnimation();
	},
	globals : {
		lastOpenedSubCat : undefined
	},
	libs : {
		scrollBar : {
			init : function () {
				$('.scrollbar-inner').scrollbar();
			}
		},
		gallery : {
			init : function () {
				$('.photoSetPic').colorbox({rel:'.photoSetPic'});
				$('.pictureSB').colorbox({rel:'.pictureSB'});
				$('.pictureC').colorbox({rel:'.pictureC'});
			}
		}
	},
	constructor : {
		templates : {
			catClick : function () {
				var $this = $(this),
					dataId = $this.attr ('data-id'),
					thisCatGroup = $('.catGroup.id' + dataId);
				$('.ctgr').removeClass('active');
				$this.addClass('active');
				$('.catGroup').addClass('hidden');
				thisCatGroup.removeClass('hidden');
			},
			openCatList : function () {
				var $this = $(this),
					thisCat = $this.next ('.subcategories'),
					isReturn = false;
				if ($this.hasClass('opened')) isReturn = true;
				if (SmartCore.globals.lastOpenedSubCat != undefined) {
					SmartCore.globals.lastOpenedSubCat.prev ('.ctgrList').removeClass('opened').addClass('closed');
					SmartCore.globals.lastOpenedSubCat.hide();
				}
				if (isReturn) return;
				SmartCore.globals.lastOpenedSubCat = thisCat;
				$this.removeClass('closed').addClass('opened');
				SmartCore.globals.lastOpenedSubCat.show ();
			}
		}
    },
    navigation : {
        menuAnimation : function(){
	        $('.to-about').on('click', function () {
		        var target = '.aboutBg';
		        $('html, body').animate({scrollTop: $(target).offset().top}, 300);
	        });

            $('.to-warranty').on('click', function () {
                var target = '.warranty';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-constructor').on('click', function () {
                var target = '.constructor';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-contacts').on('click', function () {
                var target = 'footer';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-samples').on('click', function () {
                var target = '.photos';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-process').on('click', function () {
                var target = '.steps';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-package').on('click', function () {
                var target = '.packages';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });
        }
    },
    testAndriy: {
        ajaxTest: function() {
            var sendData = 'action=GetText&id=1';
            $.ajax({
                url: '//' + document.domain + '/ajax',
                type: 'GET',
                timeout: 5000,
                data: sendData,
                success : function (msg) {
                    var response = msg;
                    console.log(response);
                }
            });
			return;
        }
    }
};