SmartCore = {
	main : function () {
		SmartCore.libs.gallery.init();
		SmartCore.libs.scrollBar.init();
		$('.ctgr').on ('click', SmartCore.constructor.templates.catClick);
		$('.ctgrList').on ('click', SmartCore.constructor.templates.openCatList);
	},
	globals : {
		latOpenedSubCat : undefined
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
				if (SmartCore.globals.latOpenedSubCat != undefined) {
					SmartCore.globals.latOpenedSubCat.prev ('.ctgrList').removeClass('opened').addClass('closed');
					SmartCore.globals.latOpenedSubCat.hide();
				}
				var $this = $(this);
				SmartCore.globals.latOpenedSubCat = $this.next ('.subcategories');
				$this.removeClass('closed').addClass('opened');
				SmartCore.globals.latOpenedSubCat.show ();
			}
		}
	}
};