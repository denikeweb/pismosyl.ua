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
				$('.ctgr').removeClass('active');
				$(this).addClass('active');
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
            var target = '#one';
            $('html, body').animate({scrollTop: $(target).offset().top}, 300);
        }
    }
};